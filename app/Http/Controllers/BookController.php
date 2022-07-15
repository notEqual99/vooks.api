<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Book;
use App\Models\BookCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
// use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::where('del_status', 'false')->orderBy('id','DESC')->get();
        return view('book.index',compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = BookCategory::where('del_status', 'false')->get();
        return view('book.create',compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        date_default_timezone_set('asia/yangon');
        $this->validate($request, [
            'title' => 'required',
            'category' => 'required',
            // 'tag_id' => 'required',
            'link' => 'required'
        ]);

        $destinationPath = public_path('images/covers');
        $thumbnailPath = public_path('images/covers/thumbnail');

        $image = request()->file('image');
        $image_name = uniqid().'_'.'p'.'_'. $image->getClientOriginalName();
        $resize_image = Image::make($image->getRealPath());
        // $resize_image->resize(300,300)->save($destinationPath . '/' . $image_name);
        $resize_image->resize(300, 500, function($constraint){
            $constraint->aspectRatio();
        })->save($thumbnailPath . '/' . $image_name);
        $image->move($destinationPath, $image_name);

        // $book = new Books();
        // $book->title = $request->title;
        // $book->cover_img = $image_name;
        // $book->category_id = $request->category;
        // $book->description = $request->description;
        // $book->save();

        $book = Book::create([
            'title'=> $request->title,
            'cover_img' => $image_name,
            'category_id' => $request->category,
            'description' => $request->description,
            'download_link' => $request->link
        ]);

        if($request->tags){
            $book->tags()->attach($request->tags);
        }

        return redirect()->route('books.index')->with('status', 'Book Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::find($id);
        $categories = BookCategory::where('del_status','false')->get();
        $tags = Tag::where('category_id', $book->category_id)->where('del_status','false')->get();

        return view('book.edit',compact('book','categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        date_default_timezone_set('asia/yangon');
        $this->validate($request, [
            'title' => 'required',
            'category_id' => 'required',
            // 'tag_id' => 'required',
            'link' => 'required'
        ]);
        
        $book = Book::find($id);
        // return $book->cover_img;
        $destinationPath = public_path('images/covers');
        $thumbnailPath = public_path('images/covers/thumbnail');
        // dd($request->all());
        

        if ($request->has('image')) {
            File::delete(public_path('images/covers/thumbnail/'.$book->cover_img));
            File::delete(public_path('images/covers/'.$book->cover_img));
            // dd(Storage::delete('/public/images/covers/thumbnail/'.$book->cover_img));

            $image = $request->file('image');
            $image_name = uniqid().'_'.'p'.'_'. $image->getClientOriginalName();
            $resize_image = Image::make($image->getRealPath());
            // $resize_image->resize(300,300)->save($destinationPath . '/' . $image_name);
            $resize_image->resize(300, 500, function($constraint){
                $constraint->aspectRatio();
            })->save($thumbnailPath . '/' . $image_name);
            $image->move($destinationPath, $image_name);
        } else {
            $image_name = $book->cover_img;
        }

        $book = Book::find($id);
        $book->title = $request->title;
        $book->cover_img = $image_name;
        $book->category_id = $request->category_id;
        $book->description = $request->description;

        if($request->tags){
            $book->tags()->sync($request->tags);
        }
        $book->save();

        return redirect()->route('books.index')->with('status', 'Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        $book->del_status = 'true';
        $book->save();

        return redirect()->back()->with('status','Deleted  Success!');
    }

    public function getTag($id)
    {
        $tags = Tag::where('category_id',$id)->get();
        return response()->json($tags);
    }

    // public function tagByCategory($id)
    // {
    //     $tag = Tag::where('category_id',$id)->get();
    //     return response()->json($tag);
    // }
}
