<x-layout> 
    <div class="max-w-7xl mx-auto p-6">
        <div class="mb-8">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('cards.index') }}" class="text-gray-400 hover:text-green-400 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </a>
                    <h1 class="text-3xl font-bold text-white font-oswald">{{ $card->name }}</h1>
                    <span class="text-gray-400 font-mono text-lg">****{{ $card->last4 }}</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
                <p class="text-gray-400 text-sm mb-2">Credit Limit</p>
                <p class="text-2xl font-bold text-white">${{ number_format($card->limit, 2) }}</p>
            </div>

            <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
                <p class="text-gray-400 text-sm mb-2">Total Spent</p>
                <p class="text-2xl font-bold text-red-400">${{ number_format($totalSpent, 2) }}</p>
            </div>

            <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
                <p class="text-gray-400 text-sm mb-2">Remaining Limit</p>
                <p class="text-2xl font-bold {{ $remainingLimit >= 0 ? 'text-green-400' : 'text-red-400' }}">
                    ${{ number_format($remainingLimit, 2) }}
                </p>
            </div>

            <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
                <p class="text-gray-400 text-sm mb-2">Utilization</p>
                <p class="text-2xl font-bold {{ $utilizationPercentage > 80 ? 'text-red-400' : 'text-green-400' }}">
                    {{ number_format($utilizationPercentage, 1) }}%
                </p>
            </div>
        </div>

        <div class="bg-gray-800 rounded-lg p-6 border border-gray-700 mb-8">
            <h2 class="text-xl font-bold text-white mb-4">Card Details</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @if($card->closing_day)
                <div>
                    <p class="text-gray-400 text-sm mb-1">Closing Day</p>
                    <p class="text-white font-semibold">Day {{ $card->closing_day }}</p>
                </div>
                @endif

                @if($card->due_day)
                <div>
                    <p class="text-gray-400 text-sm mb-1">Due Day</p>
                    <p class="text-white font-semibold">Day {{ $card->due_day }}</p>
                </div>
                @endif

                <div>
                    <p class="text-gray-400 text-sm mb-1">Monthly Recurring</p>
                    <p class="text-red-400 font-semibold">${{ number_format($totalRecurring, 2) }}</p>
                </div>
            </div>
        </div>

        <div class="bg-gray-800 rounded-lg border border-gray-700">
            <div class="border-b border-gray-700">
                <div class="flex">
                    <button onclick="showTab('regular')" 
                            id="tab-regular" 
                            class="px-6 py-4 text-white font-semibold border-b-2 border-green-500 transition-colors">
                        Regular Expenses ({{ $regularExpenses->count() }})
                    </button>
                    <button onclick="showTab('recurring')" 
                            id="tab-recurring" 
                            class="px-6 py-4 text-gray-400 font-semibold border-b-2 border-transparent hover:text-white transition-colors">
                        Recurring Expenses ({{ $recurringExpenses->count() }})
                    </button>
                </div>
            </div>

            <div id="content-regular" class="p-6">
                @if($regularExpenses->isEmpty())
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                        <p class="text-gray-400 text-lg">No regular expenses found for this card</p>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach($regularExpenses as $expense)
                            <div class="bg-gray-700 rounded-lg p-4 border border-gray-600 hover:bg-gray-650 transition-all">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2 mb-2">
                                            <div class="w-2 h-2 bg-{{ $expense->type->color }}-500 rounded-full"></div>
                                            <span class="text-{{ $expense->type->color }}-400 text-xs font-semibold uppercase">
                                                {{ $expense->type->name }}
                                            </span>
                                        </div>
                                        <p class="text-white font-medium mb-1">{{ $expense->description }}</p>
                                        <p class="text-red-400 font-bold text-lg">${{ number_format($expense->amount, 2) }}</p>
                                        
                                        @if($expense->info)
                                            <div class="mt-2 text-sm">
                                                <p class="text-gray-400">
                                                    Installment: {{ $expense->info->total_installments - $expense->info->remaining_installments }}/{{ $expense->info->total_installments }}
                                                    (${{ number_format($expense->info->installment_amount, 2) }}/month)
                                                </p>
                                                @if(!$expense->info->is_completed)
                                                    <p class="text-gray-400">
                                                        Next payment: {{ \Carbon\Carbon::parse($expense->info->next_due_date)->format('M d, Y') }}
                                                    </p>
                                                @else
                                                    <p class="text-green-400">✓ Completed</p>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                    <div class="text-right">
                                        <p class="text-gray-400 text-sm">{{ \Carbon\Carbon::parse($expense->date)->format('M d, Y') }}</p>
                                        <form action="{{ route('user-expense.destroy', $expense) }}" method="POST" class="mt-2">
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

            <div id="content-recurring" class="p-6 hidden">
                @if($recurringExpenses->isEmpty())
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        <p class="text-gray-400 text-lg">No recurring expenses found for this card</p>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach($recurringExpenses as $expense)
                            <div class="bg-gray-700 rounded-lg p-4 border border-gray-600 hover:bg-gray-650 transition-all">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2 mb-2">
                                            <div class="w-2 h-2 bg-purple-500 rounded-full"></div>
                                            <span class="text-purple-400 text-xs font-semibold uppercase">
                                                {{ ucfirst($expense->frequency) }}
                                            </span>
                                        </div>
                                        <p class="text-white font-medium mb-1">{{ $expense->name }}</p>
                                        @if($expense->description)
                                            <p class="text-gray-400 text-sm mb-2">{{ $expense->description }}</p>
                                        @endif
                                        <p class="text-red-400 font-bold text-lg">${{ number_format($expense->rec_ex_amount, 2) }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-gray-400 text-sm">Next: {{ \Carbon\Carbon::parse($expense->next_due_date)->format('M d, Y') }}</p>
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
            document.getElementById('content-regular').classList.add('hidden');
            document.getElementById('content-recurring').classList.add('hidden');
            
            document.getElementById('tab-regular').classList.remove('border-green-500', 'text-white');
            document.getElementById('tab-regular').classList.add('border-transparent', 'text-gray-400');
            document.getElementById('tab-recurring').classList.remove('border-green-500', 'text-white');
            document.getElementById('tab-recurring').classList.add('border-transparent', 'text-gray-400');
            
            if (tabName === 'regular') {
                document.getElementById('content-regular').classList.remove('hidden');
                document.getElementById('tab-regular').classList.add('border-green-500', 'text-white');
                document.getElementById('tab-regular').classList.remove('border-transparent', 'text-gray-400');
            } else {
                document.getElementById('content-recurring').classList.remove('hidden');
                document.getElementById('tab-recurring').classList.add('border-green-500', 'text-white');
                document.getElementById('tab-recurring').classList.remove('border-transparent', 'text-gray-400');
            }
        }
    </script>
</x-layout>