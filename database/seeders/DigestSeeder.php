<?php

namespace Database\Seeders;

use App\Models\Digest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DigestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Digest::factory()->count(100)->create();
    }
}
