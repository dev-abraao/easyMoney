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
                <div class="bg-gray-800 rounded-lg shadow-lg p-6 border border-gray-700 hover:bg-gray-750 transition-all duration-200">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-3">
                                <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                <h3 class="text-lg font-semibold text-white">{{ $card->name }}</h3>
                                <span class="text-gray-400 font-mono">****{{ $card->last4 }}</span>
                            </div>
                            
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                                <div>
                                    <p class="text-gray-400">Credit Limit</p>
                                    <p class="text-green-400 font-semibold">${{ number_format($card->limit, 2) }}</p>
                                </div>
                                @if($card->closing_day)
                                <div>
                                    <p class="text-gray-400">Closing Day</p>
                                    <p class="text-white">{{ $card->closing_day }}</p>
                                </div>
                                @endif
                                @if($card->due_day)
                                <div>
                                    <p class="text-gray-400">Due Day</p>
                                    <p class="text-white">{{ $card->due_day }}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-2">
                            <button class="text-gray-400 hover:text-blue-400 transition-colors duration-200 p-2 rounded-lg hover:bg-gray-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                            {{-- <form action="{{ route('cards.destroy', $card) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        onclick="return confirm('Are you sure you want to delete this card?')"
                                        class="text-gray-400 hover:text-red-400 transition-colors duration-200 p-2 rounded-lg hover:bg-gray-700">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form> --}}
                        </div>
                    </div>
                </div>
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