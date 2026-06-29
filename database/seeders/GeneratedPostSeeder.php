<?php

namespace Database\Seeders;

use App\Models\GeneratedPost;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GeneratedPostSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        GeneratedPost::factory(10)->create();
    }
}
