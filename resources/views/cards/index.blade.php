<x-layout> 
    <div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 p-6">
        <div class="max-w-7xl mx-auto">
            
            <div class="mb-8">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h1 class="text-4xl font-bold text-white font-oswald mb-2 flex items-center gap-3">
                            <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-3 rounded-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                </svg>
                            </div>
                            Credit Cards
                        </h1>
                        <p class="text-gray-400 ml-16">Manage your credit cards and track your spending limits.</p>
                    </div>
                    
                    <button 
                        id="toggle-card-form-btn"
                        class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-900 shadow-lg hover:shadow-blue-500/50 flex items-center gap-2 hover:scale-105 active:scale-95"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Add Card
                    </button>
                </div>

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

            <div id="card-form" class="hidden mb-8 transform transition-all duration-300 ease-in-out">
                <div class="bg-gradient-to-br from-gray-800 to-gray-850 rounded-xl shadow-2xl p-8 border border-gray-700">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-white font-oswald flex items-center gap-2">
                            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Add New Credit Card
                        </h2>
                        <button 
                            id="close-card-form-btn"
                            class="text-gray-400 hover:text-blue-400 transition-colors p-2 hover:bg-gray-700 rounded-lg"
                        >
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <form action="{{ route('cards.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-semibold text-gray-300 mb-2">Card Name *</label>
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
                                        class="w-full pl-10 pr-4 py-3 bg-gray-700/50 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" 
                                        placeholder="e.g., Visa Gold, Mastercard Platinum" 
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

                            <div>
                                <label for="last4" class="block text-sm font-semibold text-gray-300 mb-2">Last 4 Digits *</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <input 
                                        type="text" 
                                        id="last4" 
                                        name="last4" 
                                        maxlength="4"
                                        value="{{ old('last4') }}"
                                        class="w-full pl-10 pr-4 py-3 bg-gray-700/50 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" 
                                        placeholder="1234" 
                                        required
                                    >
                                </div>
                                @error('last4')
                                    <div class="mt-2 text-red-400 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="limit" class="block text-sm font-semibold text-gray-300 mb-2">Credit Limit *</label>
                                <x-amount 
                                    id="limit" 
                                    name="limit" 
                                    class="w-full px-4 py-3 bg-gray-700/50 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" 
                                    submitButtonId="submit-card" 
                                    :validateBalance="false"
                                />
                                @error('limit')
                                    <div class="mt-2 text-red-400 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="closing_day" class="block text-sm font-semibold text-gray-300 mb-2">Closing Day</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <select 
                                        id="closing_day" 
                                        name="closing_day"
                                        class="w-full pl-10 pr-4 py-3 bg-gray-700/50 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all appearance-none cursor-pointer"
                                    >
                                        <option value="" class="text-gray-400">Select closing day</option>
                                        @for($i = 1; $i <= 31; $i++)
                                            <option value="{{ $i }}" {{ old('closing_day') == $i ? 'selected' : '' }} class="bg-gray-700 text-white">Day {{ $i }}</option>
                                        @endfor
                                    </select>
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </div>
                                @error('closing_day')
                                    <div class="mt-2 text-red-400 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="due_day" class="block text-sm font-semibold text-gray-300 mb-2">Due Day</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <select 
                                        id="due_day" 
                                        name="due_day"
                                        class="w-full pl-10 pr-4 py-3 bg-gray-700/50 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all appearance-none cursor-pointer"
                                    >
                                        <option value="" class="text-gray-400">Select due day</option>
                                        @for($i = 1; $i <= 31; $i++)
                                            <option value="{{ $i }}" {{ old('due_day') == $i ? 'selected' : '' }} class="bg-gray-700 text-white">Day {{ $i }}</option>
                                        @endfor
                                    </select>
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </div>
                                @error('due_day')
                                    <div class="mt-2 text-red-400 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="flex justify-end gap-3 pt-4 border-t border-gray-700">
                            <button 
                                type="button"
                                id="cancel-card-form-btn"
                                class="bg-gray-700 hover:bg-gray-600 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 focus:ring-offset-gray-800"
                            >
                                Cancel
                            </button>
                            <button 
                                type="submit" 
                                id="submit-card"
                                class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800 shadow-lg hover:shadow-blue-500/50 flex items-center gap-2"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Add Card
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div>
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-white font-oswald">Your Cards</h2>
                    <span class="text-gray-400 text-sm">{{ $cards->count() }} card(s)</span>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @forelse($cards as $card)
                        <x-card-card :card="$card" />
                    @empty
                        <div class="md:col-span-2 flex flex-col items-center justify-center py-16 text-center bg-gradient-to-br from-gray-800 to-gray-850 rounded-xl border-2 border-dashed border-gray-700">
                            <div class="w-20 h-20 bg-gradient-to-br from-gray-700 to-gray-600 rounded-full flex items-center justify-center mb-6 shadow-xl">
                                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-white mb-2">No credit cards yet</h3>
                            <p class="text-gray-400 mb-6 max-w-md">Add your credit cards to track expenses, manage limits, and monitor your spending across different cards.</p>
                            <button 
                                onclick="document.getElementById('toggle-card-form-btn').click()"
                                class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-200 shadow-lg hover:shadow-blue-500/50 flex items-center gap-2"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Add Your First Card
                            </button>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleFormBtn = document.getElementById('toggle-card-form-btn');
            const closeFormBtn = document.getElementById('close-card-form-btn');
            const cancelFormBtn = document.getElementById('cancel-card-form-btn');
            const cardForm = document.getElementById('card-form');

            toggleFormBtn.addEventListener('click', function() {
                cardForm.classList.remove('hidden');
                setTimeout(() => {
                    cardForm.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }, 100);
            });

            closeFormBtn.addEventListener('click', function() {
                cardForm.classList.add('hidden');
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });

            cancelFormBtn.addEventListener('click', function() {
                cardForm.classList.add('hidden');
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        });
    </script>
</x-layout>