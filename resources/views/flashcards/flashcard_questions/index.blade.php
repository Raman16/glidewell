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
        <h1 class="m-0">FC Questions Management</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">FC Questions</li>
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
                        <div class="col-md-3">
                            <b>Select Module:</b>
                            <select id="module_master" class="form-control input-lg modules_dropdwn" 
                                 name="modules_dropdwn">
                            </select>
                        </div>
                        <div class="col-md-2 text-right offset-7">
                            <button class="btn btn-danger" 
                                data-target="#ModalForm" id="add_new_btn">Add New</button>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="fcq_datatables" class="table table-bordered table-hover ">
                        <thead>
                            <tr>
                               <th>Module Name</th>
                                <th>Question</th>
                                <th>Description</th>
                                <th>Reference</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Module Name</th>
                                <th>Question</th>
                                <th>Description</th>
                                <th>Reference</th>
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
        
   @include('flashcards.flashcard_questions.modal')

   
<script>

    var APP_URL = {!! json_encode(url('/')) !!}+'/admin/';
    var _token=$('meta[name="csrf-token"]').attr('content');

     $(document).ready( function () {
        FC_Questions._getList();
        FC_Questions._getModules();
     });

     $(document).on('click', '.delete-question', function () {
         var id=$(this).attr('data-id');
         var data={
             id:id
         }
         FC_Questions._deleteQuestion(data);
     });

     $(document).on('click', '.edit-question', function (e) {
         
            e.preventDefault();
            var id=$(this).attr('data-id');
           // var currentRow=$(this).closest("tr"); 
            // var module_id=currentRow.find("td:eq(0)").text(); // get current row 1st TD value
            // var module_name=currentRow.find("td:eq(0)").text(); 

            FC_Questions._getModules();
            FC_Questions._editQuestion(id);
          //  $('#userCrudModal').html("Edit Module");
          //  
             
 
     });

     $(document).on('click', '#add_new_btn', function (e) {
        e.preventDefault();
        //FC_Questions._getModules();
        $('#userCrudModal').html("Create Question");
        $('#ModalForm').modal('show');
     });
     
     $(document).on('click', '#module_master', function () {
        FC_Questions._getModuleFcs($('.modules_dropdwn option:selected').val());
     });


    $(document).on('click', '#add_edit', function (e) {
       
       e.preventDefault();

       var question_id=$('#question_id').val();
       var module_id=$('.modules_dropdwn option:selected').val();
       var data={ };

       if(question_id==''){
        data={
           module_id:module_id,
           question:$('#question').val(),
           description:$('#description').val(),
           reference:$('#reference').val()
           }
          FC_Questions._addQuestion(data);
       }
       else{

        data={
           question_id:question_id,
           module_id:module_id,
           question:$('#question').val(),
           description:$('#description').val(),
           reference:$('#reference').val()
       }
       
         FC_Questions._updateQuestion(data);
       }
        
   });
    
    

   $(document).on('click', '.status-change', function (e) {
  
            var data={
                id:$(this).attr('data-id'),
                status:$(this).attr('status')
            }
            FC_Questions._ChangeStatus(data);
    });





var FC_Questions = {
  
    _getList: function() {  // question heading related stuff that display's pre- option  -post
  
        $('#fcq_datatables').DataTable({
               processing: true,
               serverSide: true,
               ajax: APP_URL+"flashcards/flashcard-questions-list/",
               columns: [
                        {data:'name',name:'module.name'},
                        { data: 'question', name: 'question' },
                        { data: 'description', name: 'description' },
                        { data: 'reference', name: 'reference' },
                        {data: 'action', name: 'action', orderable: false},

                     ]
            });
      },

      _getModuleFcs: function(module_id) {  // question heading related stuff that display's pre- option  -post
  
             $("#fcq_datatables").dataTable().fnDestroy();

            $('#fcq_datatables').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: APP_URL+"flashcards/flashcard-questions-list/"+module_id,
                    columns: [
                            {data:'name',name:'module.name'},
                            { data: 'question', name: 'question' },
                            { data: 'description', name: 'description' },
                            { data: 'reference', name: 'reference' },
                            {data: 'action', name: 'action', orderable: false},

                        ]
                });
            },

    _getModules:function(){

        $.ajax({
                    url:APP_URL+"flashcards/get-modules",
                    type:'GET',
                    data:{_token:_token},
                    dataType: "JSON",
                    success:function(res){
                        var option = '<option value="0"></option>';
                        for (var i=0;i<res.length;i++){
                           option += '<option value='+ res[i]['id']+'>' + res[i]['name'] + '</option>';
                        }
                        $('.modules_dropdwn').append(option);
                       
                     },
                    error:function(response){
                        notify("Failed to list","error");
                    }
                });

    },
    _updateQuestion:function(data){
        
           $.ajax({
                    url:APP_URL+"flashcards/flashcard-update-question/"+data.question_id,
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
      _editQuestion:function(id){
                $.ajax({
                            url:APP_URL+"flashcards/flashcard-edit-question/"+id,
                            type:'GET',
                            data:{_token:_token},
                            dataType: "JSON",
                            success:function(res){
                              //  console.log(res);
                                $(".modules_dropdwn").val(res.data['module_id']).change();

                               $('#question_id').val(res.data['id']);
                               $('#description').val(res.data['description']);
                               $('#question').val(res.data['question']);
                               $('#reference').val(res.data['reference']);
                               $('#ModalForm').modal('show');


                            },
                            error:function(response){
                            }
                        });
    
    
    },
    _ChangeStatus:function(data){

                $.ajax({
                        url:APP_URL+'flashcards/enable-disable-flashcard',
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

      _deleteQuestion:function(data){

         $.ajax({
                            url:APP_URL+"flashcards/flashcard-delete-question",
                            type:'DELETE',
                            data:{_token:_token,data},
                            dataType: "JSON",
                            success:function(res){
                                notify("Deleted Successfully","success");
                                reloadList();
                            },
                            error:function(response){
                                notify("Failed to delete","error");
                            }
               });      
    },

    _addQuestion:function(data){
                $.ajax({
                            url:APP_URL+"flashcards/flashcard-add-question",
                            type:'POST',
                            data:{_token:_token,data:data},
                            dataType: "JSON",
                            success:function(res){
                                    notify("Added Successfully","success");
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
     $('#fcq_datatables').DataTable().ajax.reload();
}


</script>
</body>
 </html> 
 @endsection
