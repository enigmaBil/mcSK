@extends('layouts.index')

@section('css')
<link rel="stylesheet" href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.min.css')}}">
<link rel="stylesheet" href="{{ asset('adminlte/dist/css/skins/_all-skins.min.css')}}">
<link rel="stylesheet" href="{{ asset('adminlte/bower_components/Ionicons/css/ionicons.min.css')}}">


@endsection
@section('page_header')
<section class="content-header">
    <h1>
        {{__('relévés de note')}}
    </h1>
</section>
@endsection

@section('main')
<div class="row">
        <div class="col-md-3">
                <div class="input-group">
                    <div class="input-group-addon">
                        <label>{{__('academic_year')}} </label>
                    </div>
                    <select id="academic_year" onchange="getStudentByAcademicYear()" class="form-control select2">
                        @foreach ($academic_years as $academic_year )
                        <option value="{{$academic_year->id}}">{{$academic_year->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
    <div class="col-md-3">
        <div class="input-group">
            <div class="input-group-addon">
                <label>{{__('department')}} </label>
            </div>
            <select id="department" class="form-control select2" onchange="return departmentDiscipline()">
                <option value="0"></option>
                @foreach ($departments as $department )
                <option value="{{$department->id}}">{{$department->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="input-group">
            <div class="input-group-addon">
                <label>{{__('discipline')}} </label>
            </div>
            <select id="discipline" class="form-control select2" onchange="return disciplineLevel()">
                <option value="0"></option>
                @foreach ($disciplines as $discipline )
                <option value="{{$discipline->id}}">{{$discipline->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="input-group">
            <div class="input-group-addon">
                <label>{{__('level')}} </label>
            </div>
            <select id="level" onchange="getStudentByLevel()" class="form-control select2">
                <option value="0"></option>
                @foreach ($levels as $level )
                <option value="{{$level->id}}">{{$level->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div> <br>
<div class="box box-info">
    <div class="box-header">
        {{__('studentList')}}
    </div>
    <div id="data" class="box-body table-responsive">
        <table id="example2" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>{{__('student')}}</th>
                    <th>{{__('status')}}</th>
                    <th>{{__('discipline')}}</th>
                    <th>{{__('level')}}</th>
                    <th>{{__('inscriptionDate')}}</th>
                    <th>{{__('report_card')}}</th>
                </tr>
            </thead>
            
            <tbody id='tbody'>
                @foreach ($inscriptions as $inscription)

                <tr id={{"tr".$inscription->id}}>

                    <form id={{"frmEditinscription".$inscription->id}}>
                        <td contenteditable="false">{{$inscription->id}}</td>
                        <td>
                            {{$inscription->oneStudent->code}} : {{$inscription->oneStudent->first_name}}
                            {{$inscription->oneStudent->last_name}}
                        </td>
                        <td class="validable">
                            @php
                            if ($inscription->status==1)
                            echo '<span class="glyphicon glyphicon-ok"></span>';
                            else {
                            echo '<i onclick="validate('.$inscription->id.')" class=" icon fa fa-close"></i>';
                            }
                            @endphp


                        </td>
                        <td contenteditable="false">{{$inscription->oneClass->oneDiscipline->name}}</td>
                        <td contenteditable="false">{{$inscription->oneClass->oneLevel->name}}</td>

                        <td>{{$inscription->creation_date}}</td>
                        <td>
                            <a href="{{ route('report_card.reportcard',$inscription->id) }}" title="{{__('goto_report_card')}}">
                                <i class="fa fa-mail-forward "></i>
                            </a>
                        </td>

                    </form>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection



@section('js')
@parent
<script src="{{ asset('js/mark/filtres.js?v='.time())}}"></script>

@endsection