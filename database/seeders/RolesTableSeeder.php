<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $pembina = User::factory()->create([
            'name' => 'Pembina',
            'email' => 'pembina@gmail.com',
            'password' => '1234'
        ]);

        $pembina->assignRole($adminRole);
    }
}