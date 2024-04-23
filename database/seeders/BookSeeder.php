<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Book;
use App\Models\User;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Book :: factory() -> count(10) -> make() -> each(function ($book) {
            $user = User :: inRandomOrder() -> first();
            $book -> user() -> associate($user);
            $book -> save();
        });
    }
}
