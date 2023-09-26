@extends('layouts.header')

@section('content')
<div class="main-content">
    <section class="section">
        <form method='get' action='reports' onsubmit='show();'  enctype="multipart/form-data">

        <div class='row'>


            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="form-group mt-2">
                            <div class="input-group mb-3">
                                Department
                                <select class="form-control select2" name='department' style='width:100%' required >
                                    <option value=''>Select Department</option>
                                    @foreach($departments as $dep)
                                        {{-- <option ></option> --}}
                                        <option value='{{$dep->id}}' @if($dep->id == $depa) selected @endif>{{$dep->code}}-{{$dep->name}}</option>
                                    @endforeach
                                </select>
                              <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Generate</button>
                              </div>
                            </div>
                          </div>
                    </div>
                </div>

            </div>

        </div>
    </form>
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                      <h4>Inventories <a href="{{url('print-report?department='.$depa)}}" target="_blank" class="btn btn-icon icon-left btn-danger"><i class="far fa-file-pdf"></i> Print</a></h4>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                          <thead>
                            <tr>
                              <th>Code</th>
                              <th>Asset Type</th>
                              <th>P.O. Number</th>
                              <th>Category</th>
                              <th>Brand</th>
                              <th>Model</th>
                              <th>Serial Number</th>
                              <th>Description</th>
                              <th>Supplier</th>
                              <th>Date Purchase</th>
                              <th>Unit Price</th>
                              <th>Status</th>
                              <th>Office</th>
                              <th>Accountable Person</th>
                              <th>Remarks</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($inventories as $inventory)
                              <tr>
                                <td>{{$inventory->category->code}}-{{str_pad($inventory->equipment_code, 4, '0', STR_PAD_LEFT)}}</td>
                                <td>{{$inventory->category->asset_type->name}}</td>
                                <td>{{$inventory->po_number}}</td>
                                <td>{{$inventory->category->category_name}}</td>
                                <td>{{$inventory->brand}}</td>
                                <td>{{$inventory->model}}</td>
                                <td>
                                    @if($inventory->engine_number != null)
                                    <small>
                                     {{$inventory->engine_number}}<br>
                                      {{$inventory->chasis_number}}<br>
                                      {{$inventory->plate_mumber}}<br>
                                    </small>
                                  @else
                                  <small> {{$inventory->serial_number}}  </small>
                                  @endif
                                </td>
                                <td>
                                    <small>{{$inventory->description}}</small>
                                </td>
                                <td>
                                    <small>{{$inventory->supplier}}</small>
                                </td>
                                <td>{{date('M d, Y',strtotime($inventory->date_purchase))}}</td>

                                <td>{{number_format($inventory->amount,2)}}</td>
                                <td>{{$inventory->status}}</td>
                                @if($inventory->status == "Deployed")

                                    <td>{{$inventory->employee_inventory[0]->employee_info->dep->name}}</td>
                                    <td>{{$inventory->employee_inventory[0]->employee_info->name}}</td>
                                @else
                                     <td></td>
                                     <td></td>
                                @endif
                                    <td></td>
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

@endsection
@section('footer')
  <script src="{{ asset('assets/js/app.min.js') }}"></script>
@endsection
