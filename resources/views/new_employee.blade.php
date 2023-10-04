<div class="modal fade" id="new_employee" tabindex="-1" role="dialog" >
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{asset('images/close.png')}}" style="width: 25px;height: 25px">
                </button>
            </div>
            <form method='post' action='new-employee' onsubmit='show();'  enctype="multipart/form-data" >
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class='col-12 mb-2'>
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control-sm form-control" value="{{ old('name') }}" name="name" placeholder="Name" required/>
                    </div>
                    <div class='col-12 mb-2'>
                        <label class="form-label">Email Address</label>
                        <input type="email" class="form-control-sm form-control" value="{{ old('email') }}" name="email" placeholder="Email Address" required/>
                    </div>
                    <div class='col-12 mb-2'>
                        <label class="form-label">Employee Code</label>
                        <input type="text" class="form-control-sm form-control" value="{{ old('emp_code') }}" name="emp_code" placeholder="Employee Code" required/>
                    </div>
                    <div class='col-12 mb-2'>
                        <label class="form-label">Department</label>
                        <select  class='form-control form-control-sm' name='department' required >
                            <option value=''>Select Department</option>
                            @foreach($departments as $department)
                            <option value='{{$department->id}}'>{{$department->name}} - {{$department->code}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class='col-12 mb-2'>
                        <label class="form-label">Position</label>
                        <input type="text" class="form-control-sm form-control "  value="{{ old('position') }}"  name="position" placeholder="Position" required/>
                    </div>
                    <div class='col-12 mb-2'>
                        <label class="form-label">Employee Type</label>
                        <input type="text" class="form-control-sm form-control "  value="{{ old('emp_type') }}" placeholder="Regular,Probitionary,Project based"  name="emp_type" placeholder="" required/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type='submit'  class="btn btn-primary btn-save">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>