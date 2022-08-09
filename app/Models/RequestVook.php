<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestVook extends Model
{
    use HasFactory;

    protected $table = "book_requests";

    protected $fillable = [
        'title','author','cover_img','message','status'
    ];
}
