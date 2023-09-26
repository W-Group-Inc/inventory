@extends('layouts.header')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-4 col-md-4 col-lg-4">
                @if(session()->has('status'))
                <div class="alert alert-success alert-dismissable">
                    {{-- <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button> --}}
                    {{session()->get('status')}}
                </div>
            @endif
            @include('error')
                  <div class="card">
                      <form method='post' action='upload-inventory' onsubmit='show();'  enctype="multipart/form-data">
                          {{ csrf_field() }}
                        
                          <div class="card-header">
                          <h4>Upload </h4>
                          </div>
                            <div class="card-body">
                                File :
                                <input type="file" class=" form-control "  value="{{ old('file') }}"  name="file" required/>
                        
                                Department :

                                <select  class='form-control form-control-sm select2' name='department' required >
                                    <option value=''></option>
                                    @foreach($departments as $department)
                                    <option value='{{$department->id}}'>{{$department->name}} - {{$department->code}}</option>
                                    @endforeach
                                    </select>
                        
                                Conducted :
                                <input type="date" class=" form-control " max='{{date('Y-m-d')}}' value="{{ old('file') }}"  name="date_conducted" required/>
                        
                                Remarks :
                                <textarea type="date" class=" form-control" style='height:100px;'  value=""  name="remarks" required>{{ old('remarks') }}</textarea>

                                
                        
                            </div>
                          <div class="card-footer text-right">
                              <button class="btn btn-primary mr-1" type="submit">Save</button>
                          </div>
                         
                      </form>
                  </div>
              </div>
            <div class="col-8 col-sm-12 col-md-8 col-lg-8">
         
                <div class="card">
                    <div class="card-header">
                      <h4>Uploaded </h4>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-hover " id="employees-table" style="width:100%;">
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
                                <td><a href='{{url($count->attachment)}}' target='_blank' >{{$count->name}}</a></td>
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