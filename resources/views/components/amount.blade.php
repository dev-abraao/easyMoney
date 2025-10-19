@props([
    'id',
    'name',
    'submitButtonId',
    'validateBalance' => true,
    'class' => '',
    'placeholder' => '0.00'
])

<input type="text" name="{{ $name }}" id="{{ $id }}" step="0.01" min="0.01"
class="{{ $class }}" placeholder="{{ $placeholder }}"
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
            
            value = value.replace(/\D/g, '');    
            value = (value / 100).toFixed(2);
            value = value.replace(',', '.');
            
            @if($validateBalance)
                @if(Auth::user()->balance)
                    const balanceAmount = {{ Auth::user()->balance->balance_amount }};
                @else
                    const balanceAmount = Infinity;
                @endif
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