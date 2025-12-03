<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FunFactController;
use App\Http\Controllers\FestivalController;
use App\Http\Controllers\GameController;
// Redirect raíz a /es
Route::get('/', function () {
return redirect('/es');
});
// Redirects sin locale
Route::get('/login', function () {
return redirect('/es/login');
})->name('login.redirect');
Route::get('/register', function () {
return redirect('/es/register');
})->name('register.redirect');
// ============================================
// GRUPO DE RUTAS CON LOCALE (es|en)
// ============================================
Route::group(['prefix' => '{locale}', 'where' => ['locale' => 'es|en']], function () {
// ============================================
// HOME
// ============================================
Route::get('/', [HomeController::class, 'index'])->name('home');

// ============================================
// ARTÍCULOS
// ============================================
Route::get('/articulos', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articulos/{slug}', [ArticleController::class, 'show'])->name('articles.show');

// ============================================
// CATEGORÍAS
// ============================================
Route::get('/categorias', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categorias/{slug}', [CategoryController::class, 'show'])->name('categories.show');

// ============================================
// ENTREVISTAS
// ============================================
Route::get('/interviews', [InterviewController::class, 'index'])->name('interviews.index');
Route::get('/interviews/{slug}', [InterviewController::class, 'show'])->name('interviews.show');

// ============================================
// DATOS CURIOSOS (FUN FACTS)
// ============================================
Route::get('/datos-curiosos', [FunFactController::class, 'index'])->name('fun-facts.index');

// ============================================
// FESTIVAL ACADÉMICO DGETI
// ============================================
Route::get('/festival', [FestivalController::class, 'index'])->name('festival.index');
Route::get('/festival/{id}', [FestivalController::class, 'show'])
    ->where(['id' => '[0-9]+'])
    ->name('festival.show');
// ============================================
// JUEGOS (GAMES)
// ============================================
Route::prefix('games')->name('games.')->group(function () {
    Route::get('/', [GameController::class, 'index'])->name('index');
    Route::get('/{slug}', [GameController::class, 'show'])->name('show');
});

// ============================================
// PÁGINAS INSTITUCIONALES
// ============================================
Route::get('/nosotros', function ($locale) {
    return view('pages.institutional.about');
})->name('about');

Route::get('/contacto', [ContactController::class, 'show'])->name('contact');
Route::post('/contacto', [ContactController::class, 'send'])->name('contact.send');

Route::get('/privacidad', function ($locale) {
    return view('pages.institutional.privacy');
})->name('privacy');

Route::get('/terminos', function ($locale) {
    return view('pages.institutional.terms');
})->name('terms');

// ============================================
// AUTENTICACIÓN
// ============================================
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login-placeholder');
    })->name('login');
    
    Route::get('/register', function () {
        return view('auth.register-placeholder');
    })->name('register');
});

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('home', ['locale' => app()->getLocale()]);
})->middleware('auth')->name('logout');

// ============================================
// FAVORITOS (requieren autenticación)
// ============================================
Route::middleware('auth')->group(function () {
    Route::get('/favoritos', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/favoritos/toggle', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
    Route::delete('/favoritos/{favorite}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
    Route::delete('/favoritos', [FavoriteController::class, 'clear'])->name('favorites.clear');
});

// ============================================
// NEWSLETTER (requieren autenticación)
// ============================================
Route::post('/newsletter/subscribe', [SubscriberController::class, 'subscribe'])
    ->name('newsletter.subscribe');

Route::post('/newsletter/unsubscribe', [SubscriberController::class, 'unsubscribe'])
    ->name('newsletter.unsubscribe');

Route::post('/newsletter/preferences', [SubscriberController::class, 'updatePreferences'])
    ->name('newsletter.preferences');

});
