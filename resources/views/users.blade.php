@extends('layouts.header')
@section('content')
<div class="main-content">
  <section class="section">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        @if(session()->has('status'))
          <div class="alert alert-success alert-dismissable">
            {{-- <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button> --}}
            {{session()->get('status')}}
          </div>
        @endif
        @include('error')
        <div class="card">
          <form method='post' action='new-user' onsubmit='show();' enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="card-header">
              <h4>New User</h4>
            </div>
            <div class="card-body">
              <div class="mb-2">
                <label class="form-label">Name</label>
                <input type="text" class=" form-control" placeholder="Name" value="{{ old('name') }}" name="name" required/>
              </div>
              <div class="mb-2">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" placeholder="Email" value="{{ old('email') }}" name="email" required/>
              </div>
              <div class="mb-2">
                <label class="form-label">Password</label>
                <input type="password" class=" form-control" placeholder="Password" value="" name="password" required/>
              </div>
              <div class="mb-2">
                <label class="form-label">Confirm Password</label>
                <input type="password" class=" form-control" placeholder="Confirm Password" value="" name="password_confirmation" required/>
              </div>
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-primary btn-save" type="submit">Save</button>
            </div>
              
          </form>
        </div>
      </div>
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
      
            <div class="card">
                <div class="card-header">
                  <h4>User List</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-hover " id="employees-table" style="width:100%;">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                @if($user->status)
                                    <div class="badge badge-danger">Inactive</div>
                                @else
                                    <div class="badge badge-success">Active</div>
                                @endif

                            </td>
                            <td>
                                @if($user->id != auth()->user()->id)
                                    @if($user->status)
                                        <a href="{{url('activate/'.$user->id)}}" onclick='show()' class="btn btn-icon btn-success" title='Activate'><i class="fas fa-check"></i></a>
                                    @else
                                        <a href="{{url('deactivate/'.$user->id)}}" onclick='show()' class="btn btn-icon btn-danger" title='Deactivate'><i class="fas fa-trash-alt"></i></a>
                                    @endif
                                @endif
                              
                                

                            </td>
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