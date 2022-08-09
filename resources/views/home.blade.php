@extends('layouts.app')

@section('content')
<div class="home container">
    <h1 class="main-title">New Collections</h1><br/>
    @foreach($books as $book)
        <div class="row">
            <div class="image-panel col-12 col-sm-3 pt-3">
                <div class="thumbnail-container reviews-loading">
                    <a href="\#" class="thumbnail product-thumbnail" rel="noopener noreferrer">
                        <img class="img-fluid image-responsive ml-3" src="{{asset('/public/images/covers/thumbnail/'.$book->cover_img) }}" style="width:150px;height:200px;border-radius:5px;" alt="product's photo">
                    </a>
                </div>
                <h6 class='meta'><strong>2020</strong></h6>
            </div>
            <div class="col col-description">
                <h3 class="product-title">
                    <a href="{{route('vook.show', $book->id)}}">
                        {{$book->title}}
                    </a>
                </h3>
                <div class="author">{{"author name"}}</div>                    

                <div class="description-short">
                    {{$book->description}}
                </div>

                <div class="product-availability">
                <a href={{$book->download_link}} target="_blank" rel="noopener noreferrer">
                    <button class='download-btn'>
                        Download now
                    </button>
                </a>
                </div>
            </div>
        </div>
        @if(next($books))
            <hr class="hr-line" size="100"/>
        @endif
    @endforeach
        <div class="d-flex">
            <div class="mx-auto">
                {{$books->links("pagination::bootstrap-4")}}
            </div>
        </div>
</div>
@endsection