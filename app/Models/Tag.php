<?php

namespace App\Models;

use App\Models\Books;
use App\Models\BookCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'tag_name','category_id','del_status'
    ];

    public function category(){
        return $this->belongsTo(BookCategory::class,'category_id');
    }

    public function posts(){
        return $this->belongsToMany(Books::class);
    }
}
