@extends('layouts.layout')
@section('css')
<link rel="stylesheet" href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
<link rel="stylesheet" href="{{ asset('css/profile.css')}}">
<style>
 .MarkLigne{
      background-color:papayawhip;
      border:1px solid #6495ed;
    }
    </style>
@endsection
@section('page_header')
    <section class="content-header">
        <h1>
          @yield('nom')
        </h1>
    </section>
@endsection
@section('main')
    <button  class="btn bg-green" onclick="return $('#create_new_').toggle(1000);">
        <span class="fa fa-plus"></span> {{__('new')}}
    </button> @yield('task_menu') 
    <div id="create_new_" style="display:none;"> 
      <br>
      @yield('create') 
    </div>
  <div class="alert " id="edit-error-bag">
      <ul id="edit-task-errors">
      </ul>
  </div>
  <div class="box box-info">
    <div class="box-header">
      <h3 class="box-title">          @yield('nom2')                </h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive">
      <table id="example1" class="table table-bordered table-striped">
        @yield('data')
      </table>
    </div>
            <!-- /.box-body -->
  </div>
          <!-- /.box -->
@endsection

@section('js')

<!-- jQuery 3 -->
<!-- Bootstrap 3.3.7 -->
<!-- DataTables -->
<script src="{{ asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('js/dataTable/jquery.dataTables.js') }}"></script>
<?php
$language = App::getLocale();
if($language == 'fr'){ ?>

<script src="{{ asset('js/dataTable/mob-dataTable.fr.js') }}"></script>
<?php }else{ ?>
<script src="{{ asset('js/dataTable/mob-dataTable.en.js') }}"></script>
<?php  }
?><!-- SlimScroll -->
<script src="{{ asset('adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{ asset('adminlte/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->

<!-- DataTables -->
<

<!-- page script -->
<script>
    $(function () {
      $('#example1').DataTable();
      $('#example2').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false
      })
    })
  </script>

  @endsection