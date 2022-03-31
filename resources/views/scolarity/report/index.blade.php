
@extends('layouts.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
        folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/skins/_all-skins.min.css')}}">
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/Ionicons/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css')}}">


@endsection
@section('page_header')
    <section class="content-header">
        <h1>
        {{__('Report')}}
        </h1>
        <!--<ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
          <li class="active">Here</li>
        </ol>-->
    </section>
@endsection

@section('main')

    <section class="card-values dashboard">
        <div class="content">
            <div class="row">
                <div class="col-md-3 col-xs-12">
                    <div class="card card-stats">
                        <div class="card-header card-header-warning card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">school</i>
                            </div>
                                <p class="card-category">
                                    {{__('Inscrits')}}
                                </p>
                                <h3 class="card-title">{{$inscriptionsNbre}}</h3>
                        </div>
                        <div class="card-footer">
                            <div class="row stats" style="text-align: center; display: block; margin: auto; width: 100%">
                                <div class="col-md-6 col-xs-6" style="text-align: center;">
                                    {{('week')}}<br><span class="card-details-bottom">{{$inscriptionRepository->inscriptionPeriode("semaine")}}</span>
                                </div>
                                <div class="col-md-6 col-xs-6" style="text-align: center;">
                                    {{('month')}}<br><span class="card-details-bottom">{{$inscriptionRepository->inscriptionPeriode("mois")}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach ($slices as $slice )
                <div class="col-md-3 col-xs-12">
                    <div class="card card-stats">
                        <div class="card-header card-header-success card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">payment</i>
                            </div>
                            <p class="card-category">
                                {{$slice->name}}
                            </p>
                            <h3 class="card-title">{{$paymentRepository->paymentTranche($slice->id)}}</h3>
                            
                        </div>
                        <div class="card-footer">
                            <div class="row stats" style="text-align: center; display: block; margin: auto; width: 100%">
                                <div class="col-md-6 col-xs-6" style="text-align: center;">
                                    {{__('week')}}<br><span class="card-details-bottom">{{$paymentRepository->paymentTranchePeriode($slice->id,"semaine")}}</span>
                                </div>
                                <div class="col-md-6 col-xs-6" style="text-align: center;">
                                    {{__('month')}}<br><span class="card-details-bottom">{{$paymentRepository->paymentTranchePeriode($slice->id,"mois")}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </section>

<section class="">
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default " style="min-height: 285px">
                <div class="panel-heading" style="font-weight: bold">
                    Paiements / {{__('Inscrits')}}
                </div>
                <div class="panel-body">
                    @php $irregularStudents=[]; @endphp
                    @foreach ($disciplines  as $discipline )
                    <div class="row progress-labels">
                        <div class="col-sm-6">
                            {{$discipline->name}}
                        </div>
                        @php
                        $inscris=0;
                        $regular=0;
                        foreach ($discipline->discipline_level_studies as $class ){
                            $inscris+=$class->inscriptions->count();
                            foreach ($class->inscriptions as $inscription){
                                $payed=[];
                              /*  foreach ($inscription->payments as $payment){
                                    if($payment->payment_reason==1)
                                        array_push($payed,$payment->slice->name);
                                }*/
                            if(array_intersect($payed,$passedSlices)==$passedSlices){
                                $regular+=1;
                            }
                            else{
                                array_push($irregularStudents,$inscription);
                            }
                        }
                        }   if($inscris!=0){
                            $percent=$regular/$inscris;
                            }
                        @endphp
                        <div class="col-sm-6" style="text-align: right;">
                            {{$regular}}/{{$inscris}}
                        </div>
                    </div>
                    <div class="progress progress-striped active">
                        <div data-percentage="0%" style="width:@if($inscris==0)0% @else {{intval($percent*100)}}% @endif;" class="progress-bar progress-bar-orange" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    
        <div class="col-md-8">
            <div class="panel panel-default " style="min-height: 285px">
                <div class="panel-heading" style="font-weight: bold">
                    {{__('Irregular students list')}}
                </div>
                <div class="panel-body">
                    <div class="col-md-12 no-padding">
                        <table id="example1" class="table table-bordered table-striped">
                    <thead>
                            <tr>
                            <th>{{__('matricule')}}</th>
                            <th>{{__('discipline')}}</th>
                            <th>{{__('level')}}</th>
                            <th>{{__('rest')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($irregularStudents as $inscription)
                                <tr>
                                    <form id={{"frmEditinscription"}}>
                                    <td contenteditable="false">{{$inscription->oneStudent->code}} </td>
                                    <td contenteditable="false">{{$inscription->oneClass->oneDiscipline->name}}</td>
                                    <td contenteditable="false"  >{{$inscription->oneClass->oneLevel->name}}</td>
                                    <td contenteditable="false">{{$inscription->rest}}</td></form>                                              </tr>
                            @endforeach
                        </tbody>
            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')
@parent
    <script src="{{ asset('js/scolarity/report.js?v=',time())}}"></script>
@endsection
