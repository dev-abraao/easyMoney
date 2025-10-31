<x-layout> 
    <div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 p-6">
        <div class="max-w-7xl mx-auto">
            
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h1 class="text-4xl font-bold text-white font-oswald mb-2 flex items-center gap-3">
                            <div class="bg-gradient-to-r from-red-500 to-red-600 p-3 rounded-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                            </div>
                            Recurring Expenses
                        </h1>
                        <p class="text-gray-400 ml-16">Manage your fixed monthly expenses like rent, utilities, and subscriptions.</p>
                    </div>
                    
                    <!-- Add Button -->
                    <button 
                        id="toggle-form-btn"
                        class="bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-gray-900 shadow-lg hover:shadow-red-500/50 flex items-center gap-2 hover:scale-105 active:scale-95"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Add Expense
                    </button>
                </div>

                <!-- Error Messages -->
                @if(session('error'))
                    <div class="bg-red-900/50 border border-red-700 text-red-300 px-4 py-3 rounded-lg text-sm mb-4 flex items-center gap-3">
                        <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                        {{ session('error') }}
                    </div>
                @endif

                @if(session('success'))
                    <div class="bg-green-900/50 border border-green-700 text-green-300 px-4 py-3 rounded-lg text-sm mb-4 flex items-center gap-3">
                        <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif
            </div>

            <!-- Add Expense Form (Hidden by default) -->
            <div id="rec-expense-form" class="hidden mb-8 transform transition-all duration-300 ease-in-out">
                <div class="bg-gradient-to-br from-gray-800 to-gray-850 rounded-xl shadow-2xl p-8 border border-gray-700">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-white font-oswald flex items-center gap-2">
                            <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Add New Recurring Expense
                        </h2>
                        <button 
                            id="close-form-btn"
                            class="text-gray-400 hover:text-red-400 transition-colors p-2 hover:bg-gray-700 rounded-lg"
                        >
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <form action="{{ route('recurring.expenses.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name Input -->
                            <div>
                                <label for="name" class="block text-sm font-semibold text-gray-300 mb-2">Expense Name *</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                        </svg>
                                    </div>
                                    <input 
                                        type="text" 
                                        id="name" 
                                        name="name" 
                                        value="{{ old('name') }}"
                                        class="w-full pl-10 pr-4 py-3 bg-gray-700/50 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all" 
                                        placeholder="e.g., Rent, Netflix, Internet" 
                                        required
                                    >
                                </div>
                                @error('name')
                                    <div class="mt-2 text-red-400 text-sm flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Description Input -->
                            <div>
                                <label for="description" class="block text-sm font-semibold text-gray-300 mb-2">Description</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                                        </svg>
                                    </div>
                                    <input 
                                        type="text" 
                                        id="description" 
                                        name="description" 
                                        value="{{ old('description') }}"
                                        class="w-full pl-10 pr-4 py-3 bg-gray-700/50 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all" 
                                        placeholder="Brief description"
                                    >
                                </div>
                                @error('description')
                                    <div class="mt-2 text-red-400 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Amount Input -->
                            <div>
                                <label for="rec_ex_amount" class="block text-sm font-semibold text-gray-300 mb-2">Amount *</label>
                                <x-amount 
                                    id="rec_ex_amount" 
                                    name="rec_ex_amount" 
                                    class="w-full px-4 py-3 bg-gray-700/50 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all" 
                                    submitButtonId="submit-recurring-expense" 
                                    :validateBalance="false"
                                />
                                @error('rec_ex_amount')
                                    <div class="mt-2 text-red-400 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Frequency Select -->
                            <div>
                                <label for="frequency" class="block text-sm font-semibold text-gray-300 mb-2">Payment Frequency *</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <select 
                                        id="frequency" 
                                        name="frequency" 
                                        class="w-full pl-10 pr-4 py-3 bg-gray-700/50 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all appearance-none cursor-pointer"
                                        required
                                    >
                                        <option value="" class="text-gray-400">Select frequency</option>
                                        @foreach($frequencies as $frequency)
                                            <option value="{{ $frequency->value }}" {{ old('frequency') == $frequency->value ? 'selected' : '' }} class="bg-gray-700 text-white">
                                                {{ ucfirst($frequency->value) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </div>
                                @error('frequency')
                                    <div class="mt-2 text-red-400 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Payment Day -->
                            <div class="hidden" id="payment_divday">
                                <label for="payment_day" class="block text-sm font-semibold text-gray-300 mb-2">Payment Day</label>
                                <select id="payment_day" name="payment_day"
                                        class="w-full px-4 py-3 bg-gray-700/50 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all">
                                    <option value="" class="text-gray-400">Select payment day</option>
                                    @for($i = 1; $i <= 31; $i++)
                                    <option value="{{ $i }}" {{ old('payment_day') == $i ? 'selected' : '' }} class="bg-gray-700 text-white">{{ $i }}</option>
                                    @endfor
                                </select>
                                @error('payment_day')
                                <div class="mt-2 text-red-400 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Payment Month -->
                            <div class="hidden" id="payment_divmonth">
                                <label for="payment_month" class="block text-sm font-semibold text-gray-300 mb-2">Payment Month</label>
                                <select id="payment_month" name="payment_month"
                                class="w-full px-4 py-3 bg-gray-700/50 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all">
                                <option value="" class="text-gray-400">Select payment month</option>
                                @for($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ old('payment_month') == $i ? 'selected' : '' }} class="bg-gray-700 text-white">{{ \Carbon\Carbon::create()->month($i)->format('F') }}</option>
                                @endfor
                            </select>
                            @error('payment_month')
                            <div class="mt-2 text-red-400 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Card Selection -->
                        <div class="md:col-span-2">
                            <div class="flex justify-between items-center mb-2">
                                <label for="card_id" class="block text-sm font-semibold text-gray-300">
                                    Card 
                                    <span class="text-xs text-gray-400 bg-gray-700 rounded-full px-2 py-1 ml-2">Optional</span>
                                </label>
                                <button type="button" id="rec_clear-card-btn" 
                                class="text-sm text-red-400 hover:text-red-300 disabled:text-gray-500 disabled:cursor-not-allowed transition-colors duration-200 flex items-center gap-1" disabled>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    Clear
                                </button>
                            </div>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                    </svg>
                                </div>
                                <select name="card_id" id="rec_card_id" 
                                class="w-full pl-10 pr-4 py-3 bg-gray-700/50 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all appearance-none cursor-pointer">
                                    <option value="" selected class="text-gray-400">Select a card</option>
                                    @foreach($userCards as $card)
                                        <option value="{{ $card->id }}" class="bg-gray-700 text-white">{{ $card->name }} - ({{ $card->last4 }})</option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        </div>

                        <div class="flex justify-end gap-3 pt-4 border-t border-gray-700">
                            <button 
                                type="button"
                                id="cancel-form-btn"
                                class="bg-gray-700 hover:bg-gray-600 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 focus:ring-offset-gray-800"
                            >
                                Cancel
                            </button>
                            <button 
                                type="submit" 
                                id="submit-recurring-expense"
                                class="bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-gray-800 shadow-lg hover:shadow-red-500/50 flex items-center gap-2"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Add Expense
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Expenses List -->
            <div>
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-white font-oswald">Your Recurring Expenses</h2>
                    <span class="text-gray-400 text-sm">{{ $recurringExpenses->count() }} expense(s)</span>
                </div>
                
                <div class="grid grid-cols-1 gap-4">
                    @forelse($recurringExpenses as $expense)
                        <div class="group bg-gradient-to-br from-gray-800 to-gray-850 rounded-xl shadow-lg p-6 border border-gray-700 hover:border-red-500/50 transition-all duration-300 hover:shadow-xl hover:shadow-red-500/10">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-4">
                                        <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-red-600 rounded-lg flex items-center justify-center shadow-lg">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-xl font-bold text-white mb-1">{{ $expense->name }}</h3>
                                            <div class="flex items-center gap-2">
                                                <span class="text-xs bg-red-900/50 text-red-400 px-2 py-1 rounded-full font-semibold uppercase tracking-wide">
                                                    {{ ucfirst($expense->frequency) }}
                                                </span>
                                                @if($expense->card)
                                                    <span class="text-xs bg-blue-900/50 text-blue-400 px-2 py-1 rounded-full font-semibold flex items-center gap-1">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                                        </svg>
                                                        {{ $expense->card->name }} ({{ $expense->card->last4 }})
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                        @if($expense->description)
                                        <div class="bg-gray-900/50 p-4 rounded-lg border border-gray-700/50">
                                            <p class="text-gray-400 text-xs uppercase tracking-wide mb-1 flex items-center gap-1">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                                                </svg>
                                                Description
                                            </p>
                                            <p class="text-white font-medium">{{ $expense->description }}</p>
                                        </div>
                                        @endif
                                        
                                        <div class="bg-gray-900/50 p-4 rounded-lg border border-gray-700/50">
                                            <p class="text-gray-400 text-xs uppercase tracking-wide mb-1 flex items-center gap-1">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                Next Due
                                            </p>
                                            <p class="text-white font-medium">{{ Carbon\Carbon::parse($expense->next_due_date)->format('M d, Y') }}</p>
                                        </div>
                                        
                                        <div class="bg-gradient-to-br from-red-900/30 to-red-800/20 p-4 rounded-lg border border-red-700/50">
                                            <p class="text-red-400 text-xs uppercase tracking-wide mb-1 flex items-center gap-1">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                                </svg>
                                                Amount
                                            </p>
                                            <p class="text-2xl font-bold text-white">${{ number_format($expense->rec_ex_amount, 2) }}</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="flex items-start gap-2 ml-4">
                                    <button class="text-gray-400 hover:text-blue-400 transition-all duration-200 p-2 rounded-lg hover:bg-gray-700 group-hover:scale-110">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>
                                    <form action="{{ route('recurring.expenses.destroy', $expense) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    <button type="submit" class="text-gray-400 hover:text-red-400 transition-all duration-200 p-2 rounded-lg hover:bg-gray-700 group-hover:scale-110">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="flex flex-col items-center justify-center py-16 text-center bg-gradient-to-br from-gray-800 to-gray-850 rounded-xl border-2 border-dashed border-gray-700">
                            <div class="w-20 h-20 bg-gradient-to-br from-gray-700 to-gray-600 rounded-full flex items-center justify-center mb-6 shadow-xl">
                                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-white mb-2">No recurring expenses yet</h3>
                            <p class="text-gray-400 mb-6 max-w-md">Start tracking your regular expenses like rent, subscriptions, and bills to better manage your finances.</p>
                            <button 
                                onclick="document.getElementById('toggle-form-btn').click()"
                                class="bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-200 shadow-lg hover:shadow-red-500/50 flex items-center gap-2"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Add Your First Expense
                            </button>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleFormBtn = document.getElementById('toggle-form-btn');
            const closeFormBtn = document.getElementById('close-form-btn');
            const cancelFormBtn = document.getElementById('cancel-form-btn');
            const expenseForm = document.getElementById('rec-expense-form');
            const frequencySelect = document.getElementById('frequency');
            const paymentDivDay = document.getElementById('payment_divday');
            const paymentDivMonth = document.getElementById('payment_divmonth');
            const cardSelect = document.getElementById('rec_card_id');
            const clearBtn = document.getElementById('rec_clear-card-btn');

            // Toggle form visibility
            toggleFormBtn.addEventListener('click', function() {
                expenseForm.classList.remove('hidden');
                setTimeout(() => {
                    expenseForm.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }, 100);
            });

            closeFormBtn.addEventListener('click', function() {
                expenseForm.classList.add('hidden');
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });

            cancelFormBtn.addEventListener('click', function() {
                expenseForm.classList.add('hidden');
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });

            // Frequency change handler
            frequencySelect.addEventListener('change', function() {
                document.getElementById('payment_day').value = '';
                document.getElementById('payment_month').value = '';
                paymentDivDay.classList.add('hidden');
                paymentDivMonth.classList.add('hidden');

                if (this.value === 'monthly') {
                    paymentDivDay.classList.remove('hidden');
                } else if (this.value === 'yearly') {
                    paymentDivMonth.classList.remove('hidden');
                    paymentDivDay.classList.remove('hidden');
                }
            });

            // Card selection handler
            cardSelect.addEventListener('change', function(){
                clearBtn.disabled = this.value === '';
            });

            clearBtn.addEventListener('click', function() {
                cardSelect.value = '';
                clearBtn.disabled = true;
            });
        });
    </script>
</x-layout>