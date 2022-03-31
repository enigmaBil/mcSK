@extends('layouts.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
        folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/skins/_all-skins.min.css')}}">
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/Ionicons/css/ionicons.min.css')}}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
    
    <style>
            .kv-avatar .krajee-default.file-preview-frame,.kv-avatar .krajee-default.file-preview-frame:hover {
                margin: 0;
                padding: 0;
                border: none;
                box-shadow: none;
                text-align: center;
            }
            .kv-avatar {
                display: inline-block;
            }
            .kv-avatar .file-input {
                display: table-cell;
                width: 213px;
            }
            .kv-reqd {
                color: red;
                font-family: monospace;
                font-weight: normal;
            }
            </style>
@endsection
@section('page_header')
    <section class="content-header">
        <h1>
          {{__('students')}}
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
          <li class="active">Here</li>
        </ol>
      </section>
@endsection

@section('create')
    @include('scolarity.student.create') 
@endsection
@section('nom')
   {{__('student')}}
@endsection
@section('nom2')
    {{__('studentList')}}
@endsection
@section('data')
<thead>
    <tr>
    <th>{{__('student')}}</th>
    <th> {{('choosen discipline')}}</th>
    <th>{{__('code')}}</th>
    <th>{{__('assurance')}}</th>
    <th>{{__('entrance diploma')}}</th>
    <th>{{__('entrance diploma year')}}</th>
    <th>Actions</th>

  
    </tr>
</thead>
    <tbody id ="tbody">
       
      @foreach ($students as $student)
        @if($student)
        
            <tr id="tr{{$student->id}}">
                <form id={{"frmEditstudent".$student->id}}>
                <td>
                        <ul class="nav navbar-nav">  
                            <li class="dropdown user user-menu">
                                <!-- Menu Toggle Button -->
                                <a  onclick="modal('editStudent', {{$student->id}},['last_name','first_name','sex','birth_place','birth_date','telephone','nationality','particular_disease'
                                        , 'tutor_name','tutor_address','student_residence','region_of_origin','student_email','assurance','present_diploma','previous_school','first_language',
                                        'chosen_discipline','professional_activity','marital_status','diploma_year_obtained','release_year_prev_school'
                                        ,'second_language','country_obtained_diploma','diploma_obtained','other_languages','relationship_with_teacher','tutor_town','tutor_professional_activity','tutor_phone_1','tutor_phone_2'
                                        ,'father_name','father_town','father_profession','father_address','father_phone_1','father_phone_2','mother_name','mother_town','mother_profession','mother_address','mother_phone_1','mother_phone_2','department_of_origin','chosen_discipline','code'])" class="dropdown-toggle" data-toggle="dropdown" style="cursor: pointer">
                                {{--  <img src="{{asset('storage/student/'.$student->photo)}}" class="user-image" alt="User Image"> --}}
                                    <span class="hidden-xs">{{$student->code}} : {{$student->first_name}}
                                        {{$student->last_name}}</span>
                                </a>

                            </li>
                        </ul>
                
                </td>
                <td  contenteditable="false" style="font-size: 16px">
                        <select name=""  disabled id={{"chosen_discipline".$student->id}}>
                                @foreach ($disciplines as $discipline )
                                <option @if($discipline->id==$student->chosen_discipline)selected @endif value="{{$discipline->id}}">{{$discipline->oneDepartment->name}} : {{$discipline->name}}</option>
                                @endforeach
                        
                        </select>
                </td>

                <td id ={{"code".$student->id}} contenteditable="false">{{$student->code}}</td>
                <td id ={{"assurance".$student->id}} contenteditable="false">
                
                    

                    @php
                    if ($student->assurance==1)
                        echo '<span class="glyphicon glyphicon-ok"></span>';
                    else {
                        echo '<i class="icon fa fa-close"></i>';
                    }
                    @endphp
                    
                    
                    </td>
                <td id ={{"present_diploma".$student->id}} contenteditable="false">{{$student->present_diploma}}</td>
                <td id ={{"diploma_year_obtained".$student->id}} contenteditable="false">{{$student->diploma_year_obtained}}</td>
               {{-- <td id ={{"diploma_average".$student->id}} contenteditable="false">{{$student->diploma_average}}</td> --}}
                <td>
                            <div class="form-group">
                            <a  onclick="edit(['chosen_discipline','code','present_diploma','assurance','diploma_year_obtained'],{{$student->id}})">
                                <i class="fa fa-fw fa-pencil"></i>
                            </a>
                                <a  onclick="validate(['chosen_discipline','code','present_diploma','assurance','diploma_year_obtained'],{{$student->id}}, 'Mise à jour effectuée avec succès')">
                                    <i class="icon fa fa-check"></i>
                                </a>
        
                            <a onclick="back({{$student->id}},
                                '{{$student->name}}',{{$student->scolarity}},{{$student->status}})">
                                <i class="icon fa fa-reply"></i>
                            </a>
                            
                            </div>
        
                    </td>

                </form>
            </tr>
        @endif
      @endforeach

    </tbody>
  
 @include('scolarity.student.personal')
@endsection


 @section('js')
@parent
    <script src="{{ asset('js/scolarity/student.js')}}"></script>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>
    <script src='https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/themes/fa/theme.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" type="text/javascript"></script>
   @if(count($students)>=1)
   <script>
        $(function(){
            $("#input-b1").fileinput({
                language: 'fr',
                theme: 'fa',
                uploadUrl: '/scolarity/studentPic/'+ {{$student->id}},
                uploadExtraData: function() {
                    return {
                        _token: "{{csrf_token() }}",
                    };
                },
                defaultPreviewContent: '<img src="{{asset('storage/student/'.$student->photo)}}" width="250px">',
                allowedFileExtensions: ['jpg', 'png', 'gif','jpeg'],
                overwriteInitial: false,
                'previewFileType':'any',
            });
        });
     
    </script>
 @endif

<script src="{{ asset('js/select2.min.js') }}"></script>
<script type="text/javascript">
    (function ($) {
        $('.select2').select2({
            allowClear: true,
            tags: true,
            tokenSeparators: [',', ';']
        });
    })(jQuery);
</script>
@endsection


