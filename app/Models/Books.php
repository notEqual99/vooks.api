<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\BookCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Books extends Model
{
    use HasFactory;
    protected $fillable = [
        'title','cover_img','category_id'
    ];

    public function category(){
        return $this->belongsTo(BookCategory::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
}
