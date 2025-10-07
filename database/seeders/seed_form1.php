<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class seed_form1 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {

            db::table('form1')->insert([
            'Nome' => fake()->firstName,
            'Cognome' => fake()->lastName,
            'Società' => fake()->company,
            'Qualifica' => fake()->jobTitle,
            'Email' => fake()->email,
            'Telefono' => fake()->randomNumber(),
            'Data_di_Nascita' => fake()->date,
            'Ima' => fake()->image,
                'created_at' => fake()->dateTime,
                'updated_at' => fake()->dateTime,
        ]);
        }
    }
}
