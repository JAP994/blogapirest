<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Comment;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		Comment::create([
            'email' => 'sanchezjonathan660@gmail.com',
            'description' => 'Muy interesantes el blog',
            'blog_id' => 1,
        ]);
    }
}