<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $adminRole = Role::create(['name' => 'superadmin']);
        $userRole = Role::create(['name' => 'admin']);



       $user = User::factory()->create([
            'name' => 'Kepala Sekolah',
            'email' => 'test@example.com',
            'password' => '1234'
        ]);

       $pembina = User::factory()->create([
            'name' => 'Pembina',
            'email' => 'pembina@gmail.com',
            'password' => '1234'
        ]);

        $user->roles()->attach($adminRole);
        $pembina->roles()->attach($userRole);
    }
}