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

    <table width="100%" border="0" cellspacing="0" cellpadding="0" style='padding-bottom:5px;'>
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
    <hr>

    <table width="100%" border="0" cellspacing="0" cellpadding="0" style='padding-bottom:5px;'>
        <tr >
            <td>
                {{-- <img src='{{asset('login_css/images/logo.png')}}' width='150px' > --}}
                    <p align='center' class='font-design'><span style='font-size:18px;padding-bottom:3px;' ><strong>ASSET INFORMATION FORM</strong></span></p>

                </p>
            </td>
        </tr>
    </table>

    <table class='font-design'  width="100%" border="0" cellspacing="0" cellpadding="5" style='padding-bottom:25px;font-size:14px;'>
        <tr >
            <td align='left' style='width:30%;'>
              Date
            </td>
            <td>: {{date('F d, Y')}}
            </td>
            <td rowspan='6' align='center'><h1><img style='border:1px solid black;' src='{{asset($inventory->image)}}' onerror="this.src='{{asset('login_css/images/logo.png')}}" width='150px' ></h1>
            </td>
        </tr>
        <tr >
            <td align='left' style='width:30%;'>
              Asset Type
            </td>
            <td>: {{$inventory->category->asset_type->name}}
            </td>

        </tr>
        <tr >
            <td align='left' style='width:30%;'>
              P.O. Number
            </td>
            <td>: {{ $inventory->po_number}}
            </td>
        </tr>
        <tr >
            <td align='left' style='width:30%;'>
              Category
            </td>
            <td>: {{$inventory->category->category_name}}
            </td>
        </tr>
        <tr >
            <td align='left' style='width:30%;'>
             Brand
            </td>
            <td>: {{$inventory->brand}}
            </td>
        </tr>
        <tr >
            <td align='left' style='width:30%;'>
              Model
            </td>
            <td>: {{$inventory->model}}
            </td>
        </tr>
         </tr>
        @if($inventory->category->asset_type->id != 2)
        <tr >
            <td align='left' style='width:30%;'>
              Serial Number
            </td>
            <td>: {{$inventory->serial_number}}
            </td>
        </tr>
        @else
        <tr >
            <td align='left' style='width:30%;'>
              Engine Number
            </td>
            <td>: {{$inventory->engine_number}}
            </td>
        </tr>
        <tr >
            <td align='left' style='width:30%;'>
              Chasis Number
            </td>
            <td>: {{$inventory->chasis_number}}
            </td>
        </tr>
        <tr >
            <td align='left' style='width:30%;'>
              Plate Number
            </td>
            <td>: {{$inventory->plate_number}}
            </td>
        </tr>
        @endif
        <tr >
            <td align='left' style='width:30%;'>
              Description
            </td>
            <td colspan='2'>: {!! nl2br(e($inventory->description)) !!}
            </td>
        </tr>
        <tr >
            <td align='left' style='width:30%;'>
              Supplier
            </td>
            <td>: {{$inventory->supplier}}
            </td>
        </tr>
        <tr >
            <td align='left' style='width:30%;'>
              Date Purchase
            </td>
            <td>: @if($inventory->date_purchase) {{date('F d, Y',strtotime($inventory->date_purchase))}}@endif
            </td>
        </tr>
        <tr >
            <td align='left' style='width:30%;'>
              Unit Price
            </td>
            <td>: Php {{number_format($inventory->amount,2)}}
            </td>
        </tr>
        <tr >
            <td align='left' style='width:30%;'>
              Status
            </td>
            <td>: {{$inventory->status}}
            </td>
        </tr>
    </table>

</body>
</html>
