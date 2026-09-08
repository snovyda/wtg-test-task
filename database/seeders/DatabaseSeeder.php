<?php

namespace Database\Seeders;

use App\Models\Supplier;
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
        Supplier::factory()->create([
            'name' => 'supplier-a',
        ]);

        Supplier::factory()->create([
            'name' => 'supplier-b',
        ]);
    }
}
