@extends('layouts.app')

@section('content')


<!DOCTYPE html>
 
 <html lang="en">
 <head>    
     <meta name="csrf-token" content="{{ csrf_token() }}">

 <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">  
 <link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
 </head>

 <!-- Content Header (Page header) -->
<div class="content-header">
<div class="container-fluid">
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Question Management</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">FCM</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
</div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->


<section class="content">
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header">
                    <div class="row">
                        <div class="col-md-3 text-right offset-9">
                            <a href="{{url('admin/question-management/questions-form/'.$category)}}"  
                             class="btn btn-danger " >Add New Question</a>
                        </div>
                        <div class="col-md-3">
                            <div class="d-flex">
                                <input type="text" class="form-control" placeholder="search...">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="questions_datatables" class="table table-bordered table-hover ">
                        <thead>
                            <tr>
                                <th>Sno</th>
                                <th>Question</th>
                                <th>Options</th>
                                <th>Answer</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Sno</th>
                                <th>Question</th>
                                <th>Options</th>
                                <th>Answer</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</div><!-- /.container-fluid -->
</section>
   
<script>




    var APP_URL = {!! json_encode(url('/')) !!}+'/admin/';
    var _token=$('meta[name="csrf-token"]').attr('content');

     $(document).ready( function () {
        Questions._getList();
     });

    
  var Questions = {
  
    _getList: function() {  // question heading related stuff that display's pre- option  -post
     $('#questions_datatables').DataTable({
               processing: true,
               serverSide: true,
               ajax: APP_URL+"question-management/questions-list/quiz",
               columns: [
                        {data:'id',id:'id'},
                        { data: 'question', name: 'question' },
                        {data: 'options', name: 'options', orderable: false},
                        {data: 'answer', name: 'answer', orderable: false},
                        {data: 'action', name: 'action', orderable: false},

                     ]
            });
      }

}
function reloadList(){
     $('#questions_datatables').DataTable().ajax.reload();
}


</script>
</body>
 </html> 
 @endsection
