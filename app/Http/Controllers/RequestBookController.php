<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\RequestVook;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class RequestBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        ]);

        if(RequestVook::where('status', 'search')->whereDate('created_at', '=', Carbon::today()->toDateString())->count() == 2){
            return redirect()->back()->with('error','Sorry! Someone already requested.');
        }

        if($request->image){
            $destinationPath = public_path('images/request/');
            $thumbnailPath = public_path('images/request/thumbnail');
            $image = request()->file('image');
            $image_name = uniqid() . $image->getClientOriginalName();
            $resize_image = Image::make($image->getRealPath());
            // $resize_image->resize(300,300)->save($destinationPath . '/' . $image_name);
            $resize_image->resize(300, 500, function($constraint){
                $constraint->aspectRatio();
            })->save($thumbnailPath . '/' . $image_name);
            $image->move($destinationPath, $image_name);
        }else{
            $image_name = null;
        }

        $book = RequestVook::create([
            'title'=> $request->title,
            'author' => $request->author,
            'cover_img' => $image_name,
            'message' => $request->message,
            'status' => 'search'
        ]);

        return redirect()->route('request.book')->with('status', 'Your Book is Requested');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
