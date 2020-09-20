<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CourseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Course::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'department_id' => rand(1,5),
            'title' => $this->faker->name,
            'description' => $this->faker->paragraph,
            'image' => $this->faker->image,
            'start_date' => $this->faker->date,
            'end_date' => $this->faker->date,
        ];
    }
}
