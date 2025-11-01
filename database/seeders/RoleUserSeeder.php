<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Role_User;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cari user admin@rshp.com
        $adminUser = User::where('email', 'admin@rshp.com')->first();
        echo "Admin User: " . ($adminUser ? $adminUser->name . " (ID: " . $adminUser->iduser . ")" : "Not Found") . "\n";
        
        // Cari role Administrator
        $adminRole = Role::where('nama_role', 'Administrator')->first();
        echo "Admin Role: " . ($adminRole ? $adminRole->nama_role . " (ID: " . $adminRole->idrole . ")" : "Not Found") . "\n";
        
        if ($adminUser && $adminRole) {
            // Assign role Administrator ke admin@rshp.com
            Role_User::firstOrCreate(
                [
                    'iduser' => $adminUser->iduser,
                    'idrole' => $adminRole->idrole
                ],
                [
                    'status' => 1 // 1 = active
                ]
            );
            
            echo "✓ Role Administrator assigned to admin@rshp.com\n";
        } else {
            echo "✗ User atau Role tidak ditemukan!\n";
        }
    }
}
