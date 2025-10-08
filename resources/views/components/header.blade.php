<div class="bg-[#213e4f] shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <h1 class="text-2xl font-bold text-white">EasyMoney</h1>
                <div class="w-2 h-2 bg-[#00d19f] rounded-full animate-bounce"></div>
            </div>

            <div class="flex items-center space-x-6">
                <div class="flex items-center space-x-3">
                    <div class="bg-gradient-to-r from-[#aef3b0] to-[#00d19f] p-2 rounded-full">
                        <svg class="w-5 h-5 text-[#213e4f]" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <p class="text-white font-semibold">{{ Auth::user()->name }}</p>
                </div>

                @if (Auth::user()->balance)
                    <div class="bg-white/10 backdrop-blur-sm rounded-lg px-4 py-2 border border-white/20 hover:bg-[#00d19f]/20 transition-all duration-300 cursor-pointer transform hover:scale-105" onclick="openExpenseModal()">
                        <p class="text-xs text-[#aef3b0] font-medium">Balance: <span id="balance-amount" class="text-lg font-bold text-white">${{ Auth::user()->balance->amount }}</span></p>
                    </div>
                @else
                    <div class="bg-white/10 backdrop-blur-sm rounded-lg px-4 py-2 border border-white/20 hover:bg-[#00d19f]/20 transition-all duration-300 cursor-pointer transform hover:scale-105" onclick="openExpenseModal()">
                        <p class="text-xs text-[#aef3b0] font-medium">Balance:<span id="balance-amount" class="text-lg font-bold text-white"></span></p>
                    </div>
                @endif

                <x-create-expense-modal balanceAmount="{{ Auth::user()->balance->amount ?? 0 }}"/>

                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-white/10 hover:bg-red-500 text-white px-4 py-2 rounded-lg transition-all duration-300 border border-white/20 hover:border-red-500 font-medium">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>