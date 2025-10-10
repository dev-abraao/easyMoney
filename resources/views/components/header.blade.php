{{-- filepath: c:\Users\Abraão\Documents\easyMoney\resources\views\components\header.blade.php --}}
<div id="sidebar" class="bg-[#213e4f] shadow-lg w-64 h-screen flex flex-col transition-all duration-300">
    <!-- Logo Section with Toggle Button -->
    <div class="p-6 border-b border-white/10 flex items-center justify-between">
        <div class="flex items-center space-x-2">
            <h1 id="logo-text" class="text-2xl font-bold text-white transition-opacity duration-300">EasyMoney</h1>
            <div class="w-2 h-2 bg-[#00d19f] rounded-full animate-pulse"></div>
        </div>
        <button id="sidebar-toggle" class="text-white hover:text-[#aef3b0] transition-colors duration-200 p-1">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"></path>
            </svg>
        </button>
    </div>

    <!-- User Profile Section -->
    <div class="p-6 border-b border-white/10">
        <div class="flex items-center space-x-3 mb-4">
            <div class="bg-gradient-to-r from-[#aef3b0] to-[#00d19f] p-2 rounded-full flex-shrink-0">
                <svg class="w-5 h-5 text-[#213e4f]" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <p id="user-name" class="text-white font-semibold transition-opacity duration-300">{{ Auth::user()->name }}</p>
        </div>

        <!-- Balance Card -->
        @if (Auth::user()->balance)
            <div id="balance-card" class="bg-white/10 backdrop-blur-sm rounded-lg px-4 py-3 border border-white/20 hover:bg-[#00d19f]/20 transition-all duration-300 cursor-pointer transform hover:scale-105" onclick="openExpenseModal()">
                <p class="text-xs text-[#aef3b0] font-medium">Balance</p>
                <p class="text-lg font-bold text-white" id="balance-amount">${{ Auth::user()->balance->amount }}</p>
                <p class="text-xs text-[#aef3b0] mt-1">Click to add expense</p>
            </div>
        @else
            <div id="balance-card" class="bg-white/10 backdrop-blur-sm rounded-lg px-4 py-3 border border-white/20 hover:bg-[#00d19f]/20 transition-all duration-300 cursor-pointer transform hover:scale-105" onclick="openExpenseModal()">
                <p class="text-xs text-[#aef3b0] font-medium">Balance</p>
                <p class="text-lg font-bold text-white" id="balance-amount">$0.00</p>
                <p class="text-xs text-[#aef3b0] mt-1">Click to add expense</p>
            </div>
        @endif
    </div>
    

    <!-- Spacer to push logout to bottom -->
    <div class="flex-1"></div>

    <!-- Logout Section -->
    <div class="p-6 border-t border-white/10">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="bg-white/10 hover:bg-red-500 text-white w-full py-2 rounded-lg transition-all duration-300 border border-white/20 hover:border-red-500 font-medium flex items-center justify-center space-x-2">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013 3v1"></path>
                </svg>
                <span id="logout-text" class="transition-opacity duration-300">Logout</span>
            </button>
        </form>
    </div>
</div>

<!-- Modal -->
<x-create-expense-modal balanceAmount="{{ Auth::user()->balance->amount ?? 0 }}"/>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('sidebar-toggle');
    const logoText = document.getElementById('logo-text');
    const userName = document.getElementById('user-name');
    const balanceCard = document.getElementById('balance-card');
    const logoutText = document.getElementById('logout-text');
    
    let isCollapsed = false;
    
    toggleBtn.addEventListener('click', function() {
        if (isCollapsed) {
            // Expand sidebar
            sidebar.classList.remove('w-24');
            sidebar.classList.add('w-64');
            
            // Show text elements
            setTimeout(() => {
                logoText.classList.remove('opacity-0', 'hidden');
                userName.classList.remove('opacity-0', 'hidden');
                balanceCard.classList.remove('opacity-0', 'hidden');
                logoutText.classList.remove('opacity-0', 'hidden');
            }, 150);
            
            // Rotate toggle icon
            toggleBtn.innerHTML = `
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"></path>
                </svg>
            `;
            
            isCollapsed = false;
        } else {
            // Collapse sidebar
            logoText.classList.add('opacity-0');
            userName.classList.add('opacity-0');
            balanceCard.classList.add('opacity-0');
            logoutText.classList.add('opacity-0');
            
            setTimeout(() => {
                logoText.classList.add('hidden');
                userName.classList.add('hidden');
                balanceCard.classList.add('hidden');
                logoutText.classList.add('hidden');
                
                sidebar.classList.remove('w-64');
                sidebar.classList.add('w-24');
            }, 150);
            
            // Rotate toggle icon
            toggleBtn.innerHTML = `
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
                </svg>
            `;
            
            isCollapsed = true;
        }
    });
});
</script>