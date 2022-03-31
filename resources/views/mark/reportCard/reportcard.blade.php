@extends('layouts.index')

@section('css')
<link rel="stylesheet" href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.min.css')}}">
<link rel="stylesheet" href="{{ asset('adminlte/dist/css/skins/_all-skins.min.css')}}">
<link rel="stylesheet" href="{{ asset('adminlte/bower_components/Ionicons/css/ionicons.min.css')}}">

<style type="text/css">
    
</style>
@endsection
@section('page_header')
<section class="content-header">
    <h1>
        {{__('relévés de note')}}
    </h1>
    <a href="{{route('reportCard.printpdf',$studentId)}}">Print</a>
</section>
@endsection

@section('main')
<div class="box box-info">
    <div class="box-header">
        {{__('studentList')}}
    </div>
    <div class="box-body table-responsive">
        <style type="text/css">
            td {
              border: 1px solid #726E6D;
              padding: 5px;
            }

            thead{
              font-weight:bold;
              text-align:center;
              background: #625D5D;
              color:white;
            }

            table {
              border-collapse: collapse;
              width: 100%;
            }

            .footer {
              text-align:right;
              font-weight:bold;
            }

            tbody >tr:nth-child(odd) {
              background: #D1D0CE;
            }
        </style>
        
        @foreach ($modules as $module)
            <table>
                <thead>
                    <tr>
                        <td>{{__('course')}}</td>
                        <td>{{__('coefficient')}} </td>
                        @foreach ($sequences as $sequence )
                            <td>{{$sequence->name}}</td>
                        @endforeach
                        <td>Total</td>
                        <td>Note/20</td>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $coefs=0;
                    $points= 0;
                    @endphp
                    @foreach ($module->courses as $course)
                        <tr>
                            <td>
                                {{$course->name}} /
                                {{$course->oneTeacher->name}}
                            </td>
                            <td>{{$course->coefficient}}
                                @php
                                $coefs+= $course->coefficient;
                                @endphp
                            </td>
                            @php
                            $moyenne=0;
                            @endphp
                            @foreach ($notes as $note)
                                {{$flag=0}}
                                @if($note->course_id==$course->id)
                                    @php

                                        $flag=1;
                                        foreach($note->oneCourse->sequences as $sequence) {
                                            if($note->sequence_id==$sequence->id){
                                                $moyenne+=($note->note * $sequence->pivot->percentage)/100;
                                            }
                                        }
                                    @endphp
                                    <td>
                                        {{$note->note}}
                                    </td>
                                @endif
                                @if ($flag==0)
                                <td>Joe</td>
                                @endif
                            @endforeach
                            <td>
                                @php
                                $points+= $course->coefficient*$moyenne ;
                                @endphp
                                {{$course->coefficient * $moyenne}}
                            </td>
                            <td>
                                {{$moyenne}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" class="footer" style="border: none;">Total</td>
                        <td> 15.0 </td>
                        <td>55.95 </td>
                        <td>55.95 </td>
                        <td>55.95 </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="footer" style="border: none;">Moyenne</td>
                        <td colspan="4">3.73 / 4.0 </td>
                    </tr>
                </tfoot>
            </table><br>
            <!--<table id="" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <td>{{__('course')}}
                        </td>
                        @foreach ($sequences as $sequence )
                        <td><b>{{$sequence->name}} </b></td>
                        @endforeach
                        <td>{{__('avg')}} </td>
                        <td>{{__('coefficient')}} </td>
                        <td>{{__('total')}} </td>
                        <td>{{__('Appreciation')}}</td>
                    </tr>
                </thead>
                @php
                $coefs=0;
                $points= 0;
                @endphp
                @foreach ($module->courses as $course)
                <tr>
                    <td>
                        {{$course->name}} <br>
                        {{$course->oneTeacher->name}}
                    </td>
                    @php
                    $moyenne=0;
                    @endphp
                    @foreach ($notes as $note)
                    {{$flag=0}}
                    @if($note->course_id==$course->id)
                    @php
                    $flag=1;
                    foreach($note->oneCourse->sequences as $sequence) {
                    if($note->sequence_id==$sequence->id){
                    $moyenne+=($note->note * $sequence->pivot->percentage)/100 ;
                    }
                    }
                    @endphp
                    <td>
                        {{$note->note}}
                    </td>
                    @endif
                    @if ($flag==0)
                    <td>0</td>
                    @endif
                    @endforeach
                    <td>
                        {{$moyenne}}
                    </td>
                    <td>{{$course->coefficient}}
                        @php
                        $coefs+= $course->coefficient;
                        @endphp
                    </td>
                    <td>
                        @php
                        $points+= $course->coefficient*$moyenne ;
                        @endphp
                        {{$course->coefficient * $moyenne}}

                    </td>
                    <td>
                        {{__(getAppreciation($moyenne))}}
                    </td>
                </tr>
                @endforeach

            </table>-->
            <div class="row">
                <b>
                    <div class="col-md-3">{{$module->name}} </div>
                    <div class="col-md-3">{{__('points')}}: {{$points}} </div>
                    <div class="col-md-3">{{__('coefficients')}} : {{$coefs}} </div>
                    <div class="col-md-3">{{__('avg')}} : {{$points/$coefs}} </div>
                </b>
            </div>
        @endforeach
    </div>
</div>
@endsection