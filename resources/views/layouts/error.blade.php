@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session()->has('status'))
<p class="alert alert-success">{{session('status')}}</p>
@endif

@if(session()->has('error'))
<p class="alert alert-warning">{{session('error')}}</p>
@endif