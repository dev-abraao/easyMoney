<x-layout>
    <div class="max-w-7xl mx-auto p-6">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-4">
                <h1 class="text-3xl font-bold text-white font-oswald">My Expenses</h1>
                <button onclick="openExpenseModal()" 
                        class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg transition-colors duration-200 flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <span>Add Expense</span>
                </button>
            </div>
            <p class="text-gray-400">{{ $currentMonth }}</p>
        </div>

        <!-- Month Statistics -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <!-- Total Month Expenses -->
            <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
                <p class="text-gray-400 text-sm mb-2">Total This Month</p>
                <p class="text-2xl font-bold text-red-400">${{ number_format($totalMonthExpenses, 2) }}</p>
            </div>

            <!-- Month Cash Expenses -->
            <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
                <p class="text-gray-400 text-sm mb-2">Cash (This Month)</p>
                <p class="text-2xl font-bold text-orange-400">${{ number_format($totalMonthCash, 2) }}</p>
            </div>

            <!-- Month Card Expenses -->
            <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
                <p class="text-gray-400 text-sm mb-2">Card (This Month)</p>
                <p class="text-2xl font-bold text-purple-400">${{ number_format($totalMonthCard, 2) }}</p>
            </div>

            <!-- Active Installments -->
            <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
                <p class="text-gray-400 text-sm mb-2">Active Installments</p>
                <p class="text-2xl font-bold text-blue-400">{{ $activeInstallments->count() }}</p>
            </div>
        </div>

        <!-- Overall Statistics -->
        <div class="bg-gray-800 rounded-lg p-6 border border-gray-700 mb-8">
            <h2 class="text-xl font-bold text-white mb-4">Overall Statistics</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <p class="text-gray-400 text-sm mb-1">Total Expenses (All Time)</p>
                    <p class="text-white font-semibold text-lg">${{ number_format($totalExpenses, 2) }}</p>
                </div>
                <div>
                    <p class="text-gray-400 text-sm mb-1">Cash Expenses (All Time)</p>
                    <p class="text-orange-400 font-semibold text-lg">${{ number_format($totalCashExpenses, 2) }}</p>
                </div>
                <div>
                    <p class="text-gray-400 text-sm mb-1">Card Expenses (All Time)</p>
                    <p class="text-purple-400 font-semibold text-lg">${{ number_format($totalCardExpenses, 2) }}</p>
                </div>
            </div>
        </div>

        <!-- Tabs for Expenses -->
        <div class="bg-gray-800 rounded-lg border border-gray-700">
            <div class="border-b border-gray-700">
                <div class="flex">
                    <button onclick="showTab('cash')" 
                            id="tab-cash" 
                            class="px-6 py-4 text-white font-semibold border-b-2 border-green-500 transition-colors">
                        Cash Expenses ({{ $cashExpenses->count() }})
                    </button>
                    <button onclick="showTab('card')" 
                            id="tab-card" 
                            class="px-6 py-4 text-gray-400 font-semibold border-b-2 border-transparent hover:text-white transition-colors">
                        Card Expenses ({{ $cardExpenses->count() }})
                    </button>
                </div>
            </div>

            <!-- Cash Expenses Tab -->
            <div id="content-cash" class="p-6">
                @if($cashExpenses->isEmpty())
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <p class="text-gray-400 text-lg">No cash expenses found</p>
                        <p class="text-gray-500 text-sm mt-2">Cash expenses are paid directly from your balance</p>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach($cashExpenses as $expense)
                            <div class="bg-gray-700 rounded-lg p-4 border border-gray-600 hover:bg-gray-650 transition-all">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2 mb-2">
                                            <div class="w-2 h-2 bg-orange-500 rounded-full"></div>
                                            <span class="text-orange-400 text-xs font-semibold uppercase">
                                                {{ $expense->type->name }}
                                            </span>
                                            <span class="text-gray-500 text-xs">• Cash Payment</span>
                                        </div>
                                        <p class="text-white font-medium mb-1">{{ $expense->description }}</p>
                                        <p class="text-red-400 font-bold text-lg">${{ number_format($expense->amount, 2) }}</p>
                                    </div>
                                    <div class="text-right flex flex-col items-end">
                                        <p class="text-gray-400 text-sm mb-2">{{ \Carbon\Carbon::parse($expense->date)->format('M d, Y') }}</p>
                                        <form action="{{ route('user-expense.destroy', $expense) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    onclick="return confirm('Are you sure you want to delete this expense?')"
                                                    class="text-gray-400 hover:text-red-400 transition-colors duration-200 p-2 rounded-lg hover:bg-gray-600">
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

            <!-- Card Expenses Tab -->
            <div id="content-card" class="p-6 hidden">
                @if($cardExpenses->isEmpty())
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                        <p class="text-gray-400 text-lg">No card expenses found</p>
                        <p class="text-gray-500 text-sm mt-2">Card expenses are paid through your credit cards</p>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach($cardExpenses as $expense)
                            <div class="bg-gray-700 rounded-lg p-4 border border-gray-600 hover:bg-gray-650 transition-all">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2 mb-2">
                                            <div class="w-2 h-2 bg-purple-500 rounded-full"></div>
                                            <span class="text-purple-400 text-xs font-semibold uppercase">
                                                {{ $expense->type->name }}
                                            </span>
                                            @if($expense->card)
                                                <span class="text-gray-500 text-xs">• {{ $expense->card->name }}</span>
                                            @endif
                                        </div>
                                        <p class="text-white font-medium mb-1">{{ $expense->description }}</p>
                                        <p class="text-red-400 font-bold text-lg">${{ number_format($expense->amount, 2) }}</p>
                                        
                                        @if($expense->info)
                                            <div class="mt-2 text-sm">
                                                <p class="text-gray-400">
                                                    Installment: {{ $expense->info->installments - $expense->info->remaining_installments + 1 }}/{{ $expense->info->installments }}
                                                    (${{ number_format($expense->info->installment_amount, 2) }}/month)
                                                </p>
                                                @if(!$expense->info->is_completed)
                                                    <p class="text-gray-400">
                                                        Next payment: {{ \Carbon\Carbon::parse($expense->info->next_due_date)->format('M d, Y') }}
                                                    </p>
                                                    <div class="w-full bg-gray-600 rounded-full h-2 mt-2">
                                                        <div class="bg-purple-500 h-2 rounded-full" 
                                                             style="width: {{ (($expense->info->installments - $expense->info->remaining_installments) / $expense->info->installments) * 100 }}%">
                                                        </div>
                                                    </div>
                                                @else
                                                    <p class="text-green-400 flex items-center gap-1 mt-1">
                                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                        </svg>
                                                        Completed
                                                    </p>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                    <div class="text-right flex flex-col items-end">
                                        <p class="text-gray-400 text-sm mb-2">{{ \Carbon\Carbon::parse($expense->date)->format('M d, Y') }}</p>
                                        <form action="{{ route('user-expense.destroy', $expense) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    onclick="return confirm('Are you sure you want to delete this expense?')"
                                                    class="text-gray-400 hover:text-red-400 transition-colors duration-200 p-2 rounded-lg hover:bg-gray-600">
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

    <script>
        function showTab(tabName) {
            // Hide all tabs
            document.getElementById('content-cash').classList.add('hidden');
            document.getElementById('content-card').classList.add('hidden');
            
            // Remove active state from all buttons
            document.getElementById('tab-cash').classList.remove('border-green-500', 'text-white');
            document.getElementById('tab-cash').classList.add('border-transparent', 'text-gray-400');
            document.getElementById('tab-card').classList.remove('border-green-500', 'text-white');
            document.getElementById('tab-card').classList.add('border-transparent', 'text-gray-400');
            
            // Show selected tab and activate button
            if (tabName === 'cash') {
                document.getElementById('content-cash').classList.remove('hidden');
                document.getElementById('tab-cash').classList.add('border-green-500', 'text-white');
                document.getElementById('tab-cash').classList.remove('border-transparent', 'text-gray-400');
            } else {
                document.getElementById('content-card').classList.remove('hidden');
                document.getElementById('tab-card').classList.add('border-green-500', 'text-white');
                document.getElementById('tab-card').classList.remove('border-transparent', 'text-gray-400');
            }
        }
    </script>
</x-layout>