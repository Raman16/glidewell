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
        <h1 class="m-0">Admin Management</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Admin</li>
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
                        <div class="col-md-2 text-right offset-10">
                         <button class="btn btn-danger" data-toggle="modal"
                                data-target="#ModalLoginForm" id="add_admin">Add Admin</button>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="admin_datatables" class="table table-bordered table-hover ">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email Id</th>
                                <th>Phone Number</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Email Id</th>
                                <th>Phone Number</th>
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
        
@include('admin.modal')

   
<script>

     var APP_URL = {!! json_encode(url('/')) !!}+'/admin/';

    var _token=$('meta[name="csrf-token"]').attr('content');

     $(document).ready( function () {
        Admin._getList();
     });

     $(document).on('click', '.delete-user', function () {
         var id=$(this).attr('data-id');
         var data={
             id:id
         }
         Admin._deleteAdmin(data);
     });

     $(document).on('click', '#add_admin', function (e) {
        e.preventDefault();
        $('#ModalForm').modal('show');
     });
  
     
    $(document).on('click', '#add_edit_user', function (e) {
       
       e.preventDefault();
     
       //
       var data={
                name:$('#user_name').val(),
                email:$('#user_email').val(),
                password:$('#user_password').val(),
                phone:$('#user_phone').val(),
       }
       
       Admin._addAdmin(data);
        
   });
    
    
var Admin = {
  
    _getList: function() {  // question heading related stuff that display's pre- option  -post
     $('#admin_datatables').DataTable({
               processing: true,
               serverSide: true,
               ajax: APP_URL+"admin-list",
               columns: [
                        {data:'name',id:'name'},
                        { data: 'email', name: 'email' },
                        { data: 'phone_number', name: 'phone_number' },
                        {data: 'action', name: 'action', orderable: false},

                     ]
            });
      },
    
    
      _deleteAdmin:function(data){

         $.ajax({
                            url:APP_URL+'delete-admin',
                            type:'DELETE',
                            data:{_token:_token,data},
                            dataType: "JSON",
                            success:function(res){
                                notify("Admin deleted","success");
                               reloadList();
                            },
                            error:function(response){
                                notify("Failed to add","error");
                            }
               });      
    },

    _addAdmin:function(data){
                $.ajax({
                            url:APP_URL+'add-admin',
                            type:'POST',
                            data:{_token:_token,data:data},
                            dataType: "JSON",
                            success:function(res){
                                    notify("Admin Added","success");
                                    $('#modal-id').modal('hide');
                                    reloadList();
                            },
                            error:function(response){
                                notify("Failed to add","error");
                            }
                        });
      }

}
function reloadList(){
     $('#admin_datatables').DataTable().ajax.reload();
}


</script>
</body>
 </html> 
 @endsection
