@extends('layouts.base')

@section('content')
    <style>
        table{
            font-size:15px;
        }
        .button-text{
            color:black;
        }
    </style>
    <!-- Page content-->
    <div class="content-wrapper m-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card-header">
                            Books
                        </div>
                        
                        <div class="d-flex justify-content-left m-2">
                            <a href="{{route('books.create')}}" class="btn btn-success">
                                Add new book
                            </a>
                            <a href="#" class="btn btn-warning ml-2">
                                Archived
                            </a>
                        </div>

                        @if(session()->has('status'))
                            <p class="alert alert-success text-center text-black ml-3 mr-3">{{session('status')}}</p>
                        @endif
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-striped my-4 w-100 dataTable no-footer dtr-inline text-center" id="datatable1" role="grid" aria-describedby="datatable1_info" style="width: 1008px;">
                                        <thead>
                                            <tr role="row">
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Images</th>
                                                <th>Categories</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @php $i=1; @endphp
                                        @foreach($books as $book)
                                        <tr>
                                            <td width="15px">@php echo $i.'.';$i++; @endphp</td>
                                            <td class="align-middle">{{$book->title}}</td>
                                            <td>
                                            <img class="img-fluid image-responsive ml-3" src="{{asset('/public/images/covers/thumbnail/'.$book->cover_img) }}" style="width:150px;height:200px;border-radius:5px;" alt="product's photo">
                                            </td>
                                            <td class="align-middle">
                                                <strong>
                                                <a href="#" class="text-dark text-uppercase">
                                                    {{ $book->category->category_name}}
                                                </a>
                                                </strong><br>
                                            </td>
                                            <td class="text-center align-middle">
                                            <a href="{{route('books.edit',$book->id)}}" class="btn btn-info btn-sm d-inline">Edit</a><br><br>
                                            <form action="{{route('books.destroy',$book->id)}}" class="d-inline" method="post">
                                            {{csrf_field()}}
                                            {{method_field('Delete')}}
                                            <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                                            </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <!-- Datatables-->
    <script src="{{asset('admin/vendor/datatables.net/js/jquery.dataTables.js')}}"></script>
    <script src="{{asset('admin/vendor/datatables.net-bs4/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{asset('admin/vendor/datatables.net-buttons/js/dataTables.buttons.js')}}"></script>
    <script src="{{asset('admin/vendor/datatables.net-buttons-bs/js/buttons.bootstrap.js')}}"></script>
    <script src="{{asset('admin/vendor/datatables.net-buttons/js/buttons.colVis.js')}}"></script>
    <script src="{{asset('admin/vendor/datatables.net-buttons/js/buttons.flash.js')}}"></script>
    <script src="{{asset('admin/vendor/datatables.net-buttons/js/buttons.html5.js')}}"></script>
    <script src="{{asset('admin/vendor/datatables.net-buttons/js/buttons.print.js')}}"></script>
    <script src="{{asset('admin/vendor/datatables.net-keytable/js/dataTables.keyTable.js')}}"></script>
    <script src="{{asset('admin/vendor/datatables.net-responsive/js/dataTables.responsive.js')}}"></script>
    <script src="{{asset('admin/vendor/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
    <script src="{{asset('admin/vendor/jszip/dist/jszip.js')}}"></script>
    <script src="{{asset('admin/vendor/pdfmake/build/pdfmake.js')}}"></script>
    <script src="{{asset('admin/vendor/pdfmake/build/vfs_fonts.js')}}"></script>
@endsection