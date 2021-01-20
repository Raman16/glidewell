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
        <h1 class="m-0">End User Management</h1>
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
                        <div class="col-md-2 text-right offset-7">
                        <button class="btn btn-danger" 
                                data-target="#ModalLoginForm" id="add_new_btn">Add New</button>
                        </div>
                        <div class="col-md-3">
                            <div class="d-flex">
                                <input type="text" id="datatables_wrapper" class="form-control" placeholder="search...">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="users_datatables" class="table table-bordered table-hover ">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email Id</th>
                                <th>Auth Type</th>
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
                                <th>Auth Type</th>
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
        
   @include('flashcards.modules.modal')

   
<script>

    var url='http://gwdental.test/admin/';
    var _token=$('meta[name="csrf-token"]').attr('content');

     $(document).ready( function () {
        Users._getList();
     });

     $(document).on('click', '.delete-user', function () {
         var id=$(this).attr('data-id');
         var data={
             id:id
         }
         Users._deleteUser(data);
     });

     $(document).on('click', '.edit-user', function (e) {
         
            e.preventDefault();
            var id=$(this).attr('data-id');
            Users._editUser(id);
            $('#ModalForm').modal('show');
           // $("#ModalLoginForm").modal("toggle");

     });

  
     
    $(document).on('click', '#add_edit_user', function (e) {
       
       e.preventDefault();
       var id=$('#module_id').val();
       name=$('#module_name').val();
       var data={};
       if(id==''){
           data={
                  name:name,
                };
                Users._addUser(data);
       }else{
           
          data={
                id:id,
                name:name
          }
          Users._updateUser(data);
       }
        
   });
    
    
var Users = {
  
    _getList: function() {  // question heading related stuff that display's pre- option  -post
     $('#users_datatables').DataTable({
               processing: true,
               serverSide: true,
               ajax: "http://gwdental.test/admin/users/users-list",
               columns: [
                        {data:'name',id:'name'},
                        { data: 'email', name: 'email' },
                        { data: 'auth_type', name: 'auth_type' },
                        { data: 'phone_number', name: 'phone_number' },
                        {data: 'action', name: 'action', orderable: false},

                     ]
            });
      },
    
    _updateUser:function(data){
        
           $.ajax({
                    url:'update-user/'+data.id,
                    type:'PUT',
                    data:{_token:_token,data:data},
                    dataType: "JSON",
                    success:function(res){
                            alert("Updated Successfully");
                            reloadList();
                     },
                    error:function(response){
                            alert("Failed to updated");
                    }
                });
      },
    _editUser:function(id){
                $.ajax({
                            url:'edit-user/'+id,
                            type:'GET',
                            data:{_token:_token},
                            dataType: "JSON",
                            success:function(res){
                               $('#user_id').val(res.data['id']);
                               $('#user_name').val(res.data['name']);
                               $('#user_email').val(res.data['email'])
                               $('#user_phone').val(res.data['phone'])
                               

                            },
                            error:function(response){
                            }
                        });
    
    },
      _deleteUser:function(data){

         $.ajax({
                            url:'delete-user',
                            type:'DELETE',
                            data:{_token:_token,data},
                            dataType: "JSON",
                            success:function(res){
                               alert("User deleted");
                               reloadList();
                            },
                            error:function(response){
                               // alert("Failed to delete");
                            }
               });      
    },

    _addUser:function(data){
                $.ajax({
                            url:'add-user',
                            type:'POST',
                            data:{_token:_token,data:data},
                            dataType: "JSON",
                            success:function(res){
                                    alert("User Added");
                                    $('#modal-id').modal('hide');
                                    reloadList();
                            },
                            error:function(response){
                                alert("Failed to Add");
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
