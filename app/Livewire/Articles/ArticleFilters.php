<?php

namespace App\Livewire\Articles;

use App\Modules\Article\Models\Article;
use App\Modules\Category\Models\Category;
use App\Modules\Tag\Models\Tag;
use Livewire\Component;
use Livewire\WithPagination;

class ArticleFilters extends Component
{
    use WithPagination;

    // ============================================
    // PROPIEDADES DE FILTROS
    // ============================================
    public string $search = '';
    public array $selectedCategories = [];
    public array $selectedTags = [];
    public string $sortBy = 'recent'; // recent, popular, alphabetical

    // Paginación
    protected $paginationTheme = 'tailwind';

    // ============================================
    // LISTENERS (para resetear desde fuera si es necesario)
    // ============================================
    protected $listeners = ['resetFilters' => 'clearFilters'];

    // ============================================
    // RESETEAR PAGINACIÓN AL CAMBIAR FILTROS
    // ============================================
    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingSelectedCategories(): void
    {
        $this->resetPage();
    }

    public function updatingSelectedTags(): void
    {
        $this->resetPage();
    }

    public function updatingSortBy(): void
    {
        $this->resetPage();
    }

    // ============================================
    // MÉTODOS PÚBLICOS
    // ============================================
    
    /**
     * Limpiar todos los filtros
     */
    public function clearFilters(): void
    {
        $this->search = '';
        $this->selectedCategories = [];
        $this->selectedTags = [];
        $this->sortBy = 'recent';
        $this->resetPage();
    }

    /**
     * Alternar selección de categoría
     */
    public function toggleCategory(int $categoryId): void
    {
        if (in_array($categoryId, $this->selectedCategories)) {
            $this->selectedCategories = array_filter(
                $this->selectedCategories,
                fn($id) => $id !== $categoryId
            );
        } else {
            $this->selectedCategories[] = $categoryId;
        }
        $this->resetPage();
    }

    /**
     * Alternar selección de tag
     */
    public function toggleTag(int $tagId): void
    {
        if (in_array($tagId, $this->selectedTags)) {
            $this->selectedTags = array_filter(
                $this->selectedTags,
                fn($id) => $id !== $tagId
            );
        } else {
            $this->selectedTags[] = $tagId;
        }
        $this->resetPage();
    }

    // ============================================
    // RENDER
    // ============================================
    public function render()
    {
        // Construir query con filtros
        $query = Article::query()
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->with(['categories', 'users']);

        // Filtro de búsqueda (en título y excerpt traducidos)
        if (!empty($this->search)) {
            $locale = app()->getLocale();
            $query->where(function ($q) use ($locale) {
                $q->whereRaw("JSON_EXTRACT(title, '$.{$locale}') LIKE ?", ["%{$this->search}%"])
                  ->orWhereRaw("JSON_EXTRACT(excerpt, '$.{$locale}') LIKE ?", ["%{$this->search}%"]);
            });
        }

        // Filtro por categorías
        if (!empty($this->selectedCategories)) {
            $query->whereHas('categories', function ($q) {
                $q->whereIn('categories.id', $this->selectedCategories);
            });
        }

        // Filtro por tags
        if (!empty($this->selectedTags)) {
            $query->whereHas('tags', function ($q) {
                $q->whereIn('tags.id', $this->selectedTags);
            });
        }

        // Ordenamiento
        switch ($this->sortBy) {
            case 'popular':
                // Ordenar por vistas (si implementas contador)
                // $query->orderBy('views_count', 'desc');
                $query->orderBy('published_at', 'desc'); // Fallback por ahora
                break;
            case 'alphabetical':
                $locale = app()->getLocale();
                $query->orderByRaw("JSON_EXTRACT(title, '$.{$locale}') ASC");
                break;
            case 'recent':
            default:
                $query->orderBy('published_at', 'desc');
                break;
        }

        // Obtener datos para la vista
        $articles = $query->paginate(12);
        $categories = Category::where('is_active', true)->orderBy('sort_order')->get();
        $tags = Tag::orderBy('name')->take(20)->get(); // Top 20 tags más usados

        return view('livewire.articles.article-filters', [
            'articles' => $articles,
            'categories' => $categories,
            'tags' => $tags,
            'activeFiltersCount' => count($this->selectedCategories) + count($this->selectedTags) + (!empty($this->search) ? 1 : 0)
        ]);
    }
}