@extends('layouts.header')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-4 col-md-4 col-lg-4">
                <form method='post' action='new-department' onsubmit='show();'  enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @if(session()->has('status'))
                        <div class="alert alert-success alert-dismissable">
                            {{-- <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button> --}}
                            {{session()->get('status')}}
                        </div>
                    @endif
                    @include('error')
                    <div class="card">
                        <div class="card-header">
                        <h4>New </h4>
                        </div>
                        <div class="card-body">
                            <div class='row'>
                              <div class='col-md-12'>
                             
                                <label>Code</label>
                                <input type="text" name='code' class="form-control form-control-sm mb-2 mr-sm-2" value="{{ old('code') }}" placeholder="Code" required>
                                <label>Department Name</label>
                                <input type="text" name='department_name' class="form-control form-control-sm mb-2 mr-sm-2" value="{{ old('department_name') }}" placeholder="Department Name" required>
                          
                              </div>
 
                              
                            </div>
                        
                         
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary mr-1" type="submit">Save</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-8 col-md-8 col-lg-8">
                <div class="card">
                    <div class="card-header">
                      <h4>Departments </h4>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                          <thead>
                            <tr>
                              <th>Code</th>
                              <th>Name</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($departments as $department)
                                <tr>
                                    <td>{{$department->code}}</td>
                                    <td>{{$department->name}}</td>
                                    <td><a href="#" onclick='getId({{$department->id}});' title='Edit Department' class="btn btn-icon btn-warning" data-toggle="modal" data-target="#edit_department">
                                        <i class="
                                        far fa-edit">
                                        </i>
                                      </a>
                                    </th>
                                </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@include('edit_department')
<script>
    var departments = {!! json_encode($departments->toArray()) !!};
    function getId(data)
    {
        var depselect = departments.find(dep => dep.id === data);
        console.log(depselect);
        document.getElementById("editdepartmentId").value = data;
        document.getElementById("editdepartmentCode").value = depselect.code;
        document.getElementById("editdepartmentName").value = depselect.name;
    }
</script>
@endsection
@section('footer')
  <script src="{{ asset('assets/js/app.min.js') }}"></script>
@endsection
