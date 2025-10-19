<x-layout> 
    <div class="max-w-4xl mx-auto p-6">
        @if(session('error'))
            <div class="bg-red-900 border border-red-700 text-red-300 px-4 py-3 rounded-md text-sm mb-6">
                {{ session('error') }}
            </div>
        @endif

        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-white font-oswald mb-2">Recurring Expenses</h1>
            <p class="text-gray-400">Manage your fixed monthly expenses like rent, utilities, and subscriptions.</p>
        </div>

        <!-- Add Expense Form -->
        <div class="bg-gray-800 rounded-lg shadow-xl p-6 border border-gray-700 mb-8">
            <h2 class="text-xl font-bold text-white mb-6 font-oswald">Add New Recurring Expense</h2>
            
            <form action="{{ route('recurring.expenses.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name Input -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Expense Name</label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            value="{{ old('name') }}"
                            class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-colors" 
                            placeholder="e.g., Rent, Netflix, Internet" 
                            required
                        >
                        @error('name')
                            <div class="mt-2 text-red-400 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description Input -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-300 mb-2">Description</label>
                        <input 
                            type="text" 
                            id="description" 
                            name="description" 
                            value="{{ old('description') }}"
                            class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-colors" 
                            placeholder="Brief description of the expense"
                        >
                        @error('description')
                            <div class="mt-2 text-red-400 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Amount Input -->
                    <div>
                        <label for="rec_ex_amount" class="block text-sm font-medium text-gray-300 mb-2">Amount</label>
                        <x-amount 
                            id="rec_ex_amount" 
                            name="rec_ex_amount" 
                            class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-colors" 
                            submitButtonId="submit-recurring-expense" 
                            :validateBalance="false"
                        />
                        @error('rec_ex_amount')
                            <div class="mt-2 text-red-400 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Frequency Select -->
                    <div>
                        <label for="frequency" class="block text-sm font-medium text-gray-300 mb-2">Payment Frequency</label>
                        <select 
                            id="frequency" 
                            name="frequency" 
                            class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-colors"
                            required
                        >
                            <option value="" class="text-gray-400">Select frequency</option>
                            @foreach($frequencies as $frequency)
                                <option value="{{ $frequency->value }}" {{ old('frequency') == $frequency->value ? 'selected' : '' }} class="bg-gray-700 text-white">
                                    {{ ucfirst($frequency->value) }}
                                </option>
                            @endforeach
                        </select>
                        @error('frequency')
                            <div class="mt-2 text-red-400 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-span-2">
                        <div class="flex justify-between items-center mb-2">
                            <label for="card_id" class="block text-sm font-medium text-gray-300">
                                Card <span class="text-xs text-gray-200 bg-gray-600 rounded px-2 py-1 ml-1">Optional</span>
                            </label>
                            <button type="button" id="clear-card-btn" onclick="clearCard()" 
                            class="text-sm text-green-400 hover:text-green-300 disabled:text-gray-500 disabled:cursor-not-allowed transition-colors duration-200" disabled>
                                Clear
                            </button>
                        </div>
                        <select name="card_id" id="card_id" 
                        class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors">
                            <option value="" hidden disabled selected class="text-gray-400">Select a card</option>
                            @foreach($userCards as $card)
                                <option value="{{ $card->id }}" class="bg-gray-700 text-white">{{ $card->name }} - ({{ $card->last4 }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button 
                        type="submit" 
                        id="submit-recurring-expense"
                        class="bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-6 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-gray-800"
                    >
                        Add Expense
                    </button>
                </div>
            </form>
        </div>

        <!-- Expenses List -->
        <div class="space-y-4">
            <h2 class="text-xl font-bold text-white font-oswald mb-4">Your Recurring Expenses</h2>
            
            @forelse($recurringExpenses as $expense)
                <div class="bg-gray-800 rounded-lg shadow-lg p-6 border border-gray-700 hover:bg-gray-750 transition-all duration-200">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-3">
                                <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                                <h3 class="text-lg font-semibold text-white">{{ $expense->name }}</h3>
                                <span class="text-gray-400">{{ ucfirst($expense->frequency) }}</span>
                            </div>
                            
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 text-sm">
                                @if($expense->description)
                                <div>
                                    <p class="text-gray-400">Description</p>
                                    <p class="text-white">{{ $expense->description ?? 'N/A' }}</p>
                                </div>
                                @endif
                                <div>
                                    <p class="text-gray-400">Next Due</p>
                                    <p class="text-white">{{ Carbon\Carbon::parse($expense->next_due_date)->format('d/m/Y') ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-400">Amount</p>
                                    <div class="flex gap-1">
                                        <p class="text-red-400 font-semibold">${{ number_format($expense->rec_ex_amount, 2) }}</p>
                                        @if($expense->card)
                                            <p class="text-white">{{ $expense->card->name ?? 'N/A' }} <span class="text-xs text-gray-400">&#40;{{ $expense->card->last4 ?? '' }}&#41;</span></p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-2">
                            <button class="text-gray-400 hover:text-blue-400 transition-colors duration-200 p-2 rounded-lg hover:bg-gray-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="flex flex-col items-center justify-center py-12 text-center bg-gray-800 rounded-lg border border-gray-700">
                    <div class="w-16 h-16 bg-gray-700 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <p class="text-gray-400 text-lg mb-2">No recurring expenses found</p>
                    <p class="text-gray-500 text-sm">Add your first recurring expense to get started!</p>
                </div>
            @endforelse
        </div>
    </div>
</x-layout>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        const cardSelect = document.getElementById('card_id');
        const clearBtn = document.getElementById('clear-card-btn');

        function clearCard() {
            cardSelect.value = '';
            clearBtn.disabled = true;
        }
    
    cardSelect.addEventListener('change', function(){
        if(this.value != ""){
            clearBtn.disabled = false
        } else {
            clearBtn.disabled = true
        }
    })
});
    </script>
@endpush
