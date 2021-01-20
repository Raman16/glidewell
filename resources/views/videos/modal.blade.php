<div id="ModalForm" class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="userCrudModal"></h2>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="" id="form_id">
                        <div class="form-group">
                            <label class="control-label">Title</label>
                            <div>
                            <input type="hidden" id="video_id" class="form-control input-lg" 
                                   name="video_id" value="">
                            <input type="text" id="video_title" class="form-control input-lg" 
                                   name="video_title" value="">
                        </div>

                        <div class="form-group">
                            <label class="control-label">Description</label>
                            <div>
                            <input type="text" id="video_description" class="form-control input-lg" 
                                   name="video_description" value="">
                        </div>

                        <div class="form-group">
                            <label class="control-label">Link</label>
                            <div>
                            <input type="text" id="video_url" class="form-control input-lg" 
                                   name="video_url" value="">
                        </div>

                        <div class="form-group">
                            <div>
                                <button type="button" id="update_video" class="btn btn-success">Save</button>
                                <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
