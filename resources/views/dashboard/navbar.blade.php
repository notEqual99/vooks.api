    
    <!-- wrapper -->
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="sidebar border-right" id="sidebar-wrapper">
            <div class="sidebar-heading border-bottom">Miracle </div>
            <div class="list-group list-group-flush">
                <a href="{{route('dashboard')}}" class="sidebar list-group-item list-group-item-action">Dashboard</a>
                <a href="{{route('categories.index')}}" class="list-group-item list-group-item-action">Categories</a>
                <a href="{{route('tags.index')}}" class="list-group-item list-group-item-action">Tags</a>
                <a href="{{route('books.index')}}" class="list-group-item list-group-item-action">Books</a>
                <a href="#" class="list-group-item list-group-item-action">R-Books</a>
                <a href="#" class="list-group-item list-group-item-action">Status</a>
                
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light border-bottom">
                <a class="" id="menu-toggle" href=""><img src="https://img.icons8.com/bubbles/50/000000/menu.png"/></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{route('logout')}}">Logout</a>
                    </div>
                    </li>
                </ul>
                </div>
            </nav>
            <section class="section-container">
            <!-- Page content-->
            @yield('content')
            </section>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->

    <script>
    jQuery(document).ready(function($){
        $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
        });
    })
    </script>