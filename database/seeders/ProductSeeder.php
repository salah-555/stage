<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [];

        for ($i =  1; $i <=25; $i++) {
            $products[] = [
                'name'=>'Produit' . $i,
                'description'=> 'Description du produit ' .$i,
                'price' =>  rand(50, 500),
                'stock' => rand(10, 100),
                'category_id' => rand(1, 3),
                'image' => 'storage/default.png', // Image par défaut
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('products')->insert($products);
       
        
    }
}
