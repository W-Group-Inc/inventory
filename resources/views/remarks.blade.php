<div class="modal fade" id="remarks{{$inventory->id}}" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="formModal">Remarks</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form method='post' action='input-remarks/{{$inventory->id}}' onsubmit='show();'  enctype="multipart/form-data">
                    {{ csrf_field() }}
                    
                    <label >Date Purchase : </label>
                    <input name='date_purchase' class="form-control" type='date' placeholder="" value='{{$inventory->date_purchase}}' required>
                    <label >Serial : </label>
                    <input name='serial_number' class="form-control" placeholder="Serial Number" value='{{$inventory->serial_number}}' required>
                    <label >Remarks</label>
                    <label >Description : </label>
                    <textarea onkeyup="setHeight('description');" style="height: 100px;" onkeydown="setHeight('description');" id='description' name='description' class="form-control" placeholder="Description" required>{{$inventory->description}}</textarea>
                    <label >Remarks</label>
                    <textarea onkeyup="setHeight('description');" style="height: 100px;" onkeydown="setHeight('description');" id='remarks' name='remarks' class="form-control" placeholder="Remarks" required>{{$inventory->remarks}}</textarea>
                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>