@props([
    'id',
    'name',
    'submitButtonId',
    'validateBalance' => true,
])

<input type="text" name="{{ $name }}" id="{{ $id }}" step="0.01" min="0.01"
class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" 
required>

@if($validateBalance)
<div id="error-container-{{ $id }}" class="mt-4 hidden">
    <div class="text-red-700 ">
        <span id="error-message-{{ $id }}"></span>
    </div>
</div>
@endif

@push('scripts')
    <script>
        document.getElementById('{{ $id }}').addEventListener('input', function(e) {
            let value = this.value;
            
            // Sempre formata o valor
            value = value.replace(/\D/g, '');    
            value = (value / 100).toFixed(2);
            value = value.replace(',', '.');
            
            @if($validateBalance)
                const balanceAmount = {{ Auth::user()->balance->amount ?? 0 }};
                const submitButton = document.getElementById('{{ $submitButtonId }}');
                
                if (parseFloat(value) > balanceAmount && submitButton) {
                    document.getElementById('error-message-{{ $id }}').textContent = 'Value can not exceed your available balance.';
                    document.getElementById('error-container-{{ $id }}').classList.remove('hidden');
                    submitButton.classList.remove('bg-blue-600', 'hover:bg-blue-700');
                    submitButton.classList.add('bg-gray-400', 'cursor-not-allowed');
                    submitButton.disabled = true;
                } else if (submitButton) {
                    document.getElementById('error-container-{{ $id }}').classList.add('hidden');
                    submitButton.disabled = false;
                    submitButton.classList.add('bg-blue-600', 'hover:bg-blue-700');
                    submitButton.classList.remove('bg-gray-400', 'cursor-not-allowed');
                }
            @endif

            this.value = value;
        });
    </script>
@endpush