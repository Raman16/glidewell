
<button class="btn btn-default delete-agent" title="Delete" data-id=<?= $id;?> >
<i class="far fa-trash-alt "></i>
</button> 

@if($deleted_at==null)
<button class="btn btn-default disable-agent" title="disable" data-id=<?= $id;?>  status="Active">
<i class="fa fa-toggle-on"></i>
</button> 
@else
<button class="btn btn-default disable-agent" title="disable" data-id=<?= $id;?> status="Inactive">
<i class="fa fa-toggle-off"></i>
</button> 
@endif