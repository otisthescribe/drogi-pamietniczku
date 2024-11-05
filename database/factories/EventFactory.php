<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Carbon\Carbon;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $startDate = $this->faker->dateTimeBetween('-1 month', '+1 month');
        $endDate = Carbon::instance($startDate)->addDays($this->faker->numberBetween(1, 5));

        return [
            'title' => $this->faker->sentence(5),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'description' => $this->faker->paragraph,
            'image_path' => $this->faker->imageUrl(1000, 500, 'events', true, 'Event'),
            'user_id' => User::factory(), // Assumes user relationship exists and UserFactory is defined
            'category_id' => Category::factory(), // Assumes category relationship exists and CategoryFactory is defined
        ];
    }
}
