<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'pages',
        'price',
        'gener',
        'cover_image',
        'book_file'
    ];

    public function authors()
    {
        return $this->belongsToMany(Author::class)->withPivot('availability');
    }
}
