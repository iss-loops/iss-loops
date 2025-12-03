{{-- resources/views/layouts/partials/footer.blade.php --}}
<footer class="bg-gray-900 text-gray-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            
            {{-- ✅ COLUMNA 1: Logo y descripción --}}
            <div class="md:col-span-1">
                <div class="flex items-center gap-3 mb-4">
                    <img src="{{ asset('images/loops.svg') }}" 
                         alt="LOOPS Logo" 
                         class="h-12 w-auto brightness-0 invert">
                    <div>
                        <h3 class="text-white font-bold text-xl">LOOPS</h3>
                        <p class="text-sm text-gray-400">{{ __('Scientific Communication') }}</p>
                    </div>
                </div>
                <p class="text-sm text-gray-400">
                    {{ __('Science communication for curious minds. Exploring the universe of knowledge.') }}
                </p>
            </div>

            {{-- ✅ COLUMNA 2: Navegación --}}
            <div class="md:col-span-1">
                <h3 class="text-white font-semibold mb-4">{{ __('Navigation') }}</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('home', ['locale' => app()->getLocale()]) }}"
                           class="text-sm hover:text-white transition-colors">
                            {{ __('Home') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('articles.index', ['locale' => app()->getLocale()]) }}"
                           class="text-sm hover:text-white transition-colors">
                            {{ __('Articles') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('categories.index', ['locale' => app()->getLocale()]) }}"
                           class="text-sm hover:text-white transition-colors">
                            {{ __('Categories') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about', ['locale' => app()->getLocale()]) }}"
                           class="text-sm hover:text-white transition-colors">
                            {{ __('About Us') }}
                        </a>
                    </li>
                </ul>
            </div>

            {{-- ✅ COLUMNA 3: Categorías populares --}}
            <div class="md:col-span-1">
                <h3 class="text-white font-semibold mb-4">{{ __('Popular Categories') }}</h3>
                <ul class="space-y-2">
                    @php
                        $popularCategories = \App\Modules\Category\Models\Category::where('is_active', true)
                            ->whereNull('parent_id')
                            ->orderBy('sort_order')
                            ->take(5)
                            ->get();
                    @endphp

                    @foreach($popularCategories as $category)
                        <li>
                            <a href="{{ route('categories.show', ['locale' => app()->getLocale(), 'slug' => $category->slug]) }}"
                               class="text-sm hover:text-white transition-colors flex items-center space-x-2">
                                <span class="w-1.5 h-1.5 rounded-full" style="background-color: {{ $category->color }}"></span>
                                <span>{{ $category->getTranslation('name', app()->getLocale()) }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- ✅ COLUMNA 4: Newsletter --}}
            <div class="md:col-span-1">
                <h3 class="text-white font-semibold mb-4">{{ __('Newsletter') }}</h3>
                <p class="text-sm text-gray-400 mb-4">
                    {{ __('Get the latest science news in your inbox.') }}
                </p>

                @auth
                    @php
                        $subscriber = Auth::user()->subscriber;
                        $isSubscribed = $subscriber && $subscriber->is_active;
                    @endphp

                    <div x-data="newsletterForm({{ $isSubscribed ? 'true' : 'false' }})">
                        {{-- Si NO está suscrito --}}
                        <div x-show="!subscribed" class="space-y-3">
                            {{-- Frecuencia --}}
                            <select x-model="frequency"
                                class="w-full px-4 py-2 bg-gray-800 text-white text-sm rounded-lg border border-gray-700 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="daily">{{ __('Daily') }}</option>
                                <option value="weekly">{{ __('Weekly') }}</option>
                                <option value="monthly">{{ __('Monthly') }}</option>
                            </select>

                            {{-- Botón suscribir --}}
                            <button @click="subscribe()"
                                :disabled="loading"
                                class="w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium text-sm rounded-lg transition disabled:opacity-50 disabled:cursor-not-allowed">
                                <span x-show="!loading">{{ __('Subscribe') }}</span>
                                <span x-show="loading">{{ __('Subscribing...') }}</span>
                            </button>

                            {{-- Categorías (checkboxes compactos) --}}
                            <div class="space-y-1.5 max-h-32 overflow-y-auto">
                                @foreach(\App\Modules\Category\Models\Category::active()->take(4)->get() as $category)
                                    <label class="flex items-center cursor-pointer text-xs">
                                        <input type="checkbox"
                                            value="{{ $category->id }}"
                                            x-model="categories"
                                            class="form-checkbox text-blue-600 rounded border-gray-600 bg-gray-800 focus:ring-blue-500 w-3.5 h-3.5">
                                        <span class="ml-2 text-gray-300">
                                            {{ $category->getTranslation('name', app()->getLocale()) }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        {{-- Si YA está suscrito --}}
                        <div x-show="subscribed" class="space-y-3">
                            <div class="flex items-center gap-2 text-green-400 text-sm">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span>{{ __('You are subscribed') }}</span>
                            </div>
                            <button @click="unsubscribe()"
                                :disabled="loading"
                                class="text-gray-400 hover:text-white underline text-xs disabled:opacity-50">
                                {{ __('Unsubscribe') }}
                            </button>
                        </div>

                        {{-- Mensajes --}}
                        <div x-show="message"
                            x-text="message"
                            :class="messageType === 'success' ? 'text-green-400' : 'text-red-400'"
                            class="mt-2 text-xs">
                        </div>
                    </div>
                @else
                    {{-- Si NO está autenticado --}}
                    <div class="bg-gray-800 rounded-lg p-4 border border-gray-700">
                        <p class="text-xs text-gray-400 mb-3">
                            {{ __('Sign in to subscribe to our newsletter') }}
                        </p>
                        <a href="{{ route('login', ['locale' => app()->getLocale()]) }}"
                            class="block text-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium text-sm rounded-lg transition">
                            {{ __('Sign In') }}
                        </a>
                    </div>
                @endauth
            </div>
        </div>

        {{-- Copyright y links legales --}}
        <div class="mt-12 pt-8 border-t border-gray-800">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <p class="text-sm text-gray-500">
                    © {{ date('Y') }} LOOPS. {{ __('All rights reserved.') }}
                </p>
                <div class="flex items-center space-x-6">
                    <a href="{{ route('privacy', ['locale' => app()->getLocale()]) }}" 
                       class="text-sm text-gray-500 hover:text-white transition-colors">
                        {{ __('Privacy Policy') }}
                    </a>
                    <a href="{{ route('terms', ['locale' => app()->getLocale()]) }}" 
                       class="text-sm text-gray-500 hover:text-white transition-colors">
                        {{ __('Terms and Conditions') }}
                    </a>
                    <a href="{{ route('contact', ['locale' => app()->getLocale()]) }}" 
                       class="text-sm text-gray-500 hover:text-white transition-colors">
                        {{ __('Contact') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>

{{-- Script Alpine.js para Newsletter --}}
<script>
function newsletterForm(initialSubscribed) {
    return {
        subscribed: initialSubscribed,
        loading: false,
        message: '',
        messageType: 'success',
        frequency: 'weekly',
        categories: [],

        async subscribe() {
            this.loading = true;
            this.message = '';

            try {
                const response = await fetch('/{{ app()->getLocale() }}/newsletter/subscribe', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        frequency: this.frequency,
                        categories: this.categories
                    })
                });

                const data = await response.json();

                if (data.status === 'success' || data.status === 'already_subscribed') {
                    this.subscribed = true;
                    this.message = data.message;
                    this.messageType = 'success';
                } else {
                    this.message = data.message;
                    this.messageType = 'error';
                }
            } catch (error) {
                this.message = '{{ __("An error occurred") }}';
                this.messageType = 'error';
            } finally {
                this.loading = false;

                setTimeout(() => {
                    this.message = '';
                }, 3000);
            }
        },

        async unsubscribe() {
            if (!confirm('{{ __("Are you sure you want to unsubscribe?") }}')) {
                return;
            }

            this.loading = true;

            try {
                const response = await fetch('/{{ app()->getLocale() }}/newsletter/unsubscribe', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });

                const data = await response.json();

                if (data.status === 'success') {
                    this.subscribed = false;
                    this.message = data.message;
                    this.messageType = 'success';
                }
            } catch (error) {
                this.message = '{{ __("An error occurred") }}';
                this.messageType = 'error';
            } finally {
                this.loading = false;
            }
        }
    }
}
</script>