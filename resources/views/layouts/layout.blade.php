<!DOCTYPE html>
<html lang="en" id="mcskool">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="shortcut icon" href="{{asset('adminlte/images/favicon.png')}}" type="image/x-icon"/>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- script for  loading-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<!-- end  of script for  loading-->


<title>MC SKool  | Prenez en main la gestion de votre établisement scolaire</title>
  <style>
    .MarkLigne{
      background-color:papayawhip;
      font-size: 1.5em;
    }
    
  .required{
    color: brown;
  }



/**css for loading**/

.centered{
	width:400px;
	height:400px;
	position:absolute;
	top:50%;
	left:50%;
	transform:translate(-50%,-50%);
	/***background:#000;*/
	filter: blur(10px) contrast(20);
}
.blob-1,.blob-2{
	width:70px;
	height:70px;
	position:absolute;
	background:#fff;
	border-radius:50%;
	top:50%;left:50%;
	transform:translate(-50%,-50%);
}
.blob-1{
	left:20%;
	animation:osc-l 2.5s ease infinite;
}
.blob-2{
	left:80%;
	animation:osc-r 2.5s ease infinite;
	background:#0ff;
}
@keyframes osc-l{
	0%{left:20%;}
	50%{left:50%;}
	100%{left:20%;}
}
@keyframes osc-r{
	0%{left:80%;}
	50%{left:50%;}
	100%{left:80%;}
}
/*******end of css for loading*/
  </style>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" type="image/png" href="{{ mob_asset('images/favicon-mobility-cloud.png') }}"/>
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/Ionicons/css/ionicons.min.css')}}">
   <!-- Select2 -->
   <link rel="stylesheet" href="{{asset('adminlte/bower_components/select2/dist/css/select2.min.css')}}">
   <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{asset('adminlte/plugins/iCheck/all.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('adminlte/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')}}">
  <!-- Toast style -->
  <link rel="stylesheet" href="{{ asset('toast/index.css')}}">

  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/skins/skin-blue.min.css')}}">
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/skins/_all-skins.min.css')}}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
  href="{{asset('css/css.css')}}">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="stylesheet" href="{{ asset('css/skool.css')}}">

        @yield('css')

</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                  adm           |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->

    
      <!-- Main Header -->
<body class="hold-transition skin-blue-light sidebar-mini">
<div class="wrapper">
      @include('layouts.navbar')
  <!-- Left side column. contains the logo and sidebar -->

  <aside class="main-sidebar">
    @include('layouts.menu')
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="overflow-x: hidden;">
    <!-- Content Header (Page header) -->

    @yield('page_header')


    <!-- Main content -->
    <section class="content container-fluid" style="overflow-x: hidden;">
      <div id="loader"></div>

      @yield('main')

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      {{__('We are working every day to give you the best solutions for your software problems')}}
    </div>
    <!-- Default to the left -->
    <strong>&copy;  2020 <a href="#">Mobility Cloud</a>.</strong> {{__('All Rights reserved')}} .
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-home-tab">

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">{{__('Stats Tab Content')}}</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">{{__('General Settings')}}</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              {{__('Report panel usage')}}
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              {{__('Some information about this general settings option')}}
            </p>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="{{ asset('adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{ asset('adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{ asset('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('adminlte/bower_components/fastclick/lib/fastclick.js')}}"></script>
<script src="{{ asset('adminlte/dist/js/adminlte.min.js')}}"></script>
<script src="{{ asset('adminlte/dist/js/demo.js')}}"></script>
<script src="{{ asset('toast/index.js')}}"></script> 
<script src="{{ asset('toast/script.js')}}"></script>
<script src="{{ asset('toast/generalToast.js')}}"></script>

<script src="{{ asset('adminlte/dist/js/pages/dashboard2.js')}}"></script>
<script src="{{ asset('adminlte/dist/js/pages/dashboard.js')}}"></script>


<!-- AdminLTE App -->
<!-- FastClick -->

<!-- Toast  -->

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
     @yield('js')
</body>
</html>