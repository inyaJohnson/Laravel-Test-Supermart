<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookAuthor extends Model
{
    public $timestamps = false;

    protected $table = 'book_author';
    
    protected $fillable = [
        'book_id',
        'author_id',
    ];


}
