<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'age',
        'country',
        'image'
    ];
    public function books()
    {
        return $this->belongsToMany(Book::class, 'authors_books')->withPivot('availability'); // 1-n relationship
    }
}
