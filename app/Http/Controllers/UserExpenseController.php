<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateExpenseRequest;
use App\Models\UserExpense;
use App\Models\ExpenseInfo;
use App\Models\Card;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Throwable;

class UserExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        
        // Pegar despesas do mês atual
        $startOfMonth = now()->startOfMonth();
        $endOfMonth = now()->endOfMonth();
        
        // Despesas regulares (todas e do mês)
        $allExpenses = $user->expenses()
            ->with(['type', 'card', 'info'])
            ->orderBy('date', 'desc')
            ->get();
            
        $monthExpenses = $user->expenses()
            ->with(['type', 'card', 'info'])
            ->whereBetween('date', [$startOfMonth, $endOfMonth])
            ->orderBy('date', 'desc')
            ->get();
        
        // Separar despesas por tipo de pagamento
        $cashExpenses = $allExpenses->whereNull('card_id');
        $cardExpenses = $allExpenses->whereNotNull('card_id');
        
        // Calcular estatísticas do mês
        $totalMonthExpenses = $monthExpenses->sum('amount');
        $totalMonthCash = $monthExpenses->whereNull('card_id')->sum('amount');
        $totalMonthCard = $monthExpenses->whereNotNull('card_id')->sum('amount');
        
        // Estatísticas gerais
        $totalExpenses = $allExpenses->sum('amount');
        $totalCashExpenses = $cashExpenses->sum('amount');
        $totalCardExpenses = $cardExpenses->sum('amount');
        
        // Despesas com parcelas ativas
        $activeInstallments = $allExpenses->filter(function($expense) {
            return $expense->info && !$expense->info->is_completed;
        });
        
        return view('expenses.index', [
            'cashExpenses' => $cashExpenses,
            'cardExpenses' => $cardExpenses,
            'totalMonthExpenses' => $totalMonthExpenses,
            'totalMonthCash' => $totalMonthCash,
            'totalMonthCard' => $totalMonthCard,
            'totalExpenses' => $totalExpenses,
            'totalCashExpenses' => $totalCashExpenses,
            'totalCardExpenses' => $totalCardExpenses,
            'activeInstallments' => $activeInstallments,
            'currentMonth' => now()->format('F Y'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateExpenseRequest $request)
    {
        // dd($request);
        
        try {
            $validated = $request->validated();
            $validated['user_id'] = auth()->id();
            $userBalance = auth()->user()->balance;


            if (!$userBalance) {
                throw ValidationException::withMessages(['error' => 'User has no balance available.']);
            }

            if ($validated['amount'] > $userBalance->balance_amount) {
                throw ValidationException::withMessages(['error' => 'Insufficient balance to cover this expense.']);
            }
            $createdExpense = DB::transaction(function () use ($validated, $userBalance) {

                $newExpense = UserExpense::create([
                    'user_id' => $validated['user_id'],
                    'expense_type_id' => $validated['expense_type_id'],
                    'description' => $validated['description'],
                    'amount' => $validated['amount'],
                    'card_id' => $validated['card_id'] ?? null,
                    'date' => $validated['date'],
                ]);

                if (isset($validated['card_id']) && isset($validated['installments']) && $validated['installments'] >= 2) {
                    ExpenseInfo::create([
                        'user_expense_id' => $newExpense->id,
                        'installments' => $validated['installments'],
                        'installment_amount' => $validated['amount'] / $validated['installments'],
                        'remaining_installments' => $validated['installments'],
                        'next_due_date' => $this->dueDate($validated['card_id']),
                        'is_completed' => false,
                    ]);
                }

                if (!isset($validated['card_id'])) {
                    $userBalance->balance_amount -= $newExpense->amount;
                    $userBalance->save();
                }

                return $newExpense;
            });

            if ($request->ajax()){
                return response()->json(['success' => true, 'message' => 'Expense created successfully.', 'data' => $createdExpense], 201);
            }

            return redirect()->back()->with('success', 'Expense created successfully.');
            
        } catch (ValidationException $e) {
            if ($request->ajax()){
                return response()->json(['success' => false, 'errors' => $e->errors()], 422);
            }
            return redirect()->back()->with('error', 'Something went wrong.')->withInput();
        } catch (Throwable $e) {
            if ($request->ajax()){
                return response()->json(['success' => false, 'errors' => 'An unexpected error occurred. Please try again later.'], 500);
            }
            return redirect()->back()->with('error', 'Something went wrong.')->withInput();
        }
    }

    private function dueDate($cardId){
        $card = Card::find($cardId);
        $currentDate = now();
        $dueDate = Carbon::createFromFormat('Y-m-d', $currentDate->year . '-' . $currentDate->month . '-' . $card->due_day);

        if ($currentDate->day > $card->closing_day) {
            $dueDate->addMonth();
        }

        return $dueDate->toDateString();
    }

    /**
     * Display the specified resource.
     */
    public function show(UserExpense $userExpense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserExpense $userExpense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserExpense $userExpense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserExpense $expense)
    {

        if (auth()->id() !== $expense->user_id) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        try {
            $userBalance = auth()->user()->balance;

            DB::transaction(function () use ($userBalance, $expense) {
                $userBalance->balance_amount += $expense->amount;
                $userBalance->save();
                $expense->delete();

            });
            return redirect()->back()->with('success', 'Expense deleted successfully.');
        } catch (Throwable $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again later.');
        }


    }
}
