<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['nama_role' => 'Administrator'],
            ['nama_role' => 'Dokter'],
            ['nama_role' => 'Perawat'],
            ['nama_role' => 'Resepsionis'],
            ['nama_role' => 'Pemilik'],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['nama_role' => $role['nama_role']], $role);
        }
    }
}
