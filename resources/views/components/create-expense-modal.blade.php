@php
    $expenseTypes = \App\Models\ExpenseTypes::all();
    $userCards = Auth::user()->cards;
@endphp

<div id="expense-modal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div class="bg-gray-800 rounded-lg shadow-xl max-w-md w-full mx-4 border border-gray-700">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-white font-oswald">New Expense</h3>
                <button type="button" class="text-gray-400 hover:text-red-400 transition-colors duration-200 p-1 rounded-lg hover:bg-gray-700" onclick="closeExpenseModal()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <form id="expense-form" action="{{ route('user.expense.store') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="expense_type_id" class="block text-sm font-medium text-gray-300 mb-2">Expense Category</label>
                        <select name="expense_type_id" id="expense_type_id" 
                        class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors" 
                        required>
                            <option value="" hidden disabled selected class="text-gray-400">Select a category</option>
                            @foreach($expenseTypes as $type)
                                <option value="{{ $type->id }}" class="bg-gray-700 text-white">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-300 mb-2">Description</label>
                        <input type="text" name="description" id="description" 
                        class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors" 
                        placeholder="Enter expense description" required>
                    </div>

                    <div>
                        <label for="amount" class="block text-sm font-medium text-gray-300 mb-2">Amount</label>
                        <x-amount name="amount" id="amount" submitButtonId="submit-expense-button" class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors"/>
                        <div id="error-container" class="mt-2 hidden">
                            <div class="bg-red-900 border border-red-700 text-red-300 px-3 py-2 rounded-md text-sm">
                                <span id="error-message"></span>
                            </div>
                        </div>
                    </div>

                    <div id="card_selection" class="space-y-4">
                        <div>
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
                        
                        <div id="payment_div" class="hidden">
                            <label for="installments" class="block text-sm font-medium text-gray-300 mb-2">
                                Payment Installments <span class="text-xs text-gray-200 bg-gray-600 rounded px-2 py-1 ml-1">Optional</span>
                            </label>
                            <select name="installments" id="installments" 
                            class="w-full custom-scrollbar px-4 py-3 bg-gray-700 border border-gray-600 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors">
                                <option value="" hidden disabled selected class="text-gray-400">Select installments</option>
                                @for($i = 1; $i <= 24; $i++)
                                    <option value="{{ $i }}" class="bg-gray-700 text-white">{{ $i }}x</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="date" class="block text-sm font-medium text-gray-300 mb-2">Date</label>
                        <input type="date" name="date" id="date" min="2000-01-01" max="{{ date('Y-m-d') }}"
                               class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors" 
                               value="{{ date('Y-m-d') }}" required>
                    </div>
                </div>

                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" onclick="closeExpenseModal()" 
                            class="px-4 py-2 text-sm font-medium text-gray-300 bg-gray-700 border border-gray-600 rounded-md hover:bg-gray-600 transition-colors duration-200">
                        Cancel
                    </button>
                    <button type="submit" id="submit-expense-button"
                            class="px-4 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition-colors duration-200">
                        Create Expense
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const paymentAmount = document.getElementById('payment_div')
    const cardSelect = document.getElementById('card_id')
    const clearCardBtn = document.getElementById('clear-card-btn')
    const paymentSelect = document.getElementById('installments')

    cardSelect.addEventListener('change', function(){
        if(this.value != ""){
            paymentAmount.classList.remove('hidden')
            clearCardBtn.disabled = false
        } else {
            paymentAmount.classList.add('hidden')
            clearCardBtn.disabled = true
            paymentSelect.value = "";
        }
    })

    function clearCard(){
        cardSelect.value = "";
        paymentAmount.classList.add('hidden');
        clearCardBtn.disabled = true;
        paymentSelect.value = "";
    }

    function openExpenseModal() {
        document.getElementById('expense-modal').classList.remove('hidden');
        document.getElementById('expense-modal').classList.add('flex');
    }

    function closeExpenseModal() {
        document.getElementById('expense-modal').classList.add('hidden');
        document.getElementById('expense-modal').classList.remove('flex');
        document.getElementById('expense-form').reset();
        document.getElementById('error-container').classList.add('hidden');
        cardSelect.value = "";
        paymentAmount.classList.add('hidden');
        clearCardBtn.disabled = true;
    }

    document.getElementById('expense-modal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeExpenseModal();
        }
    });
</script>