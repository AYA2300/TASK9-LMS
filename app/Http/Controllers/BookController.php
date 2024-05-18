<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $book = Book::query();

        if ($request->has('genre')) {
            $book->where('genre', $request->gener);
        }

        if ($request->has('author_id')) {
            $book->authors()->where('author_id', $request->author_id);
        }

        if ($request->has('availability')) {
            $book->where('availability', $request->availability);
        }
        return response()->json([
            'books'=>$book,

        ]);


        return response()->json([
            'status'=>'success',
            'book'=>$book]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $book = Book::create([
            'title'=>$request->title,
            'pages'=>$request->pages,
            'price'=>$request->price,
            'gener'=>$request->gener,
            'cover_image'=>$request->cover_image,
            'book_file'=>$request->book_file,



    ]);
     // $book->authors()->attach($request->author_id,['availability'=>true]);
    return response()->json([
        'status'=>'success',
        'book'=>$book
    ]);
}


    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        $book->authors()->get('name');
        return response()->json([
            'status'=>'success',
            'book'=>$book
        ]);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return response()->json([
            'status'=>'success',
            'message'=>'book deleted successfully'
        ]);
    }
}
