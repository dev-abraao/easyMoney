@props(['expense'])
<div class="flex flex-row justify-between bg-[#00d19f]/10 p-4 border-1 border-gray-300 rounded-lg m-4">
    <div>
        <p class="font-bold text-lg text-[#00d19f]">{{ $expense->type->name }}</p>
        <p class="font-black text-green-800 truncate">{{ $expense->description }}</p>
        <p class="font-black text-green-800">{{ $expense->amount }}$</p>
        <p>{{ Carbon\Carbon::parse($expense->date)->format('d/m/Y') }}</p>
    </div>
    <form action="{{ route('user.expense.destroy', $expense) }}" method="POST" class="flex items-center">
        @csrf
        @method('DELETE')
        <button type="submit" class="cursor-pointer text-red-500 hover:text-red-700 transition-colors duration-200 p-2 rounded-lg hover:bg-red-50">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
            </svg>
        </button>
    </form>
</div>