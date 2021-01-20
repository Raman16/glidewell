<button class="btn btn-danger edit-question" title="Edit" 
        data-id=<?= $id;?> data-target="#ModalForm">
       Edit
</button>

@if($deleted_at==null)
 <button class="btn btn-danger status-change" title="Disable" data-id=<?= $id;?> status="enable">
   Disable
</button>
@else
<button class="btn btn-success status-change" title="Enable" data-id=<?= $id;?> status="disable">
   Enable
</button>
@endif