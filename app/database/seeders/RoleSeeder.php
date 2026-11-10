<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        foreach (['admin', 'investigator', 'reviewer'] as $role) {
            Role::findOrCreate($role);
        }

        User::where('email', 'investigator@aretia.com')
            ->first()
            ->assignRole('investigator');
    }
}