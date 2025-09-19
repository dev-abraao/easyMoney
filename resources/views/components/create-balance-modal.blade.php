<div id="balance-modal" class="fixed inset-0 z-50 bg-purple-500 text-white transition-opacity duration-300">
        <h1 class="">It seems like it's your first time here.</h1>
        <p class="">Let's start by adding a starting amount to your balance, you can leave the amount at 0 and change it later!</p>
        
        <form id="balance-form" action="{{ route('user.balance.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <input type="text" id="amount-input" name="amount"  placeholder="Enter amount" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" 
                       required>
            </div>
            <button type="submit" class="w-full bg-purple-500 text-white py-2 px-4 rounded-lg hover:bg-purple-600 transition-colors">
                Create Balance
            </button>
        </form>
    </div>
</div>

<script>
document.getElementById('balance-form').addEventListener('submit', function(e) {

    e.preventDefault();
    
    const formData = new FormData(this);
    const modal = document.getElementById('balance-modal');
    const balanceDisplay = document.getElementById('balance-amount');
    const amountInput = document.getElementById('amount-input');
    amountInput.value = parseFloat(amountInput.value).toFixed(2);
    
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

            balanceDisplay.textContent = `Balance: ${amountInput.value}$`;
            modal.style.opacity = '0';
            setTimeout(() => {
                modal.remove();
            }, 300);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
</script>