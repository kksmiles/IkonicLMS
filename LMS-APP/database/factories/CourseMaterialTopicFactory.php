<?php

namespace Database\Factories;

use App\Models\CourseMaterialTopic;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CourseMaterialTopicFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CourseMaterialTopic::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'course_id' => rand(1,5),
            'title' => $this->faker->name,
            'description' => $this->faker->paragraph,
            'hidden' => $this->faker->boolean,
        ];
    }
}
