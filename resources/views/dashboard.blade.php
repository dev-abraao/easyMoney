<x-layout>

    @if (!Auth::user()->balance)
    <x-create-balance-modal/>
    @endif

</x-layout>