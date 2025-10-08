@props(['expense'])
<div class=" bg-[#00d19f]/10 p-4 border-1 border-gray-300 rounded-lg m-4">
    <p class="font-bold text-lg text-[#00d19f]">{{ $expense->type->name }}</p>
    <p>{{ $expense->amount }}</p>
    <p>{{ Carbon\Carbon::parse($expense->date)->format('d/m/Y') }}</p>
    <p class="font-mono text-xs">View details > </p>
</div>