<div id="ModalUserForm" class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="userCrudModal"></h2>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="">
                        <input type="hidden" name="_token" value="">
                        <div class="form-group">
                            <label class="control-label">User Name</label>
                            <div>
                            <input type="hidden" id="user_id" class="form-control input-lg" 
                                   name="user_id" value="">
                            <input type="text" id="user_name" class="form-control input-lg" 
                                   name="user_name" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Email</label>
                            <div>
                            <input type="text" id="user_email" class="form-control input-lg" 
                                   name="user_email" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Phone</label>
                            <div>
                            <input type="text" id="user_phone" class="form-control input-lg" 
                                   name="user_phone" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div>
                                <button type="button" id="add_edit_user" class="btn btn-success">Save</button>
                                <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
