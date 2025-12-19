<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'id' => 1,
                'name' => 'Administrateur',
                'slug' => 'admin',
                'description' => 'Administrateur système',
                'permissions' => ['*']
            ],
            [
                'id' => 2,
                'name' => 'Modérateur',
                'slug' => 'moderator',
                'description' => 'Modérateur',
                'permissions' => ['view.users', 'edit.users']
            ],
            [
                'id' => 3,
                'name' => 'Chauffeur',
                'slug' => 'chauffeur',
                'description' => 'Chauffeur professionnel',
                'permissions' => ['view.reservations', 'update.reservations']
            ],
            [
                'id' => 4,
                'name' => 'Formateur',
                'slug' => 'formateur',
                'description' => 'Formateur',
                'permissions' => ['view.courses', 'create.courses', 'edit.courses']
            ],
            [
                'id' => 5,
                'name' => 'Client',
                'slug' => 'client',
                'description' => 'Client',
                'permissions' => ['view.profile', 'edit.profile', 'make.reservations']
            ],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(
                ['id' => $role['id']],
                $role
            );
        }
    }
}
