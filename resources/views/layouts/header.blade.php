<!DOCTYPE html>
<html lang="en">

<!-- index.html  21 Nov 2019 03:44:50 GMT -->
<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Asset Inventory Monitoring System</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('assets/css/app.min.css') }}">
  <link rel="shortcut icon" href="{{asset('images/wgroup.png')}}">
  <!-- Template CSS -->

  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

  <link rel="stylesheet" href="{{asset('assets/bundles/select2/dist/css/select2.min.css')}}"> 
  <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
  <!-- <link rel="stylesheet" href="{{ asset('login_css/css/style-new.css') }}"> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>

  <!-- Custom style CSS -->
  
  <script src="{{ asset('qrcode/dist/easy.qrcode.min.js') }}" type="text/javascript" charset="utf-8"></script>

  <style type="text/css">
    #header{
      text-align: left;
      margin: 0;
      line-height: 80px;
      background-color: #007bff;
      color: #fff;
      padding-left: 20px;
      font-size: 36px;
    }
    #header a{color: #FFFF00;}
    #header a:hover{color: #FF9933;}
    #container {
      width: 1030px;
      margin: 10px auto;
    }

    .imgblock {
      margin: 10px 0;
      text-align: center;
      float: left;
      min-height: 420px;
    }
    .zoom:hover {
      transform: scale(1.5); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
    }
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    .pointer {cursor: pointer;}
    
    /* Firefox */
    input[type=number] {
        -moz-appearance:textfield;
    }
    .loader {
      position: fixed;
      left: 0px;
      top: 0px;
      width: 100%;
      height: 100%;
      z-index: 9999;
      background: url("{{ asset('/images/loading.gif')}}") 50% 50% no-repeat rgb(249,249,249) ;
      opacity: .8;
      background-size:120px 120px;
    }
    .btn-save {
      text-transform: uppercase;
      transition: 0.5s;
      width: 100px;
      background-size: 200% auto;
      color: white;
      box-shadow: 0px 0px 14px -7px #1737b2;
      background-image: linear-gradient(45deg, #0b2daf 0%, #1737b2  51%, #3c64ff  100%);
    }
    .btn-print {
      text-transform: uppercase;
      transition: 0.5s;
      width: 100px;
      background-size: 200% auto;
      color: white;
      box-shadow: 0px 0px 14px -7px #f94238;
      background-image: linear-gradient(45deg, #dc3545 0%, #dd6c66 51%, #f94238 100%);
    }
    .btn-new {
      text-transform: uppercase;
      transition: 0.5s;
      width: 100px;
      background-size: 200% auto;
      color: white;
      box-shadow: 0px 0px 14px -7px #41c457;
      background-image: linear-gradient(45deg, #3fdb63 0%, #28a745 51%, #28c76f 100%);
    }
    .btn-default {
      text-transform: uppercase;
      transition: 0.5s;
      width: 100px;
      background-size: 200% auto;
      color: #FFF;
      box-shadow: 0px 0px 14px -7px #e7e7e7;
      background-image: linear-gradient(45deg, #808180 0%, #b1b1b1 51%, #979797 100%);
    }
    .btn-default:hover {
      background-position: right center;
      /* change the direction of the change here */
      color: #fff;
      text-decoration: none;
    }
    .btn-default:active {
      transform: scale(0.95);
    }
    .btn-new:hover {
      background-position: right center;
      /* change the direction of the change here */
      color: #fff;
      text-decoration: none;
    }
    .btn-print:hover {
      background-position: right center;
      /* change the direction of the change here */
      color: #fff;
      text-decoration: none;
    }
    .btn-save:hover {
      background-position: right center;
      /* change the direction of the change here */
      color: #fff;
      text-decoration: none;
    }
    .btn-print:active {
      transform: scale(0.95);
    }
    .btn-save:active {
      transform: scale(0.95);
    }
    .btn-new:active {
      transform: scale(0.95);
    }
    .form-label {
      font-weight: 700;
    }
    @media (min-width: 768px) {
      .modal-xl {
        width: 100%;
        max-width:1700px;
      }
    }
    #employees-table_filter
    {
      text-align: right;
    }
    #employees-table_filter label
    {
      text-align: left;
    }
    #transaction-table_filter
    {
      text-align: right;
    }
    #transaction-table_filter label
    {
      text-align: left;
    }
    #accountability-table_filter
    {
      text-align: right;
    }
    #accountability-table_filter label
    {
      text-align: left;
    }
    .dataTables_paginate
    {
      float: right !important;
    }
    .dataTables_empty {
      text-align: center;
    }
    .dataTables_info {
      position: absolute;
      margin-top: 10px;
    }
    .modal-header {
      background-color: #007bff;
      color: #FFF;
    }
    .sidebar-mini .main-sidebar .sidebar-brand a .header-logo  {
      height: 35px;
    }
</style>
</head>

<body>
  <div id="myDiv" class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar sticky d-flex justify-content-between">
        <div class="form-inline ">
          <ul class="navbar-nav mr-3">
            <li>
                <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg collapse-btn"> <i data-feather="align-justify"></i></a>
            </li>
          </ul>
        </div>
        <div style="letter-spacing: 3px;margin-top: 10px">
            <h3>ASSET INVENTORY MONITORING SYSTEM</h3>
        </div>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user"> 
            <img alt="image" src="{{'images/no_image.png'}}"> <span class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
              <div class="dropdown-title">Hello {{auth()->user()->name}}</div>
              {{-- <a href="profile.html" class="dropdown-item has-icon"> <i class="far
										fa-user"></i> Profile
              </a>  --}}
              <div class="dropdown-divider"></div>
              <a href="{{ route('logout') }}"  onclick="logout(); show();" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
                Logout
              </a>
              <form id="logout-form"  action="{{ route('logout') }}"  method="POST" style="display: none;">
                {{ csrf_field() }}
              </form>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand p-2">
            <a href="{{url('/')}}"> <img alt="image" src="{{asset('images/wgroup.png')}}" class="header-logo" /></a>
            <br>
            <h5 class="logo-name pt-2" >Welcome {{ (explode(" ", auth()->user()->name))[0] }}</h5>
          </div>
            <ul class="sidebar-menu">
              <li class="menu-header">Transactions</li>
              <li class="dropdown  @if($header == "Dashboard") active @endif">
                <a href="{{ url('/') }}" class="nav-link" onclick='show();'><i data-feather="monitor"></i><span>Dashboard</span></a>
              </li>
              <li class="dropdown  @if($header == "Available Assets") active @endif">
                <a href="{{ url('/available-assets') }}" class="nav-link" onclick='show();'><i data-feather="check-square"></i><span>Available Assets</span></a>
              </li>
              <li class="dropdown  @if($header == "Accountabilities") active @endif">
                <a href="{{ url('/accountabilities') }}" class="nav-link" onclick='show();'><i data-feather="user-check"></i><span>Accountabilities</span></a>
              </li>
              <li class="dropdown  @if($header == "Transactions") active @endif">
                <a href="{{ url('/transactions') }}" class="nav-link" onclick='show();'><i data-feather="file-text"></i><span>Transactions</span></a>
              </li> 
              <li class="dropdown  @if($header == "Returns") active @endif">
                <a href="{{ url('/returns') }}" class="nav-link" onclick='show();'><i data-feather="corner-down-left"></i><span>Return Items</span></a>
              </li> 
              <li class="menu-header">Settings</li>
              <li class="dropdown @if($header == "Category") active @endif">
                <a href="{{ url('/category') }}" class="nav-link" onclick='show();'><i data-feather="list"></i><span>Categories</span></a>
              </li>
              <li class="dropdown @if($header == "Departments") active @endif">
                <a href="{{ url('/departments') }}" class="nav-link" onclick='show();'><i data-feather="grid"></i><span>Departments</span></a>
              </li>
              <li class="dropdown @if($header == "Employees") active @endif">
                <a href="{{ url('/employees') }}" class="nav-link" onclick='show();'><i data-feather="users"></i><span>Employees</span></a>
              </li>
              <li class="dropdown @if($header == "Users") active @endif">
                <a href="{{ url('/users') }}" class="nav-link" onclick='show();'><i data-feather="user-plus"></i><span>Users</span></a>
              </li>
              <li class="dropdown @if($header == "Assets") active @endif">
                <a href="{{ url('/assets-inventory') }}" class="nav-link" onclick='show();'><i data-feather="hard-drive"></i><span>Assets</span></a>
              </li>
              <li class="dropdown @if($header == "Reports") active @endif">
                <a href="{{ url('/reports') }}" class="nav-link" onclick='show();'><i data-feather="file-text"></i><span>Report</span></a>
              </li>
              <li class="dropdown @if($header == "Physical Inventory") active @endif">
                <a href="{{ url('/physical-inventory') }}" class="nav-link" onclick='show();'><i data-feather="upload"></i><span>Physical Inventory</span></a>
              </li>
            </ul>
        </aside>
      </div>
      <!-- Main Content -->
      @yield('content')
      <footer class="main-footer">
        <div class="footer-left">
            
        </div>
        <div class="footer-right">
            <small>Copyright &copy; {{date('Y')}}</small> W Group Inc.
        </div>
      </footer> 
    </div>
  </div>
  @yield('footer')
  <script type='text/javascript'>
    function show()
    {
        document.getElementById("myDiv").style.display="block";
    }
    function logout()
    {
        event.preventDefault();
        document.getElementById('logout-form').submit();
    }
</script>
  <!-- General JS Scripts -->

  <script src="{{ asset('assets/js/scripts.js') }}"></script>
  <!-- Custom JS File -->
  <script src="{{ asset('assets/js/custom.js') }}"></script>

  <script src="{{ asset('assets/bundles/select2/dist/js/select2.full.min.js') }}"></script>
  <!-- JS Libraies -->
  <script src="{{ asset('assets/bundles/datatables/datatables.min.js') }}"></script>

  <script src="{{ asset('assets/bundles/jquery-ui/jquery-ui.min.js') }}"></script>
  
  <script src="{{ asset('assets/bundles/sweetalert/sweetalert.min.js') }}"></script>
  <!-- Page Specific JS File -->
  <script src="{{ asset('assets/js/page/sweetalert.js') }}"></script>
  <!-- Page Specific JS File -->
  <script src="{{ asset('assets/js/page/datatables.js') }}"></script>
  <script  type="text/javascript">

    function department(data)
    {
      alert(data.checked);
        $('#departmentd').empty();
        if(data.checked == true)
        {
        
        }
    }
  </script>

  <script> 

    $(".deactivate-category").click(function () {
      var id = $(this).parent("td").data('id');
      swal({
        title: 'Are you sure you want to deactivate this?',
        // text: 'Once deleted, you will not be able to recover this imaginary file!',
        icon: 'warning',
        buttons: true,
        dangerMode: true,
      })
        .then((willDelete) => {
          if (willDelete) {
            $.ajax({
                dataType: 'json',
                type:'POST',
                url:  'deactivate-category',
                data:{id:id},
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            }).done(function(data){
                // console.log(data);
                swal('Category has been deactivated.', {  
                  icon: 'success',
                });
            });
          
          } 
        });
    });
    $(".activate-category").click(function () {
      var id = $(this).parent("td").data('id');
      swal({
        title: 'Are you sure you want to activate this?',
        // text: 'Once deleted, you will not be able to recover this imaginary file!',
        icon: 'warning',
        buttons: true,
        dangerMode: true,
      })
        .then((willDelete) => {
          if (willDelete) {
            $.ajax({
                dataType: 'json',
                type:'POST',
                url:  'activate-category',
                data:{id:id},
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            }).done(function(data){
                // console.log(data);
                swal('Category has been activated.', {  
                  icon: 'success',
                });
            });
          
          } 
        });
    });
  
  </script>
  @include('sweetalert::alert')
</body>


<!-- index.html  21 Nov 2019 03:47:04 GMT -->
</html>