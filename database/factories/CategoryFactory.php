<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,                 // Generates a single word as category name
            'icon_path' => $this->faker->imageUrl(50, 50, 'icons', true, 'Category'), // Placeholder image URL for icon
            'color' => $this->faker->hexColor,           // Generates a random hex color code
        ];
    }
}
