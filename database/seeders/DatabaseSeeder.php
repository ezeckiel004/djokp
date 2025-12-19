<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Créer les rôles
        $roles = [
            [
                'name' => 'Administrateur',
                'slug' => 'admin',
                'description' => 'Administrateur système avec tous les droits',
                'permissions' => json_encode(['*'])
            ],
            [
                'name' => 'Utilisateur',
                'slug' => 'user',
                'description' => 'Utilisateur standard',
                'permissions' => json_encode(['view_dashboard', 'edit_profile'])
            ],
            [
                'name' => 'Chauffeur',
                'slug' => 'chauffeur',
                'description' => 'Chauffeur VTC',
                'permissions' => json_encode(['view_dashboard', 'manage_reservations', 'view_vehicles'])
            ],
            [
                'name' => 'Formateur',
                'slug' => 'formateur',
                'description' => 'Formateur VTC',
                'permissions' => json_encode(['view_dashboard', 'manage_formations', 'view_students'])
            ],
            [
                'name' => 'Client',
                'slug' => 'client',
                'description' => 'Client des services',
                'permissions' => json_encode(['view_dashboard', 'make_reservations', 'view_formations'])
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }

        // Créer l'admin par défaut
        User::create([
            'name' => 'Admin DJOK',
            'email' => 'admin@djokprestige.com',
            'password' => Hash::make('password123'),
            'role_id' => 1, // admin
            'phone' => '+221 33 867 90 00',
            'is_active' => true,
        ]);

        // Créer un client de test
        User::create([
            'name' => 'Client Test',
            'email' => 'client@test.com',
            'password' => Hash::make('password123'),
            'role_id' => 5, // client
            'phone' => '+221 77 123 45 67',
            'is_active' => true,
        ]);
        FormationsTestSeeder::class;
    }
}
