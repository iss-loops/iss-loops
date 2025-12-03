<div class="relative" x-data="{ open: @entangle('showResults') }" @click.away="open = false">
    {{-- Input de búsqueda --}}
    <div class="relative">
        <input 
            type="text" 
            wire:model.live.debounce.300ms="search"
            @focus="if($wire.search.length >= 2) open = true"
            placeholder="{{ __('Buscar artículos...') }}"
            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
            autocomplete="off"
        >
        
        {{-- Icono de búsqueda --}}
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </div>

        {{-- Botón limpiar --}}
        @if($search)
            <button 
                wire:click="resetSearch"
                class="absolute inset-y-0 right-0 pr-3 flex items-center"
            >
                <svg class="h-5 w-5 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        @endif
    </div>

    {{-- Panel de resultados --}}
    <div 
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-1"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-1"
        class="absolute z-50 w-full mt-2 bg-white rounded-lg shadow-xl border border-gray-200 max-h-96 overflow-y-auto"
        style="display: none;"
    >
        {{-- Loading state --}}
        <div wire:loading class="p-4 text-center text-gray-500">
            <svg class="animate-spin h-5 w-5 mx-auto text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </div>

        {{-- Resultados --}}
        <div wire:loading.remove>
            @if($results->isEmpty() && strlen($search) >= 2)
                <div class="p-4 text-center text-gray-500">
                    <svg class="h-12 w-12 mx-auto text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-sm">{{ __('No se encontraron resultados para') }} "<strong>{{ $search }}</strong>"</p>
                </div>
            @else
                <div class="py-2">
                    @foreach($results as $article)
                        <a 
                            href="{{ route('articles.show', $article->slug) }}"
                            wire:click="resetSearch"
                            class="block px-4 py-3 hover:bg-gray-50 transition-colors border-b border-gray-100 last:border-b-0"
                        >
                            <div class="flex items-start space-x-3">
                                {{-- Imagen miniatura --}}
                                @if($article->featured_image)
                                    <img 
                                        src="{{ Storage::url($article->featured_image) }}" 
                                        alt="{{ $article->getTranslation('title', app()->getLocale()) }}"
                                        class="w-16 h-16 object-cover rounded flex-shrink-0"
                                    >
                                @else
                                    <div class="w-16 h-16 bg-gray-200 rounded flex-shrink-0 flex items-center justify-center">
                                        <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    </div>
                                @endif

                                {{-- Contenido --}}
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-sm font-medium text-gray-900 line-clamp-1">
                                        {!! $this->highlightText($article->getTranslation('title', app()->getLocale()), $search) !!}
                                    </h4>
                                    <p class="text-xs text-gray-500 line-clamp-2 mt-1">
                                        {!! $this->highlightText(strip_tags($article->getTranslation('excerpt', app()->getLocale())), $search) !!}
                                    </p>
                                    
                                    {{-- Categorías --}}
                                    @if($article->categories->isNotEmpty())
                                        <div class="flex flex-wrap gap-1 mt-2">
                                            @foreach($article->categories->take(2) as $category)
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium" 
                                                      style="background-color: {{ $category->color }}20; color: {{ $category->color }};">
                                                    {{ $category->getTranslation('name', app()->getLocale()) }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                {{-- Footer con link a todos los resultados --}}
                @if($totalResults >= $resultsLimit)
                    <div class="border-t border-gray-200 p-3 text-center">
                        <a 
                            href="{{ route('articles.index', ['search' => $search]) }}"
                            wire:click="resetSearch"
                            class="text-sm text-blue-600 hover:text-blue-800 font-medium"
                        >
                            {{ __('Ver todos los resultados') }} →
                        </a>
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>