@extends('layouts.layout')

@section('css')
<link rel="stylesheet" href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
<link rel="stylesheet" href="{{ asset('css/profile.css')}}">

@endsection

@section('header')
<div class="form-group">
    <label>{{__('choose a module')}}</label>
    <select name="" id="classe" onchange="loadcourse()">
        @foreach ($classes as $classe)
        <option value="{{$classe->id}}">
            {{$classe->name}}
        </option>
        @endforeach
    </select>
@endsection

@section('main')
<div class="alert " id="edit-error-bag">
  <ul id="edit-task-errors">
  </ul>
</div>
<div class="box box-info">
  <div class="box-header">
    <h3 class="box-title"> Les notes de mon cour particulier pour le moment  et pour l'année académique donc le bilan générale             </h3>
  </div>
<!-- /.box-header -->
  <div class="box-body table-responsive">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th rowspan="2">{{__('students')}}</th>
            @foreach ($academic_year->sessions as $session )
            <th colspan="{{count($session->session->sequences)+1}}"> {{$session->session->name}}</th>
            @endforeach
          
            <th rowspan="2"><a href="http://"> <i class="fa fa-check"></i></a>{{('general')}} {{__('avg')}}</th>
          <th>{{('actions')}}</th>
          </tr>
          <tr>
            @foreach ( $academic_year->sessions as $session)
            @foreach ($session->session->sequences as $sequence )
            <td><b>{{$sequence->name}} </b></td>
            
            @endforeach
            <th>{{__('avg')}}</th>

            @endforeach
              
              <td>
                  <div class="form-group">
                      <a title={{__("edit")}} onclick="edit()">
                        <i class="fa fa-fw fa-pencil"></i>
                      </a>
                        <a title={{__("save")}} onclick="validate(1,{{$classes[0]->id}})">
                            <i class="icon fa fa-check"></i>
                          </a>
                  </div>
              </td>
          </tr> 
      </thead>
      <tbody id="tbody">
        <script>students=[];</script>
        @foreach ($classes[0]->students as $student )
        <tr id={{"".$student->id}}>
          <script>students.push( <?php echo $student->id ?>)</script>
        <td>{{$student->code."nom :".$student->first_name}}</td>
            @foreach ( $academic_year->sessions as $session)
                  @php
                  $moy=0;
                  @endphp
                @foreach ($session->session->sequences as $sequence )
          <td id={{"std: ".$student->id."sess: ".$session->id."seq: ".$sequence->id}} class="editable" student_id={{"".$student->id}} course_id="1" session_id={{"".$session->id}} sequence_id={{"".$sequence->id}}>
                    @if ($markRepository->getcurrentnote_student_course($student->id,1,$session->id,$sequence->id)->isEmpty())
                    0
                    @else
                    {{$markRepository->getcurrentnote_student_course($student->id,1,$session->id,$sequence->id)[0]->note}}
                    @endif
                   </td>
                    
                
                @endforeach
                <td>sessmoy</td>
            @endforeach
            <td>gmoyennes</td>
        </tr> 
        @endforeach
              
      </tbody>
    </table>
  </div>
        <!-- /.box-body -->
</div>

@endsection
@section('js')
 @parent
 <script src="{{ asset('js/mark/mark.js')}}"></script>

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
  
@endsection