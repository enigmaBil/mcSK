@extends('layouts.layout')


@section('css')
<link rel="stylesheet" href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
<link rel="stylesheet" href="{{ asset('css/profile.css')}}">
<style>
  .MarkLigne {
    background-color: papayawhip;
    border: 1px solid #6495ed;
  }
</style>
@endsection
@section('page_header')
<section class="content-header">
  <h1>
    {{__('classroom')}}
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> {{__('level')}}</a></li>
    <li class="active">{{__('here')}}</li>
  </ol </section> @endsection @section('main') @php $modalclass=false @endphp @foreach ($levelss as $levels ) @if($levels->display==1 )
  <br><br>
  <div class="box-body">
    <div class="box-header">
      <h2 class="box-title"> <b>{{('discipline')}}: {{$levels->name}}</b> </h2>
    </div>
    @if(isset($name))
      @php
      $modalclass=false
      @endphp
      <button class="btn bg-green createClass" id={{$levels->id}} onclick="return $('#create_new_').toggle(1000);">
        <span class="fa fa-plus"></span> {{__('new')}}
      </button> @yield('task_menu') <br>
      <div id="create_new_" style="display:none;">
        <br>
        @include('configuration.classroom.createClass')
      </div>
      @else
      @php
      $modalclass=true
      @endphp
      <button class="btn bg-green createClass" onclick="  createClass('{{$levels->id}}', {{$slices}} )">
        <span class="fa fa-plus"></span> {{__('new')}}
      </button> @yield('task_menu') <br>
    @endif
    <br>
    @if( $levels->level_studies!=null)
      <div id={{"rootdiscipline".$levels->id}}>
        @foreach ($levels->level_studies as $level)
          @if ($level->pivot->display==1)
            <div class="box box-primary collapsed-box" id={{"class".$level->pivot->id}} style="margin-buttom:5px">
              <div class="box-header with-border"> {{__('level')}} {{$level->name}}
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                  </button>
                  <div class="btn-group">
                    <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                  </div>
                </div>
              </div>
              <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>{{__('education amount')}}</th>
                      <th>{{__('inscription amount')}}</th>
                      <th>{{__('discipline')}}</th>
                      <th>{{__('actions')}}</th>
                    </tr>
                  </thead>
                  <tbody>

                    <tr>

                      <td id="{{"education".$level->pivot->id}}" contenteditable="false">
                        {{$level->pivot->education_amount}}
                        <a href="{{ route('class_slice.indexAmount',$level->pivot->id) }}">
                          <i class="icon fa fa-forward"></i>
                        </a>

                      </td>
                      <td id="{{"inscription".$level->pivot->id}}" contenteditable="false">
                        <div> {{$level->pivot->inscription_amount}}</div>

                      </td>
                      <td>
                        <select class="form-control select2" disabled name="role" id={{"discipline".$level->pivot->id}}>
                          @foreach ($disciplines as $discipline )
                            <option value={{$discipline->id}} @if($discipline->id ==$level->pivot->discipline_id) selected @endif> {{$discipline->name}} </option>
                          @endforeach
                        </select>
                      </td>

                      <td>
                        <div class="form-group">
                          <a onclick="editClass({{$level->pivot->id}})">
                            <i class="fa fa-fw fa-pencil"></i>
                          </a>
                          <a onclick="validateClass({{$level->pivot->id}},{{$levels->id}},{{count($levelss)}})">
                            <i class="icon fa fa-check"></i>
                          </a>
                          <a onclick="backClass({{$level->pivot->id}},{{$levels->id}},{{count($levelss)}},{{$level->pivot->education_amount}},{{$level->pivot->inscription_amount}})">
                            <i class="icon fa fa-reply"></i>
                          </a>
                          <a onclick="destroy('class',{{$level->pivot->id}})">
                            <i class="icon fa fa-trash"></i>
                          </a>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <h3 class="box-title">{{__('modules')}}
                  <a onclick="addModule({{$level->pivot->id}})">
                    <i class="fa fa-fw fa-plus"></i>
                  </a>
                </h3>
                <div id={{"classroom".$level->pivot->id}}>
                  @foreach ( $level->pivot->modules as $module )
                  @if($module->display==1)
                  <div id={{"module".$module->id}}>
                    <div class="box  collapsed-box">
                      <div class="box-header ">
                        <b> {{$module->name}}</b>
                        @php
                        $classroom =$module->classroom->id;
                        @endphp
                        <a onclick="editModule({{$module->id}},{{$classroom}}); ">
                          <i class="fa fa-fw fa-pencil"></i>
                        </a>
                        <a onclick="destroy('module',{{$module->id}})">
                          <i class="fa fa-fw fa-trash"></i>
                        </a>
                        <a onclick="addCourseModal({{$module->id}}, {{$classroom}})"> cours
                          <i class="fa fa-fw fa-plus"></i>
                        </a>

                        <div class="box-tools pull-right">
                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                          </button>
                        </div>

                        <!-- /.box-tools -->
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                        <table class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th>{{__('name')}}</th>
                              <th>{{__('Session')}}</th>
                              <th>{{__('teacher')}}</th>
                              <th>{{__('amount hours')}}</th>
                              <th>{{__('coefficient')}}</th>
                              <th>{{__('status')}}</th>
                            <th>{{__('configure sequences')}}</th>
                              <th>{{__('actions')}}</th>

                            </tr>
                          </thead>
                          <tbody id={{"addCourse".$module->id}}>
                            @foreach ($module->courses->where('display', 1) as $course )
                            <tr id="{{"tr".$course->id}}">
                              <td id="{{"name".$course->id}}" contenteditable="false">
                                {{$course->name}}
                              </td>
                              <td id={{"sess".$course->id}} contenteditable="false">
                                <select class="form-control select2" id={{"session".$course->id}} disabled>
                                  @foreach ($sessions->where('display', 1) as $item)

                                  <option value="{{$item->id}}" @if ($item->id==$course->session_id) selected @endif >{{$item->name}}</option>
                                  @endforeach
                                </select>
                              </td>

                              <td contenteditable="false">


                                <select class="form-control select2" id={{"teacher".$course->id}} disabled>
                                  @foreach ($teachers as $item)

                                  <option value="{{$item->id}}" @if ($item->id==$course->oneteacher->id) selected @endif >{{$item->name}}</option>
                                  @endforeach
                                </select>

                              </td>
                              <td id="{{"amount_hour".$course->id}}" contenteditable="false">

                                {{$course->amount_hour}}
                              </td>
                              <td id="{{"coefficient".$course->id}}" contenteditable="false">

                                {{$course->coefficient}}
                              </td>

                              <td contenteditable="false">
                                <a id={{"Coursestatus".$course->id}}>

                                  @php

                                  if($course->status ==0){
                                  echo("<i class='icon fa fa-eye-slash'></i>");
                                  }
                                  else {
                                  echo("<i class='icon fa fa-eye'></i>");
                                  }


                                  @endphp
                                </a>
                              </td>
                              <td id={{"ses".$course->id}} contenteditable="false">
                                  <a href="#" onclick="loadcourse_sequence({{$course->id}})">: ) {{("configure percentages")}}</a>
                                  
                                  </td>
                              <td>
                                <div class="form-group">
                                  <a onclick="editCourse({{$course->id}})">
                                    <i class="fa fa-fw fa-pencil"></i>
                                  </a>
                                  <a onclick="validateCourse({{$course->id}},{{$module->id}})">
                                    <i class="icon fa fa-check"></i>
                                  </a>
                                  <a onclick="backCourse( '{{$course->id}}', '{{$course->name}}', '{{$course->amount_hour}}', '{{$course->coefficient}}', '{{$course->session_id}}', '{{$course->status}}',
                                                        '{{$course->oneteacher->id}}', '{{$course->oneModule->id}} ')">
                                    <i class="icon fa fa-reply"></i>
                                  </a>
                                  <a onclick="destroyCourse({{$course->id}})">
                                    <i class="icon fa fa-trash"></i>
                                  </a>
                                </div>

                              </td>
                            </tr>
                            @endforeach


                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  @endif
                  @endforeach
                </div>
              </div>


              <!-- /.box-body -->
            </div>
          @endif
        @endforeach
      </div>
    @endif

  </div>
  @endif
  @endforeach
  @endsection
  @include('configuration.classroom.createCourse')
  @include('configuration.classroom.createModule')
  @include('configuration.classroom.editModule')
  @if($modalclass)
  @include('configuration.classroom.create')

  @endif
  @include('configuration.course.course_sequence')

  @section('js')
  <script src="{{  asset('/js/jquery.min.js?v='.time())}}"></script>
  <script src="{{  asset('/js/bootstrap2.min.js')}}"></script>
  <script src="{{  asset('/js/configuration/classroom.js?v='.time())}}"></script>
  <script src="{{  asset('/js/configuration/destroy.js?v='.time())}}"></script>
  @parent
  <!-- jQuery 3 -->
  <!-- Bootstrap 3.3.7 -->
  <!-- DataTables -->
  <script src="{{ asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{ asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
  <!-- SlimScroll -->
  <script src="{{ asset('adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
  <!-- FastClick -->
  <script src="{{ asset('adminlte/bower_components/fastclick/lib/fastclick.js')}}"></script>
  <!-- AdminLTE App -->

  <!-- DataTables -->
  < <!-- page script -->
    <script>
      $(function() {
        $('#example1').DataTable()
        $('#example2').DataTable({
          'paging': true,
          'lengthChange': false,
          'searching': false,
          'ordering': true,
          'info': true,
          'autoWidth': false
        })
      })
    </script>
    <script>
     function configure(id){
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('')
                }
            });
            $.ajax({
                type: 'GET',
                url: '/mark/course_sequence/course/'+id,
                data: {
                },
                dataType: 'json',
                success: function(data) {
                },
                error: function(data) {
                    var errors = $.parseJSON(data.responseText);
                    
                    $.each(errors.messages, function(key, value) {
                        toastada.error(value+"");
                    });
                }
            });
    }
    </script>

    @endsection