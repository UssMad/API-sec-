<?php

namespace Database\Seeders;

use App\Models\Blueprint;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlueprintSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        Blueprint::factory(10)->create();
    }
}
