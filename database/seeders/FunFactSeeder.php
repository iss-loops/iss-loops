<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\FunFact\Models\FunFact;
use App\Modules\Category\Models\Category;

class FunFactSeeder extends Seeder
{
    public function run(): void
    {
        $physics = Category::where('slug', 'fisica')->first();
        $biology = Category::where('slug', 'biologia')->first();
        $astronomy = Category::where('slug', 'astronomia')->first();
        $technology = Category::where('slug', 'tecnologia')->first();

        $funFacts = [
            [
                'title' => [
                    'es' => '¿Sabías que el agua caliente se congela más rápido que la fría?',
                    'en' => 'Did you know hot water freezes faster than cold water?'
                ],
                'content' => [
                    'es' => 'Este fenómeno se conoce como el efecto Mpemba, nombrado por el estudiante tanzano que lo redescubrió en 1963. Aunque parezca contradictorio, bajo ciertas condiciones el agua caliente puede congelarse más rápido que el agua fría.',
                    'en' => 'This phenomenon is known as the Mpemba effect, named after the Tanzanian student who rediscovered it in 1963. Although it may seem contradictory, under certain conditions hot water can freeze faster than cold water.'
                ],
                'category_id' => $physics?->id,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'title' => [
                    'es' => 'Los pulpos tienen tres corazones',
                    'en' => 'Octopuses have three hearts'
                ],
                'content' => [
                    'es' => 'Dos de ellos bombean sangre a las branquias, mientras que el tercero bombea sangre al resto del cuerpo. Además, su sangre es azul debido a una proteína rica en cobre llamada hemocianina.',
                    'en' => 'Two of them pump blood to the gills, while the third pumps blood to the rest of the body. Additionally, their blood is blue due to a copper-rich protein called hemocyanin.'
                ],
                'category_id' => $biology?->id,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'title' => [
                    'es' => 'Un día en Venus dura más que un año en Venus',
                    'en' => 'A day on Venus lasts longer than a year on Venus'
                ],
                'content' => [
                    'es' => 'Venus tarda 243 días terrestres en completar una rotación sobre su eje, pero solo 225 días terrestres en orbitar alrededor del Sol. Esto significa que su día es más largo que su año.',
                    'en' => 'Venus takes 243 Earth days to complete one rotation on its axis, but only 225 Earth days to orbit the Sun. This means its day is longer than its year.'
                ],
                'category_id' => $astronomy?->id,
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'title' => [
                    'es' => 'El primer mensaje de correo electrónico fue enviado en 1971',
                    'en' => 'The first email was sent in 1971'
                ],
                'content' => [
                    'es' => 'Ray Tomlinson envió el primer email a través de ARPANET. El mensaje era una serie de letras y números sin sentido, pero revolucionó la comunicación. También fue quien eligió el símbolo @ para las direcciones de correo.',
                    'en' => 'Ray Tomlinson sent the first email via ARPANET. The message was a series of meaningless letters and numbers, but it revolutionized communication. He was also the one who chose the @ symbol for email addresses.'
                ],
                'category_id' => $technology?->id,
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'title' => [
                    'es' => 'Las abejas pueden reconocer rostros humanos',
                    'en' => 'Bees can recognize human faces'
                ],
                'content' => [
                    'es' => 'Investigaciones han demostrado que las abejas melíferas pueden recordar y reconocer rostros humanos individuales utilizando patrones de características faciales, similar a como lo hacemos nosotros.',
                    'en' => 'Research has shown that honey bees can remember and recognize individual human faces using patterns of facial features, similar to how we do it.'
                ],
                'category_id' => $biology?->id,
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'title' => [
                    'es' => 'La Vía Láctea huele a frambuesas y ron',
                    'en' => 'The Milky Way smells like raspberries and rum'
                ],
                'content' => [
                    'es' => 'Astrónomos detectaron formiato de etilo cerca del centro de nuestra galaxia. Esta sustancia química es responsable del sabor de las frambuesas y también se encuentra en el ron. ¡Nuestra galaxia es deliciosa!',
                    'en' => 'Astronomers detected ethyl formate near the center of our galaxy. This chemical is responsible for the flavor of raspberries and is also found in rum. Our galaxy is delicious!'
                ],
                'category_id' => $astronomy?->id,
                'is_active' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($funFacts as $fact) {
            FunFact::create($fact);
        }
    }
}