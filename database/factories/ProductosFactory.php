<?php

namespace Database\Factories;

use App\Models\Productos;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductosFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Productos::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        'nombre' => substr($this->faker->sentence(3), 0, -1),
        'descripcion' => $this->faker->sentence(10),
        'l_descripcion' => $this->faker->text,
        'precio' => $this->faker->randomFloat(2, 5, 150),
        'categoria_id' => $this->faker->numberBetween(1, 5)
        ];
    }
}
