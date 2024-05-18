<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $author = Author::all();
        return response()->json([
            'status'=>'success',
            'book'=>$author]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $author = Author::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'age'=>$request->age,
                'country'=>$request->country,
                'image'=>$request->image,


        ]);
        $author->books()->attach($request->book_id,['availability'=>true]);
        return response()->json([
            'status'=>'success',
            'author'=>$author
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        $books=$author->books()->get('title');
        return response()->json([
            'status'=>'success',
            'author'=>$author,
            'books'=>$books
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author)
    {
        $authorData=[];
        if($request->name){
            $authorData['name']=$request->name;
        }
        if($request->email){
            $authorData['email']=$request->email;
        }
        if($request->age){
            $authorData['age']=$request->age;
        }
        if($request->country){
            $authorData['country']=$request->country;
        }
        if($request->image){
            $authorData['image']=$request->image;
        }
        $author->update($authorData);
        $author->book()->detach($request->book_id,['availability'=>true]);
        return response()->json([
            'status'=>'success',
            'author'=>$author
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        $author->delete();
        return response()->json([
            'status'=>'success',
            'message'=>'Author deleted successfully'
        ]);
    }
}
