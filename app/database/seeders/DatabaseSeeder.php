<?php

namespace Database\Seeders;
use App\Models\Organisation;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Organisation::query()->firstOrCreate([
            'name' => 'Aretia Advisors',
        ]);

        $this->call(RoleSeeder::class);
    }
}
