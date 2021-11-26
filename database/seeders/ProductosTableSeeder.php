<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Productos;
use App\Models\Categorias;
use App\Models\ProductImage;
class ProductosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //model factories
        //factory(App\Models\Productos::class, 100)->create();
        \App\Models\Categorias::factory()->count(5)->create();
        \App\Models\Productos::factory()->count(100)->create();
        \App\Models\ProductImage::factory()->count(200)->create();
    }
}
