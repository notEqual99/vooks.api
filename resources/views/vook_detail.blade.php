@extends('layouts.app')

@section('content')
<div class="home container">
    <h1 class="main-title">{{$vook->title}}</h1><br/>
        <div class="row justify-content-start">
            <div class="cover-frame col-md-3">
                <img class="cover-image ui middle aligned image" src="{{asset('public/images/covers/thumbnail/'.$vook->cover_img)}}" alt="book's cover"/>
            </div>
            <div class="vook-info col-md-9">
                <p class="info">Author : {{"Author Name"}}</p>
                <p class="info">Publication Year : <strong>{{"2020"}}</strong></p>
                <p class="info">Language : {{"English"}}</p>
                <p class="description">{{$vook->description}}</p>
                <a href="#" target="_blank" rel="noopener noreferrer">
                    <button class='download-btn'>
                        Download now
                    </button>
                </a>
                <div class="tag mt-3">
                    @foreach($vook->tags as $tag)
                    <a href="https://google.com" target="_blank" rel="noopener noreferrer">
                        <button class='tag-btn'>
                            <span>{{$tag->tag_name}}</span>
                        </button>
                    </a>
                    @endforeach
                </div>
                <br/>
            </div>
        </div>
    </div>
</div>
@endsection
