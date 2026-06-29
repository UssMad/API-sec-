<?php

namespace Database\Seeders;

use App\Models\RawContent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RawContentSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        RawContent::factory(10)->create();
    }
}
