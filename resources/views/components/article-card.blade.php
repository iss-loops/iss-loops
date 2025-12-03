@props(['article'])

<article class="group bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border border-gray-100">
    {{-- Imagen destacada --}}
    <div class="relative">
        <a href="{{ route('articles.show', ['locale' => app()->getLocale(), 'slug' => $article->slug]) }}" class="block relative h-48 overflow-hidden">
            @if($article->featured_image)
                <img
                    src="{{ asset('storage/' . $article->featured_image) }}"
                    alt="{{ $article->getTranslation('title', app()->getLocale()) }}"
                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                    loading="lazy"
                >
            @else
                {{-- Gradiente por defecto si no hay imagen --}}
                <div class="w-full h-full bg-gradient-to-br from-blue-400 via-purple-500 to-pink-500"></div>
            @endif

            {{-- Overlay en hover --}}
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/0 to-black/0 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

            {{-- Badge de categoría --}}
            @if($article->categories->isNotEmpty())
            <span class="absolute top-3 left-3 px-3 py-1 text-xs font-semibold rounded-full backdrop-blur-sm"
                  style="background-color: {{ $article->categories->first()->color }}; color: white;">
                {{ $article->categories->first()->getTranslation('name', app()->getLocale()) }}
            </span>
            @endif

            {{-- Badge de destacado (opcional) --}}
            @if($article->is_featured)
            <span class="absolute top-3 right-3 px-2 py-1 bg-yellow-400 text-yellow-900 text-xs font-bold rounded-full">
                ⭐
            </span>
            @endif
        </a>

        {{-- Botón de Favorito en esquina superior derecha --}}
        <div class="absolute" style="top: 156px; right: 12px; z-index: 20;" onclick="event.stopPropagation();">
            @livewire('favorite-button', [
                'favorableType' => get_class($article),
                'favorableId' => $article->id,
                'showLabel' => false,
                'size' => 'sm'
            ], key('fav-'.$article->id))
        </div>
    </div>

    {{-- Contenido --}}
    <div class="p-5">
        {{-- Título --}}
        <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-blue-600 transition-colors">
            <a href="{{ route('articles.show', ['locale' => app()->getLocale(), 'slug' => $article->slug]) }}">
                {{ $article->getTranslation('title', app()->getLocale()) }}
            </a>
        </h3>

        {{-- Excerpt --}}
        <p class="text-gray-600 text-sm line-clamp-3 mb-4 leading-relaxed">
            {{ $article->getTranslation('excerpt', app()->getLocale()) }}
        </p>

        {{-- Botón Leer Más --}}
        <div class="flex items-center justify-between mt-4">
            <a href="{{ route('articles.show', ['locale' => app()->getLocale(), 'slug' => $article->slug]) }}"
               class="inline-flex items-center gap-1 text-blue-600 hover:text-blue-700 font-medium text-sm transition-colors group/link">
                {{ __('Read More') }}
                <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        {{-- Footer con meta info --}}
        <div class="flex items-center justify-between pt-4 border-t border-gray-100 mt-4">
            {{-- Fecha y tiempo de lectura --}}
            <div class="flex items-center gap-3 text-xs text-gray-500">
                <span class="flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    {{ $article->published_at->diffForHumans() }}
                </span>
                <span>•</span>
                <span class="flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ $article->reading_time }} min
                </span>
            </div>

            {{-- Autor (si existe) --}}
            @if($article->users->isNotEmpty())
            <div class="flex items-center gap-1.5">
                @if($article->users->first()->avatar)
                    <img src="{{ asset('storage/' . $article->users->first()->avatar) }}"
                         alt="{{ $article->users->first()->name }}"
                         class="w-6 h-6 rounded-full object-cover"
                         loading="lazy">
                @else
                    <div class="w-6 h-6 rounded-full bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center text-white text-xs font-bold">
                        {{ substr($article->users->first()->name, 0, 1) }}
                    </div>
                @endif
            </div>
            @endif
        </div>

        {{-- Tags (máximo 3) --}}
        @if($article->tags->isNotEmpty())
        <div class="flex flex-wrap gap-1.5 mt-3">
            @foreach($article->tags->take(3) as $tag)
            <span class="px-2 py-0.5 bg-gray-100 text-gray-600 text-xs rounded">
                #{{ $tag->getTranslation('name', app()->getLocale()) }}
            </span>
            @endforeach
        </div>
        @endif
    </div>

    {{-- Indicador de hover en la parte inferior --}}
    <div class="h-1 bg-gradient-to-r from-blue-500 to-purple-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></div>
</article>