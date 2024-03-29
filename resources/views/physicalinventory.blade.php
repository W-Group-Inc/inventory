@extends('layouts.header')
@section('content')
<div class="main-content">
  <section class="section">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        @if(session()->has('status'))
        <div class="alert alert-success alert-dismissable">
          {{-- <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>--}}
          {{session()->get('status')}}
        </div>
        @endif
        @include('error')
          <div class="card">
            <form method='post' action='upload-inventory' onsubmit='show();' enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="card-header">
                  <h4>Upload</h4>
                </div>
                <div class="card-body">
                  <div class="mb-2">
                    <label for="file" class="form-label">File</label>
                    <input type="file" class=" form-control" value="{{ old('file') }}"  name="file" required/>
                  </div>
                  <div class="mb-2">
                    <label for="department" class="form-label">Department</label>
                    <select  class='form-control select2' name='department' required >
                      <option value=''>Select Department</option>
                        @foreach($departments as $department)
                      <option value='{{$department->id}}'>{{$department->name}} - {{$department->code}}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="mb-2">
                    <label for="conducted" class="form-label">Conducted</label>
                    <input type="date" class=" form-control " max='{{date('Y-m-d')}}' value="{{ old('file') }}"  name="date_conducted" required/>
                  </div>
                  <div class="mb-2">
                    <label for="remarks" class="form-label">Remarks</label>
                    <textarea type="date" class=" form-control" style='height:100px;' placeholder="Remarks" name="remarks" required>{{ old('remarks') }}</textarea>
                  </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-save" type="submit">Save</button>
                </div>
            </form>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <div class="card">
                <div class="card-header">
                  <h4>Uploaded</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-hover" id="employees-table" style="width:100%;">
                      <thead>
                        <tr>
                          <th>File</th>
                          <th>Department</th>
                          <th>Conducted</th>
                          <th>Remarks</th>
                          <th>Uploaded By</th>
                          <th>Uploaded Date</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach($counts as $count)
                          <tr>
                            <td><a href='{{url($count->attachment)}}' target='_blank'>{{$count->name}}</a></td>
                            <td>{{$count->department->name}}</td>
                            <td>{{date('M d, Y',strtotime($count->date_coducted))}}</td>
                            <td><small>{{$count->remarks}}</small></td>
                            <td>{{$count->user->name}}</td>
                            <td>{{date('M d, Y',strtotime($count->created_at))}}</td>
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

{{-- @include('new_employee'); --}}


@endsection
@section('footer')
  <script src="{{ asset('assets/js/app.min.js') }}"></script>
@endsection