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
        <h1 class="m-0">Agent Management</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Agent</li>
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
                                data-target="#ModalLoginForm" id="add_Agent">Add Agent</button>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="agent_datatables" class="table table-bordered table-hover ">
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
        
@include('agent.modal')

   
<script>

     var APP_URL = {!! json_encode(url('/')) !!}+'/admin/';

    var _token=$('meta[name="csrf-token"]').attr('content');

     $(document).ready( function () {
        Agent._getList();
     });

     $(document).on('click', '.delete-agent', function () {
         var id=$(this).attr('data-id');
         var data={
             id:id
         }
         Agent._deleteAgent(data);
     });

     $(document).on('click', '.disable-agent', function () {
         var data={
             id:$(this).attr('data-id'),
             status:$(this).attr('status')
         }
         Agent._disableAgent(data);
     });

     

     $(document).on('click', '#add_Agent', function (e) {
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
       
       Agent._addAgent(data);
        
   });
    
    
var Agent = {
  
    _getList: function() {  // question heading related stuff that display's pre- option  -post
        
     $('#agent_datatables').DataTable({
               processing: true,
               serverSide: true,
               ajax: APP_URL+"agent-list",
               columns: [
                        {data:'name',id:'name'},
                        { data: 'email', name: 'email' },
                        { data: 'phone_number', name: 'phone_number' },
                        {data: 'action', name: 'action', orderable: false},

                     ]
            });
      },
    
    
      _deleteAgent:function(data){

         $.ajax({
                            url:APP_URL+'delete-agent',
                            type:'DELETE',
                            data:{_token:_token,data},
                            dataType: "JSON",
                            success:function(res){
                                notify("Agent deleted","success");
                               reloadList();
                            },
                            error:function(response){
                                notify("Failed to add","error");
                            }
               });      
    },

    _disableAgent:function(data){

        $.ajax({
                        url:APP_URL+'disable-agent',
                        type:'post',
                        data:{_token:_token,data},
                        dataType: "JSON",
                        success:function(res){
                            reloadList();
                            if(data.status=='Active')
                                notify("Agent disabled","success");
                            else
                                notify("Agent enabled","success");
                        },
                        error:function(response){
                            notify("Failed to change status","error");
                        }
            });      
        },


    _addAgent:function(data){
                $.ajax({
                            url:APP_URL+'add-agent',
                            type:'POST',
                            data:{_token:_token,data:data},
                            dataType: "JSON",
                            success:function(res){
                                    notify("Agent Added","success");
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
     $('#agent_datatables').DataTable().ajax.reload();
}


</script>
</body>
 </html> 
 @endsection
