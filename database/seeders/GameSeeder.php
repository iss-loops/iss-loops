<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Game\Models\Game;
use Illuminate\Support\Str;

class GameSeeder extends Seeder
{
    public function run(): void
    {
        $games = [
            [
                'title' => [
                    'es' => 'Simulador de Péndulo Simple',
                    'en' => 'Simple Pendulum Simulator'
                ],
                'slug' => 'pendulum-simulator',
                'description' => [
                    'es' => 'Explora el movimiento armónico simple con este simulador interactivo de péndulo. Ajusta la longitud, masa y ángulo inicial para observar cómo cambia el periodo de oscilación.',
                    'en' => 'Explore simple harmonic motion with this interactive pendulum simulator. Adjust length, mass, and initial angle to observe how the oscillation period changes.'
                ],
                'instructions' => [
                    'es' => '1. Ajusta la longitud del péndulo con el control deslizante\n2. Modifica la masa de la bola\n3. Establece el ángulo inicial\n4. Presiona "Iniciar" para comenzar la simulación\n5. Observa cómo cambian las variables en tiempo real',
                    'en' => '1. Adjust the pendulum length with the slider\n2. Modify the ball mass\n3. Set the initial angle\n4. Press "Start" to begin the simulation\n5. Observe how variables change in real-time'
                ],
                'type' => 'physics',
                'difficulty' => 'medium',
                'thumbnail' => 'games/pendulum-thumb.jpg',
                'game_file' => 'pendulum',
                'learning_objectives' => [
                    'es' => [
                        'Comprender el movimiento armónico simple',
                        'Observar la relación entre longitud y periodo',
                        'Identificar las fuerzas que actúan sobre el péndulo',
                        'Analizar la conservación de energía'
                    ],
                    'en' => [
                        'Understand simple harmonic motion',
                        'Observe the relationship between length and period',
                        'Identify forces acting on the pendulum',
                        'Analyze energy conservation'
                    ]
                ],
                'estimated_time' => 15,
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'title' => [
                    'es' => 'Caída Libre',
                    'en' => 'Free Fall'
                ],
                'slug' => 'free-fall',
                'description' => [
                    'es' => 'Experimenta con la caída libre de objetos. Ajusta la altura inicial y la gravedad para ver cómo afectan el tiempo de caída y la velocidad final.',
                    'en' => 'Experiment with free falling objects. Adjust initial height and gravity to see how they affect fall time and final velocity.'
                ],
                'instructions' => [
                    'es' => '1. Selecciona la altura inicial\n2. Ajusta la gravedad (puedes simular otros planetas)\n3. Elige el objeto a soltar\n4. Presiona "Soltar" para iniciar\n5. Observa las gráficas de velocidad y posición',
                    'en' => '1. Select initial height\n2. Adjust gravity (simulate other planets)\n3. Choose the object to drop\n4. Press "Drop" to start\n5. Observe velocity and position graphs'
                ],
                'type' => 'physics',
                'difficulty' => 'easy',
                'thumbnail' => 'games/freefall-thumb.jpg',
                'game_file' => 'freefall',
                'learning_objectives' => [
                    'es' => [
                        'Entender el concepto de aceleración gravitacional',
                        'Calcular velocidad final y tiempo de caída',
                        'Comparar gravedad en diferentes planetas',
                        'Interpretar gráficas de movimiento'
                    ],
                    'en' => [
                        'Understand gravitational acceleration concept',
                        'Calculate final velocity and fall time',
                        'Compare gravity on different planets',
                        'Interpret motion graphs'
                    ]
                ],
                'estimated_time' => 10,
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'title' => [
                    'es' => 'Vectores en 2D',
                    'en' => '2D Vectors'
                ],
                'slug' => 'vectors-2d',
                'description' => [
                    'es' => 'Practica operaciones con vectores en dos dimensiones. Suma, resta, descomposición en componentes y producto punto de manera visual e interactiva.',
                    'en' => 'Practice operations with two-dimensional vectors. Add, subtract, decompose into components, and dot product in a visual and interactive way.'
                ],
                'instructions' => [
                    'es' => '1. Dibuja vectores arrastrando con el mouse\n2. Selecciona la operación que deseas realizar\n3. Observa el resultado gráficamente\n4. Lee los valores numéricos de componentes\n5. Prueba con diferentes ángulos y magnitudes',
                    'en' => '1. Draw vectors by dragging with the mouse\n2. Select the operation you want to perform\n3. Observe the result graphically\n4. Read numerical component values\n5. Try different angles and magnitudes'
                ],
                'type' => 'physics',
                'difficulty' => 'medium',
                'thumbnail' => 'games/vectors-thumb.jpg',
                'game_file' => 'vectors',
                'learning_objectives' => [
                    'es' => [
                        'Comprender la representación gráfica de vectores',
                        'Realizar operaciones vectoriales básicas',
                        'Descomponer vectores en componentes',
                        'Calcular magnitud y dirección'
                    ],
                    'en' => [
                        'Understand graphical representation of vectors',
                        'Perform basic vector operations',
                        'Decompose vectors into components',
                        'Calculate magnitude and direction'
                    ]
                ],
                'estimated_time' => 20,
                'is_active' => true,
                'is_featured' => false,
                'sort_order' => 3,
            ],
            [
                'title' => [
                    'es' => 'Tiro Parabólico',
                    'en' => 'Projectile Motion'
                ],
                'slug' => 'projectile-motion',
                'description' => [
                    'es' => 'Simula el lanzamiento de proyectiles. Ajusta el ángulo de disparo y la velocidad inicial para alcanzar diferentes objetivos y observar la trayectoria parabólica.',
                    'en' => 'Simulate projectile launching. Adjust launch angle and initial velocity to reach different targets and observe the parabolic trajectory.'
                ],
                'instructions' => [
                    'es' => '1. Ajusta el ángulo de lanzamiento\n2. Establece la velocidad inicial\n3. Presiona "Lanzar" para disparar\n4. Intenta alcanzar el objetivo\n5. Observa la descomposición de velocidades',
                    'en' => '1. Adjust launch angle\n2. Set initial velocity\n3. Press "Launch" to fire\n4. Try to reach the target\n5. Observe velocity decomposition'
                ],
                'type' => 'physics',
                'difficulty' => 'hard',
                'thumbnail' => 'games/projectile-thumb.jpg',
                'game_file' => 'projectile',
                'learning_objectives' => [
                    'es' => [
                        'Analizar movimiento en dos dimensiones',
                        'Comprender la independencia de movimientos',
                        'Calcular alcance máximo y altura máxima',
                        'Predecir trayectorias'
                    ],
                    'en' => [
                        'Analyze two-dimensional motion',
                        'Understand independence of motions',
                        'Calculate maximum range and height',
                        'Predict trajectories'
                    ]
                ],
                'estimated_time' => 25,
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($games as $gameData) {
            Game::create($gameData);
        }

        $this->command->info('✅ Games seeded successfully!');
    }
}