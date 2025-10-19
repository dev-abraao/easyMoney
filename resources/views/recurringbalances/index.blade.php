<x-layout> 
    <div class="max-w-4xl mx-auto p-6">
        @if(session('error'))
            <div class="bg-red-900 border border-red-700 text-red-300 px-4 py-3 rounded-md text-sm mb-6">
                {{ session('error') }}
            </div>
        @endif

        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-white font-oswald mb-2">Recurring Payments</h1>
            <p class="text-gray-400">Manage your recurring income here.</p>
        </div>

        <!-- Add Payment Form -->
        <div class="bg-gray-800 rounded-lg shadow-xl p-6 border border-gray-700 mb-8">
            <h2 class="text-xl font-bold text-white mb-6 font-oswald">Add New Payment</h2>
            
            <form action="{{ route('recurring.balances.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name Input -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Payment Name</label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            value="{{ old('name') }}"
                            class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors" 
                            placeholder="e.g., Monthly Salary" 
                            required
                        >
                        @error('name')
                            <div class="mt-2 text-red-400 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description Input -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-300 mb-2">Description</label>
                        <input 
                            type="text" 
                            id="description" 
                            name="description" 
                            value="{{ old('description') }}"
                            class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors" 
                            placeholder="Brief description of the payment"
                            required
                        >
                        @error('description')
                            <div class="mt-2 text-red-400 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Amount Input -->
                    <div>
                        <label for="rec_bal_amount" class="block text-sm font-medium text-gray-300 mb-2">Amount</label>
                        <x-amount 
                            id="rec_bal_amount" 
                            name="rec_bal_amount" 
                            class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors" 
                            submitButtonId="submit-recurring-balance" 
                            :validateBalance="false"
                        />
                        @error('rec_bal_amount')
                            <div class="mt-2 text-red-400 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Frequency Select -->
                    <div>
                        <label for="frequency" class="block text-sm font-medium text-gray-300 mb-2">Payment Frequency</label>
                        <select 
                            id="frequency" 
                            name="frequency" 
                            class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors"
                            required
                        >
                            <option value="" class="text-gray-400">Select frequency</option>
                            @foreach($frequencies as $frequency)
                                <option value="{{ $frequency->value }}" {{ old('frequency') == $frequency->value ? 'selected' : '' }} class="bg-gray-700 text-white">
                                    {{ ucfirst($frequency->value) }}
                                </option>
                            @endforeach
                        </select>
                        @error('frequency')
                            <div class="mt-2 text-red-400 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end">
                    <button 
                        type="submit" 
                        id="submit-recurring-balance"
                        class="bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 focus:ring-offset-gray-800"
                    >
                        Add Payment
                    </button>
                </div>
            </form>
        </div>

        <!-- Payments List -->
        <div class="space-y-4">
            <h2 class="text-xl font-bold text-white font-oswald mb-4">Your Recurring Payments</h2>
            
            @forelse($recurringBalances as $balance)
                <div class="bg-gray-800 rounded-lg shadow-lg p-6 border border-gray-700 hover:bg-gray-750 transition-all duration-200">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-3">
                                <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                <h3 class="text-lg font-semibold text-white">{{ $balance->name }}</h3>
                                <span class="text-gray-400">{{ ucfirst($balance->frequency) }}</span>
                            </div>
                            
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 text-sm">
                                <div>
                                    <p class="text-gray-400">Description</p>
                                    <p class="text-white">{{ $balance->description }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-400">Next Payment</p>
                                    <p class="text-white">{{ Carbon\Carbon::parse($balance->next_due_date)->format('d/m/Y')  ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-400">Amount</p>
                                    <p class="text-green-400 font-semibold">${{ number_format($balance->rec_bal_amount, 2) }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-2">
                            <button class="text-gray-400 hover:text-blue-400 transition-colors duration-200 p-2 rounded-lg hover:bg-gray-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="flex flex-col items-center justify-center py-12 text-center bg-gray-800 rounded-lg border border-gray-700">
                    <div class="w-16 h-16 bg-gray-700 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <p class="text-gray-400 text-lg mb-2">No recurring payments found</p>
                    <p class="text-gray-500 text-sm">Add your first recurring payment to get started!</p>
                </div>
            @endforelse
        </div>
    </div>
</x-layout>