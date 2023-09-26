
<div class="modal" id="edit_department" tabindex="-1" role="dialog"  >
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class='col-md-10'>
                    <h5 class="modal-title" id="exampleModalLabel">Edit Department</h5>
                </div>
                <div class='col-md-2'>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <form method='post' action='edit-department' onsubmit='show();'  enctype="multipart/form-data" >
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class='col-md-12'>
                        Code :
                        <input type="hidden" class="form-control-sm form-control " id='editdepartmentId' name="department_id" required/>
                        <input type="text" class="form-control-sm form-control "  id='editdepartmentCode' name="code" required/>
                    </div>
                    <div class='col-md-12'>
                        Department Name :
                        <input type="text" class="form-control-sm form-control " id='editdepartmentName'  name="department" required/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type='submit'  class="btn btn-primary" >Update</button>
                </div>
            </form>
        </div>
    </div>
</div>