@php
    $expenseTypes = \App\Models\ExpenseTypes::all();
@endphp

<div id="expense-modal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900">New Expense</h3>
                <button type="button" class="text-gray-400 hover:text-gray-600" onclick="closeExpenseModal()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <form id="expense-form" action="{{ route('user.expense.store') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="expense_type_id" class="block text-sm font-medium text-gray-700">Expense Category</label>
                        <select name="expense_type_id" id="expense_type_id" 
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                        required>
                        <option value="" hidden disabled {{ old('expense_type_id') ? '' : 'selected' }}>Select an option</option>
                        @foreach($expenseTypes as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Additional description</label>
                        <input type="text" name="description" id="description" 
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                               required>
                    </div>

                    <div>
                        <label for="amount" class="block text-sm font-medium text-gray-700">Value</label>
                        <input type="text" name="amount" id="amount" step="0.01" min="0.01"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                        required>
                        <div id="error-container" class="mt-4 hidden">
                            <div class="text-red-700 ">
                                <span id="error-message"></span>
                            </div>
                        </div>
                    </div>
                    

                    <div>
                        <label for="card_id" class="block text-sm font-medium text-gray-700">Card <span class="text-gray-500 bg-gray-200 rounded p-1">Optional</span></label>
                        <select name="card_id" id="card_id" 
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="" hidden disabled {{ old('card_id') ? '' : 'selected' }}>Select an option</option>
                        </select>
                    </div>

                    <div>
                        <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                        <input type="date" name="date" id="date" min="2000-01-01" max="{{ date('Y-m-d') }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                               value="{{ date('Y-m-d') }}" required>
                    </div>
                </div>


                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" onclick="closeExpenseModal()" 
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Cancel
                    </button>
                    <button type="submit"
                            id="submit-expense-button"
                            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Create Expense
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // AJAX(IMPLEMENTAR DEPOIS SE NECESSARIO)
    // document.getElementById('expense-form').addEventListener('submit', function(e) {
    //     e.preventDefault();
        
    //     const formData = new FormData(this);
        
    //     fetch(this.action, {
    //         method: 'POST',
    //         body: formData,
    //         headers: {
    //             'X-Requested-With': 'XMLHttpRequest',
    //             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    //         }
    //     })
    //     .then(response => response.json())
    //     .then(data => {
    //         if (data.success) {
    //             closeExpenseModal();
    //             location.reload(); // Ou atualize a lista de despesas
    //         } else {
    //             document.getElementById('error-message').textContent = data.message || 'Erro ao criar despesa';
    //             document.getElementById('error-container').classList.remove('hidden');
    //         }
    //     })
    //     .catch(error => {
    //         document.getElementById('error-message').textContent = 'Erro ao processar requisição';
    //         document.getElementById('error-container').classList.remove('hidden');
    //     });
    // });


function openExpenseModal() {
    document.getElementById('expense-modal').classList.remove('hidden');
    document.getElementById('expense-modal').classList.add('flex');
}

function closeExpenseModal() {
    document.getElementById('expense-modal').classList.add('hidden');
    document.getElementById('expense-modal').classList.remove('flex');
    document.getElementById('expense-form').reset();
    document.getElementById('error-container').classList.add('hidden');
}


document.getElementById('expense-modal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeExpenseModal();
    }
});

document.getElementById('amount').addEventListener('input', function(e) {
    let value = this.value;
    const balanceAmount = {{ $balanceAmount }};
    const submitButton = document.getElementById('submit-expense-button');
    value = value.replace(/\D/g, '');    
    value = (value / 100).toFixed(2);
    value = value.replace(',', '.');

    if (parseFloat(value) > balanceAmount) {
        document.getElementById('error-message').textContent = 'Value can not exceed your available balance.';
        document.getElementById('error-container').classList.remove('hidden');
        submitButton.classList.remove('bg-blue-600', 'hover:bg-blue-700');
        submitButton.classList.add('bg-gray-400', 'cursor-not-allowed');
        submitButton.disabled = true;
    } else {
        document.getElementById('error-container').classList.add('hidden');
        submitButton.disabled = false;
        submitButton.classList.add('bg-blue-600', 'hover:bg-blue-700');
        submitButton.classList.remove('bg-gray-400', 'cursor-not-allowed');
    }

    this.value = value;
});

</script>