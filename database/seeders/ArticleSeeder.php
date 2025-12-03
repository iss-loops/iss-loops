<?php
// database/seeders/ArticleSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Article\Models\Article;
use App\Modules\Category\Models\Category;
use App\Modules\Tag\Models\Tag;
use App\Models\User;

class ArticleSeeder extends Seeder
{
    public function run()
    {
        // Obtener el primer usuario
        $user = User::first();
        if (!$user) {
            $this->command->error('No hay usuarios. Crea uno primero.');
            return;
        }

        // Artículos de ejemplo con contenido científico real
        $articles = [
            [
                'title' => [
                    'es' => 'Computación Cuántica: El Futuro de la Tecnología',
                    'en' => 'Quantum Computing: The Future of Technology'
                ],
                'slug' => 'computacion-cuantica-futuro-tecnologia',
                'excerpt' => [
                    'es' => 'Las computadoras cuánticas prometen revolucionar campos desde la medicina hasta la criptografía, resolviendo problemas imposibles para las computadoras clásicas.',
                    'en' => 'Quantum computers promise to revolutionize fields from medicine to cryptography, solving problems impossible for classical computers.'
                ],
                'body' => [
                    'es' => '<p>La computación cuántica representa uno de los avances más prometedores en tecnología. A diferencia de las computadoras clásicas que usan bits (0 o 1), las computadoras cuánticas utilizan qubits que pueden estar en superposición de ambos estados simultáneamente.</p><p>Esta característica permite procesar enormes cantidades de información en paralelo, lo que podría revolucionar campos como el descubrimiento de fármacos, la predicción del clima y la inteligencia artificial.</p>',
                    'en' => '<p>Quantum computing represents one of the most promising advances in technology. Unlike classical computers that use bits (0 or 1), quantum computers use qubits that can be in superposition of both states simultaneously.</p>'
                ],
                'status' => 'published',
                'is_featured' => true,
                'reading_time' => 7,
                'published_at' => now()->subDays(1),
            ],
            [
                'title' => [
                    'es' => 'El James Webb Revela los Secretos del Universo Primitivo',
                    'en' => 'James Webb Reveals Secrets of the Early Universe'
                ],
                'slug' => 'james-webb-secretos-universo-primitivo',
                'excerpt' => [
                    'es' => 'El telescopio espacial James Webb ha capturado imágenes sin precedentes de las primeras galaxias del universo, desafiando nuestras teorías sobre la formación cósmica.',
                    'en' => 'The James Webb Space Telescope has captured unprecedented images of the first galaxies in the universe, challenging our theories about cosmic formation.'
                ],
                'body' => [
                    'es' => '<p>El telescopio espacial James Webb continúa asombrando a la comunidad científica con sus descubrimientos. Las últimas imágenes revelan galaxias formadas apenas 300 millones de años después del Big Bang, mucho antes de lo que predecían los modelos actuales.</p><p>Estas observaciones están obligando a los astrónomos a reconsiderar cómo se formaron las primeras estructuras en el universo.</p>',
                    'en' => '<p>The James Webb Space Telescope continues to amaze the scientific community with its discoveries.</p>'
                ],
                'status' => 'published',
                'is_featured' => true,
                'reading_time' => 9,
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => [
                    'es' => 'Fusión Nuclear: Un Paso Más Cerca de la Energía Limpia Infinita',
                    'en' => 'Nuclear Fusion: One Step Closer to Infinite Clean Energy'
                ],
                'slug' => 'fusion-nuclear-energia-limpia-infinita',
                'excerpt' => [
                    'es' => 'Por primera vez en la historia, científicos logran una reacción de fusión nuclear que produce más energía de la que consume, marcando un hito histórico.',
                    'en' => 'For the first time in history, scientists achieve a nuclear fusion reaction that produces more energy than it consumes, marking a historic milestone.'
                ],
                'body' => [
                    'es' => '<p>El Laboratorio Nacional Lawrence Livermore ha logrado un avance histórico en fusión nuclear. Por primera vez, una reacción de fusión produjo más energía de la que se utilizó para iniciarla, un logro conocido como "ganancia neta de energía".</p><p>Este avance nos acerca un paso más a la promesa de energía limpia, abundante y prácticamente ilimitada.</p>',
                    'en' => '<p>Lawrence Livermore National Laboratory has achieved a historic breakthrough in nuclear fusion.</p>'
                ],
                'status' => 'published',
                'is_featured' => false,
                'reading_time' => 8,
                'published_at' => now()->subDays(3),
            ],
            [
                'title' => [
                    'es' => 'Organoides Cerebrales: Mini-cerebros en el Laboratorio',
                    'en' => 'Brain Organoids: Mini-brains in the Laboratory'
                ],
                'slug' => 'organoides-cerebrales-mini-cerebros',
                'excerpt' => [
                    'es' => 'Científicos cultivan tejido cerebral humano en laboratorio, abriendo nuevas posibilidades para estudiar enfermedades neurológicas y el desarrollo del cerebro.',
                    'en' => 'Scientists grow human brain tissue in the laboratory, opening new possibilities for studying neurological diseases and brain development.'
                ],
                'body' => [
                    'es' => '<p>Los organoides cerebrales son estructuras tridimensionales cultivadas a partir de células madre que replican aspectos del desarrollo y organización del cerebro humano.</p><p>Estos "mini-cerebros" están revolucionando nuestra capacidad para estudiar enfermedades como el Alzheimer, el Parkinson y el autismo en modelos más precisos que nunca antes.</p>',
                    'en' => '<p>Brain organoids are three-dimensional structures grown from stem cells that replicate aspects of human brain development and organization.</p>'
                ],
                'status' => 'published',
                'is_featured' => false,
                'reading_time' => 10,
                'published_at' => now()->subDays(4),
            ],
            [
                'title' => [
                    'es' => 'Grafeno: El Material del Futuro',
                    'en' => 'Graphene: The Material of the Future'
                ],
                'slug' => 'grafeno-material-del-futuro',
                'excerpt' => [
                    'es' => 'El grafeno, una lámina de carbono de un átomo de grosor, promete revolucionar la electrónica, medicina y energía con sus propiedades extraordinarias.',
                    'en' => 'Graphene, a one-atom-thick sheet of carbon, promises to revolutionize electronics, medicine, and energy with its extraordinary properties.'
                ],
                'body' => [
                    'es' => '<p>El grafeno es 200 veces más fuerte que el acero, más conductor que el cobre y casi completamente transparente. Estas propiedades únicas lo convierten en el candidato ideal para revolucionar múltiples industrias.</p><p>Desde baterías que se cargan en segundos hasta pantallas flexibles y sensores biomédicos ultrasensibles, el grafeno está cambiando nuestro futuro.</p>',
                    'en' => '<p>Graphene is 200 times stronger than steel, more conductive than copper, and almost completely transparent.</p>'
                ],
                'status' => 'published',
                'is_featured' => true,
                'reading_time' => 6,
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => [
                    'es' => 'Inteligencia Artificial Detecta Cáncer con 99% de Precisión',
                    'en' => 'AI Detects Cancer with 99% Accuracy'
                ],
                'slug' => 'ia-detecta-cancer-99-precision',
                'excerpt' => [
                    'es' => 'Un nuevo sistema de IA desarrollado por Google supera a los médicos en la detección temprana de cáncer de mama, salvando potencialmente millones de vidas.',
                    'en' => 'A new AI system developed by Google outperforms doctors in early breast cancer detection, potentially saving millions of lives.'
                ],
                'body' => [
                    'es' => '<p>Google Health ha desarrollado un sistema de inteligencia artificial que puede detectar cáncer de mama en mamografías con una precisión del 99.5%, superando a radiólogos experimentados.</p><p>El sistema reduce los falsos positivos en un 5.7% y los falsos negativos en un 9.4%, lo que significa diagnósticos más tempranos y tratamientos más efectivos.</p>',
                    'en' => '<p>Google Health has developed an artificial intelligence system that can detect breast cancer in mammograms with 99.5% accuracy.</p>'
                ],
                'status' => 'published',
                'is_featured' => false,
                'reading_time' => 5,
                'published_at' => now()->subDays(6),
            ],
            [
                'title' => [
                    'es' => 'Bacterias Modificadas Limpian Derrames de Petróleo',
                    'en' => 'Modified Bacteria Clean Oil Spills'
                ],
                'slug' => 'bacterias-modificadas-limpian-petroleo',
                'excerpt' => [
                    'es' => 'Científicos crean bacterias genéticamente modificadas capaces de consumir petróleo 10 veces más rápido, ofreciendo una solución ecológica a los derrames.',
                    'en' => 'Scientists create genetically modified bacteria capable of consuming oil 10 times faster, offering an ecological solution to spills.'
                ],
                'body' => [
                    'es' => '<p>Un equipo de biotecnólogos ha desarrollado una cepa de bacterias modificadas genéticamente que pueden degradar hidrocarburos del petróleo a una velocidad sin precedentes.</p><p>Estas bacterias no solo limpian el petróleo más rápido, sino que lo convierten en compuestos biodegradables inofensivos para el medio ambiente.</p>',
                    'en' => '<p>A team of biotechnologists has developed a strain of genetically modified bacteria that can degrade petroleum hydrocarbons at unprecedented speeds.</p>'
                ],
                'status' => 'published',
                'is_featured' => false,
                'reading_time' => 7,
                'published_at' => now()->subDays(7),
            ],
            [
                'title' => [
                    'es' => 'Fotosíntesis Artificial: Convirtiendo CO2 en Combustible',
                    'en' => 'Artificial Photosynthesis: Converting CO2 into Fuel'
                ],
                'slug' => 'fotosintesis-artificial-co2-combustible',
                'excerpt' => [
                    'es' => 'Investigadores desarrollan un sistema que imita la fotosíntesis natural para convertir dióxido de carbono en combustible limpio usando solo luz solar.',
                    'en' => 'Researchers develop a system that mimics natural photosynthesis to convert carbon dioxide into clean fuel using only sunlight.'
                ],
                'body' => [
                    'es' => '<p>Un equipo internacional ha creado una "hoja artificial" que puede convertir CO2 y agua en combustibles líquidos usando energía solar. Este avance podría resolver dos problemas globales simultáneamente: el exceso de CO2 atmosférico y la necesidad de combustibles limpios.</p><p>La eficiencia del sistema ya supera a las plantas naturales y continúa mejorando.</p>',
                    'en' => '<p>An international team has created an "artificial leaf" that can convert CO2 and water into liquid fuels using solar energy.</p>'
                ],
                'status' => 'published',
                'is_featured' => true,
                'reading_time' => 8,
                'published_at' => now()->subDays(8),
            ],
        ];

        foreach ($articles as $articleData) {
            Article::create(array_merge($articleData, [
                'created_by' => $user->id,
                'updated_by' => $user->id,
            ]));
        }

        $this->command->info('✅ ' . count($articles) . ' artículos creados exitosamente!');
    }
}