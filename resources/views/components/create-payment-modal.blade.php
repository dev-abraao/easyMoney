<div id="payment_modal" class="fixed inset-0 bg-black/70 backdrop-blur-sm hidden items-center justify-center z-50 p-4">
    <div class="bg-gradient-to-br from-gray-800 to-gray-850 rounded-xl shadow-2xl max-w-lg w-full border border-gray-700 transform transition-all duration-300 scale-95 opacity-0" id="payment-modal-content">
        <!-- Header -->
        <div class="bg-gradient-to-r from-green-600 to-green-700 p-6 rounded-t-xl border-b border-gray-700">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white font-oswald">New Payment</h3>
                        <p class="text-green-200 text-xs">Add income to your balance</p>
                    </div>
                </div>
                <button type="button" class="text-green-200 hover:text-white transition-all duration-200 p-2 rounded-lg hover:bg-white/10 active:scale-95" onclick="closePaymentModal()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Body -->
        <div class="p-6">
            <form id="payment-form" action="{{ route('user.balance.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-5">
                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-semibold text-gray-300 mb-2 flex items-center gap-1">
                            <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                            </svg>
                            Description *
                        </label>
                        <input type="text" name="description" id="description" 
                        class="w-full px-4 py-3 bg-gray-700/50 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all" 
                        placeholder="e.g., Salary, Freelance, Bonus" required>
                    </div>

                    <!-- Amount -->
                    <div>
                        <label for="payment_amount" class="block text-sm font-semibold text-gray-300 mb-2 flex items-center gap-1">
                            <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                            Amount *
                        </label>
                        <x-amount name="payment_amount" id="payment_amount" submitButtonId="submit-payment-button" class="w-full px-4 py-3 bg-gray-700/50 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all"/>
                        <div id="error-container" class="mt-2 hidden">
                            <div class="bg-red-900/50 border border-red-700 text-red-300 px-3 py-2 rounded-lg text-sm flex items-center gap-2">
                                <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                </svg>
                                <span id="error-message"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Date -->
                    <div>
                        <label for="date" class="block text-sm font-semibold text-gray-300 mb-2 flex items-center gap-1">
                            <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Date *
                        </label>
                        <input type="date" name="date" id="date" min="2000-01-01" max="{{ date('Y-m-d') }}"
                               class="w-full px-4 py-3 bg-gray-700/50 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all" 
                               value="{{ date('Y-m-d') }}" required>
                    </div>
                </div>

                <!-- Footer Buttons -->
                <div class="flex justify-end gap-3 mt-6 pt-6 border-t border-gray-700">
                    <button type="button" onclick="closePaymentModal()" 
                            class="px-5 py-2.5 text-sm font-semibold text-gray-300 bg-gray-700 border border-gray-600 rounded-lg hover:bg-gray-600 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-gray-500 active:scale-95">
                        Cancel
                    </button>
                    <button type="submit" id="submit-payment-button"
                            class="px-5 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition-all duration-200 shadow-lg hover:shadow-green-500/50 flex items-center gap-2 active:scale-95">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Create Payment
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openPaymentModal() {
        const modal = document.getElementById('payment_modal');
        const modalContent = document.getElementById('payment-modal-content');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => {
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closePaymentModal() {
        const modal = document.getElementById('payment_modal');
        const modalContent = document.getElementById('payment-modal-content');
        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.getElementById('payment-form').reset();
            document.getElementById('error-container').classList.add('hidden');
        }, 300);
    }

    document.getElementById('payment_modal').addEventListener('click', function(e) {
        if (e.target === this) {
            closePaymentModal();
        }
    });
</script>