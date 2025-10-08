<x-layout>

    {{-- Pop in the screen if the user doesn't have a balance --}}
    @if (!Auth::user()->balance)
    <x-create-balance-modal/>
    @endif

    <div class="grid grid-cols-1 w-1/3 overflow-y-auto h-[100vh] scroll-smooth overscroll-contain no-scrollbar">
        @forelse ($expenses as $expense)
            <x-expense-card :expense="$expense"/>
        @empty
            <p>No expenses found.</p>
        @endforelse
    </div>

</x-layout>