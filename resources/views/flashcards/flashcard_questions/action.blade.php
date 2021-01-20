<button class="btn btn-danger edit-question" title="Edit" 
        data-id=<?= $id;?> data-target="#ModalLoginForm">
        <i class="fas fa-pencil-alt" ></i>
</button>

@if($deleted_at==null)
 <button class="btn btn-default status-change" title="Disable" data-id=<?= $id;?> status="enable">
 <i class="fa fa-toggle-on"></i>
</button>
@else
<button class="btn btn-default status-change" title="Enable" data-id=<?= $id;?> status="disable">
<i class="fa fa-toggle-off"></i>
</button>
@endif
<!-- 
<button class="btn btn-default delete-question" title="Delete" data-id=<?= $id;?> >
        <i class="far fa-trash-alt "></i>
</button> -->


<!-- 
<a  data-toggle="tooltip" data-id=<?= $id;?> data-original-title="Edit" class="edit btn btn-success edit-module">
Edit
</a> -->
<!-- <a href="javascript:void(0)" data-id=<?= $id;?> data-toggle="tooltip" data-original-title="Delete" 
  class="delete btn btn-danger delete-module">
Delete
</a> -->

