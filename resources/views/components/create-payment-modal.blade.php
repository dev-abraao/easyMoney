<div id="payment_modal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div class="bg-gray-800 rounded-lg shadow-xl max-w-md w-full mx-4 border border-gray-700">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-white font-oswald">New Payment</h3>
                <button type="button" class="text-gray-400 hover:text-red-400 transition-colors duration-200 p-1 rounded-lg hover:bg-gray-700" onclick="closePaymentModal()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form id="payment-form" action="{{ route('user.balance.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-300 mb-2">Description</label>
                        <input type="text" name="description" id="description" 
                        class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors" 
                        placeholder="Enter payment description" required>
                    </div>

                    <div>
                        <label for="payment_amount" class="block text-sm font-medium text-gray-300 mb-2">Amount</label>
                        <x-amount name="payment_amount" id="payment_amount" submitButtonId="submit-payment-button" class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors"/>
                        <div id="error-container" class="mt-2 hidden">
                            <div class="bg-red-900 border border-red-700 text-red-300 px-3 py-2 rounded-md text-sm">
                                <span id="error-message"></span>
                            </div>
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
                    <button type="button" onclick="closePaymentModal()" 
                            class="px-4 py-2 text-sm font-medium text-gray-300 bg-gray-700 border border-gray-600 rounded-md hover:bg-gray-600 transition-colors duration-200">
                        Cancel
                    </button>
                    <button type="submit" id="submit-payment-button"
                            class="px-4 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition-colors duration-200">
                        Create Payment
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openPaymentModal() {
        document.getElementById('payment_modal').classList.remove('hidden');
        document.getElementById('payment_modal').classList.add('flex');
    }

    function closePaymentModal() {
        document.getElementById('payment_modal').classList.add('hidden');
        document.getElementById('payment_modal').classList.remove('flex');
        document.getElementById('payment-form').reset();
        document.getElementById('error-container').classList.add('hidden');
    }

    document.getElementById('payment_modal').addEventListener('click', function(e) {
        if (e.target === this) {
            closePaymentModal();
        }
    });
</script>