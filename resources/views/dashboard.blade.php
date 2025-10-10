<x-layout>

    {{-- Pop in the screen if the user doesn't have a balance --}}
    @if (!Auth::user()->balance)
    <x-create-balance-modal/>
    @endif

    <div class="flex flex-col w-1/3 overflow-y-auto h-[calc(100vh-5rem)] scroll-smooth overscroll-contain no-scrollbar">
        @forelse ($expenses as $expense)
            <x-expense-card :expense="$expense"/>
        @empty
            <p>No expenses found.</p>
        @endforelse
        @if($expensesCount > 10)
        <a class=" text-white mx-auto font-semibold p-2 rounded-lg bg-green-600 w-fit" href="#">See all Expenses</a>
        @endif
    </div>

</x-layout>