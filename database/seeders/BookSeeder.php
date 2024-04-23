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
        $index = 1;
        $books = Book :: factory() -> count(10) -> make();

        foreach ($books as $book) {
            $book -> cover = $index++ . ".jpg";
            $book -> images = json_encode([
                $index++ . ".jpg",
                $index++ . ".jpg",
                $index++ . ".jpg",
            ]);

            $user = User :: inRandomOrder() -> first();

            $book -> user() -> associate($user);
            $book -> save();
        }
    }
}
