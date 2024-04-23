<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Book;

class GuestApiController extends Controller
{
    public function getBooks() {

        $books = Book :: orderBy('updated_at', 'desc') -> get();

        return response()->json($books);
    }
}
