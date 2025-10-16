<div id="sidebar" class="bg-gray-800 text-white shadow-lg w-72 h-dvh flex flex-col transition-all duration-300 border-r border-gray-700">
    <!-- Logo Section with Toggle Button -->
    <div class="p-6 border-b border-gray-700 flex items-center justify-between">
        <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
            <h1 id="logo-text" class="text-2xl font-bold text-white transition-opacity duration-300 font-oswald">EasyMoney</h1>
        </a>
        <button id="sidebar-toggle" class="text-gray-400 hover:text-green-400 transition-colors duration-200 p-1">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"></path>
            </svg>
        </button>
    </div>

    <!-- User Profile Section -->
    <div class="p-6 border-b border-gray-700">
        <div class="flex items-center space-x-3 mb-4">
            <div class="bg-gradient-to-r from-green-400 to-green-600 p-2 rounded-full flex-shrink-0">
                <svg class="w-5 h-5 text-gray-800" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <p id="user-name" class="text-white font-semibold transition-opacity duration-300">{{ Auth::user()->name }}</p>
        </div>

        <!-- Balance Card -->
        @if (Auth::user()->balance)
            <div id="balance-card" class="bg-gray-700 backdrop-blur-sm rounded-lg px-4 py-3 border border-gray-600 hover:bg-green-600/20 transition-all duration-300 cursor-pointer transform hover:scale-105" onclick="openExpenseModal()">
                <p class="text-xs text-green-400 font-medium">Balance</p>
                <p class="text-lg font-bold text-white" id="balance-amount">${{ Auth::user()->balance->amount }}</p>
                <p class="text-xs text-green-400 mt-1">Click to add expense</p>
            </div>
        @else
            <div id="balance-card" class="bg-gray-700 backdrop-blur-sm rounded-lg px-4 py-3 border border-gray-600 hover:bg-green-600/20 transition-all duration-300 cursor-pointer transform hover:scale-105" onclick="openExpenseModal()">
                <p class="text-xs text-green-400 font-medium">Balance</p>
                <p class="text-lg font-bold text-white" id="balance-amount">$0.00</p>
                <p class="text-xs text-green-400 mt-1">Click to add expense</p>
            </div>
        @endif
    </div>
    
    <!-- Navigation Links -->
    <div class="flex flex-col  gap-2 font-semibold flex-1 p-6">
        <a href="{{ route('recurring.expenses.index') }}" class="text-gray-300 hover:text-green-400 hover:bg-gray-700 px-4 py-3 rounded-lg transition-all duration-200 flex items-center space-x-3">
            <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path>
            </svg>
            <span id="nav-text-1" class="transition-opacity duration-300">Expenses</span>
        </a>
        <a href="{{ route('recurring.balances.index') }}" class="text-gray-300 hover:text-green-400 hover:bg-gray-700 px-4 py-3 rounded-lg transition-all duration-200 flex items-center space-x-3">
            <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
            </svg>
            <span id="nav-text-2" class="transition-opacity duration-300">Payments</span>
        </a>
        <a href="{{ route('cards.index') }}" class="text-gray-300 hover:text-green-400 hover:bg-gray-700 px-4 py-3 rounded-lg transition-all duration-200 flex items-center space-x-3">
            <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
            </svg>
            <span id="nav-text-3" class="transition-opacity duration-300">Cards</span>
        </a>
    </div>

    <!-- Logout Section -->
    <div class="p-6 border-t border-gray-700">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class=" cursor-pointer bg-gray-700 hover:bg-red-600 text-white w-full py-3 rounded-lg transition-all duration-300 border border-gray-600 hover:border-red-500 font-medium flex items-center justify-center space-x-2">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 3H7a2 2 0 00-2 2v14a2 2 0 002 2h8M15 12h6m0 0l-3-3m3 3l-3 3"></path>
                </svg>
                <span id="logout-text" class="transition-opacity duration-300">Logout</span>
            </button>
        </form>
    </div>
</div>

<!-- Modal -->
<x-create-expense-modal/>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('sidebar-toggle');
    const logoText = document.getElementById('logo-text');
    const userName = document.getElementById('user-name');
    const balanceCard = document.getElementById('balance-card');
    const logoutText = document.getElementById('logout-text');
    const navTexts = [
        document.getElementById('nav-text-1'),
        document.getElementById('nav-text-2'),
        document.getElementById('nav-text-3')
    ];
    
    let isCollapsed = false;
    
    toggleBtn.addEventListener('click', function() {
        if (isCollapsed) {
            // Expand sidebar
            sidebar.classList.remove('w-24');
            sidebar.classList.add('w-72');
            
            // Show text elements
            setTimeout(() => {
                logoText.classList.remove('opacity-0', 'hidden');
                userName.classList.remove('opacity-0', 'hidden');
                balanceCard.classList.remove('opacity-0', 'hidden');
                logoutText.classList.remove('opacity-0', 'hidden');
                navTexts.forEach(text => {
                    if (text) text.classList.remove('opacity-0', 'hidden');
                });
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
            navTexts.forEach(text => {
                if (text) text.classList.add('opacity-0');
            });
            
            setTimeout(() => {
                logoText.classList.add('hidden');
                userName.classList.add('hidden');
                balanceCard.classList.add('hidden');
                logoutText.classList.add('hidden');
                navTexts.forEach(text => {
                    if (text) text.classList.add('hidden');
                });
                
                sidebar.classList.remove('w-72');
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