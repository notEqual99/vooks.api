<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as Input;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::where('del_status', 'false')->orderBy('id','DESC')->paginate(10);
        return view('home', compact('books'));
    }

    public function test()
    {
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vook = Book::with('tags')->where('id',$id)->first();
        // return $vook;
        return view('vook_detail', compact('vook'));
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

    public function about()
    {
        return view('about');
    }

    public function request()
    {
        return view('request_book');
    }

    public function searchByName(Request $request){
        date_default_timezone_set('asia/yangon');
        // return $request;

        $q = Input::get ( 'q' );
        
        if($q == !null){
            $books = Book::with('category')->where('del_status','false')->where('title','LIKE','%'.$q.'%')->orderBy('id','DESC')->paginate(10);
            
            foreach($books as $key=>$vs){
                $image = Book::where('id',$vs->id)->first()->cover_img;
                $books[$key]->cover_img = $image;
            }

            if(count($books) > 0){
                return view('home',compact('books'))->withDetails($books)->withQuery ( $q );
            }else{
                return view ('home',compact('books'))->withMessage('No Details found. Try to search again !');
            } 
        }else {
            return redirect('/');
        }
    }
}
