<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name' => 'Location de véhicules VTC',
                'slug' => 'location',
                'description' => 'Location courte, moyenne et longue durée de véhicules VTC',
                'price_from' => 49.00,
                'price_unit' => 'jour',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Service VTC & Transport',
                'slug' => 'vtc-transport',
                'description' => 'Services de transport avec chauffeur privé',
                'price_from' => 65.00,
                'price_unit' => 'trajet',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Service Conciergerie',
                'slug' => 'conciergerie',
                'description' => 'Arrivée et installation en France - Services complets',
                'price_from' => 99.00,
                'price_unit' => 'forfait',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Formation VTC',
                'slug' => 'formation',
                'description' => 'Formation et accompagnement pour devenir chauffeur VTC',
                'price_from' => 790.00,
                'price_unit' => 'formation',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Formation Internationale',
                'slug' => 'formation-international',
                'description' => 'Formation pour étrangers souhaitant travailler en France',
                'price_from' => 1250.00,
                'price_unit' => 'mois',
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'Informations générales',
                'slug' => 'general',
                'description' => 'Demandes générales et informations diverses',
                'price_from' => null,
                'price_unit' => null,
                'is_active' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
