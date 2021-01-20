@extends('layouts.app')

@section('content')

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">  
 <link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

 <!-- /.card-body -->
<?php 

$question_id='';
$question='';
$video_id='';
$options='';
$opt1='';
$opt2='';
$opt3='';
$opt4='';
$opt5='';
$answer='';
$video_link='';
$video_title='';
$video_description='';

   if(isset($data)){
       $question_id=$data[0]->id;
       $question=$data[0]->question;
       $video_id=$data[0]->video_id;
       $options=$data[0]->options;
       $opt1=$data[0]->opt1;
       $opt2=$data[0]->opt2;
       $opt3=$data[0]->opt3;
       $opt4=$data[0]->opt4;
       $opt5=$data[0]->opt5;
       $answer=$data[0]->answer;
       $video_link=$data[0]->video_link;
       $video_title=$data[0]->video_title;
       $video_description=$data[0]->video_description;
   }

?>   

<div class="content-header">
<div class="container-fluid">
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Question Form</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Question List</a></li>
            <li class="breadcrumb-item Active">Question Form</li>

        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
</div><!-- /.container-fluid -->
</div>

<!-- /.card-header -->
<div class="card-body">
    <form action="#">
        <div class="row">
            <div class="col-md-8">
                <h3>Add new question</h3>
                <div class="question-list">
                    <!-- <div class="form-group">
                        <label for="">Question ID</label>
                        <input type="text" class="form-control"
                            placeholder="Question ID" disabled>
                    </div> -->
                    <div class="form-group">
                        <label for="">Question Name</label>
                        <input type="text" class="form-control" id="question_name"
                            placeholder="Question Name" value="<?= $question?>"  name="question_name">
                        
                      <input type="hidden" class="form-control" id="question_id"
                            placeholder="Question Name" value="<?= $question_id ?>"  name="question_id">
                      <input type="hidden" class="form-control" id="video_id"
                            placeholder="video Name" value="<?= $video_id ;?>"  name="video_id">
                    </div>
                    <div class="form-group">
                        <label for="">No.of Options</label>
                        <select name="no_of_options" id="no_of_options" class="form-control">
                            <option value="">Choose no of option</option>
                            <option <?= ($options=='1')?'selected':'' ?> value="">1</option>
                            <option <?= ($options=='2')?'selected':'' ?> value="">2</option>
                            <option <?= ($options=='3')?'selected':'' ?> value="">3</option>
                            <option <?= ($options=='4')?'selected':'' ?> value="">4</option>
                            <option  <?= ($options=='5')?'selected':'' ?>value="">5</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for=""> Option 1</label>
                                <input type="text" id="opt1" name="opt1" class="form-control"
                                value="<?= $opt1; ?>"  placeholder="Option">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for=""> Option 2</label>
                                <input type="text"  id="opt2" name="opt2"  class="form-control"
                                value="<?= $opt2; ?>" placeholder="Option">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for=""> Option 3</label>
                                <input type="text"  id="opt3" name="opt3"  class="form-control"
                                value="<?= $opt3; ?>"   placeholder="Option">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for=""> Option 4</label>
                                <input type="text"  id="opt4" name="op4"  class="form-control"
                                value="<?=$opt4; ?>" placeholder="Option">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for=""> Option 5</label>
                                <input type="text"  id="opt5" name="opt5"  class="form-control"
                                value="<?= $opt5; ?>"  placeholder="Option">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Answer</label>
                                <select id="answer" name="answer" class="form-control">
                                    <option <?= ($answer=='opt1')?'selected':'' ?> value="opt1">opt1</option>
                                    <option <?= ($answer=='opt2')?'selected':'' ?> value="opt2">opt2</option>
                                    <option <?= ($answer=='opt3')?'selected':'' ?> value="opt3">opt3</option>
                                    <option <?= ($answer=='opt4')?'selected':'' ?> value="opt4">opt4</option>
                                    <option <?= ($answer=='opt5')?'selected':'' ?>  value="opt5">opt5</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Video URL</label>
                        <input type="text" value="<?=$video_link ?>"  id="video_url" name="video_url" class="form-control" placeholder="Video URL">
                    </div>
                    <div class="form-group">
                        <label for="">Video Title</label>
                        <input type="text" id="video_title" value="<?=  $video_title; ?>" name="video_title"  class="form-control"
                            placeholder="Video Title">
                    </div>
                    <div class="form-group">
                        <label for="">Video Description</label>
                        <input type="text" id="video_description" value="<?= $video_description; ?>"  name="video_description"  class="form-control"
                            placeholder="Video Description">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-danger btn-lg save_form_add" id="" >Save</button>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>
     


<script>


var APP_URL = {!! json_encode(url('/')) !!}+'/admin/';
var _token=$('meta[name="csrf-token"]').attr('content');

$(document).on('click', '.save_form_add', function (e) {
       
       e.preventDefault();
       var question_id=$('#question_id').val();
       var data={};
       if(question_id!=''){

        data={
                    question_id:question_id,
                    video_id:$('#video_id').val(),
                    question:$('#question_name').val(),
                    answer:$('#answer option:selected').val(),
                    opt1:$('#opt1').val(),
                    opt2:$('#opt2').val(),
                    opt3:$('#opt3').val(),
                    opt4:$('#opt4').val(),
                    opt5:$('#opt5').val(),
                    video_title:$('#video_title').val(),
                    video_url:$('#video_url').val(),
                    video_description:$('#video_description').val(),
                    no_of_options:$('#no_of_options option:selected').val()
        }

        Questions._updateQuestions(data);

      }else{
                data={
                    question:$('#question_name').val(),
                    answer:$('#answer option:selected').val(),
                    opt1:$('#opt1').val(),
                    opt2:$('#opt2').val(),
                    opt3:$('#opt3').val(),
                    opt4:$('#opt4').val(),
                    opt5:$('#opt5').val(),
                    video_title:$('#video_title').val(),
                    video_url:$('#video_url').val(),
                    video_description:$('#video_description').val(),
                    no_of_options:$('#no_of_options option:selected').val()
        }

        Questions._addQuestions(data);
       }
        
        
   });

   
var Questions={

   _addQuestions:function(data){

         var category_type="<?=$category;?>";

               $.ajax({
                           url:APP_URL+'question-management/add-question/'+category_type,
                           type:'POST',
                           data:{_token:_token,data:data},
                           dataType: "JSON",
                           success:function(res){
                            notify("Question Added","success");
                           },
                           error:function(response){
                              notify("Failed to add","error");
                           }
                       });
    },

    _updateQuestions:function(data){

      var category_type="<?=$category;?>";

      $.ajax({
                  url:APP_URL+'question-management/update-question/'+category_type,
                  type:'PUT',
                  data:{_token:_token,data:data},
                  dataType: "JSON",
                  success:function(res){
                    //$.notify("update success", {align:"right", verticalAlign:"top",type:'success'});
                    notify("Updated Successfully","success");
                  },
                  error:function(response){
                    notify("Update Failed","error");
                  }
              });
}

}

</script>
@endsection