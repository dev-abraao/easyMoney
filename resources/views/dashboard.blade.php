<x-layout>
    {{-- Pop in the screen if the user doesn't have a balance --}}
    @if (!Auth::user()->balance)
    <x-create-balance-modal/>
    @endif

<div class="flex flex-row">
    <div class="flex flex-col w-1/3 overflow-y-auto h-dvh scroll-smooth overscroll-contain custom-scrollbar bg-gray-900">
        <div class="sticky top-0 bg-gray-900 z-10 p-4 border-b border-gray-700">
            <h2 class="text-xl font-bold text-green-400 text-center font-oswald">Latest Expenses</h2>
        </div>

        <div class="flex flex-col gap-3 p-4 flex-1">
            @forelse ($expenses as $expense)
                <x-expense-card :expense="$expense" class="w-full"/>
            @empty
                <div class="flex flex-col items-center justify-center py-12 text-center">
                    <div class="w-16 h-16 bg-gray-800 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                    <p class="text-gray-400 text-lg mb-2">No expenses yet</p>
                    <p class="text-gray-500 text-sm">Start tracking your expenses by adding one!</p>
                </div>
            @endforelse
        </div>

        @if($expensesCount > 10)
        <div class="p-4 border-t border-gray-700 bg-gray-900">
            <a href="#" class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center space-x-2">
                <span>View All Expenses</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
        @endif
    </div>


    <div class="flex flex-col w-1/3 overflow-y-auto h-dvh scroll-smooth overscroll-contain custom-scrollbar bg-gray-900">
        <div class="sticky top-0 bg-gray-900 z-10 p-4 border-b border-gray-700">
            <h2 class="text-xl font-bold text-green-400 text-center font-oswald">Latest Expenses2</h2>
        </div>

        <div class="flex flex-col gap-3 p-4 flex-1">
            @forelse ($expenses as $expense)
                <x-expense-card :expense="$expense" class="w-full"/>
            @empty
                <div class="flex flex-col items-center justify-center py-12 text-center">
                    <div class="w-16 h-16 bg-gray-800 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                    <p class="text-gray-400 text-lg mb-2">No expenses yet</p>
                    <p class="text-gray-500 text-sm">Start tracking your expenses by adding one!</p>
                </div>
            @endforelse
        </div>

        @if($expensesCount > 10)
        <div class="p-4 border-t border-gray-700 bg-gray-900">
            <a href="#" class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center space-x-2">
                <span>View All Expenses</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
        @endif
    </div>


    <div class="flex flex-col w-1/3 overflow-y-auto h-dvh scroll-smooth overscroll-contain custom-scrollbar bg-gray-900">
        <div class="sticky top-0 bg-gray-900 z-10 p-4 border-b border-gray-700">
            <h2 class="text-xl font-bold text-green-400 text-center font-oswald">Latest Expenses3</h2>
        </div>

        <div class="flex flex-col gap-3 p-4 flex-1">
            @forelse ($expenses as $expense)
                <x-expense-card :expense="$expense" class="w-full"/>
            @empty
                <div class="flex flex-col items-center justify-center py-12 text-center">
                    <div class="w-16 h-16 bg-gray-800 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                    <p class="text-gray-400 text-lg mb-2">No expenses yet</p>
                    <p class="text-gray-500 text-sm">Start tracking your expenses by adding one!</p>
                </div>
            @endforelse
        </div>

        @if($expensesCount > 10)
        <div class="p-4 border-t border-gray-700 bg-gray-900">
            <a href="#" class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center space-x-2">
                <span>View All Expenses</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
        @endif
    </div>
</div>   
</x-layout>