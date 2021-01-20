<button class="btn btn-danger user-status" title="Active" data-id=<?= $id;?>
   user-status=<?= ($deleted_at==null)?'Active':'Inactive' ?> >
   <?= ($deleted_at==null)?'Active':'Inactive'?> 
</button>