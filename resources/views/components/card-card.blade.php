@props(['card'])

<div class="group bg-gradient-to-br from-gray-800 to-gray-850 rounded-xl shadow-lg p-6 border border-gray-700 hover:border-blue-500/50 transition-all duration-300 hover:shadow-xl hover:shadow-blue-500/10 relative overflow-hidden">
    <a href="{{ route('cards.show', $card) }}" class="absolute inset-0 z-10"></a>
    
    <div class="relative">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-white mb-1 group-hover:text-blue-400 transition-colors">{{ $card->name }}</h3>
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                        <span class="text-gray-400 font-mono text-sm">•••• {{ $card->last4 }}</span>
                    </div>
                </div>
            </div>
            
            <div class="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-20">
                <button class="text-gray-400 hover:text-blue-400 transition-all duration-200 p-2 rounded-lg hover:bg-gray-700 hover:scale-110">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </button>
                <form action="{{ route('cards.destroy', $card) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            onclick="return confirm('Are you sure you want to delete this card?')"
                            class="text-gray-400 hover:text-red-400 transition-all duration-200 p-2 rounded-lg hover:bg-gray-700 hover:scale-110">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                </form>
            </div>
        </div>

        <div class="grid grid-cols-3 gap-4">
            <div class="bg-gradient-to-br from-blue-900/30 to-blue-800/20 p-4 rounded-lg border border-blue-700/50">
                <p class="text-blue-400 text-xs uppercase tracking-wide mb-1 flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                    Limit
                </p>
                <p class="text-xl font-bold text-white">${{ number_format($card->limit, 0) }}</p>
            </div>
            
            @if($card->closing_day)
            <div class="bg-gray-900/50 p-4 rounded-lg border border-gray-700/50">
                <p class="text-gray-400 text-xs uppercase tracking-wide mb-1 flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Closing
                </p>
                <p class="text-xl font-bold text-white">Day {{ $card->closing_day }}</p>
            </div>
            @endif
            
            @if($card->due_day)
            <div class="bg-gray-900/50 p-4 rounded-lg border border-gray-700/50">
                <p class="text-gray-400 text-xs uppercase tracking-wide mb-1 flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Due
                </p>
                <p class="text-xl font-bold text-white">Day {{ $card->due_day }}</p>
            </div>
            @endif
            
            @if(!$card->closing_day && !$card->due_day)
            <div class="col-span-2 bg-gray-900/30 p-4 rounded-lg border border-gray-700/30 border-dashed">
                <p class="text-gray-500 text-xs text-center">No payment dates set</p>
            </div>
            @elseif(!$card->closing_day || !$card->due_day)
            <div class="bg-gray-900/30 p-4 rounded-lg border border-gray-700/30 border-dashed">
                <p class="text-gray-500 text-xs text-center">-</p>
            </div>
            @endif
        </div>

        <div class="mt-4 pt-4 border-t border-gray-700/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            <div class="flex items-center justify-between text-sm">
                <span class="text-gray-400">Click to view details</span>
                <svg class="w-4 h-4 text-blue-400 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </div>
        </div>
    </div>
</div>