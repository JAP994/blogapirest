<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		Category::create([
            'name' => 'Turismo'
        ]);
        Category::create([
            'name' => 'Consejos'
        ]);
        Category::create([
            'name' => 'Noticias'
        ]);
        Category::create([
            'name' => 'Eventos'
        ]);
        Category::create([
            'name' => 'Cursos'
        ]);
    }
}