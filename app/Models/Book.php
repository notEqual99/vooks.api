<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $table = "book";

    protected $fillable = [
        'title','cover_img','category_id','description','download_link'
    ];

    public function category(){
        return $this->belongsTo(BookCategory::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function hasTag($tagid){
        return in_array($tagid,$this->tags->pluck('id')->toArray());
    }
}
