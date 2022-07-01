<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id_user_type' => 1,
            'user' => 'Yonathan',
            'name' => 'yonathan william',
            'last_name' => 'Mamani calisaya',
            'email' => 'yonathan@gmail.com',
            'password' => Hash::make('123'),
            'api_token' => str_random(60),
            'state' => 1,
        ]);
    }
}
