<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'title' => 'Rolex Submariner',
                'content' => 'Luxury diving watch with a classic design.',
                'price' => 12000.99,
                'stock' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Omega Speedmaster',
                'content' => 'The legendary watch that went to the moon.',
                'price' => 6500.50,
                'stock' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Tag Heuer Carrera',
                'content' => 'A stylish sports chronograph.',
                'price' => 4200.00,
                'stock' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Patek Philippe Nautilus',
                'content' => 'A rare and luxurious timepiece.',
                'price' => 30000.75,
                'stock' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Audemars Piguet Royal Oak',
                'content' => 'An iconic luxury sports watch.',
                'price' => 28000.00,
                'stock' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}