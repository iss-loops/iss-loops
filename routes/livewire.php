<?php

use Illuminate\Support\Facades\Route;

// Rutas de Livewire
Livewire\Livewire::setUpdateRoute(function ($handle) {
    return Route::post('/livewire/update', $handle);
});

Livewire\Livewire::setScriptRoute(function ($handle) {
    return Route::get('/livewire/livewire.js', $handle);
});