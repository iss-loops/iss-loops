# Script de testing del sistema de idiomas
Write-Host "=== ISS-LOOPS - Test de Sistema Multilenguaje ===" -ForegroundColor Cyan
Write-Host ""

# Test 1: Verificar archivos de traducción
Write-Host "[1/7] Verificando archivos de traducción..." -ForegroundColor Yellow
if (Test-Path "lang/es.json") {
    Write-Host "  ✓ lang/es.json existe" -ForegroundColor Green
} else {
    Write-Host "  ✗ lang/es.json NO existe" -ForegroundColor Red
}

if (Test-Path "lang/en.json") {
    Write-Host "  ✓ lang/en.json existe" -ForegroundColor Green
} else {
    Write-Host "  ✗ lang/en.json NO existe" -ForegroundColor Red
}

# Test 2: Verificar configuración
Write-Host "[2/7] Verificando configuración..." -ForegroundColor Yellow
if (Test-Path "config/locales.php") {
    Write-Host "  ✓ config/locales.php existe" -ForegroundColor Green
} else {
    Write-Host "  ✗ config/locales.php NO existe" -ForegroundColor Red
}

# Test 3: Verificar middleware
Write-Host "[3/7] Verificando middleware..." -ForegroundColor Yellow
if (Test-Path "app/Http/Middleware/SetLocale.php") {
    Write-Host "  ✓ SetLocale middleware existe" -ForegroundColor Green
} else {
    Write-Host "  ✗ SetLocale middleware NO existe" -ForegroundColor Red
}

if (Test-Path "app/Http/Middleware/SavePreviousUrl.php") {
    Write-Host "  ✓ SavePreviousUrl middleware existe" -ForegroundColor Green
} else {
    Write-Host "  ✗ SavePreviousUrl middleware NO existe" -ForegroundColor Red
}

# Test 4: Verificar helper
Write-Host "[4/7] Verificando helper..." -ForegroundColor Yellow
if (Test-Path "app/Helpers/LocaleHelper.php") {
    Write-Host "  ✓ LocaleHelper existe" -ForegroundColor Green
} else {
    Write-Host "  ✗ LocaleHelper NO existe" -ForegroundColor Red
}

# Test 5: Verificar vistas
Write-Host "[5/7] Verificando vistas..." -ForegroundColor Yellow
if (Test-Path "resources/views/layouts/app.blade.php") {
    Write-Host "  ✓ app.blade.php existe" -ForegroundColor Green
} else {
    Write-Host "  ✗ app.blade.php NO existe" -ForegroundColor Red
}

if (Test-Path "resources/views/layouts/partials/nav.blade.php") {
    Write-Host "  ✓ nav.blade.php existe" -ForegroundColor Green
} else {
    Write-Host "  ✗ nav.blade.php NO existe" -ForegroundColor Red
}

if (Test-Path "resources/views/layouts/partials/footer.blade.php") {
    Write-Host "  ✓ footer.blade.php existe" -ForegroundColor Green
} else {
    Write-Host "  ✗ footer.blade.php NO existe" -ForegroundColor Red
}

# Test 6: Verificar rutas
Write-Host "[6/7] Verificando rutas..." -ForegroundColor Yellow
if (Test-Path "routes/web.php") {
    Write-Host "  ✓ web.php existe" -ForegroundColor Green
} else {
    Write-Host "  ✗ web.php NO existe" -ForegroundColor Red
}

# Test 7: Limpiar caché
Write-Host "[7/7] Limpiando caché..." -ForegroundColor Yellow
php artisan config:clear | Out-Null
php artisan cache:clear | Out-Null
php artisan view:clear | Out-Null
php artisan route:clear | Out-Null
Write-Host "  ✓ Caché limpiado" -ForegroundColor Green

Write-Host ""
Write-Host "=== Testing completado ===" -ForegroundColor Cyan
Write-Host ""
Write-Host "Ahora prueba manualmente en el navegador:" -ForegroundColor Yellow
Write-Host "  1. http://localhost:8000" -ForegroundColor White
Write-Host "  2. Cambia entre idiomas usando el selector" -ForegroundColor White
Write-Host "  3. Navega por diferentes páginas" -ForegroundColor White
Write-Host "  4. Verifica que las traducciones funcionen" -ForegroundColor White
Write-Host ""