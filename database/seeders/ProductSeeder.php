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
        DB::table('products')->insert([
            [
                'name' => 'Chaussures de Sport',
                'description' => 'Chaussures confortables pour le sport et la course.',
                'price' => 499.99,
                'stock' => 50,
                'image' => 'images/chaussures.jpg',
                'category_id' => 1, // Assurez-vous que la catégorie existe
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ballon de Football',
                'description' => 'Ballon en cuir de haute qualité.',
                'price' => 199.99,
                'stock' => 30,
                'image' => 'images/ballon.jpg',
                'category_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Maillot de Football',
                'description' => 'Maillot officiel de l’équipe nationale.',
                'price' => 299.99,
                'stock' => 20,
                'image' => 'images/maillot.jpg',
                'category_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Maillot ',
                'description' => 'Maillot officiel.',
                'price' => 300,
                'stock' => 40,
                'image' => 'images/maillot.jpg',
                'category_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
