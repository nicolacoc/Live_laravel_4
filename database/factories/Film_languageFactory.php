<?php

namespace Database\Factories;

use App\Models\Film_language;
use Illuminate\Database\Eloquent\Factories\Factory;

class Film_languageFactory extends Factory
{
    protected $model = Film_language::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
