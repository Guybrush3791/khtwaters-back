<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\BookEditRequest;

class UserApiController extends Controller
{
    // GET MY BOOKS
    public function getBooks() {
        // get all my books ordered by updated_at desc
        $books = auth()->user()->books()->orderBy('updated_at', 'desc')->get();

        return response()->json($books);
    }

    // GET MY BOOK BY ID
    public function getBook($id) {
        $book = auth()->user()->books()->find($id);

        return response()->json($book);
    }

    // ADD BOOK
    public function addBook(BookEditRequest $request) {

        // TODO: cover and images should be handled

        $book = auth()->user()->books()->create($request->all());

        return response()->json($book);
    }

    // UPDATE BOOK
    public function updateBook(BookEditRequest $request, $id) {

        // TODO: cover and images should be handled

        $book = auth()->user()->books()->find($id);
        $book -> update($request -> all());
        $book -> save();

        return response() -> json($book);
    }

    // DELETE BOOK
    public function deleteBook($id) {

        $book = auth()->user()->books()->find($id);
        $book -> delete();

        return response() -> json(['message' => 'Book deleted']);
    }
}
