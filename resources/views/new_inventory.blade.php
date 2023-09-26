<div class="modal fade" id="new_inventory" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">New Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method='post' action='new-inventory' onsubmit='show();'  enctype="multipart/form-data">
                    {{ csrf_field() }}
                        <div class='row'>
                        <div class='col-md-6'>
                            <label>Asset Type</label>
                            <select class=" select2 form-control form-control-sm" name='asset_type' style='width:100%;' required>
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
                        <div class='col-md-6'>
                        </div>
                        </div>
                    
                        <label>Model</label>
                        <input type="text" name='model' class="form-control form-control-sm mb-2 mr-sm-2" value="{{ old('model') }}" placeholder="Model" required>
                        <label>Serial Number</label>
                        <input type="text" name='serial_number' class="form-control mb-2 mr-sm-2 form-control-sm" value="{{ old('serial_number') }}" placeholder="Serial Number" required>
                        <label>Description</label>
                        <textarea onkeyup="setHeight('description');" onkeydown="setHeight('description');" id='description' name='description' class="form-control form-control-sm" placeholder="Description" required>{{ old('description') }}</textarea>
                        <label>Date Purchased</label>
                        <input type="date" name='date_purchased' max='{{date('Y-m-d')}}' class="form-control form-control-sm mb-2 mr-sm-2" value="{{ old('date_purchased') }}" placeholder="Date Purchased" >
                        <label>Amount</label>
                        <input type="number" name='amount' max='{{date('Y-m-d')}}' class="form-control mb-2 mr-sm-2 form-control-sm" value="{{ old('amount') }}" step='0.01' min='0.01' placeholder="Amount" >
                    
                
                    <div class="text-right">
                        <button class="btn btn-primary mr-1" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>