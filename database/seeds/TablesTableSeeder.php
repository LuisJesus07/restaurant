<?php

use Illuminate\Database\Seeder;
use App\Table;

class TablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = new Table();
    	$table->name = "Mesa 1";
    	$table->table_number = "1";
    	$table->capacity = 4;
    	$table->save();

    	$table = new Table();
    	$table->name = "Mesa 2";
    	$table->table_number = "2";
    	$table->capacity = 4;
    	$table->save();

    	$table = new Table();
    	$table->name = "Mesa 3";
    	$table->table_number = "3";
    	$table->capacity = 4;
    	$table->save();

    	$table = new Table();
    	$table->name = "Mesa 4";
    	$table->table_number = "4";
    	$table->capacity = 6;
    	$table->save();

    	$table = new Table();
    	$table->name = "Mesa 5";
    	$table->table_number = "5";
    	$table->capacity = 6;
    	$table->save();

    	$table = new Table();
    	$table->name = "Mesa 6";
    	$table->table_number = "6";
    	$table->capacity = 4;
    	$table->save();

    	$table = new Table();
    	$table->name = "Mesa 7";
    	$table->table_number = "7";
    	$table->capacity = 4;
    	$table->save();

    	$table = new Table();
    	$table->name = "Mesa 8";
    	$table->table_number = "8";
    	$table->capacity = 4;
    	$table->save();

    	$table = new Table();
    	$table->name = "Mesa 9";
    	$table->table_number = "9";
    	$table->capacity = 10;
    	$table->save();

    	$table = new Table();
    	$table->name = "Mesa 10";
    	$table->table_number = "10";
    	$table->capacity = 10;
    	$table->save();

    	$table = new Table();
    	$table->name = "Mesa 11";
    	$table->table_number = "11";
    	$table->capacity = 4;
    	$table->save();

    	$table = new Table();
    	$table->name = "Mesa 12";
    	$table->table_number = "12";
    	$table->capacity = 4;
    	$table->save();

    	$table = new Table();
    	$table->name = "Mesa 13";
    	$table->table_number = "13";
    	$table->capacity = 6;
    	$table->save();

    	$table = new Table();
    	$table->name = "Mesa 14";
    	$table->table_number = "14";
    	$table->capacity = 12;
    	$table->save();

    	$table = new Table();
    	$table->name = "Mesa 15";
    	$table->table_number = "15";
    	$table->capacity = 12;
    	$table->save();

    }
}
