# ====================================================================
# Script de Instalación - Sistema de Categorías ISS-LOOPS
# ====================================================================

Write-Host "=== Instalando Sistema de Categorías ISS-LOOPS ===" -ForegroundColor Cyan
Write-Host ""

# Ruta de descargas
$DESCARGAS = "C:\Users\dolor\Downloads\files"

# Verificar que la carpeta de descargas existe
if (-Not (Test-Path $DESCARGAS)) {
    Write-Host "❌ ERROR: No se encontró la carpeta de descargas: $DESCARGAS" -ForegroundColor Red
    exit 1
}

# ====================================================================
# PASO 1: Crear directorios necesarios
# ====================================================================
Write-Host "📁 Creando directorios necesarios..." -ForegroundColor Yellow

$directorios = @(
    "app\Http\Controllers\Web",
    "app\Modules\Category\Models",
    "resources\views\pages\categories",
    "resources\views\layouts\partials"
)

foreach ($dir in $directorios) {
    if (-Not (Test-Path $dir)) {
        New-Item -ItemType Directory -Path $dir -Force | Out-Null
        Write-Host "  ✓ Creado: $dir" -ForegroundColor Green
    } else {
        Write-Host "  ✓ Ya existe: $dir" -ForegroundColor Gray
    }
}

Write-Host ""

# ====================================================================
# PASO 2: Copiar Controllers
# ====================================================================
Write-Host "📄 Copiando Controllers..." -ForegroundColor Yellow

# CategoryController
$origen = "$DESCARGAS\CategoryController.php"
$destino = "app\Http\Controllers\Web\CategoryController.php"
if (Test-Path $origen) {
    Copy-Item -Path $origen -Destination $destino -Force
    Write-Host "  ✓ CategoryController.php copiado" -ForegroundColor Green
} else {
    Write-Host "  ❌ No se encontró: CategoryController.php" -ForegroundColor Red
}

# ArticleController (renombrado)
$origen = "$DESCARGAS\ArticleController-updated.php"
$destino = "app\Http\Controllers\Web\ArticleController.php"
if (Test-Path $origen) {
    Copy-Item -Path $origen -Destination $destino -Force
    Write-Host "  ✓ ArticleController.php actualizado" -ForegroundColor Green
} else {
    Write-Host "  ❌ No se encontró: ArticleController-updated.php" -ForegroundColor Red
}

Write-Host ""

# ====================================================================
# PASO 3: Copiar Model
# ====================================================================
Write-Host "📦 Copiando Model..." -ForegroundColor Yellow

$origen = "$DESCARGAS\Category-model.php"
$destino = "app\Modules\Category\Models\Category.php"
if (Test-Path $origen) {
    Copy-Item -Path $origen -Destination $destino -Force
    Write-Host "  ✓ Category.php copiado" -ForegroundColor Green
} else {
    Write-Host "  ❌ No se encontró: Category-model.php" -ForegroundColor Red
}

Write-Host ""

# ====================================================================
# PASO 4: Copiar Views
# ====================================================================
Write-Host "🎨 Copiando Views..." -ForegroundColor Yellow

# Categorías - Index
$origen = "$DESCARGAS\categories-index.blade.php"
$destino = "resources\views\pages\categories\index.blade.php"
if (Test-Path $origen) {
    Copy-Item -Path $origen -Destination $destino -Force
    Write-Host "  ✓ categories/index.blade.php copiado" -ForegroundColor Green
} else {
    Write-Host "  ❌ No se encontró: categories-index.blade.php" -ForegroundColor Red
}

# Categorías - Show
$origen = "$DESCARGAS\categories-show.blade.php"
$destino = "resources\views\pages\categories\show.blade.php"
if (Test-Path $origen) {
    Copy-Item -Path $origen -Destination $destino -Force
    Write-Host "  ✓ categories/show.blade.php copiado" -ForegroundColor Green
} else {
    Write-Host "  ❌ No se encontró: categories-show.blade.php" -ForegroundColor Red
}

