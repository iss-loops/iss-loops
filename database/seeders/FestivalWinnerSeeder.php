<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FestivalWinner;

class FestivalWinnerSeeder extends Seeder
{
    public function run(): void
    {
        $winners = [
            // FÍSICA - Primer Lugar
            [
                'student_name' => [
                    'es' => 'Ana Sofía Martínez Rodríguez',
                    'en' => 'Ana Sofía Martínez Rodríguez'
                ],
                'photo' => null,
                'school' => 'CETis 32 "Ing. José Luis Uribe Rivera"',
                'state' => 'Jalisco',
                'project_title' => [
                    'es' => 'Aprovechamiento de Energía Solar mediante Paneles Fotovoltaicos de Bajo Costo',
                    'en' => 'Solar Energy Harvesting using Low-Cost Photovoltaic Panels'
                ],
                'project_description' => [
                    'es' => 'Este proyecto propone un sistema innovador de captación de energía solar utilizando materiales de bajo costo disponibles en México. El sistema incluye paneles fotovoltaicos construidos con silicio reciclado y un sistema de almacenamiento eficiente. Los resultados muestran una eficiencia del 78% con un costo 40% menor que los paneles comerciales. El proyecto tiene aplicaciones directas en comunidades rurales sin acceso a electricidad, promoviendo la sustentabilidad energética y el desarrollo social.',
                    'en' => 'This project proposes an innovative solar energy collection system using low-cost materials available in Mexico. The system includes photovoltaic panels built with recycled silicon and an efficient storage system. Results show 78% efficiency at 40% lower cost than commercial panels. The project has direct applications in rural communities without electricity access, promoting energy sustainability and social development.'
                ],
                'category' => 'physics',
                'year' => 2025,
                'award_level' => 'first_place',
                'sort_order' => 1,
                'is_featured' => true,
                'is_active' => true,
            ],

            // BIOLOGÍA - Primer Lugar
            [
                'student_name' => [
                    'es' => 'Carlos Eduardo Hernández López',
                    'en' => 'Carlos Eduardo Hernández López'
                ],
                'photo' => null,
                'school' => 'CBTis 224',
                'state' => 'Veracruz',
                'project_title' => [
                    'es' => 'Biorremediación de Suelos Contaminados con Hidrocarburos usando Hongos Nativos',
                    'en' => 'Bioremediation of Hydrocarbon-Contaminated Soils using Native Fungi'
                ],
                'project_description' => [
                    'es' => 'Investigación sobre el uso de hongos nativos de la región del Golfo de México para la degradación de hidrocarburos en suelos contaminados. El estudio identificó tres especies de hongos con capacidad de degradar hasta 85% de los contaminantes en 60 días. Esta solución biotecnológica representa una alternativa ecológica y económica para la limpieza de derrames petroleros, con aplicación directa en zonas afectadas por la industria petrolera mexicana.',
                    'en' => 'Research on the use of native fungi from the Gulf of Mexico region for hydrocarbon degradation in contaminated soils. The study identified three fungal species capable of degrading up to 85% of contaminants in 60 days. This biotechnological solution represents an ecological and economical alternative for oil spill cleanup, with direct application in areas affected by the Mexican oil industry.'
                ],
                'category' => 'biology',
                'year' => 2025,
                'award_level' => 'first_place',
                'sort_order' => 2,
                'is_featured' => true,
                'is_active' => true,
            ],

            // TECNOLOGÍA - Primer Lugar
            [
                'student_name' => [
                    'es' => 'María Fernanda García Santos',
                    'en' => 'María Fernanda García Santos'
                ],
                'photo' => null,
                'school' => 'CETis 109',
                'state' => 'Ciudad de México',
                'project_title' => [
                    'es' => 'Sistema de Monitoreo de Calidad del Aire mediante IoT y Machine Learning',
                    'en' => 'Air Quality Monitoring System using IoT and Machine Learning'
                ],
                'project_description' => [
                    'es' => 'Desarrollo de un sistema integral de monitoreo de calidad del aire utilizando sensores IoT de bajo costo y algoritmos de Machine Learning para predicción de niveles de contaminación. El sistema puede predecir con 92% de precisión los niveles de contaminación con 24 horas de anticipación. La plataforma incluye una aplicación móvil que alerta a los usuarios sobre condiciones peligrosas de calidad del aire, contribuyendo a la salud pública en zonas metropolitanas.',
                    'en' => 'Development of a comprehensive air quality monitoring system using low-cost IoT sensors and Machine Learning algorithms for pollution level prediction. The system can predict pollution levels with 92% accuracy 24 hours in advance. The platform includes a mobile app that alerts users about hazardous air quality conditions, contributing to public health in metropolitan areas.'
                ],
                'category' => 'technology',
                'year' => 2025,
                'award_level' => 'first_place',
                'sort_order' => 3,
                'is_featured' => true,
                'is_active' => true,
            ],

            // FÍSICA - Segundo Lugar
            [
                'student_name' => [
                    'es' => 'Diego Alejandro Ramírez Flores',
                    'en' => 'Diego Alejandro Ramírez Flores'
                ],
                'photo' => null,
                'school' => 'CBTis 75',
                'state' => 'Guanajuato',
                'project_title' => [
                    'es' => 'Optimización de Turbinas Eólicas de Eje Vertical para Zonas Urbanas',
                    'en' => 'Optimization of Vertical Axis Wind Turbines for Urban Areas'
                ],
                'project_description' => [
                    'es' => 'Diseño y construcción de un prototipo de turbina eólica de eje vertical optimizada para condiciones de viento urbano. El diseño incorpora álabes con geometría variable que se ajustan automáticamente según la velocidad del viento. Las pruebas muestran un aumento del 35% en eficiencia comparado con diseños convencionales. Esta tecnología tiene potencial para instalación en edificios y espacios urbanos reducidos.',
                    'en' => 'Design and construction of a vertical axis wind turbine prototype optimized for urban wind conditions. The design incorporates blades with variable geometry that automatically adjust according to wind speed. Tests show a 35% increase in efficiency compared to conventional designs. This technology has potential for installation in buildings and reduced urban spaces.'
                ],
                'category' => 'physics',
                'year' => 2025,
                'award_level' => 'second_place',
                'sort_order' => 4,
                'is_featured' => false,
                'is_active' => true,
            ],

            // QUÍMICA - Primer Lugar
            [
                'student_name' => [
                    'es' => 'Valeria Monserrat Torres Mendoza',
                    'en' => 'Valeria Monserrat Torres Mendoza'
                ],
                'photo' => null,
                'school' => 'CETis 50',
                'state' => 'Nuevo León',
                'project_title' => [
                    'es' => 'Síntesis de Bioplásticos a partir de Residuos Agrícolas del Nopal',
                    'en' => 'Synthesis of Bioplastics from Cactus Agricultural Waste'
                ],
                'project_description' => [
                    'es' => 'Investigación sobre la producción de bioplásticos biodegradables utilizando residuos de la industria del nopal. El proceso desarrollado transforma los desechos del nopal en un material plástico que se degrada completamente en 90 días bajo condiciones de compostaje. El bioplástico muestra propiedades mecánicas similares al polietileno convencional pero con cero impacto ambiental. Esta innovación aprovecha un recurso abundante en México y ofrece una solución al problema de contaminación por plásticos.',
                    'en' => 'Research on the production of biodegradable bioplastics using waste from the cactus industry. The developed process transforms cactus waste into a plastic material that completely degrades in 90 days under composting conditions. The bioplastic shows mechanical properties similar to conventional polyethylene but with zero environmental impact. This innovation leverages an abundant resource in Mexico and offers a solution to plastic pollution.'
                ],
                'category' => 'chemistry',
                'year' => 2025,
                'award_level' => 'first_place',
                'sort_order' => 5,
                'is_featured' => false,
                'is_active' => true,
            ],

            // MATEMÁTICAS - Primer Lugar
            [
                'student_name' => [
                    'es' => 'Luis Fernando Mendoza Ortiz',
                    'en' => 'Luis Fernando Mendoza Ortiz'
                ],
                'photo' => null,
                'school' => 'CETis 41',
                'state' => 'Estado de México',
                'project_title' => [
                    'es' => 'Modelo Matemático para Optimización de Rutas de Transporte Público Urbano',
                    'en' => 'Mathematical Model for Urban Public Transport Route Optimization'
                ],
                'project_description' => [
                    'es' => 'Desarrollo de un modelo matemático basado en teoría de grafos y algoritmos genéticos para optimizar rutas de transporte público. El modelo considera variables como densidad poblacional, flujo vehicular, tiempos de espera y consumo de combustible. Simulaciones muestran una reducción potencial del 28% en tiempos de traslado y 35% en consumo de combustible. La implementación de este modelo podría mejorar significativamente la movilidad urbana en ciudades mexicanas.',
                    'en' => 'Development of a mathematical model based on graph theory and genetic algorithms to optimize public transport routes. The model considers variables such as population density, vehicular flow, waiting times, and fuel consumption. Simulations show a potential 28% reduction in travel times and 35% in fuel consumption. Implementation of this model could significantly improve urban mobility in Mexican cities.'
                ],
                'category' => 'mathematics',
                'year' => 2025,
                'award_level' => 'first_place',
                'sort_order' => 6,
                'is_featured' => false,
                'is_active' => true,
            ],

            // BIOLOGÍA - Segundo Lugar
            [
                'student_name' => [
                    'es' => 'Daniela Itzel Morales Castro',
                    'en' => 'Daniela Itzel Morales Castro'
                ],
                'photo' => null,
                'school' => 'CBTis 166',
                'state' => 'Chiapas',
                'project_title' => [
                    'es' => 'Cultivo Hidropónico Automatizado de Plantas Medicinales Nativas',
                    'en' => 'Automated Hydroponic Cultivation of Native Medicinal Plants'
                ],
                'project_description' => [
                    'es' => 'Sistema de cultivo hidropónico automatizado para plantas medicinales nativas de Chiapas. El sistema utiliza sensores IoT para monitorear pH, nutrientes, temperatura y humedad, ajustando automáticamente las condiciones óptimas. Los resultados muestran un incremento del 45% en producción de principios activos comparado con cultivo tradicional. Este proyecto preserva conocimiento ancestral de plantas medicinales mientras aplica tecnología moderna para su cultivo sustentable.',
                    'en' => 'Automated hydroponic cultivation system for native medicinal plants from Chiapas. The system uses IoT sensors to monitor pH, nutrients, temperature, and humidity, automatically adjusting optimal conditions. Results show a 45% increase in active ingredient production compared to traditional cultivation. This project preserves ancestral knowledge of medicinal plants while applying modern technology for sustainable cultivation.'
                ],
                'category' => 'biology',
                'year' => 2025,
                'award_level' => 'second_place',
                'sort_order' => 7,
                'is_featured' => false,
                'is_active' => true,
            ],

            // TECNOLOGÍA - Segundo Lugar
            [
                'student_name' => [
                    'es' => 'Roberto Carlos Sánchez Pérez',
                    'en' => 'Roberto Carlos Sánchez Pérez'
                ],
                'photo' => null,
                'school' => 'CETis 67',
                'state' => 'Puebla',
                'project_title' => [
                    'es' => 'Prótesis Robótica de Mano con Control Mioeléctrico de Bajo Costo',
                    'en' => 'Low-Cost Robotic Hand Prosthesis with Myoelectric Control'
                ],
                'project_description' => [
                    'es' => 'Diseño y fabricación de una prótesis robótica de mano controlada por señales mioeléctricas utilizando impresión 3D y componentes electrónicos de bajo costo. La prótesis permite realizar 12 movimientos diferentes de agarre con precisión del 94%. El costo total de producción es 15 veces menor que las prótesis comerciales, haciéndola accesible para población de bajos recursos. El proyecto demuestra cómo la tecnología puede democratizar soluciones de salud.',
                    'en' => 'Design and manufacture of a robotic hand prosthesis controlled by myoelectric signals using 3D printing and low-cost electronic components. The prosthesis allows 12 different gripping movements with 94% precision. Total production cost is 15 times lower than commercial prostheses, making it accessible to low-income populations. The project demonstrates how technology can democratize health solutions.'
                ],
                'category' => 'technology',
                'year' => 2025,
                'award_level' => 'second_place',
                'sort_order' => 8,
                'is_featured' => false,
                'is_active' => true,
            ],

            // FÍSICA - Tercer Lugar
            [
                'student_name' => [
                    'es' => 'Andrea Paola Jiménez Vargas',
                    'en' => 'Andrea Paola Jiménez Vargas'
                ],
                'photo' => null,
                'school' => 'CBTis 198',
                'state' => 'Querétaro',
                'project_title' => [
                    'es' => 'Estudio de Materiales Termoeléctricos para Recuperación de Calor Residual',
                    'en' => 'Study of Thermoelectric Materials for Waste Heat Recovery'
                ],
                'project_description' => [
                    'es' => 'Investigación experimental sobre materiales termoeléctricos de bajo costo para convertir calor residual en electricidad. Se probaron diferentes aleaciones y compositos, logrando eficiencias de conversión del 12%. El sistema desarrollado puede instalarse en chimeneas industriales para recuperar energía térmica desperdiciada. Las proyecciones indican que la implementación industrial podría generar ahorros energéticos del 20% en sectores manufactureros.',
                    'en' => 'Experimental research on low-cost thermoelectric materials to convert waste heat into electricity. Different alloys and composites were tested, achieving conversion efficiencies of 12%. The developed system can be installed in industrial chimneys to recover wasted thermal energy. Projections indicate that industrial implementation could generate 20% energy savings in manufacturing sectors.'
                ],
                'category' => 'physics',
                'year' => 2025,
                'award_level' => 'third_place',
                'sort_order' => 9,
                'is_featured' => false,
                'is_active' => true,
            ],

            // QUÍMICA - Segundo Lugar
            [
                'student_name' => [
                    'es' => 'Jorge Alberto Ruiz Domínguez',
                    'en' => 'Jorge Alberto Ruiz Domínguez'
                ],
                'photo' => null,
                'school' => 'CETis 153',
                'state' => 'Michoacán',
                'project_title' => [
                    'es' => 'Desarrollo de Nanofiltros de Grafeno para Purificación de Agua',
                    'en' => 'Development of Graphene Nanofilters for Water Purification'
                ],
                'project_description' => [
                    'es' => 'Síntesis de membranas de grafeno de bajo costo para filtración de agua contaminada. Las membranas desarrolladas pueden eliminar 99.9% de bacterias, virus y metales pesados, con un flujo de filtración 5 veces superior a filtros convencionales. El proceso de síntesis utiliza grafito reciclado de baterías, reduciendo costos y promoviendo economía circular. Esta tecnología tiene aplicación directa en comunidades rurales sin acceso a agua potable.',
                    'en' => 'Synthesis of low-cost graphene membranes for contaminated water filtration. The developed membranes can remove 99.9% of bacteria, viruses, and heavy metals, with a filtration flow 5 times higher than conventional filters. The synthesis process uses recycled graphite from batteries, reducing costs and promoting circular economy. This technology has direct application in rural communities without access to drinking water.'
                ],
                'category' => 'chemistry',
                'year' => 2025,
                'award_level' => 'second_place',
                'sort_order' => 10,
                'is_featured' => false,
                'is_active' => true,
            ],

            // MATEMÁTICAS - Mención Honorífica
            [
                'student_name' => [
                    'es' => 'Mariana Guadalupe León Rivera',
                    'en' => 'Mariana Guadalupe León Rivera'
                ],
                'photo' => null,
                'school' => 'CBTis 254',
                'state' => 'Sonora',
                'project_title' => [
                    'es' => 'Algoritmo de Predicción de Sequías usando Redes Neuronales y Datos Climáticos',
                    'en' => 'Drought Prediction Algorithm using Neural Networks and Climate Data'
                ],
                'project_description' => [
                    'es' => 'Desarrollo de un modelo de predicción de sequías basado en redes neuronales profundas que analiza datos climáticos históricos de 30 años. El algoritmo puede predecir condiciones de sequía con 87% de precisión hasta con 6 meses de anticipación. Esta herramienta puede ayudar a agricultores y autoridades a tomar decisiones preventivas sobre uso de agua y planificación de cultivos, especialmente relevante en zonas áridas de México.',
                    'en' => 'Development of a drought prediction model based on deep neural networks that analyzes 30 years of historical climate data. The algorithm can predict drought conditions with 87% accuracy up to 6 months in advance. This tool can help farmers and authorities make preventive decisions about water use and crop planning, especially relevant in arid zones of Mexico.'
                ],
                'category' => 'mathematics',
                'year' => 2025,
                'award_level' => 'honorable_mention',
                'sort_order' => 11,
                'is_featured' => false,
                'is_active' => true,
            ],

            // TECNOLOGÍA - Mención Honorífica
            [
                'student_name' => [
                    'es' => 'Kevin Antonio Delgado Silva',
                    'en' => 'Kevin Antonio Delgado Silva'
                ],
                'photo' => null,
                'school' => 'CETis 28',
                'state' => 'Coahuila',
                'project_title' => [
                    'es' => 'Sistema de Alerta Temprana de Inundaciones mediante Análisis de Imágenes Satelitales',
                    'en' => 'Early Flood Warning System through Satellite Image Analysis'
                ],
                'project_description' => [
                    'es' => 'Plataforma de alerta temprana que utiliza inteligencia artificial para analizar imágenes satelitales y datos meteorológicos en tiempo real. El sistema puede detectar condiciones de riesgo de inundación con 72 horas de anticipación y enviar alertas automáticas a autoridades y población en zonas de riesgo. Durante pruebas piloto, el sistema predijo correctamente 9 de 10 eventos de inundación en la región, salvando potencialmente vidas y propiedades.',
                    'en' => 'Early warning platform that uses artificial intelligence to analyze satellite images and meteorological data in real-time. The system can detect flood risk conditions 72 hours in advance and send automatic alerts to authorities and populations in risk areas. During pilot tests, the system correctly predicted 9 out of 10 flood events in the region, potentially saving lives and properties.'
                ],
                'category' => 'technology',
                'year' => 2025,
                'award_level' => 'honorable_mention',
                'sort_order' => 12,
                'is_featured' => false,
                'is_active' => true,
            ],
        ];

        foreach ($winners as $winner) {
            FestivalWinner::create($winner);
        }
    }
}