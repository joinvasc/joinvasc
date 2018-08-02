<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name'     => 'Joinvasc',
            'email'    => 'joinvasc@test.com',
            'password' => bcrypt('000'),
            'access_level' => 0,
            'group'    => 'JOINVASC'
        ]);

        \App\User::create([
            'name'     => 'Rafaela',
            'email'    => 'enfrafaelaliberato@gmail.com',
            'password' => bcrypt('Stroke_2018'),
            'access_level' => 1,
            'group'    => 'JOINVASC'
        ]);

        \App\User::create([
            'name'     => 'Vivian',
            'email'    => 'viviann.nnagel@gmail.com',
            'password' => bcrypt('Joinvasc_2018'),
            'access_level' => 1,
            'group'    => 'JOINVASC'
        ]);

        \App\User::create([
            'name'     => 'Vanessa',
            'email'    => 'vanessaguesserenf@gmail.com',
            'password' => bcrypt('1007Pedro'),
            'access_level' => 1,
            'group'    => 'JOINVASC'
        ]);

        \App\User::create([
            'name'     => 'Juliana',
            'email'    => 'juliana.safanelli@gmail.com',
            'password' => bcrypt('Join@2018'),
            'access_level' => 1,
            'group'    => 'JOINVASC'
        ]);

        \App\User::create([
            'name'     => 'Ivonei',
            'email'    => 'ivonei22@yahoo.com.br',
            'password' => bcrypt('54025402IB'),
            'access_level' => 1,
            'group'    => 'JOINVASC'
        ]);

        \App\User::create([
            'name'     => 'Teste nivel 3',
            'email'    => 'teste3@easycomtec.com',
            'password' => bcrypt('000'),
            'access_level' => 3,
            'group'    => 'TESTE'
        ]);
    }
}
