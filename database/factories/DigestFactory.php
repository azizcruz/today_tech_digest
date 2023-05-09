<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Digest>
 */
class DigestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $imagePath = 'images/' . Str::random(40) . '.jpg';

        Storage::put($imagePath, file_get_contents($this->faker->imageUrl()));

        return [
            'title' => $this->faker->unique()->sentence,
            'body' => $this->faker->paragraph,
            'keywords' => $this->faker->unique()->sentence,
            'slug' => $this->faker->unique()->sentence,
            'category_id' => Category::inRandomOrder()->first()->id,
            'image' => $imagePath,
            'created_at' => $this->faker->dateTimeBetween('-2 years', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-2 years', 'now')
        ];
    }
}
