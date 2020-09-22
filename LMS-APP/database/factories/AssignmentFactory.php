<?php

namespace Database\Factories;

use App\Models\Assignment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AssignmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Assignment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'course_material_topic_id' => rand(1,5),
            'title' => $this->faker->name,
            'description' => $this->faker->paragraph,
            'assignment_file' => $this->faker->image,
            'full_grade' => $this->faker->randomFloat(2, 5, 20),
            'due_date' => $this->faker->date,
        ];
    }
}
