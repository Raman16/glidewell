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
                            <label class="control-label">Module Name</label>
                            <div>
                            <select id="" class="form-control input-lg modules_dropdwn" 
                                 name="modules_dropdwn1">
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Question</label>
                            <div>
                            <input type="hidden" id="question_id" class="form-control input-lg" 
                                   name="question_id" value="">
                            <input type="text" id="question" class="form-control input-lg" 
                                   name="question" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Description</label>
                            <div>
                            <input type="text" id="description" class="form-control input-lg" 
                                   name="description" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Reference</label>
                            <div>
                            <input type="text" id="reference" class="form-control input-lg" 
                                   name="reference" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <button type="button" id="add_edit" class="btn btn-success">Save</button>
                                <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
