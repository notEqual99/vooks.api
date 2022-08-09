@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="request-header">Book Request</h1>
    <p class="alert-message">We limit only 3 request books per day. We'll upload the requested books when we found.</p>
    <div class="request-container row">
        <div class="request-card card mt-3 col-md-4 offset-md-4">
            <div class="card-header text-center font-weight-bold">
                Fill this form and request books
            </div>
            <div class="request-form card-body">
                <form name="#" id="#" method="post" action="{{route('book.store')}}" enctype="multipart/form-data">
                    @csrf
                    @include('layouts.error')
                    <div class="form-group">
                        <label for="exampleInputEmail1">Title</label>
                        <input type="text" id="title" name="title" class="input-field form-control" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Author Name (optional)</label>
                        <input type="text" id="author" name="author" class="input-field form-control">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Message (optional)</label>
                        <textarea name="message" class="input-field form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Image (optional)</label>
                        <input type="file" name="image" class="input-field form-control" accept="image/*">
                        @if ($errors->has('files'))
                        @foreach ($errors->get('files') as $error)
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $error }}</strong>
                        </span>
                        @endforeach
                        @endif
                    </div>
                    <button type="submit" class="btn download-btn">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection