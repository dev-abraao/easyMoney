@props(['expense'])

<div {{ $attributes->merge(['class' => 'flex flex-row justify-between items-center bg-gray-800 p-4 border border-gray-700 rounded-lg hover:bg-gray-750 transition-all duration-200 shadow-sm']) }}>
    <div class="flex flex-col">
            <div class="flex items-center gap-2 mb-2">
                <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                <p class="font-semibold text-green-400 text-sm uppercase tracking-wide">{{ $expense->type->name }}</p>
            </div>
            <p class="font-medium text-white text-base mb-1 truncate">{{ $expense->description }}</p>
            @if($expense->card)
                <div class="flex gap-2 items-center">
                <p class="font-bold text-green-500 text-lg">${{ number_format($expense->amount, 2) }}</p>
                <p class="text-xs uppercase">{{$expense->card->name}} <span class="text-gray-400">&#40;{{ $expense->card->last4 }}&#41;</span></p>
                </div>
            @else
                <p class="font-bold text-green-500 text-lg">${{ number_format($expense->amount, 2) }}</p>
            @endif
    </div>
    <div class="flex flex-col items-center ml-4">
        <form action="{{ route('user.expense.destroy', $expense) }}" method="POST" class="flex items-center">
            @csrf
            @method('DELETE')
            <button type="submit" 
            onclick="return confirm('Are you sure you want to delete this expense?')"
            class="text-gray-400 hover:text-red-400 transition-colors duration-200 p-2 rounded-lg hover:bg-gray-700 group">
            <svg class="w-5 h-5 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
            </svg>
        </button>
    </form>
    <p class="text-gray-400 text-sm">{{ Carbon\Carbon::parse($expense->date)->format('M d, Y') }}</p>
    </div>
</div>