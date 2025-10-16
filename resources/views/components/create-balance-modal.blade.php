<div id="balance-modal" class="fixed inset-0 z-50 bg-gray-900 flex items-center justify-center transition-opacity duration-300">
    <div class="max-w-lg w-full mx-4">
        <!-- Welcome Section -->
        <div class="text-center mb-8">
            <div class="mb-6">
                <h1 class="text-4xl font-bold text-white mb-4 font-oswald">Welcome to EasyMoney!</h1>
                <div class="w-16 h-1 bg-green-500 mx-auto mb-6"></div>
            </div>
            <p class="text-gray-300 text-lg leading-relaxed">
                It seems like it's your first time here. Let's start by adding a starting amount to your balance. 
                You can leave the amount at $0.00 and change it later!
            </p>
        </div>

        <!-- Balance Form Card -->
        <div class="bg-gray-800 rounded-lg shadow-xl p-8 border border-gray-700">
            <h2 class="text-xl font-bold text-white mb-6 text-center font-oswald">Set Your Starting Balance</h2>
            
            <form id="balance-form" action="{{ route('user.balance.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label for="balance_amount" class="block text-sm font-medium text-gray-300 mb-2">Starting Amount</label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-lg">$</span>
                        <x-amount id="balance_amount" name="balance_amount" class="w-full pl-8 pr-4 py-3 bg-gray-700 border border-gray-600 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors text-lg"  submitButtonId="submit-balance" :validateBalance="false"/>
                        
                    </div>
                    <span id="amount-error" class="text-red-400 text-sm mt-2 hidden block"></span>
                </div>

                <div class="bg-gray-700 rounded-lg p-4 border border-gray-600">
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0">
                            <svg class="w-5 h-5 text-green-400 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-300">
                                <strong class="text-green-400">Tip:</strong> This will be your available balance for tracking expenses. 
                                You can always update this amount later from your dashboard.
                            </p>
                        </div>
                    </div>
                </div>

                <button type="submit" id="submit-balance"
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-4 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 focus:ring-offset-gray-800">
                    Create Balance & Continue
                </button>
            </form>
        </div>

        <!-- Skip Option -->
        <div class="text-center mt-6">
            <p class="text-gray-400 text-sm">
                Want to set this up later? 
                <button onclick="skipBalance()" class="text-green-400 hover:text-green-300 font-medium transition-colors underline">
                    Skip for now
                </button>
            </p>
        </div>
    </div>
</div>

<script>
function skipBalance() {
    const modal = document.getElementById('balance-modal');
    const formData = new FormData();
    formData.append('amount', '0');
    
    fetch('{{ route("user.balance.store") }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            modal.style.opacity = '0';
            setTimeout(() => {
                modal.remove();
            }, 300);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

document.getElementById('balance-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const modal = document.getElementById('balance-modal');
    const balanceDisplay = document.getElementById('balance-amount');
    const amountInput = document.getElementById('balance_amount');
    const amountError = document.getElementById('amount-error');

    amountError.classList.add('hidden');
    amountError.textContent = '';
    
    fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const formattedAmount = parseFloat(amountInput.value || 0).toFixed(2);
            amountInput.value = formattedAmount;
            if (balanceDisplay) {
                balanceDisplay.textContent = `$${formattedAmount}`;
            }
            modal.style.opacity = '0';
            setTimeout(() => {
                modal.remove();
            }, 300);
        } else {
            if (data.errors && data.errors.amount) {
                amountError.textContent = data.errors.amount[0];
                amountError.classList.remove('hidden');
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
        amountError.textContent = 'An error occurred. Please try again.';
        amountError.classList.remove('hidden');
    });
});
</script>