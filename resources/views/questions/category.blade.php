<!-- @extends('layouts.app')

@section('content')


<!DOCTYPE html>
 
 <html lang="en">
 <head>    
     <meta name="csrf-token" content="{{ csrf_token() }}">

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
            <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Question Management</li>
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
                   
                </div>
                <!-- /.card-header -->
                <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Category</th>
                                                <th>No. Question </th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(isset($question_category))
                                                @foreach($question_category as $qm)
                                           <tr>
                                                <td>{{$qm['sno']}}</td>
                                                <td>{{$qm['category']}}</td>
                                                <td>{{$qm['no_question']}}</td>
                                                <td><a class="btn btn-danger"
                                                      href="{{'questions-list/'.$qm['category']}}">View
                                                    </a>
                                                    <button class="btn btn-default" title="Delete">Delete </button>
                                                </td>
                                            </tr>
                                                @endforeach
                                               @endif
                                        

                                            
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                                <th>S.No</th>
                                                <th>Category</th>
                                                <th>No. Question </th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</div><!-- /.container-fluid -->
</section>
        
   
</body>
 </html> 
 @endsection -->
