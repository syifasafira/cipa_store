<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@cipastore.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // 2. Create Customer
        User::create([
            'name' => 'Customer User',
            'email' => 'customer@cipastore.com',
            'password' => bcrypt('password'),
            'role' => 'customer',
        ]);

        // 3. Create Categories
        $categories = [
            ['name' => 'Baju', 'slug' => 'baju'],
            ['name' => 'Celana/Rok', 'slug' => 'celana-rok'],
            ['name' => 'Sepatu', 'slug' => 'sepatu'],
            ['name' => 'Hijab', 'slug' => 'hijab'],
            ['name' => 'Aksesoris', 'slug' => 'aksesoris'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        // 4. Create Sample Products
        $baju = Category::where('slug', 'baju')->first();
        Product::create([
            'category_id' => $baju->id,
            'name' => 'Kemeja Oversize Wanita',
            'slug' => 'kemeja-oversize-wanita',
            'description' => 'Kemeja oversize bahan katun premium, nyaman dipakai sehari-hari.',
            'price' => 150000,
            'stock' => 50,
            'weight' => 250,
            'sku' => 'BJU-001',
            'sizes' => 'S,M,L,XL'
        ]);
        
        $celana = Category::where('slug', 'celana-rok')->first();
        Product::create([
            'category_id' => $celana->id,
            'name' => 'Rok Plisket Premium',
            'slug' => 'rok-plisket-premium',
            'description' => 'Rok plisket dengan bahan hyget super yang jatuh dan tidak nerawang.',
            'price' => 85000,
            'stock' => 100,
            'weight' => 300,
            'sku' => 'ROK-001',
            'sizes' => 'All Size'
        ]);

        $sepatu = Category::where('slug', 'sepatu')->first();
        Product::create([
            'category_id' => $sepatu->id,
            'name' => 'Sneakers Putih Casual',
            'slug' => 'sneakers-putih-casual',
            'description' => 'Sneakers putih model terbaru, empuk dan ringan.',
            'price' => 250000,
            'stock' => 30,
            'weight' => 800,
            'sku' => 'SPT-001',
            'sizes' => '37,38,39,40'
        ]);

        $hijab = Category::where('slug', 'hijab')->first();
        Product::create([
            'category_id' => $hijab->id,
            'name' => 'Pashmina Ceruty Babydoll',
            'slug' => 'pashmina-ceruty-babydoll',
            'description' => 'Pashmina bahan ceruty bebydoll premium, mudah dibentuk.',
            'price' => 45000,
            'stock' => 200,
            'weight' => 150,
            'sku' => 'HJB-001',
            'sizes' => '175x75'
        ]);

        $aksesoris = Category::where('slug', 'aksesoris')->first();
        Product::create([
            'category_id' => $aksesoris->id,
            'name' => 'Jam Tangan Minimalis',
            'slug' => 'jam-tangan-minimalis',
            'description' => 'Jam tangan wanita dengan desain minimalis dan elegan.',
            'price' => 120000,
            'stock' => 15,
            'weight' => 100,
            'sku' => 'AKS-001',
            'sizes' => null
        ]);
    }
}
