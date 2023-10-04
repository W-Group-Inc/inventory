
<div class="modal fade" id="edit_department" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Department</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{asset('images/close.png')}}" style="width: 25px;height: 25px">
                </button>
            </div>
            <form method='post' action='edit-department' onsubmit='show();'  enctype="multipart/form-data" >
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class='col-12 mb-2'>
                        <label class="form-label">Code</label>
                        <input type="hidden" class="form-control-sm form-control" id='editdepartmentId' name="department_id" required/>
                        <input type="text" class="form-control-sm form-control"  id='editdepartmentCode' name="code" required/>
                    </div>
                    <div class='col-12'>
                        <label class="form-label">Department Name</label>
                        <input type="text" class="form-control-sm form-control " id='editdepartmentName' name="department" required/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-default" data-dismiss="modal">Close</button>
                    <button type='submit'  class="btn btn-primary btn-save">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>