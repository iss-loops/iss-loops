<?php

namespace App\Livewire;

use Livewire\Component;
use App\Modules\Article\Models\Article;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class ArticleSearch extends Component
{
    public string $search = '';
    public bool $showResults = false;
    public int $resultsLimit = 5;
    
    protected $listeners = ['closeSearch' => 'resetSearch'];

    public function updatedSearch()
    {
        $this->showResults = strlen($this->search) >= 2;
    }

    public function resetSearch()
    {
        $this->search = '';
        $this->showResults = false;
    }

    public function getResultsProperty(): Collection
    {
        // Debug: Log para verificar que se ejecuta
        Log::info('Search ejecutado', [
            'search' => $this->search,
            'length' => strlen($this->search)
        ]);

        if (strlen($this->search) < 2) {
            return collect();
        }

        $locale = app()->getLocale();
        $searchTerm = '%' . $this->search . '%';

        try {
            $results = Article::query()
                ->where('status', 'published')
                ->where(function ($query) use ($searchTerm, $locale) {
                    $query->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(title, '$.{$locale}')) LIKE ?", [$searchTerm])
                          ->orWhereRaw("JSON_UNQUOTE(JSON_EXTRACT(excerpt, '$.{$locale}')) LIKE ?", [$searchTerm])
                          ->orWhereRaw("JSON_UNQUOTE(JSON_EXTRACT(body, '$.{$locale}')) LIKE ?", [$searchTerm]);
                })
                ->with(['categories'])
                ->orderBy('published_at', 'desc')
                ->limit($this->resultsLimit)
                ->get();

            Log::info('Resultados encontrados', ['count' => $results->count()]);

            return $results;

        } catch (\Exception $e) {
            Log::error('Error en búsqueda: ' . $e->getMessage());
            return collect();
        }
    }

    public function highlightText(string $text, string $search): string
    {
        if (empty($search)) {
            return e($text);
        }

        $highlighted = preg_replace(
            '/(' . preg_quote($search, '/') . ')/i',
            '<mark class="bg-yellow-200 font-medium">$1</mark>',
            e($text)
        );

        return $highlighted;
    }

    public function render()
    {
        return view('livewire.article-search', [
            'results' => $this->results,
            'totalResults' => $this->results->count()
        ]);
    }
}