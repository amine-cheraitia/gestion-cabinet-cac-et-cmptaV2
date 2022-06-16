<?php

namespace Database\Factories;

use App\Models\Entreprise;
use Illuminate\Database\Eloquent\Factories\Factory;

class EntrepriseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Entreprise::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'raison_social' => $this->faker->name(),
            'num_registre_commerce' => $this->faker->text(10),
            'num_art_imposition' => $this->faker->text(10),
            'num_id_fiscale' => $this->faker->text(10),
            'adresse' => $this->faker->address(),
            'num_tel' => $this->faker->phoneNumber(),
            'email' => $this->faker->email(),
            'fiscal_id' => $this->faker->numberBetween(1, 2),
            'activite_id' => $this->faker->numberBetween(1, 5),
            'categorie_id' => $this->faker->numberBetween(1, 3)
        ];
    }
}