# Artículos - Index con filtros
$origen = "$DESCARGAS\articles-index-with-filters.blade.php"
$destino = "resources\views\pages\articles\index.blade.php"
if (Test-Path $origen) {
    Copy-Item -Path $origen -Destination $destino -Force
    Write-Host "  ✓ articles/index.blade.php actualizado (con filtros)" -ForegroundColor Green
} else {
    Write-Host "  ❌ No se encontró: articles-index-with-filters.blade.php" -ForegroundColor Red
}

# Navegación
$origen = "$DESCARGAS\nav-component.blade.php"
$destino = "resources\views\layouts\partials\nav.blade.php"
if (Test-Path $origen) {
    Copy-Item -Path $origen -Destination $destino -Force
    Write-Host "  ✓ layouts/partials/nav.blade.php actualizado" -ForegroundColor Green
} else {
    Write-Host "  ❌ No se encontró: nav-component.blade.php" -ForegroundColor Red
}

Write-Host ""

# ====================================================================
# PASO 5: Limpiar caché de Laravel
# ====================================================================
Write-Host "🧹 Limpiando caché de Laravel..." -ForegroundColor Yellow

try {
    php artisan cache:clear | Out-Null
    Write-Host "  ✓ Cache cleared" -ForegroundColor Green
    
    php artisan config:clear | Out-Null
    Write-Host "  ✓ Config cleared" -ForegroundColor Green
    
    php artisan route:clear | Out-Null
    Write-Host "  ✓ Routes cleared" -ForegroundColor Green
    
    composer dump-autoload -q
    Write-Host "  ✓ Autoload regenerado" -ForegroundColor Green
} catch {
    Write-Host "  ⚠ Advertencia: No se pudo limpiar algún cache" -ForegroundColor Yellow
}

Write-Host ""

# ====================================================================
# PASO 6: Verificación
# ====================================================================
Write-Host "🔍 Verificando instalación..." -ForegroundColor Yellow

$archivosEsperados = @(
    "app\Http\Controllers\Web\CategoryController.php",
    "app\Http\Controllers\Web\ArticleController.php",
    "app\Modules\Category\Models\Category.php",
    "resources\views\pages\categories\index.blade.php",
    "resources\views\pages\categories\show.blade.php",
    "resources\views\pages\articles\index.blade.php",
    "resources\views\layouts\partials\nav.blade.php"
)

$todoOk = $true
foreach ($archivo in $archivosEsperados) {
    if (Test-Path $archivo) {
        Write-Host "  ✓ $archivo" -ForegroundColor Green
    } else {
        Write-Host "  ❌ FALTA: $archivo" -ForegroundColor Red
        $todoOk = $false
    }
}

Write-Host ""

# ====================================================================
# RESUMEN FINAL
# ====================================================================
if ($todoOk) {
    Write-Host "════════════════════════════════════════════════════" -ForegroundColor Cyan
    Write-Host "✅ ¡INSTALACIÓN COMPLETADA EXITOSAMENTE!" -ForegroundColor Green
    Write-Host "════════════════════════════════════════════════════" -ForegroundColor Cyan
    Write-Host ""
    Write-Host "Próximos pasos:" -ForegroundColor Yellow
    Write-Host "1. Actualiza routes/web.php con las nuevas rutas" -ForegroundColor White
    Write-Host "2. Actualiza layouts/app.blade.php para incluir el nuevo nav" -ForegroundColor White
    Write-Host "3. Prueba visitando: http://localhost:8000/categorias" -ForegroundColor White
    Write-Host ""
} else {
    Write-Host "════════════════════════════════════════════════════" -ForegroundColor Red
    Write-Host "⚠ INSTALACIÓN INCOMPLETA" -ForegroundColor Yellow
    Write-Host "════════════════════════════════════════════════════" -ForegroundColor Red
    Write-Host ""
    Write-Host "Revisa los archivos faltantes marcados arriba." -ForegroundColor White
    Write-Host "Verifica que todos los archivos estén en:" -ForegroundColor White
    Write-Host "$DESCARGAS" -ForegroundColor Cyan
    Write-Host ""
}