<div>
    @auth
        <button 
            wire:click="toggle"
            type="button"
            class="group relative flex items-center justify-center w-7 h-7 rounded-full bg-white/90 backdrop-blur-sm shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-110"
            title="{{ $isFavorited ? __('Remove from favorites') : __('Add to favorites') }}"
        >
            {{-- Corazón SVG --}}
            <svg 
                class="w-5 h-5 transition-all duration-300 {{ $isFavorited ? 'text-red-500 fill-red-500 scale-110' : 'text-gray-400 fill-none hover:text-red-400' }}"
                viewBox="0 0 24 24" 
                stroke="currentColor" 
                stroke-width="2"
            >
                <path 
                    stroke-linecap="round" 
                    stroke-linejoin="round" 
                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
                />
            </svg>

            {{-- Animación de pulso cuando se hace favorito --}}
            @if($isFavorited)
                <span class="absolute inset-0 rounded-full bg-red-400 opacity-0 animate-ping"></span>
            @endif
        </button>
    @else
        <a 
            href="{{ route('login', ['locale' => app()->getLocale()]) }}"
            class="group relative flex items-center justify-center w-10 h-10 rounded-full bg-white/90 backdrop-blur-sm shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-110"
            title="{{ __('Login to add favorites') }}"
        >
            <svg 
                class="w-5 h-5 text-gray-400 fill-none hover:text-red-400 transition-colors duration-300"
                viewBox="0 0 24 24" 
                stroke="currentColor" 
                stroke-width="1"
            >
                <path 
                    stroke-linecap="round" 
                    stroke-linejoin="round" 
                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
                />
            </svg>
        </a>
    @endauth

    {{-- Toast de confirmación --}}
    @if($showToast)
        <div 
            x-data="{ show: true }"
            x-show="show"
            x-init="setTimeout(() => show = false, 2000)"
            class="fixed bottom-4 right-4 z-50 px-4 py-3 bg-white rounded-lg shadow-xl border-l-4 {{ $isFavorited ? 'border-red-500' : 'border-gray-400' }}"
        >
            <div class="flex items-center gap-2">
                @if($isFavorited)
                    <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                    </svg>
                @else
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                @endif
                <span class="text-sm font-medium text-gray-900">
                    {{ $isFavorited ? __('Added to favorites') : __('Removed from favorites') }}
                </span>
            </div>
        </div>
    @endif
</div>