@extends('layouts.layout')

@section('css')
<link rel="stylesheet" href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
<link rel="stylesheet" href="{{ asset('css/profile.css')}}">

@endsection

@section('header')
<h3 class="box-title"> {{__('manage notes')}} </h3>

@if(isset($department))
    
<div slass="row">
  <div class="col-md-4">
    <div class="input-group">
            <div class="input-group-addon">
                <label>{{__('department')}} </label>
            </div>
          <div id="department"> {{$department}}</div>
        </div> 
  </div>
  <div class="col-md-4">
    <div class="input-group">
            <div class="input-group-addon">
                <label>{{__('discipline')}} </label>
            </div>
          <div id="discipline">{{$discipline}}</div>
        </div> 
  </div>
  <div class="col-md-4">
    <div class="input-group">
            <div class="input-group-addon">
                <label>{{__('level')}} </label>
            </div>
          <div id="level">{{$level}}</div>
        </div> 
  </div>
  <div class="col-md-4">
    <div class="input-group">
            <div class="input-group-addon">
                <label>{{__('module')}} </label>
            </div>
          <div id="module">{{$module}}</div>
        </div> 
  </div>
  </div> <br>
  <div class="box box-info">
  <div class="box-header">
  {{__('studentList')}}
  </div>
</div>
@endif
<br>

@endsection
@section('main')
<div class="alert " id="edit-error-bag">
  <ul id="edit-task-errors">
  </ul>
</div>
<div class="box box-info">
  <div class="box-header">
    <div class="row">

      <div class="col-md-4">
        <div class="input-group">
                <div class="input-group-addon">
                    <label for="course">{{__('Choose the academic year')}} </label>
                </div>
              <select id="academic_year" class="form-control select2"  onchange="reload()" >
                  <option value=""></option>
                      @foreach ($academic_years as $a_year )
                      <option value="{{$a_year->id}}"><b>{{__('academic year:')}}</b> {{$a_year->name}}</option>                      @endforeach
              </select>
            </div> 
      </div>
      <div class="col-md-4">
        <div class="input-group">
                <div class="input-group-addon">
                    <label for="course">{{__('Choose the course')}} </label>
                </div>
              <select id="course" class="form-control select2"  onchange="reload()" >
                  <option value=""></option>
                      @foreach ($courses as $course )
                      <option value="{{$course->id}}"><b>{{__('discipline:')}}</b> {{$course->oneModule->classroom->oneDiscipline->name}} <b>{{__('level:')}}</b> {{$course->oneModule->classroom->oneLevel->name}} <b>{{__('cours:')}}</b>{{$course->name}}</option>
                      @endforeach
              </select>
            </div> 
      </div>
      <div class="col-md-4">
        <div class="text-center">
           
              <a  id="reloader" onclick="reload()"> <i  style="font-size:24px" class="glyphicon glyphicon-repeat"></i></a>
            </div> 
      </div>
    </div>
  </div>
<!-- /.box-header -->
<div id="all_notes" >
</div>
</div>

@endsection

@section('js')
 @parent
 <script src="{{ asset('js/mark/mark.js?v='.time())}}"></script>

<script src="{{ asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{ asset('adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{ asset('adminlte/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->

<!-- DataTables -->
<

<!-- page script -->
<script>
    $(function () {
      $('#example1').DataTable()
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
 <script src="{{ asset('/js/configuration/department.js?v=',time())}}"></script> 
  
@endsection