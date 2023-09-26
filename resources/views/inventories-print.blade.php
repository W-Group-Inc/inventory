<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
   
    
    <title>{{ config('app.name', 'Laravel') }}</title>
    <style>
        table { 
            border-spacing: 0;
            border-collapse: collapse;
        }
        body{
            font-family: Calibri;
            font-size : 12px;
        }
        .font-design
        {
            font-family: Arial, Helvetica, sans-serif;

        }
        @page { }
        #header { position: fixed; left: -500px; right: 0px; text-align: center; }
        .content td{
        padding-bottom: 5px;
        }
       
        #footer { position: fixed;  bottom: 70px; }
    </style>
</head>
<body class='font-design'>
    <div id="header">
        <h1><img src='{{asset('login_css/images/logo.png')}}' width='80px' ></h1>
    </div>
 
    <table width="100%" border="0" cellspacing="0" cellpadding="0" >
        <tr >
            <td>
                {{-- <img src='{{asset('login_css/images/logo.png')}}' width='150px' > --}}
                    <p align='center' class='font-design'><span style='font-size:14px;padding-bottom:3px;' ><strong> Republic of the Philippines</strong></span></p>
                    <p align='center' class='font-design'><span style='font-size:22px;padding-bottom:5px;' ><strong> PROVINCE OF CATANDUANES</strong></span></p>
                    <p align='center' class='font-design'><span style='font-size:14px;padding-bottom:5px;' ><strong> Municipality of Caramoran</strong></span></p>
         
                </p>
            </td>
        </tr>
    </table>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" >
        <tr >
            <td>
                {{-- <img src='{{asset('login_css/images/logo.png')}}' width='150px' > --}}
                    <p align='center' class='font-design'><span style='font-size:18px;padding-bottom:3px;' ><strong>PHYSICAL INVENTORY REPORT</strong></span></p>
         
                </p>
            </td>
        </tr>
    </table>
    <table width="100%" border="0" >
        <tr style='padding-bottom:10px;' >
            <td style='width:70%;'>
                Filter By : {{auth()->user()->name}}
              
            </td>
            <td style='width:30%;'>
               Date : {{{date('M d, Y')}}}
            </td>
        </tr>
        <tr >
            <td style='width:70%;'>
                Office    : @if($department == null) ALL @else {{$department->code}} - {{$department->name}}  @endif
            </td>
            <td style='width:30%;'>
            </td>
        </tr>
    </table>
    <Br>
    <table width="100%" border="1" cellspacing="0" cellpadding="0" style='font-size:8px;' >
        <thead>
            <tr style='background-color:#e0e0d1;' >
              <th style='padding:2px;'>Code</th>
              <th >Asset Type</th>
              <th>P.O. Number</th>
              <th>Category</th>
              <th>Brand</th>
              <th>Model</th>
              <th>Serial Number</th>
              <th>Description</th>
              <th>Supplier</th>
              <th>Date Purchase</th>
              <th>Unit Price</th>
              <th>Office</th>
              <th>Accountable Person</th>
              <th>Remarks</th>
            </tr>
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
              @if($inventory->status == "Deployed")
                                  
                <td>{{$inventory->employee_inventory[0]->employee_info->dep->name}}</td>
                <td>{{$inventory->employee_inventory[0]->employee_info->name}}</td>
                @else
                    <td></td>
                    <td></td>
                @endif
                  <td>{{$inventory->status}}</td>
            </tr>
          @endforeach
          </thead>
    </table>

    <div id="footer">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr >
                <td  align='center'>
                    Conducted By:  <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <span class='font-design' style='font-size:12px;padding-bottom:10px;text-decoration: overline;' >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Signature over Printed Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                </td>
                <td  align='center'>
                    Acknowledged by: <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <span class='font-design' style='font-size:12px;padding-bottom:10px;text-decoration: overline;' >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Signature over Printed Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
             
                </td>
            </tr>
        </table>
    </div>

 
</body>
</html>