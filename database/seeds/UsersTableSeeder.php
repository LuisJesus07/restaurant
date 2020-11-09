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
    }
}
