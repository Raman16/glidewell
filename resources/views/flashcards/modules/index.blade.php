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
        <h1 class="m-0">Module Management</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Modules</li>
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
                                data-target="#ModalLoginForm" id="add_module">Add New</button>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="modules_datatables" class="table table-bordered table-hover ">
                        <thead>
                            <tr>
                                <th>Module ID</th>
                                <th>Module Name</th>
                                <th>Api Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Module ID</th>
                                <th>Module Name</th>
                                <th>Api Name</th>
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

    var APP_URL = {!! json_encode(url('/')) !!}+'/admin/';
    var _token=$('meta[name="csrf-token"]').attr('content');

     $(document).ready( function () {

      // alert(APP_URL);
        Modules._getList();
     });

     $(document).on('click', '.delete-module', function () {

        confirm = confirm("Please confirm delete"); 
        if (confirm == true)
        {
       
        }
         var id=$(this).attr('data-id');
         var data={
             id:id
         }
         Modules._deleteModule(data);
     });

     $(document).on('click', '.edit-module', function (e) {
         
            e.preventDefault();
            var id=$(this).attr('data-id');
            var currentRow=$(this).closest("tr"); 
            // var module_id=currentRow.find("td:eq(0)").text(); // get current row 1st TD value
            // var module_name=currentRow.find("td:eq(0)").text(); 

              Modules._editModule(id);
          //  $('#userCrudModal').html("Edit Module");
          //  
             
 
     });

     $(document).on('click', '.add-module-btn', function (e) {
        e.preventDefault();
        $('#module_id').val('');
        $('#module_name').val('');
        $('#userCrudModal').html("Create Module");
        // $('#modal-id').modal('show');
     });
     
    $(document).on('click', '#add_edit_module', function (e) {
       
       e.preventDefault();
       var id=$('#module_id').val();
       name=$('#module_name').val();
       var data={};
       if(id==''){
           data={
                  name:name,
                };
           Modules._addModule(data);
       }else{
           
          data={
                id:id,
                name:name
          }
          Modules._updateModule(data);
       }
        
   });
    
   $(document).on('click', '.status-change', function (e) {
  
    var data={
                id:$(this).attr('data-id'),
                status:$(this).attr('status')
            }
            Modules._ChangeStatus(data);
    });



    
var Modules = {
  
    _getList: function() {  // question heading related stuff that display's pre- option  -post
     $('#modules_datatables').DataTable({
               processing: true,
               serverSide: true,
               ajax: APP_URL+"flashcards/modules-list",
               columns: [
                        {data:'id',id:'id'},
                        { data: 'name', name: 'name' },
                        { data: 'api_name', name: 'api_name' },
                        {data: 'action', name: 'action', orderable: false},

                     ]
            });
      },
    
    _updateModule:function(data){
        
           $.ajax({
                    url:APP_URL+'flashcards/update-module/'+data.id,
                    type:'PUT',
                    data:{_token:_token,data:data},
                    dataType: "JSON",
                    success:function(res){
                        notify("Updated Successfully","success");
                            reloadList();
                     },
                    error:function(response){
                        notify("Failed to update","error");
                    }
                });
      },
    _editModule:function(id){
                $.ajax({
                            url:APP_URL+'flashcards/edit-module/'+id,
                            type:'GET',
                            data:{_token:_token},
                            dataType: "JSON",
                            success:function(res){
                               // console.log(res.data['name']);
                               $('#ModalLoginForm').modal('show');
                               $('#module_id').val(res.data['id']);
                               $('#module_name').val(res.data['name'])
;
                            },
                            error:function(response){
                            }
                        });
    
    
    },
    _ChangeStatus:function(data){

                $.ajax({
                        url:APP_URL+'flashcards/enable-disable-module',
                        type:'POST',
                        data:{_token:_token,data:data},
                        dataType: "JSON",
                        success:function(res){
                            if(data.status=='enable')
                              notify("Disabled Successfully","success");
                            else
                            notify("Enabled Successfully","success");
                            reloadList();
                        },
                        error:function(response){
                            notify("Failed to disable","error");
                        }
                });    
        },
      _deleteModule:function(data){

         $.ajax({
                            url:APP_URL+'flashcards/delete-module',
                            type:'DELETE',
                            data:{_token:_token,data},
                            dataType: "JSON",
                            success:function(res){
                               notify("Module Deleted","success");
                               reloadList();
                            },
                            error:function(response){
                                notify("Failed to delete","error");
                            }
               });      
    },

    _addModule:function(data){
                $.ajax({
                            url:APP_URL+'flashcards/add-module',
                            type:'POST',
                            data:{_token:_token,data:data},
                            dataType: "JSON",
                            success:function(res){
                                    notify("Module Added","success");
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
     $('#modules_datatables').DataTable().ajax.reload();
}


</script>
</body>
 </html> 
 @endsection
