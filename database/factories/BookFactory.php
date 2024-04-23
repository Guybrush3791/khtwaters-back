<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Book;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake() -> words(rand(3, 5), true),
            'description' => fake() -> sentences(rand(10, 20), true),
            'price' => fake() -> randomFloat(2, 10, 100),
            'cover' => rand(1, 10) . ".jpg",
            'images' => json_encode([
                rand(1, 10) . ".jpg",
                rand(1, 10) . ".jpg",
                rand(1, 10) . ".jpg",
                rand(1, 10) . ".jpg",
                rand(1, 10) . ".jpg",
            ]),
        ];
    }
}
