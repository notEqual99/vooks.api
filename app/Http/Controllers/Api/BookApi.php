<?php

namespace App\Http\Controllers\Api;

use stdClass;
use Carbon\Carbon;
use App\Models\Tag;
use App\Models\Book;
use App\Models\BookTag;
use App\Models\RequestVook;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class BookApi extends Controller
{
    public function getVooks(){
        date_default_timezone_set('asia/yangon');
        $v = Validator::make(request()->all(),[
            'secrete'=>'required',
        ]);
        if($v->fails()){
            return $this->convertJson('fail',500,$v->errors());
        }

        try{
            $vooks = Book::where('del_status','false')->orderBy('id','DESC')->paginate(5);
            return $this->convertJson('success',200,$vooks);
        }catch(\Exception $e){
            return $this->convertJson('fail',503,$e->getMessage());
        }
    }

    public function getVookDetail(Request $request){
        $v = Validator::make(request()->all(),[
            'secrete'=>'required',
            'book_id'=>'required',
        ]);
        if($v->fails()){
            return $this->convertJson('fail',500,$v->errors());
        }

        if(Book::where("id",$request->book_id)->count()>0){
            $book = Book::where("id",$request->book_id)->with('tags')->first();
            return $this->convertJson('success', 200, $book);
        }else{
            return $this->convertJson('fail, Book not found', 200, new stdClass);
        }
    }

    public function submitRequestBook(Request $request){
        date_default_timezone_set('asia/yangon');

        $v = Validator::make(request()->all(),[
            'secrete'=>'required',
            'title'=>'required',
        ]);
        if($v->fails()){
            return $this->convertJson('fail',500,$v->errors());
        }


        if(RequestVook::where('status', 'search')->whereDate('created_at', '=', Carbon::today()->toDateString())->count() > 1){
            return $this->convertJson('fail Sorry! can request only one book in a day', 500, new stdClass);
        }else{
            $destinationPath = public_path('images/request');
            $thumbnailPath = public_path('images/request/thumbnail');

            if ($request->has('image')) {
                $image = request()->file('image');
                $image_name = uniqid().'_'.'p'.'_'. $image->getClientOriginalName();
                $resize_image = Image::make($image->getRealPath());
                // $resize_image->resize(300,300)->save($destinationPath . '/' . $image_name);
                $resize_image->resize(300, 500, function($constraint){
                    $constraint->aspectRatio();
                })->save($thumbnailPath . '/' . $image_name);
                $image->move($destinationPath, $image_name);
            } else {
                $image_name = null;
            }


            $vook = new RequestVook();
            $vook->title = $request->title;
            $vook->author = $request->author;
            $vook->cover_img = $image_name;

            if(!$vook->save()){
                return $this->convertJson('fail! error',500,new stdClass());
            }

            return $this->convertJson('success', 200, new stdClass);
        }
    }
}
