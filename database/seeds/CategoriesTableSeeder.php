<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Category();
        $category->name = "Comidas";
        $category->description = "Platillos del mar";
        $category->save();

        $category = new Category();
        $category->name = "Bebidas";
        $category->description = "Descripción bebidas";
        $category->save();

        $category = new Category();
        $category->name = "Desayunos";
        $category->description = "Platillos para desayunar";
        $category->save();
    }
}
