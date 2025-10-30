@php
    $expenseTypes = \App\Models\ExpenseTypes::all();
    $userCards = Auth::user()->cards;
@endphp

<div id="expense-modal" class="fixed inset-0 bg-black/70 backdrop-blur-sm hidden items-center justify-center z-50 p-4">
    <div class="bg-gradient-to-br from-gray-800 to-gray-850 rounded-xl shadow-2xl max-w-lg w-full border border-gray-700 transform transition-all duration-300 scale-95 opacity-0" id="expense-modal-content">
        <!-- Header -->
        <div class="bg-gradient-to-r from-purple-600 to-purple-700 p-6 rounded-t-xl border-b border-gray-700">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white font-oswald">New Expense</h3>
                        <p class="text-purple-200 text-xs">Add a new expense to track</p>
                    </div>
                </div>
                <button type="button" class="text-purple-200 hover:text-white transition-all duration-200 p-2 rounded-lg hover:bg-white/10 active:scale-95" onclick="closeExpenseModal()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <!-- Body -->
        <div class="p-6">
            <form id="expense-form" action="{{ route('user-expense.store') }}" method="POST">
                @csrf
                <div class="space-y-5">
                    <!-- Expense Category -->
                    <div>
                        <label for="expense_type_id" class="block text-sm font-semibold text-gray-300 mb-2 flex items-center gap-1">
                            <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            Expense Category *
                        </label>
                        <div class="relative">
                            <select name="expense_type_id" id="expense_type_id" 
                            class="w-full px-4 py-3 bg-gray-700/50 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all appearance-none cursor-pointer" 
                            required>
                                <option value="" hidden disabled selected class="text-gray-400">Select a category</option>
                                @foreach($expenseTypes as $type)
                                    <option value="{{ $type->id }}" class="bg-gray-700 text-white">{{ $type->name }}</option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-semibold text-gray-300 mb-2 flex items-center gap-1">
                            <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                            </svg>
                            Description *
                        </label>
                        <input type="text" name="description" id="description" 
                        class="w-full px-4 py-3 bg-gray-700/50 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all" 
                        placeholder="e.g., Grocery shopping, Gas, Restaurant" required>
                    </div>

                    <!-- Amount -->
                    <div>
                        <label for="amount" class="block text-sm font-semibold text-gray-300 mb-2 flex items-center gap-1">
                            <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                            Amount *
                        </label>
                        <x-amount name="amount" id="amount" submitButtonId="submit-expense-button" class="w-full px-4 py-3 bg-gray-700/50 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all"/>
                        <div id="error-container" class="mt-2 hidden">
                            <div class="bg-red-900/50 border border-red-700 text-red-300 px-3 py-2 rounded-lg text-sm flex items-center gap-2">
                                <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                </svg>
                                <span id="error-message"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Card Selection -->
                    <div id="card_selection" class="space-y-4">
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <label for="card_id" class="block text-sm font-semibold text-gray-300 flex items-center gap-1">
                                    <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                    </svg>
                                    Card
                                    <span class="text-xs text-gray-400 bg-gray-700 rounded-full px-2 py-0.5 ml-1">Optional</span>
                                </label>
                                <button type="button" id="clear-card-btn" onclick="clearCard()" 
                                class="text-sm text-purple-400 hover:text-purple-300 disabled:text-gray-500 disabled:cursor-not-allowed transition-colors duration-200 flex items-center gap-1" disabled>
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    Clear
                                </button>
                            </div>
                            <div class="relative">
                                <select name="card_id" id="card_id" 
                                class="w-full px-4 py-3 bg-gray-700/50 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all appearance-none cursor-pointer">
                                    <option value="" hidden disabled selected class="text-gray-400">Select a card</option>
                                    @foreach($userCards as $card)
                                        <option value="{{ $card->id }}" class="bg-gray-700 text-white">{{ $card->name }} - ({{ $card->last4 }})</option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Installments -->
                        <div id="payment_div" class="hidden">
                            <label for="installments" class="block text-sm font-semibold text-gray-300 mb-2 flex items-center gap-1">
                                <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                                Payment Installments
                                <span class="text-xs text-gray-400 bg-gray-700 rounded-full px-2 py-0.5 ml-1">Optional</span>
                            </label>
                            <div class="relative">
                                <select name="installments" id="installments" 
                                class="w-full custom-scrollbar px-4 py-3 bg-gray-700/50 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all appearance-none cursor-pointer">
                                    <option value="" hidden disabled selected class="text-gray-400">Select installments</option>
                                    @for($i = 2; $i <= 24; $i++)
                                        <option value="{{ $i }}" class="bg-gray-700 text-white">{{ $i }}x installments</option>
                                    @endfor
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Date -->
                    <div>
                        <label for="date" class="block text-sm font-semibold text-gray-300 mb-2 flex items-center gap-1">
                            <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Date *
                        </label>
                        <input type="date" name="date" id="date" min="2000-01-01" max="{{ date('Y-m-d') }}"
                               class="w-full px-4 py-3 bg-gray-700/50 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all" 
                               value="{{ date('Y-m-d') }}" required>
                    </div>
                </div>

                <!-- Footer Buttons -->
                <div class="flex justify-end gap-3 mt-6 pt-6 border-t border-gray-700">
                    <button type="button" onclick="closeExpenseModal()" 
                            class="px-5 py-2.5 text-sm font-semibold text-gray-300 bg-gray-700 border border-gray-600 rounded-lg hover:bg-gray-600 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-gray-500 active:scale-95">
                        Cancel
                    </button>
                    <button type="submit" id="submit-expense-button"
                            class="px-5 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition-all duration-200 shadow-lg hover:shadow-purple-500/50 flex items-center gap-2 active:scale-95">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
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
        const modal = document.getElementById('expense-modal');
        const modalContent = document.getElementById('expense-modal-content');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => {
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeExpenseModal() {
        const modal = document.getElementById('expense-modal');
        const modalContent = document.getElementById('expense-modal-content');
        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.getElementById('expense-form').reset();
            document.getElementById('error-container').classList.add('hidden');
            cardSelect.value = "";
            paymentAmount.classList.add('hidden');
            clearCardBtn.disabled = true;
        }, 300);
    }

    document.getElementById('expense-modal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeExpenseModal();
        }
    });
</script>