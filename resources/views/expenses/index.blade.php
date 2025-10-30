<x-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 p-6">
        <div class="max-w-7xl mx-auto">
            
            <div class="mb-8">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h1 class="text-4xl font-bold text-white font-oswald mb-2 flex items-center gap-3">
                            <div class="bg-gradient-to-r from-purple-500 to-purple-600 p-3 rounded-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            My Expenses
                        </h1>
                        <p class="text-gray-400 ml-16">{{ $currentMonth }}</p>
                    </div>
                    
                    <button 
                        onclick="openExpenseModal()"
                        class="bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-gray-900 shadow-lg hover:shadow-purple-500/50 flex items-center gap-2 hover:scale-105 active:scale-95"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Add Expense
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="group bg-gradient-to-br from-gray-800 to-gray-850 rounded-xl p-6 border border-gray-700 hover:border-red-500/50 transition-all duration-300 hover:shadow-lg hover:shadow-red-500/10">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-red-600 rounded-lg flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                        </div>
                        <div class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></div>
                    </div>
                    <p class="text-gray-400 text-xs uppercase tracking-wide mb-2">Total This Month</p>
                    <p class="text-3xl font-bold text-white">${{ number_format($totalMonthExpenses, 2) }}</p>
                </div>

                <div class="group bg-gradient-to-br from-gray-800 to-gray-850 rounded-xl p-6 border border-gray-700 hover:border-orange-500/50 transition-all duration-300 hover:shadow-lg hover:shadow-orange-500/10">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div class="w-2 h-2 bg-orange-500 rounded-full animate-pulse"></div>
                    </div>
                    <p class="text-gray-400 text-xs uppercase tracking-wide mb-2">Cash (This Month)</p>
                    <p class="text-3xl font-bold text-white">${{ number_format($totalMonthCash, 2) }}</p>
                </div>

                <div class="group bg-gradient-to-br from-gray-800 to-gray-850 rounded-xl p-6 border border-gray-700 hover:border-purple-500/50 transition-all duration-300 hover:shadow-lg hover:shadow-purple-500/10">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                            </svg>
                        </div>
                        <div class="w-2 h-2 bg-purple-500 rounded-full animate-pulse"></div>
                    </div>
                    <p class="text-gray-400 text-xs uppercase tracking-wide mb-2">Card (This Month)</p>
                    <p class="text-3xl font-bold text-white">${{ number_format($totalMonthCard, 2) }}</p>
                </div>

                <div class="group bg-gradient-to-br from-gray-800 to-gray-850 rounded-xl p-6 border border-gray-700 hover:border-blue-500/50 transition-all duration-300 hover:shadow-lg hover:shadow-blue-500/10">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></div>
                    </div>
                    <p class="text-gray-400 text-xs uppercase tracking-wide mb-2">Active Installments</p>
                    <p class="text-3xl font-bold text-white">{{ $activeInstallments->count() }}</p>
                </div>
            </div>

            <div class="bg-gradient-to-br from-gray-800 to-gray-850 rounded-xl p-8 border border-gray-700 mb-8 shadow-lg">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-gradient-to-br from-gray-700 to-gray-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-white font-oswald">Overall Statistics</h2>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-gray-900/50 p-5 rounded-lg border border-gray-700/50">
                        <p class="text-gray-400 text-xs uppercase tracking-wide mb-2 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                            Total Expenses (All Time)
                        </p>
                        <p class="text-white font-bold text-2xl">${{ number_format($totalExpenses, 2) }}</p>
                    </div>
                    <div class="bg-gray-900/50 p-5 rounded-lg border border-gray-700/50">
                        <p class="text-gray-400 text-xs uppercase tracking-wide mb-2 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            Cash Expenses (All Time)
                        </p>
                        <p class="text-orange-400 font-bold text-2xl">${{ number_format($totalCashExpenses, 2) }}</p>
                    </div>
                    <div class="bg-gray-900/50 p-5 rounded-lg border border-gray-700/50">
                        <p class="text-gray-400 text-xs uppercase tracking-wide mb-2 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                            </svg>
                            Card Expenses (All Time)
                        </p>
                        <p class="text-purple-400 font-bold text-2xl">${{ number_format($totalCardExpenses, 2) }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-gray-800 to-gray-850 rounded-xl border border-gray-700 shadow-lg overflow-hidden">
                <div class="border-b border-gray-700">
                    <div class="flex">
                        <button 
                            onclick="showTab('cash')" 
                            id="tab-cash" 
                            class="flex-1 px-6 py-4 text-white font-semibold border-b-2 border-purple-500 transition-all duration-200 hover:bg-gray-700/50 flex items-center justify-center gap-2"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            Cash Expenses
                            <span class="bg-orange-600 text-white text-xs px-2 py-0.5 rounded-full">{{ $cashExpenses->count() }}</span>
                        </button>
                        <button 
                            onclick="showTab('card')" 
                            id="tab-card" 
                            class="flex-1 px-6 py-4 text-gray-400 font-semibold border-b-2 border-transparent hover:text-white transition-all duration-200 hover:bg-gray-700/50 flex items-center justify-center gap-2"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                            </svg>
                            Card Expenses
                            <span class="bg-purple-600 text-white text-xs px-2 py-0.5 rounded-full">{{ $cardExpenses->count() }}</span>
                        </button>
                    </div>
                </div>

                <div id="content-cash" class="p-6">
                    @if($cashExpenses->isEmpty())
                        <div class="flex flex-col items-center justify-center py-16 text-center">
                            <div class="w-20 h-20 bg-gradient-to-br from-gray-700 to-gray-600 rounded-full flex items-center justify-center mb-6 shadow-xl">
                                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-white mb-2">No cash expenses found</h3>
                            <p class="text-gray-400 mb-2">Cash expenses are paid directly from your balance</p>
                            <button 
                                onclick="openExpenseModal()"
                                class="mt-4 bg-gradient-to-r from-orange-600 to-orange-700 hover:from-orange-700 hover:to-orange-800 text-white font-semibold py-2 px-5 rounded-lg transition-all duration-200 shadow-lg hover:shadow-orange-500/50 flex items-center gap-2"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Add Cash Expense
                            </button>
                        </div>
                    @else
                        <div class="space-y-3">
                            @foreach($cashExpenses as $expense)
                                <div class="group bg-gray-700/50 rounded-lg p-5 border border-gray-600 hover:border-orange-500/50 transition-all duration-300 hover:shadow-lg hover:shadow-orange-500/10">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-2 mb-3">
                                                <div class="w-8 h-8 bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                                    </svg>
                                                </div>
                                                <span class="text-orange-400 text-xs font-semibold uppercase bg-orange-900/30 px-2 py-1 rounded-full">
                                                    {{ $expense->type->name }}
                                                </span>
                                                <span class="text-gray-500 text-xs">• Cash Payment</span>
                                            </div>
                                            <p class="text-white font-semibold mb-2 text-lg">{{ $expense->description }}</p>
                                            <p class="text-red-400 font-bold text-2xl">${{ number_format($expense->amount, 2) }}</p>
                                        </div>
                                        <div class="text-right flex flex-col items-end gap-3">
                                            <p class="text-gray-400 text-sm flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                {{ \Carbon\Carbon::parse($expense->date)->format('M d, Y') }}
                                            </p>
                                            <form action="{{ route('user-expense.destroy', $expense) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button 
                                                    type="submit" 
                                                    onclick="return confirm('Are you sure you want to delete this expense?')"
                                                    class="text-gray-400 hover:text-red-400 transition-all duration-200 p-2 rounded-lg hover:bg-gray-600 opacity-0 group-hover:opacity-100"
                                                >
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div id="content-card" class="p-6 hidden">
                    @if($cardExpenses->isEmpty())
                        <div class="flex flex-col items-center justify-center py-16 text-center">
                            <div class="w-20 h-20 bg-gradient-to-br from-gray-700 to-gray-600 rounded-full flex items-center justify-center mb-6 shadow-xl">
                                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-white mb-2">No card expenses found</h3>
                            <p class="text-gray-400 mb-2">Card expenses are paid through your credit cards</p>
                            <button 
                                onclick="openExpenseModal()"
                                class="mt-4 bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white font-semibold py-2 px-5 rounded-lg transition-all duration-200 shadow-lg hover:shadow-purple-500/50 flex items-center gap-2"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Add Card Expense
                            </button>
                        </div>
                    @else
                        <div class="space-y-3">
                            @foreach($cardExpenses as $expense)
                                <div class="group bg-gray-700/50 rounded-lg p-5 border border-gray-600 hover:border-purple-500/50 transition-all duration-300 hover:shadow-lg hover:shadow-purple-500/10">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-2 mb-3">
                                                <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                                    </svg>
                                                </div>
                                                <span class="text-purple-400 text-xs font-semibold uppercase bg-purple-900/30 px-2 py-1 rounded-full">
                                                    {{ $expense->type->name }}
                                                </span>
                                                @if($expense->card)
                                                    <span class="text-gray-500 text-xs flex items-center gap-1">
                                                        •
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                                        </svg>
                                                        {{ $expense->card->name }}
                                                    </span>
                                                @endif
                                            </div>
                                            <p class="text-white font-semibold mb-2 text-lg">{{ $expense->description }}</p>
                                            <p class="text-red-400 font-bold text-2xl mb-3">${{ number_format($expense->amount, 2) }}</p>
                                            
                                            @if($expense->info)
                                                <div class="bg-gray-800/50 rounded-lg p-4 border border-gray-700/50">
                                                    <div class="flex items-center justify-between mb-2">
                                                        <p class="text-gray-300 text-sm font-semibold">
                                                            Installment {{ $expense->info->installments - $expense->info->remaining_installments + 1 }}/{{ $expense->info->installments }}
                                                        </p>
                                                        <p class="text-purple-400 font-bold text-sm">
                                                            ${{ number_format($expense->info->installment_amount, 2) }}/month
                                                        </p>
                                                    </div>
                                                    
                                                    @if(!$expense->info->is_completed)
                                                        <p class="text-gray-400 text-xs mb-2 flex items-center gap-1">
                                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                            </svg>
                                                            Next: {{ \Carbon\Carbon::parse($expense->info->next_due_date)->format('M d, Y') }}
                                                        </p>
                                                        <div class="w-full bg-gray-700 rounded-full h-2">
                                                            <div 
                                                                class="bg-gradient-to-r from-purple-500 to-purple-600 h-2 rounded-full transition-all duration-500" 
                                                                style="width: {{ (($expense->info->installments - $expense->info->remaining_installments) / $expense->info->installments) * 100 }}%"
                                                            ></div>
                                                        </div>
                                                    @else
                                                        <div class="flex items-center gap-2 text-green-400">
                                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                            </svg>
                                                            <span class="font-semibold text-sm">Completed</span>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                        <div class="text-right flex flex-col items-end gap-3">
                                            <p class="text-gray-400 text-sm flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                {{ \Carbon\Carbon::parse($expense->date)->format('M d, Y') }}
                                            </p>
                                            <form action="{{ route('user-expense.destroy', $expense) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button 
                                                    type="submit" 
                                                    onclick="return confirm('Are you sure you want to delete this expense?')"
                                                    class="text-gray-400 hover:text-red-400 transition-all duration-200 p-2 rounded-lg hover:bg-gray-600 opacity-0 group-hover:opacity-100"
                                                >
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        function showTab(tabName) {
            document.getElementById('content-cash').classList.add('hidden');
            document.getElementById('content-card').classList.add('hidden');
            
            document.getElementById('tab-cash').classList.remove('border-purple-500', 'text-white');
            document.getElementById('tab-cash').classList.add('border-transparent', 'text-gray-400');
            document.getElementById('tab-card').classList.remove('border-purple-500', 'text-white');
            document.getElementById('tab-card').classList.add('border-transparent', 'text-gray-400');
            
            if (tabName === 'cash') {
                document.getElementById('content-cash').classList.remove('hidden');
                document.getElementById('tab-cash').classList.add('border-purple-500', 'text-white');
                document.getElementById('tab-cash').classList.remove('border-transparent', 'text-gray-400');
            } else {
                document.getElementById('content-card').classList.remove('hidden');
                document.getElementById('tab-card').classList.add('border-purple-500', 'text-white');
                document.getElementById('tab-card').classList.remove('border-transparent', 'text-gray-400');
            }
        }
    </script>
</x-layout>