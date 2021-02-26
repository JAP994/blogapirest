<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Blog;

class BlogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		Blog::create([
            'tittle' => 'Blog 1 Recetas',
            'summary' => 'este es un blog de recetas',
            'content' => 'The best UI icons for your projects',
            'url' => 'image.png',
            'user_id' => 1,
            'category_id'=>1,
        ]);
    }
}