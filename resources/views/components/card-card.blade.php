@props(['card'])

<div class="bg-gray-800 relative rounded-lg shadow-lg p-6 border border-gray-700 hover:bg-gray-750 transition-all duration-200 hover:scale-103">
    <a href="{{ route('cards.show', $card) }}" class="absolute inset-0 z-10"></a>
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
                        
                        <div class="flex items-center space-x-2 z-20">
                            <button class="text-gray-400 hover:text-blue-400 transition-colors duration-200 p-2 rounded-lg hover:bg-gray-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                            <form action="{{ route('cards.destroy', $card) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        onclick="return confirm('Are you sure you want to delete this card?')"
                                        class="text-gray-400 hover:text-red-400 transition-colors duration-200 p-2 rounded-lg hover:bg-gray-700">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>