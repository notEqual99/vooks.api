<nav class="whole-nav navbar sticky-top navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand" href="{{route('home')}}">Vooks</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fas fa-bars"></i>
    </button>
    
    <div class="navbar-header collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-1 w-100 justify-content-end">
        <li class="nav-item active">
          <a class="nav-link" href="{{route('home')}}">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('request.book')}}">Request</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('about')}}">About</a>
        </li>
      </ul>
    </div>
  </div>
</nav>