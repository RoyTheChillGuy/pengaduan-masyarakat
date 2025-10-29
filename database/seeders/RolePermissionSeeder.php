<?php
namespace Database\Seeders;

use App\Models\User;                          // [1] Model User
use Illuminate\Database\Seeder;               // [2] Base seeder
use Illuminate\Support\Facades\Hash;          // [3] Hash password
use Spatie\Permission\Models\Role;            // [4] Model Role

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin']);       // [5] Buat role admin
        $wargaRole = Role::firstOrCreate(['name' => 'warga']);       // [6] Buat role warga

        $admin = User::firstOrCreate(                                // [7] Buat akun admin
            ['email' => 'admin@example.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        if (! $admin->hasRole('admin')) {                            // [8] Assign role admin
            $admin->assignRole($adminRole);
        }
    }
}
