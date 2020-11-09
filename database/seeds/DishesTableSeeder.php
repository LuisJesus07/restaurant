<?php

use Illuminate\Database\Seeder;
use App\Dish;

class DishesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	//platillos Desayunos
        $dish = new Dish();
        $dish->name = "Plato de fruta";
        $dish->description = "Fruta de temporada acompañado de yogurt y granola.";
        $dish->price = 90;
        $dish->category_id = 1;
        $dish->save();
    
        $dish = new Dish();
        $dish->name = "Pan francés";
        $dish->description = "Delicioso pan hecho con nuestra receta secreta.";
        $dish->price = 55;
        $dish->category_id = 1;
        $dish->save();

        $dish = new Dish();
        $dish->name = "Hot cakes";
        $dish->description = "Orden con 3 Hot cakes acompañados con fruta de temporada.";
        $dish->price = 110;
        $dish->category_id = 1;
        $dish->save();

        $dish = new Dish();
        $dish->name = "Chilaquiles(con Carne)";
        $dish->description = "Crujientes tortillas bañadas en salsa de la casa roja o verde acompañados de deliciosos frijoles refritos.";
        $dish->price = 90;
        $dish->category_id = 1;
        $dish->save();

        $dish = new Dish();
        $dish->name = "Chilaquiles(con Pollo)";
        $dish->description = "Crujientes tortillas bañadas en salsa de la casa roja o verde acompañados de deliciosos frijoles refritos.";
        $dish->price = 130;
        $dish->category_id = 1;
        $dish->save();

        $dish = new Dish();
        $dish->name = "Chilaquiles(con Huevo)";
        $dish->description = "Crujientes tortillas bañadas en salsa de la casa roja o verde acompañados de deliciosos frijoles refritos.";
        $dish->price = 110;
        $dish->category_id = 1;
        $dish->save();

        $dish = new Dish();
        $dish->name = "Omelette";
        $dish->description = "Acompañado de frijoles refritos.";
        $dish->price = 90;
        $dish->category_id = 1;
        $dish->save();

        $dish = new Dish();
        $dish->name = "Omelette(c/ingrediente extra)";
        $dish->description = "Acompañado de frijoles refritos, con ingrediente extra a tu elección chorizo, jamón, champiñon, salchicha o vegetariano.";
        $dish->price = 95;
        $dish->category_id = 1;
        $dish->save();

        $dish = new Dish();
        $dish->name = "Omelette Hacienda";
        $dish->description = "Con el ingrediente de tu eleccción bañado en nuestra deliciosa crema de la casa.";
        $dish->price = 100;
        $dish->category_id = 1;
        $dish->save();

        $dish = new Dish();
        $dish->name = "Orden de machaca";
        $dish->description = "Exqusita machaca regional con verdura, acompañada de frijoles refritos.";
        $dish->price = 95;
        $dish->category_id = 1;
        $dish->save();

        $dish = new Dish();
        $dish->name = "Huevos con machaca";
        $dish->description = "Huevos con machaca.";
        $dish->price = 85;
        $dish->category_id = 1;
        $dish->save();

        $dish = new Dish();
        $dish->name = "Huevos al gusto";
        $dish->description = "Revueltos, estrellados o rancheros.";
        $dish->price = 80;
        $dish->category_id = 1;
        $dish->save();

        $dish = new Dish();
        $dish->name = "Orden de quesadillas";
        $dish->description = "3 quesadillas acompañadas de frijoles refritos.";
        $dish->price = 60;
        $dish->category_id = 1;
        $dish->save();

        $dish = new Dish();
        $dish->name = "Orden de quesadillas con Rajas";
        $dish->description = "3 quesadillas acompañadas de frijoles refritos con rajas.";
        $dish->price = 70;
        $dish->category_id = 1;
        $dish->save();

        $dish = new Dish();
        $dish->name = "Orden de quesadillas con Carne";
        $dish->description = "3 quesadillas acompañadas de frijoles refritos con carne.";
        $dish->price = 85;
        $dish->category_id = 1;
        $dish->save();

        //comidas
        $dish = new Dish();
        $dish->name = "Aguachile";
        $dish->description = "Platillo de Aguchiles";
        $dish->price = 220;
        $dish->category_id = 2;
        $dish->save();

        $dish = new Dish();
        $dish->name = "Camarón";
        $dish->description = "Platillo de Camarón";
        $dish->price = 220;
        $dish->category_id = 2;
        $dish->save();

        $dish = new Dish();
        $dish->name = "Ceviche de Pescado (Orden)";
        $dish->description = "Ceviche de Pescado Orden";
        $dish->price = 145;
        $dish->category_id = 2;
        $dish->save();

        $dish = new Dish();
        $dish->name = "Ceviche de Pescado (1/2 Orden)";
        $dish->description = "Ceviche de Pescado 1/2 Orden";
        $dish->price = 85;
        $dish->category_id = 2;
        $dish->save();

        $dish = new Dish();
        $dish->name = "Tostada de Ceviche de Pescado";
        $dish->description = "Tostada de Ceviche de Pescado";
        $dish->price = 45;
        $dish->category_id = 2;
        $dish->save();

        $dish = new Dish();
        $dish->name = "Ceviche de Camarón (Orden)";
        $dish->description = "Ceviche de Camarón Orden";
        $dish->price = 220;
        $dish->category_id = 2;
        $dish->save();

        $dish = new Dish();
        $dish->name = "Ceviche de Camarón (1/2 Orden)";
        $dish->description = "Ceviche de Camarón 1/2 Orden";
        $dish->price = 130;
        $dish->category_id = 2;
        $dish->save();

        $dish = new Dish();
        $dish->name = "Tostada de Ceviche de Camarón";
        $dish->description = "Tostada de Ceviche de Camarón";
        $dish->price = 55;
        $dish->category_id = 2;
        $dish->save();

        $dish = new Dish();
        $dish->name = "Coctel de Camarón";
        $dish->description = "Coctel de Camarón";
        $dish->price = 220;
        $dish->category_id = 2;
        $dish->save();

        $dish = new Dish();
        $dish->name = "Parrillada Paraíso";
        $dish->description = "Carne de res, Camarón, Pollo, Salchichas, además frijoles refritos y cebollitas.";
        $dish->price = 420;
        $dish->category_id = 2;
        $dish->save();

        $dish = new Dish();
        $dish->name = "Hamburguesa Clásica con papas";
        $dish->description = "Jitomate, cebolla, lechuga, aguacate. Carne de res y queso c/papas.";
        $dish->price = 130;
        $dish->category_id = 2;
        $dish->save();

        $dish = new Dish();
        $dish->name = "Carne Asada (Orden)";
        $dish->description = "Acompañado con tortillas, chile toreado y salsas.";
        $dish->price = 250;
        $dish->category_id = 2;
        $dish->save();

        $dish = new Dish();
        $dish->name = "Carne Asada (1/2 Orden)";
        $dish->description = "Acompañado con tortillas, chile toreado y salsas.";
        $dish->price = 135;
        $dish->category_id = 2;
        $dish->save();



        //bebidas
        $dish = new Dish();
        $dish->name = "Café (Refil)";
        $dish->description = "Café (Refil).";
        $dish->price = 30;
        $dish->category_id = 3;
        $dish->save();

        $dish = new Dish();
        $dish->name = "Chocomilk";
        $dish->description = "Chocomilk.";
        $dish->price = 35;
        $dish->category_id = 3;
        $dish->save();

        $dish = new Dish();
        $dish->name = "Malteada(Fresa, chocolate o vainilla)";
        $dish->description = "Malteada(Fresa, chocolate o vainilla).";
        $dish->price = 55;
        $dish->category_id = 3;
        $dish->save();

        $dish = new Dish();
        $dish->name = "Refresco";
        $dish->description = "Refresco.";
        $dish->price = 30;
        $dish->category_id = 3;
        $dish->save();

        $dish = new Dish();
        $dish->name = "Fuze tea";
        $dish->description = "Fuze tea.";
        $dish->price = 30;
        $dish->category_id = 3;
        $dish->save();

        $dish = new Dish();
        $dish->name = "Naranjada/Limonada Natural";
        $dish->description = "Naranjada/Limonada Natural.";
        $dish->price = 30;
        $dish->category_id = 3;
        $dish->save();

        $dish = new Dish();
        $dish->name = "Naranjada/Limonada Mineral";
        $dish->description = "Naranjada/Limonada Mineral.";
        $dish->price = 35;
        $dish->category_id = 3;
        $dish->save();

        $dish = new Dish();
        $dish->name = "Agua fresca del día";
        $dish->description = "Agua fresca del día.";
        $dish->price = 25;
        $dish->category_id = 3;
        $dish->save();

        $dish = new Dish();
        $dish->name = "Cerveza Nacional";
        $dish->description = "Cerveza Nacional.";
        $dish->price = 30;
        $dish->category_id = 3;
        $dish->save();

        $dish = new Dish();
        $dish->name = "Cerveza Internacional";
        $dish->description = "Cerveza Internacional(Heineken, Coors y Bohemia).";
        $dish->price = 35;
        $dish->category_id = 3;
        $dish->save();

        

    }
}
