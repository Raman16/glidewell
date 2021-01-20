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
        <h1 class="m-0">Video Management</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Videos</li>
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
                <div class="card-body">
                    <table id="users_datatables" class="table table-bordered table-hover ">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Link</th>
                                <th>QuestionId</th>
                                <th>Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Link</th>
                                <th>QuestionId</th>
                                <th>Category</th>
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
        
   @include('videos.modal')

   
<script>

    var APP_URL = {!! json_encode(url('/')) !!}+'/admin/';
    var _token=$('meta[name="csrf-token"]').attr('content');

     $(document).ready( function () {
        Videos._getList();
     });

  
     $(document).on('click', '.edit-video', function (e) {
         
            e.preventDefault();
            var id=$(this).attr('data-id');
            var category_name=$(this).attr('category');
            Videos._editVideo(category_name,id);

     });

  
     
    $(document).on('click', '#update_video', function (e) {
       
       e.preventDefault();
     
       //
       var data={
                video_id:$('#video_id').val(),
                video_title:$('#video_title').val(),
                video_url:$('#video_url').val(),
                video_description:$('#video_description').val()
       }
       
       Videos._updateVideo(data);
        
   });
    
    
var Videos = {
  
    _getList: function() {  // question heading related stuff that display's pre- option  -post
     $('#users_datatables').DataTable({
               processing: true,
               serverSide: true,
               ajax: APP_URL+"videos-management/video-list",
               columns: [
                        { data: 'video_title', name: 'video_title' },
                        { data: 'video_description', name: 'video_description' },
                        { data: 'video_link', name: 'video_link' },
                        { data: 'question_id', name: 'question_id' },
                        { data: 'category_name', name: 'category_name' },
                        {data: 'action', name: 'action', orderable: false},

                     ]
            });
      },
    
    _updateVideo:function(data){
        
           $.ajax({
                    url:APP_URL+"videos-management/update-video/"+data.video_id,
                    type:'PUT',
                    data:{_token:_token,data:data},
                    dataType: "JSON",
                    success:function(res){
                            notify("Update success","success");
                            reloadList();
                     },
                    error:function(response){
                        notify("Failed to update","error");
                    }
                });
      },
    _editVideo:function(category,id){
                $.ajax({
                            url:APP_URL+'videos-management/edit-video/'+category+'/'+id,
                            type:'GET',
                            data:{_token:_token},
                            dataType: "JSON",
                            success:function(res){
                               $('#video_id').val(res.data['id']);
                               $('#video_url').val(res.data['video_link']);
                               $('#video_title').val(res.data['video_title'])
                               $('#video_description').val(res.data['video_description'])
                               $('#ModalForm').modal('show');

                            },
                            error:function(response){
                            }
                        });
    
    }
}
function reloadList(){
     $('#users_datatables').DataTable().ajax.reload();
}


</script>
</body>
 </html> 
 @endsection
