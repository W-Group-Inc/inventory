@extends('layouts.header')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-4 col-md-4 col-lg-4">
                <form method='post' action='new-inventory' onsubmit='show();'  enctype="multipart/form-data">
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
                              <div class='col-md-6'>
                                <label>Asset Type</label>
                                <select class=" select2 form-control form-control-sm" name='asset_type' style='width:100%;' onchange='select_type(this.value)' required>
                                    <option value=''>Select Type</option>
                                    @foreach($asset_types as $asset_type)
                                        <option value='{{$asset_type->id}}'>{{$asset_type->name}}</option>
                                    @endforeach
                                </select>
                                <label>PO. Number</label>
                                <input type="text" name='po_number' class="form-control form-control-sm mb-2 mr-sm-2" value="{{ old('po_number') }}" placeholder="PO Number" required>
                                <label>Category</label>
                                <select class="form-control select2 form-control-sm" name='category' style='width:100%' required>
                                    <option value=''>Select category</option>
                                    @foreach($categories as $category)
                                        <option value='{{$category->id}}'>{{$category->category_name}}</option>
                                    @endforeach
                                </select>
                                  <label>Brand</label>
                                  <input type="text" name='brand' class="form-control form-control-sm mb-2 mr-sm-2" value="{{ old('brand') }}" placeholder="Brand" required>
                          
                              </div>
                              <div class='col-md-6 text-center'>
                                <img class="rounded" id='avatar' style='width:170px;height:170px;' src='{{URL::asset('/images/no_image.png')}}' onerror="this.src='{{URL::asset('/images/no_image.png')}}';">
                                <div class="row mt-3">
                                  <div class='col-md-12 text-center'>
                                    <label title="Upload image file" for="inputImage" class="btn btn-primary btn-sm ">
                                        <input type="file" accept="image/*" name="file" id="inputImage" style="display:none"  onchange='uploadimage(this)' required>
                                        Upload Image
                                    </label>
                                  </div>
                                </div>
                              </div>
                              
                            </div>
                        
                            <label>Model</label>
                            <input type="text" name='model' class="form-control form-control-sm mb-2 mr-sm-2" value="{{ old('model') }}" placeholder="Model" required>
                            <div id='depart'>
                              <div id='d'><label>Serial Number</label>
                                <input type='text' name='serial_number' id='serial_number_new' class='form-control mb-2 mr-sm-2 form-control-sm' value='{{ old('serial_number') }}' placeholder='Serial Number' required></div>
                            </div>
                           
                            
                            <label>Description</label>
                            <textarea onkeyup="setHeight('description');" onkeydown="setHeight('description');" id='description' name='description' class="form-control form-control-sm" placeholder="Description" required>{{ old('description') }}</textarea>
                            <label>Supplier</label>
                            <input type="text" name='supplier' class="form-control form-control-sm mb-2 mr-sm-2" value="{{ old('supplier') }}" placeholder="Supplier" required>
                            <label>Date Purchased</label>
                            <input type="date" name='date_purchased' max='{{date('Y-m-d')}}' class="form-control form-control-sm mb-2 mr-sm-2" value="{{ old('date_purchased') }}" placeholder="Date Purchased" required>
                            <label>Amount</label>
                            <input type="number" name='amount' max='{{date('Y-m-d')}}' class="form-control mb-2 mr-sm-2 form-control-sm" value="{{ old('amount') }}" step='0.01' min='0.01' placeholder="Amount" required >
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
                      <h4>Inventories </h4>
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
                              <th>Model</th>
                              <th>Details</th>
                              <th>Date Purchase</th>
                              <th>Status</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($inventories as $inventory)
                              <tr>
                                <td>{{$inventory->category->code}}-{{str_pad($inventory->equipment_code, 4, '0', STR_PAD_LEFT)}}</td>
                                <td>{{$inventory->category->asset_type->name}}</td>
                                <td>{{$inventory->po_number}}</td>
                                <td>{{$inventory->category->category_name}}</td>
                                <td>{{$inventory->model}}</td>
                                <td>
                                  @if($inventory->engine_number != null)
                                    <small>
                                      Engine Number: {{$inventory->engine_number}}<br>
                                      Chasis Number: {{$inventory->chasis_number}}<br>
                                      Plate Number: {{$inventory->plate_mumber}}<br>
                                    </small>
                                  @else
                                    Serial Number : {{$inventory->serial_number}}
                                  @endif
                                </td>
                                <td>{{date('M d, Y',strtotime($inventory->date_purchase))}}</td>
                                <td>{{$inventory->status}}</td>
                                <td>
                                  <a href="{{url('print-inventory/'.$inventory->id)}}" target='_blank' class="btn btn-icon btn-info" title='View Inventory'>
                                    <i class=" far fa-file-pdf">
                                    </i>
                                  </a>
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
<script type="text/javascript">
   function select_type(value)
   {
          if(value == 2)
          {
            var element = document.getElementById("d");
            element.remove();
         
                            
                            
                            
                            
                            
          var data = "<div id='d'><label>Engine Number</label>";
              data += "<input type='text' name='engine_number' id='engine_number_new' class='form-control mb-2 mr-sm-2 form-control-sm' value='{{ old('engine_number') }}'' placeholder='Engine Number' >";
              data += "<label>Chasis Number</label>";
              data += "<input type='text' name='chasis_number' id='chasis_number_new' class='form-control mb-2 mr-sm-2 form-control-sm' value='{{ old('chasis_number') }}' placeholder='Chasis Number' >";
              data += "<label>Plate Number</label>";
              data += "<input type='text' name='plate_number' id='plate_number_new' class='form-control mb-2 mr-sm-2 form-control-sm' value='{{ old('plate_number') }}'' placeholder='Plate Number' >";
              data += "</div>";
             $('#depart').append(data);

               
          }
          else
          {
            var element = document.getElementById("d");
            element.remove();
            var data =  "<div id='d'><label>Serial Number</label>";
                data+= "<input type='text' name='serial_number' id='serial_number_new' class='form-control mb-2 mr-sm-2 form-control-sm' value='{{ old('serial_number') }}' placeholder='Serial Number' required></div>";
                            
       
            $('#depart').append(data);
         
            
          }
        
   }
   function uploadimage(input)
        {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                    $('#avatar').attr('src', e.target.result);
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
    setHeight('description');
    function setHeight(fieldId)
    {
        document.getElementById(fieldId).style.height = document.getElementById(fieldId).scrollHeight+'px';
       
    }
</script>
@endsection
@section('footer')
  <script src="{{ asset('assets/js/app.min.js') }}"></script>
@endsection
