<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Yajra\Acl\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Role::query()->create(['name' => 'admin', 'slug' => 'admin']);
        Role::query()->create(['name' => 'organizer', 'slug' => 'organizer']);
    }
}
