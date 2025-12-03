{{-- resources/views/components/layouts/footer.blade.php --}}
<footer class="bg-gray-900 text-white mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-xl font-bold mb-4 bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">
                    ISS-LOOPS
                </h3>
                <p class="text-gray-400">
                    Divulgación científica para mentes curiosas
                </p>
            </div>
            
            <div>
                <h4 class="font-semibold mb-4">Categorías</h4>
                <ul class="space-y-2 text-gray-400">
                    <li><a href="#" class="hover:text-white transition">Física</a></li>
                    <li><a href="#" class="hover:text-white transition">Biología</a></li>
                    <li><a href="#" class="hover:text-white transition">Tecnología</a></li>
                    <li><a href="#" class="hover:text-white transition">Astronomía</a></li>
                </ul>
            </div>
            
            <div>
                <h4 class="font-semibold mb-4">Enlaces</h4>
                <ul class="space-y-2 text-gray-400">
                    <li><a href="/sobre-nosotros" class="hover:text-white transition">Sobre Nosotros</a></li>
                    <li><a href="/contacto" class="hover:text-white transition">Contacto</a></li>
                    <li><a href="#" class="hover:text-white transition">Newsletter</a></li>
                </ul>
            </div>
            
            <div>
                <h4 class="font-semibold mb-4">Newsletter</h4>
                <p class="text-gray-400 mb-4">
                    Recibe los últimos artículos en tu correo
                </p>
                <form class="flex">
                    <input type="email" 
                           placeholder="tu@email.com" 
                           class="bg-gray-800 text-white px-4 py-2 rounded-l-lg flex-1 focus:outline-none focus:bg-gray-700">
                    <button type="submit" 
                            class="bg-blue-600 px-4 py-2 rounded-r-lg hover:bg-blue-700 transition">
                        Suscribir
                    </button>
                </form>
            </div>
        </div>
        
        <div class="mt-8 pt-8 border-t border-gray-800 text-center text-gray-400">
            <p>&copy; 2025 ISS-LOOPS. PROYECTO EDUCATIVO SIN FINES DE LUCRO</p>
        </div>
    </div>
</footer>