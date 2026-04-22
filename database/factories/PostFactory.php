<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->sentence(4);

        return [
            'title' => $title,
            'slug' => Str::slug($title . '-' . fake()->unique()->numberBetween(1, 9999)),
            'excerpt' => fake()->paragraph(2),
            'content' => fake()->paragraphs(5, true),

            // ВОТ ТУТ РАНДОМ КАРТИНКА
            'image' => 'https://picsum.photos/800/400?random=' . fake()->numberBetween(1, 1000),

            'published_at' => now()->subDays(fake()->numberBetween(1, 30)),
            'category_id' => Category::inRandomOrder()->value('id'),
        ];
    }
}