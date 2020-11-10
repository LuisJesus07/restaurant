<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = "Luis Jesus";
        $user->lastname = "Aviles Morales";
        $user->email = "luisjesusavilesmorales7@gmail.com";
        $user->password = bcrypt("1234");
        $user->role_id = 1;
        $user->save();


        /////Meseros////////////
        $user = new User();
        $user->name = "Silvano";
        $user->lastname = "Castro";
        $user->email = "silvano@gmail.com";
        $user->password = bcrypt("1234");
        $user->role_id = 2;
        $user->save();
        $user->tables()->attach([1,2,3,4,5]);


        $user = new User();
        $user->name = "Casimiro";
        $user->lastname = "Gutierrez";
        $user->email = "casimiro@gmail.com";
        $user->password = bcrypt("1234");
        $user->role_id = 2;
        $user->save();
        $user->tables()->attach([6,7,8,9,10]);

        $user = new User();
        $user->name = "Frederick";
        $user->lastname = "Beltran";
        $user->email = "frederick@gmail.com";
        $user->password = bcrypt("1234");
        $user->role_id = 2;
        $user->save();
        $user->tables()->attach([11,12,13,14,15]);
    }
}
