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
        for ($i = 1; $i <= 50; $i++){
            if ($i <= 5) {
                $parent = 0;
                DB::table('menus')->insert([
                    'title' => 'Menu '.$i,
                    'href' => '#',
                    'parent_id' => $parent,
                    'user_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }elseif ($i >= 6 && $i <= 30){
                $parent = rand(1,5);
                DB::table('menus')->insert([
                    'title' => 'Menu '.$i,
                    'href' => '#',
                    'parent_id' => $parent,
                    'user_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }else{
                $parent = rand(6,30);
                DB::table('menus')->insert([
                    'title' => 'Menu '.$i,
                    'href' => '#',
                    'parent_id' => $parent,
                    'user_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
