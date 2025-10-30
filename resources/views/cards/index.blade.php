<x-layout> 
    <div class="max-w-4xl mx-auto p-6">
        @if(session('error'))
            <div class="bg-red-900 border border-red-700 text-red-300 px-4 py-3 rounded-md text-sm mb-6">
                {{ session('error') }}
            </div>
        @endif

        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-white font-oswald mb-2">Cards</h1>
            <p class="text-gray-400">Manage your credit cards here.</p>
        </div>

        <!-- Add Card Form -->
        <div class="bg-gray-800 rounded-lg shadow-xl p-6 border border-gray-700 mb-8">
            <h2 class="text-xl font-bold text-white mb-6 font-oswald">Add New Card</h2>
            
            <form action="{{ route('cards.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Card Name</label>
                        <input type="text" id="name" name="name" 
                               value="{{ old('name') }}"
                               class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors" 
                               placeholder="e.g., Visa Gold" required>
                        @error('name')
                            <div class="mt-2 text-red-400 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="last4" class="block text-sm font-medium text-gray-300 mb-2">Last 4 Digits</label>
                        <input type="text" id="last4" name="last4" maxlength="4" 
                               value="{{ old('last4') }}"
                               class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors" 
                               placeholder="1234" required>
                        @error('last4')
                            <div class="mt-2 text-red-400 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="limit" class="block text-sm font-medium text-gray-300 mb-2">Credit Limit</label>
                        <x-amount id="limit" name="limit" class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors"  submitButtonId="submit-card" :validateBalance="false"/>
                        @error('limit')
                            <div class="mt-2 text-red-400 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="closing_day" class="block text-sm font-medium text-gray-300 mb-2">Closing Day</label>
                        <select id="closing_day" name="closing_day"
                                class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors">
                            <option value="" class="text-gray-400">Select closing day</option>
                            @for($i = 1; $i <= 31; $i++)
                                <option value="{{ $i }}" {{ old('closing_day') == $i ? 'selected' : '' }} class="bg-gray-700 text-white">{{ $i }}</option>
                            @endfor
                        </select>
                        @error('closing_day')
                            <div class="mt-2 text-red-400 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="due_day" class="block text-sm font-medium text-gray-300 mb-2">Due Day</label>
                        <select id="due_day" name="due_day"
                                class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors">
                            <option value="" class="text-gray-400">Select due day</option>
                            @for($i = 1; $i <= 31; $i++)
                                <option value="{{ $i }}" {{ old('due_day') == $i ? 'selected' : '' }} class="bg-gray-700 text-white">{{ $i }}</option>
                            @endfor
                        </select>
                        @error('due_day')
                            <div class="mt-2 text-red-400 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" id="submit-card"
                            class="bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 focus:ring-offset-gray-800">
                        Add Card
                    </button>
                </div>
            </form>
        </div>

        <!-- Cards List -->
        <div class="space-y-4">
            <h2 class="text-xl font-bold text-white font-oswald mb-4">Your Cards</h2>
            
            @forelse($cards as $card)
                <x-card-card :card="$card" />
            @empty
                <div class="flex flex-col items-center justify-center py-12 text-center bg-gray-800 rounded-lg border border-gray-700">
                    <div class="w-16 h-16 bg-gray-700 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                    </div>
                    <p class="text-gray-400 text-lg mb-2">No cards found</p>
                    <p class="text-gray-500 text-sm">Add your first credit card to get started!</p>
                </div>
            @endforelse
        </div>
    </div>
</x-layout>