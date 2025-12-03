<div x-data="{ 
    showFilters: false,
    filterAnimation() {
        gsap.from('.filter-tag', {
            opacity: 0,
            scale: 0.8,
            duration: 0.3,
            stagger: 0.05,
            ease: 'back.out(1.7)'
        });
    }
}" x-init="filterAnimation()" class="space-y-6">

    {{-- Header con búsqueda y toggle de filtros --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex flex-col md:flex-row md:items-center gap-4">
            
            {{-- Barra de búsqueda --}}
            <div class="flex-1">
                <div class="relative">
                    <input 
                        type="text" 
                        wire:model.live.debounce.300ms="search"
                        placeholder="{{ __('Buscar artículos...') }}"
                        class="w-full pl-11 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                    >
                    <svg class="absolute left-3 top-3.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    
                    @if($search)
                        <button 
                            wire:click="$set('search', '')"
                            class="absolute right-3 top-3.5 text-gray-400 hover:text-gray-600"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    @endif
                </div>
            </div>

            {{-- Botón toggle filtros (móvil) --}}
            <button 
                @click="showFilters = !showFilters"
                class="md:hidden flex items-center gap-2 px-4 py-3 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                </svg>
                <span>{{ __('Filtros') }}</span>
                @if($activeFiltersCount > 0)
                    <span class="px-2 py-0.5 bg-blue-600 text-white text-xs rounded-full">{{ $activeFiltersCount }}</span>
                @endif
            </button>

            {{-- Ordenamiento --}}
            <div class="flex items-center gap-2">
                <label class="text-sm text-gray-600 whitespace-nowrap">{{ __('Ordenar por:') }}</label>
                <select 
                    wire:model.live="sortBy"
                    class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                >
                    <option value="recent">{{ __('Más recientes') }}</option>
                    <option value="alphabetical">{{ __('Alfabético') }}</option>
                    <option value="popular">{{ __('Más populares') }}</option>
                </select>
            </div>

            {{-- Botón limpiar filtros --}}
            @if($activeFiltersCount > 0)
                <button 
                    wire:click="clearFilters"
                    class="px-4 py-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors text-sm font-medium"
                >
                    {{ __('Limpiar filtros') }}
                </button>
            @endif
        </div>
    </div>

    {{-- Panel de filtros --}}
    <div 
        x-show="showFilters || window.innerWidth >= 768"
        x-transition
        class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 space-y-6"
    >
        {{-- Filtro por categorías --}}
        <div>
            <h3 class="text-sm font-semibold text-gray-900 mb-3">{{ __('Categorías') }}</h3>
            <div class="flex flex-wrap gap-2">
                @foreach($categories as $category)
                    <button 
                        wire:click="toggleCategory({{ $category->id }})"
                        class="filter-tag px-4 py-2 rounded-full text-sm font-medium transition-all duration-200
                            {{ in_array($category->id, $selectedCategories) 
                                ? 'bg-blue-600 text-white' 
                                : 'bg-gray-100 text-gray-700 hover:bg-gray-200' 
                            }}"
                        style="{{ in_array($category->id, $selectedCategories) ? 'background-color: ' . $category->color : '' }}"
                    >
                        @if($category->icon)
                            <span class="mr-1">{{ $category->icon }}</span>
                        @endif
                        {{ $category->getTranslation('name', app()->getLocale()) }}
                    </button>
                @endforeach
            </div>
        </div>

        {{-- Filtro por tags --}}
        <div>
            <h3 class="text-sm font-semibold text-gray-900 mb-3">{{ __('Etiquetas') }}</h3>
            <div class="flex flex-wrap gap-2">
                @foreach($tags as $tag)
                    <button 
                        wire:click="toggleTag({{ $tag->id }})"
                        class="filter-tag px-3 py-1.5 rounded-lg text-xs font-medium transition-all duration-200
                            {{ in_array($tag->id, $selectedTags) 
                                ? 'bg-green-600 text-white' 
                                : 'bg-gray-100 text-gray-600 hover:bg-gray-200' 
                            }}"
                    >
                        #{{ $tag->getTranslation('name', app()->getLocale()) }}
                    </button>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Indicador de carga --}}
    <div wire:loading class="flex justify-center py-4">
        <div class="flex items-center gap-2 text-blue-600">
            <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span class="text-sm font-medium">{{ __('Cargando...') }}</span>
        </div>
    </div>

    {{-- Grid de artículos --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" wire:loading.remove>
        @forelse($articles as $article)
            <x-article-card :article="$article" />
        @empty
            <div class="col-span-full py-12 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900">{{ __('No se encontraron artículos') }}</h3>
                <p class="mt-2 text-sm text-gray-500">{{ __('Intenta ajustar tus filtros de búsqueda') }}</p>
            </div>
        @endforelse
    </div>

    {{-- Paginación --}}
    <div class="mt-8">
        {{ $articles->links() }}
    </div>

</div>

{{-- Scripts GSAP para animaciones (se cargan una sola vez) --}}
@push('scripts')
<script>
document.addEventListener('livewire:init', () => {
    // Animar nuevas cards cuando Livewire actualiza
    Livewire.hook('morph.updated', ({ el, component }) => {
        if (el.classList.contains('grid')) {
            gsap.from(el.children, {
                opacity: 0,
                y: 30,
                duration: 0.5,
                stagger: 0.1,
                ease: 'power2.out'
            });
        }
    });
});
</script>
@endpush