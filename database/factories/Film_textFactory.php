<?php

namespace Database\Factories;

use App\Models\Film_text;
use Illuminate\Database\Eloquent\Factories\Factory;

class Film_textFactory extends Factory
{
    protected $model = Film_text::class;

    public function definition(): array
    {
        return [
            'description' => $this->faker->text(),
            'title' => $this->faker->word(),
        ];
    }
}
