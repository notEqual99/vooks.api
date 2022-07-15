<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\BookCategory;
use Illuminate\Http\Request;

class BookTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::where('del_status','false')->orderBy('id','DESC')->get();
        return view('book_tag.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = BookCategory::where('del_status','false')->get();
        return view('book_tag.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        date_default_timezone_set('asia/yangon');
        $this->validate($request, [
            'name'=>'required',
            'category_id'=>'required'
        ]);

        $tag = new Tag();
        $tag->tag_name = $request->name;
        $tag->category_id = $request->category_id;
        $tag->save();

        return redirect()->route('tags.index')->with('status', 'Successfully created');
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
        date_default_timezone_set('asia/yangon');
        $tag = Tag::find($id);
        $categories = BookCategory::where('del_status','false')->get();

        return view('book_tag.edit', compact('tag','categories'));
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
            'name'=>'required',
            'category_id'=>'required'
        ]);

        $tag = Tag::find($id);

        $tag->tag_name = $request->name;
        $tag->category_id = $request->category_id;
        $tag->save();

        return redirect()->route('tags.index')->with('status', 'Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        date_default_timezone_set('asia/yangon');
        $type = Tag::where('id', $id)->first();

        $type->del_status = 'true';
        $type->save();

        // need to delete book and tag relation too

        return redirect()->back()->with('status','Deleted  Success!');
    }
}
