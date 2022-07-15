@extends('layouts.base')

@section('content')
    <style>
        .wrapper{height:100%;position:relative;overflow-x:hidden;overflow-y:auto}
    </style>
    <!-- Page content-->
    <div class="content-wrapper mt-2">
        <div class="content-heading">
            <div class="card-header">
                Edit Book
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-body">
                        @include('layouts.error')
                        <form class="form-horizontal" method="post" action="{{route('books.update', $book->id)}}" enctype="multipart/form-data">
                            @method('PUT')
                            {{csrf_field()}}
                            <div class="form-group row">
                                <!-- name -->
                                <div class="col-xl-6">
                                    <label class="col-xl-4 col-form-label">Title</label>
                                    <input class="form-control" type="text" name="title" value="{{$book->title}}">
                                </div>

                                <!-- categories -->
                                <div class="col-xl-6">
                                    <label class="col-xl-4 col-form-label">Category</label>
                                    <select name="category_id" id="category" class="form-control">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}"
                                                @if($book->category->id == $category->id)
                                                    selected
                                                @endif
                                            >{{ $category->category_name }}</option>>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            </div>
                            
                            <!-- Tags -->
                            <div class="form-group-row">
                                <label class="col-xl-4 col-form-label">Tags</label>
                                <select name="tags[]" id="tag" class="form-control" multiple>
                                    @foreach($tags as $tag)
                                        <option value="{{$tag->id}}"
                                            @if(isset($book))
                                                @if($book->hasTag($tag->id))
                                                    selected
                                                @endif
                                            @endif
                                        >
                                        {{ $tag->tag_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div><br>

                            <div class="form-group-row">
                                <label class="col-xl-4 col-form-label">Description</label><br>
                                <textarea name="description" id="" cols="70" rows="10">{{$book->description}}</textarea>
                            </div>

                            <!-- images -->
                            <div class="form-group">
                                <label class="col-xl-4 col-form-label">Images</label>
                                <input type="file" name="image" class="form-control" accept="image/*">
                                @if ($errors->has('files'))
                                @foreach ($errors->get('files') as $error)
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $error }}</strong>
                                </span>
                                @endforeach
                                @endif
                            </div>

                            <div class="form-group">
                                <lable class="col-xl-4 col-form-label">Link</lable>
                                <input type="text" name="link" class="form-control" value="{{$book->download_link}}">
                            </div>

                            <div class="form-group row">
                                <div class="col-xl-2"></div>
                                <div class="col-xl-10">
                                    <button class="btn btn-sm btn-green" type="submit">Update</button>
                                    <a href="{{route('books.index')}}" class="btn btn-sm btn-secondary" type="reset">back</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        $('#category').change(function(){
            var sid = $(this).val();
            // console.log(sid);
            if(sid){
            $.ajax({
                type:"get",
                url:"/laravel/vooks/archivist/tag_get/"+sid,
                success:function(res){
                    if(res){
                        // console.log(res);
                        $("#tag").empty();
                        $("#tag").append('<option>Select Tags</option>');
                        $.each(res,function(key,value){
                            $("#tag").append(res);
                            //$("#city").append('<option value="'+key+'">'+value.city_name+'</option>');
                            $("#tag").append('<option value="'+value.id+'">'+value.tag_name+'</option>');
                        });
                    }else{
                        console.log("Data Empty");
                    }
                }
            });
            }
        });
    </script>
@endsection
@section('script')
@endsection