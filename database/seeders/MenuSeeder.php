<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->insert([
            'title' => 'Menus',
            'href' => '#',
            'icon' => 'bars',
            'parent_id' => 0,
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('menus')->insert([
            'title' => 'Lista de menus',
            'href' => '/menus',
            'icon' => '',
            'parent_id' => 1,
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('menus')->insert([
            'title' => 'Cadastrar menu',
            'href' => '/menus/create',
            'icon' => '',
            'parent_id' => 1,
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('menus')->insert([
            'title' => 'Páginas',
            'href' => '#',
            'icon' => 'newspaper',
            'parent_id' => 0,
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('menus')->insert([
            'title' => 'Lista de páginas',
            'href' => '/pages',
            'icon' => '',
            'parent_id' => 4,
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('menus')->insert([
            'title' => 'Cadastrar página',
            'href' => '/pages/create',
            'icon' => '',
            'parent_id' => 4,
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('menus')->insert([
            'title' => 'Usuários',
            'href' => '#',
            'icon' => 'user-group',
            'parent_id' => 0,
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('menus')->insert([
            'title' => 'Lista de usuários',
            'href' => '/users',
            'icon' => '',
            'parent_id' => 7,
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('menus')->insert([
            'title' => 'Cadastrar usuário',
            'href' => '/users/create',
            'icon' => '',
            'parent_id' => 7,
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
