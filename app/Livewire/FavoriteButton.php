<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FavoriteButton extends Component
{
    public $favorableType;
    public $favorableId;
    public $showLabel = true;
    public $size = 'md'; // sm, md, lg
    
    public $isFavorited = false;
    public $favoritesCount = 0;
    public $showToast = false;
    public $toastMessage = '';

    public function mount($favorableType, $favorableId, $showLabel = true, $size = 'md')
    {
        $this->favorableType = $favorableType;
        $this->favorableId = $favorableId;
        $this->showLabel = $showLabel;
        $this->size = $size;
        
        $this->updateFavoriteState();
    }

    public function toggle()
    {
        Log::info('FavoriteButton toggle called', [
            'favorableType' => $this->favorableType,
            'favorableId' => $this->favorableId,
            'authenticated' => Auth::check()
        ]);

        // Verificar autenticación
        if (!Auth::check()) {
            Log::info('User not authenticated, redirecting to login');
            session()->flash('message', __('Please login to add favorites'));
            return redirect()->route('login', ['locale' => app()->getLocale()]);
        }

        try {
            $favorable = $this->favorableType::findOrFail($this->favorableId);
            $user = Auth::user();

            Log::info('Before toggle', [
                'user_id' => $user->id,
                'favorable_id' => $favorable->id
            ]);

            // Toggle favorito
            $wasAdded = $user->toggleFavorite($favorable);

            Log::info('After toggle', [
                'wasAdded' => $wasAdded
            ]);

            // Actualizar estado
            $this->updateFavoriteState();

            // Mostrar mensaje
            if ($wasAdded) {
                $this->toastMessage = __('Added to favorites');
            } else {
                $this->toastMessage = __('Removed from favorites');
            }

            $this->showToast = true;
            
            Log::info('Toast should show', [
                'showToast' => $this->showToast,
                'message' => $this->toastMessage
            ]);

        } catch (\Exception $e) {
            Log::error('Error in toggle', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            $this->toastMessage = __('An error occurred');
            $this->showToast = true;
        }
    }

    public function updateFavoriteState()
    {
        if (Auth::check()) {
            $favorable = $this->favorableType::find($this->favorableId);
            if ($favorable) {
                $this->isFavorited = $favorable->isFavoritedBy(Auth::id());
                $this->favoritesCount = $favorable->favoritesCount();
            }
        } else {
            $this->isFavorited = false;
            $favorable = $this->favorableType::find($this->favorableId);
            $this->favoritesCount = $favorable ? $favorable->favoritesCount() : 0;
        }
    }

    public function getSizeClasses()
    {
        return match($this->size) {
            'sm' => 'p-1.5',
            'lg' => 'p-3',
            default => 'p-2',
        };
    }

    public function getIconSize()
    {
        return match($this->size) {
            'sm' => 'w-4 h-4',
            'lg' => 'w-6 h-6',
            default => 'w-5 h-5',
        };
    }

    public function render()
    {
        return view('livewire.favorite-button');
    }
}