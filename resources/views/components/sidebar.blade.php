<div id="sidebar" class="bg-gray-800 text-white shadow-lg w-full h-screen flex flex-col sticky top-0 border-r border-gray-700">
    <div class="p-6 border-b border-gray-700 flex items-center justify-between">
        <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 overflow-hidden">
            <div class="bg-gradient-to-r from-green-400 to-green-600 p-2 rounded-lg flex-shrink-0">
                <svg class="w-6 h-6 text-gray-800" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path>
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <h1 id="logo-text" class="text-xl font-bold text-white transition-opacity duration-300 font-oswald whitespace-nowrap sidebar-text">EasyMoney</h1>
        </a>
        <button id="sidebar-toggle" class="text-gray-400 hover:text-green-400 transition-colors duration-200 p-2 hover:bg-gray-700 rounded-lg flex-shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"></path>
            </svg>
        </button>
    </div>

    <div class="p-6 border-b border-gray-700">
        <div class="flex items-center space-x-3 mb-4">
            <div class="bg-gradient-to-r from-green-400 to-green-600 p-2.5 rounded-full flex-shrink-0">
                <svg class="w-5 h-5 text-gray-800" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <p id="user-name" class="text-white font-semibold transition-opacity duration-300 truncate sidebar-text">{{ Auth::user()->name }}</p>
        </div>
        
        @if(session('error'))
            <div class="bg-red-900/50 border border-red-700 text-red-300 px-3 py-2 rounded-lg text-xs mb-4">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            @foreach($errors->all() as $error)
            <div class="bg-red-900/50 border border-red-700 text-red-300 px-3 py-2 rounded-lg text-xs mb-4">
                {{ $error }}
            </div>
            @endforeach
        @endif

        @if (Auth::user()->balance)
            <div id="balance-card" class="bg-gradient-to-br from-gray-700 to-gray-750 backdrop-blur-sm rounded-lg p-4 border border-gray-600 transition-all duration-300 shadow-lg sidebar-card">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-xs text-green-400 font-semibold uppercase tracking-wide">Balance</p>
                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                </div>
                <p class="text-2xl font-bold text-white mb-4" id="balance-amount">${{ number_format(Auth::user()->balance->balance_amount, 2) }}</p>
                
                <div class="grid grid-cols-2 gap-2">
                    <button onclick="openPaymentModal()" 
                            class="group bg-green-500 hover:bg-green-600 text-white py-2.5 px-3 rounded-lg transition-all duration-200 flex items-center justify-center space-x-1.5 hover:scale-105 active:scale-95">
                        <svg class="w-4 h-4 group-hover:rotate-90 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span class="text-xs font-black">Income</span>
                    </button>
                    <button onclick="openExpenseModal()" 
                            class="group bg-purple-600 hover:bg-purple-700 text-white py-2.5 px-3 rounded-lg transition-all duration-200 flex items-center justify-center space-x-1.5 hover:scale-105 active:scale-95">
                        <svg class="w-4 h-4 group-hover:rotate-90 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 12H4"></path>
                        </svg>
                        <span class="text-xs font-black">Expense</span>
                    </button>
                </div>
            </div>
        @else
            <div id="balance-card" class="bg-gradient-to-br from-gray-700 to-gray-750 backdrop-blur-sm rounded-lg p-4 border border-gray-600 transition-all duration-300 shadow-lg sidebar-card">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-xs text-orange-400 font-semibold uppercase tracking-wide">Balance</p>
                    <div class="w-2 h-2 bg-orange-500 rounded-full"></div>
                </div>
                <p class="text-2xl font-bold text-white mb-4" id="balance-amount">$0.00</p>
                
                <button onclick="alert('Create your balance first!')" 
                        class="w-full bg-orange-600 hover:bg-orange-700 text-white py-2.5 px-3 rounded-lg transition-all duration-200 flex items-center justify-center space-x-2 hover:scale-105 active:scale-95">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <span class="text-xs font-semibold">Create Balance</span>
                </button>
            </div>
        @endif
    </div>
    
    <div class="flex flex-col gap-1 font-semibold flex-1 p-4">
        <a href="{{ route('user-expense.index') }}" 
           class="text-gray-300 hover:text-white hover:bg-gray-700 px-3 py-3 rounded-lg transition-all duration-200 flex items-center justify-start gap-3 group">
            <div class="w-10 h-10 flex items-center justify-center flex-shrink-0 bg-gray-700 group-hover:bg-green-600 rounded-lg transition-colors duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
            <span class="transition-all duration-300 text-sm whitespace-nowrap sidebar-text">Expenses</span>
        </a>

        <a href="{{ route('recurring.expenses.index') }}" 
           class="text-gray-300 hover:text-white hover:bg-gray-700 px-3 py-3 rounded-lg transition-all duration-200 flex items-center justify-start gap-3 group">
            <div class="w-10 h-10 flex items-center justify-center flex-shrink-0 bg-gray-700 group-hover:bg-green-600 rounded-lg transition-colors duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
            </div>
            <span class="transition-all duration-300 text-sm whitespace-nowrap sidebar-text">Recurring Expenses</span>
        </a>

        <a href="{{ route('recurring.balances.index') }}" 
           class="text-gray-300 hover:text-white hover:bg-gray-700 px-3 py-3 rounded-lg transition-all duration-200 flex items-center justify-start gap-3 group">
            <div class="w-10 h-10 flex items-center justify-center flex-shrink-0 bg-gray-700 group-hover:bg-green-600 rounded-lg transition-colors duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                </svg>
            </div>
            <span class="transition-all duration-300 text-sm whitespace-nowrap sidebar-text">Recurring Income</span>
        </a>

        <a href="{{ route('cards.index') }}" 
           class="text-gray-300 hover:text-white hover:bg-gray-700 px-3 py-3 rounded-lg transition-all duration-200 flex items-center justify-start gap-3 group">
            <div class="w-10 h-10 flex items-center justify-center flex-shrink-0 bg-gray-700 group-hover:bg-green-600 rounded-lg transition-colors duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                </svg>
            </div>
            <span class="transition-all duration-300 text-sm whitespace-nowrap sidebar-text">Cards</span>
        </a>
    </div>

    <div class="p-4 border-t border-gray-700">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="group cursor-pointer bg-gray-700 hover:bg-red-600 text-white w-full py-3 rounded-lg transition-all duration-300 border border-gray-600 hover:border-red-500 font-medium flex items-center justify-center gap-2 hover:scale-105 active:scale-95">
                <svg class="w-5 h-5 flex-shrink-0 group-hover:rotate-12 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                <span class="transition-all duration-300 text-sm font-semibold sidebar-text">Logout</span>
            </button>
        </form>
    </div>
</div>

<x-create-expense-modal/>
<x-create-payment-modal/>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const sidebarContainer = document.getElementById('sidebar-container');
    const toggleBtn = document.getElementById('sidebar-toggle');
    
    let isCollapsed = localStorage.getItem('sidebarState') === 'compact';
    
    updateToggleIcon();
    
    toggleBtn.addEventListener('click', function() {
        if (isCollapsed) {
            expandSideBar();
        } else {
            collapseSideBar();
        }
    });

    function expandSideBar() {
        document.documentElement.classList.remove('sidebar-compact');
        localStorage.setItem('sidebarState', 'expanded');
        isCollapsed = false;
        updateToggleIcon();
    }

    function collapseSideBar() {
        document.documentElement.classList.add('sidebar-compact');
        localStorage.setItem('sidebarState', 'compact');
        isCollapsed = true;
        updateToggleIcon();
    }

    function updateToggleIcon() {
        toggleBtn.innerHTML = isCollapsed ? `
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
            </svg>
        ` : `
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"></path>
            </svg>
        `;
    }
});
</script>