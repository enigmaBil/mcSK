
@extends('layouts.index')

@section('css')
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
        folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/skins/_all-skins.min.css')}}">
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/Ionicons/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css')}}">
<style>
    /* Tabs */
    .tabs {
        width: 100%;

        border-radius: 5px 5px 5px 5px;
    }
    ul#tabs-nav {
        list-style: none;
        margin: 0;
        padding: 5px;
        overflow: auto;
    }
    ul#tabs-nav li {
        float: left;
        font-weight: bold;
        margin-right: 2px;
        padding: 8px 10px;
        border-radius: 5px 5px 5px 5px;
        /*border: 1px solid #d5d5de;
        border-bottom: none;*/
        cursor: pointer;
    }
    ul#tabs-nav li:hover,
    ul#tabs-nav li.active {
        background-color: #08E;
        color: #fff;
    }
    #tabs-nav li a {
        text-decoration: none;
        color: #fff;
    }
    #tabs-nav li{
        background-color: lightgrey;

    }
    .tab-content {
        padding: 10px;
        background-color: #FFF;
    }

</style>



@endsection
@php
    $totalDebt = 0;
    $totalAmtPaid = 0;
@endphp
@section('main')
    <div class="tabs">
        <ul id="tabs-nav">
            <li><a href="#tab1" id="paymentNav" style="padding-bottom: 10px">Paiements</a></li>
            <li><a href="#tab2" id="debtorNav"  style="padding-bottom: 10px">Étudiants irréguliers</a></li>

        </ul> <!-- END tabs-nav -->
        <div id="tabs-content">
            <div id="tab1" class="tab-content">
                <h3 style="text-align: center;margin-bottom:18px;">Rapport des paiements</h3>
                <div class="row" style="background: #d2d6de;margin:2px">
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>
                                Type paiement
                            </label>
                            <select name="" id="payment_type" class="select2" style="width:150px">
                                <option value="">Tous les moyens</option>
                                @foreach ($payment_reasons as $key=> $value)
                                    <option value="{{$key}}">
                                        {{$value}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>
                                Année scolaire
                            </label>
                            <select name="" id="school_year" class="select2" style="width:150px">
                                <option value="">Toute l'année scolaire</option>
                                @foreach ($academic_years as $academic_year )
                                    <option value="{{$academic_year->id}}" >{{$academic_year->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>
                                Discipline
                            </label>
                            <select name="" id="payment_discipline" class="select2" style="width:350px">
                                <option value="">Toutes les discipline</option>
                                @foreach ($disciplines as $discipline )
                                    <option value="{{$discipline->id}}" >{{$discipline->oneDepartment->name}} : {{$discipline->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>
                                {{__('level')}}
                            </label>
                            <select name="" id="payment_level" class="select2" style="width:150px">
                                <option value="">Tous les niveaux</option>
                                @foreach ($level_studies as $level )
                                    <option value="{{$level->id}}" >{{$level->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <button class="btn btn-success" id="btn_generate_payment" style="margin-top: 25px">
                                <i class=" fa fa-arrow-down" ></i> Générer
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default " style="min-height: 285px">
                            <div class="panel-heading" style="font-weight: bold">
                                Liste de paiement
                                <a href="#"  id="print_payment" style="float: right"><i class="fa fa-print"></i></a>
                            </div>
                            <div id="loadingImage1" style="display: none; text-align: center">
                                <img src="{{asset('images/loading_debtors.gif')}}" />
                            </div>
                            <div id="loadingImagePrint1" style="display: none; text-align: center">
                                <img src="{{asset('images/printing_payment.gif')}}" />
                            </div>
                            <div class="panel-body">
                                <div class="col-md-12 no-padding" id="payment_listing">
                                    <table id="example1"  class="table table-bordered table-striped paymentTable">
                                        <thead>
                                        <tr>
                                            <th>Nom de l'étudiant</th>
                                            <th>{{__('matricule')}}</th>
                                            <th>{{__('discipline')}}</th>
                                            <th>{{__('level')}}</th>
                                            <th>Date de paiement</th>
                                            <th>{{__('amount')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($studentsPayments as $payment)
                                            <tr>
                                                <form>
                                                    <td contenteditable="false">{{$payment->oneInscription->oneStudent->last_name}} {{$payment->oneInscription->oneStudent->first_name}}</td>
                                                    <td contenteditable="false">{{$payment->oneInscription->oneStudent->code}}</td>
                                                    <td contenteditable="false">{{$payment->oneInscription->oneClass->oneDiscipline->name}}</td>
                                                    <td contenteditable="false">{{$payment->oneInscription->oneClass->oneLevel->name}}</td>
                                                    <td contenteditable="false">{{$payment->created_at}}</td>
                                                    <td contenteditable="false">{{number_format($payment->amount, 2, ',', ' ')}}</td>
                                                    @php
                                                        $totalAmtPaid += $payment->amount
                                                    @endphp
                                                </form>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <form>
                                                <td contenteditable="false"style="font-size: 16px;font-weight:bold;">Montant total</td>
                                                <td style="border-right: none"></td><td style="border-right: none"></td><td style="border-right: none"></td><td></td>
                                                <td contenteditable="false" style="font-size: 15px;font-weight:bold">{{number_format($totalAmtPaid, 2, ',', ' ')}}</td>
                                            </form>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="tab2" class="tab-content">
                <h3 style="text-align: center;margin-bottom:18px;">Rapport d'étudiants irréguliers</h3>
                <div class="row" style="background: #d2d6de;margin:2px">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>
                                {{__('chosen discipline')}}
                            </label>
                            <select name="" id="debtors_discipline" class="select2" style="width:350px">
                                <option value="">Toutes les discipline</option>
                                @foreach ($disciplines as $discipline )
                                    <option value="{{$discipline->id}}" >{{$discipline->oneDepartment->name}} : {{$discipline->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>
                                {{__('academicYears')}}
                            </label>
                            <select name="" id="debtors_academic_year" class="select2" style="width:250px">
                                <option value="">Toute l'année académique</option>
                                @foreach ($academic_years as $academic_year )
                                    <option value="{{$academic_year->id}}" >{{$academic_year->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>
                                {{__('level')}}
                            </label>
                            <select name="" id="debtors_level" class="select2" style="width:250px">
                                <option value="">Tous les niveaux</option>
                                @foreach ($level_studies as $level )
                                    <option value="{{$level->id}}" >{{$level->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <button class="btn btn-success" id="btn_generate" style="margin-top: 25px">
                                <i class=" fa fa-arrow-down" ></i> Générer
                            </button>
                        </div>
                    </div>
                </div>
                    <div class="row">
                     <div class="col-md-12">
                        <div class="panel panel-default " style="min-height: 285px">
                            <div class="panel-heading" style="font-weight: bold">
                                {{__('Irregular students list')}}
                                <a href="#"  id="print_debtors" style="float: right"><i class="fa fa-print"></i></a>
                            </div>

                            <div id="loadingImage" style="display: none; text-align: center">
                                <img src="{{asset('images/loading_debtors.gif')}}" />
                            </div>
                            <div id="loadingImagePrint" style="display: none; text-align: center">
                                <img src="{{asset('images/printing_payment.gif')}}" />
                            </div>
                            <div class="panel-body">
                                <div class="col-md-12 no-padding" id="debtors_listing">
                                    <table id="debtorsTable" class="table table-bordered table-striped debtorsTable">
                                        <thead>
                                        <tr>
                                            <th>Année scolaire</th>
                                            <th>Nom de l'étudiant</th>
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
                                                    <td contenteditable="false">{{$inscription->oneAcademic_year->name}}</td>
                                                    <td contenteditable="false">{{$inscription->oneStudent->last_name}} {{$inscription->oneStudent->first_name}}</td>
                                                    <td contenteditable="false">{{$inscription->oneStudent->code}} </td>
                                                    <td contenteditable="false">{{$inscription->oneClass->oneDiscipline->name}}</td>
                                                    <td contenteditable="false">{{$inscription->oneClass->oneLevel->name}}</td>
                                                    <td contenteditable="false">{{number_format($inscription->rest, 2, ',', ' ')}}</td>
                                                    @php
                                                        $totalDebt += $inscription->rest
                                                    @endphp
                                                </form>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <form>
                                                <td contenteditable="false"style="font-size: 16px;font-weight:bold;border-right: none" >Montant total</td>
                                                <td style="border-right: none"></td><td style="border-right: none"></td><td style="border-right: none"></td><td></td>
                                                <td contenteditable="false" style="font-size: 15px;font-weight:bold">{{number_format($totalDebt, 2, ',', ' ')}}</td>
                                            </form>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
            </div>

        </div>
    </div>
    </section>
    </div>

@endsection

@section('js')
    @parent
    <script src="{{ asset('js/scolarity/report.js?v=',time())}}"></script>

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
    <script type="text/javascript">
        jQuery(document).ready(function () {
            $("#btn_generate_payment").click(function () {
                var discipline_id = $('#payment_discipline').find(":selected").val()
                var academic_year_id = $('#school_year').find(":selected").val()
                var level_id = $('#payment_level').find(":selected").val()
                var payment_type_id = $('#payment_type').find(":selected").val()
                var data = { "disciplineID" : discipline_id, "academicYearID" : academic_year_id,"levelID" : level_id, "paymentID" : payment_type_id }
                var url = "{{route('report_payment')}}";
                console.log(data)
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    beforeSend: function() {
                        $('#loadingImage1').css('display','block');
                        $("#payment_listing").css('display','none');
                    },
                    complete:function(){
                        $('#loadingImage1').css('display','none');
                        $("#payment_listing").css('display','block');
                    },
                    url: url,
                    data: JSON.stringify(data),
                    type: 'POST',
                    contentType: 'application/json; charset=utf-8',
                    success: function (data) {
                        $("#payment_listing").html(data);
                        $('#example1').DataTable();
                    }
                });
            });
            $("#btn_generate").click(function () {
                var discipline_id = $('#debtors_discipline').find(":selected").val()
                var academic_year_id = $('#debtors_academic_year').find(":selected").val()
                var level_id = $('#debtors_level').find(":selected").val()
                var data = { "disciplineID" : discipline_id, "academicYearID" : academic_year_id,"levelID" : level_id }
                var url = "{{route('report_accounting1')}}";
                console.log(data)
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    beforeSend: function() {
                        $('#loadingImage').css('display','block');
                        $("#debtors_listing").css('display','none');
                    },
                    complete:function(){
                        $('#loadingImage').css('display','none');
                        $("#debtors_listing").css('display','block');
                    },
                    url: url,
                    data: JSON.stringify(data),
                    type: 'POST',
                    contentType: 'application/json; charset=utf-8',
                    success: function (data) {
                        $("#debtors_listing").html(data);
                        $('.debtorsTable').DataTable();
                    }
                });
            });

            $("#print_payment").click(function () {
                var discipline_id = $('#payment_discipline').find(":selected").val()
                var academic_year_id = $('#school_year').find(":selected").val()
                var level_id = $('#payment_level').find(":selected").val()
                var payment_type_id = $('#payment_type').find(":selected").val()
                var data = { "disciplineID" : discipline_id, "academicYearID" : academic_year_id,"levelID" : level_id, "paymentID" : payment_type_id }
                var url = "{{route('report_accounting_payment.printpdf')}}";
                url += '?print='+print+'%20&disciplineID=%20'+discipline_id+'%20&academicYearID=%20'+academic_year_id+'%20&levelID=%20'+level_id+'%20&paymentID=%20'+payment_type_id;
                console.log(data)

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    beforeSend: function() {
                        $('#loadingImagePrint1').css('display','block');
                        $("#payment_listing").css('display','none');
                    },
                    complete:function(){
                        $('#loadingImagePrint1').css('display','none');
                        $("#payment_listing").css('display','block');
                    },
                    url: url,
                    data: JSON.stringify(data),
                    type: 'GET',
                    contentType: 'application/json; charset=utf-8',
                    success: function (data) {
                        if(data){
                            window.open(url);
                        }
                    }
                });
            });
            $("#print_debtors").click(function () {
                var print = 0;
                var discipline_id = $('#debtors_discipline').find(":selected").val();
                var academic_year_id = $('#debtors_academic_year').find(":selected").val();
                var level_id = $('#debtors_level').find(":selected").val();
                var data = $.param({"disciplineID" : discipline_id, "academicYearID" : academic_year_id, "levelID" : level_id});
                var url = "{{route('report_accounting1.printpdf')}}";
                url += '?print='+print+'%20&disciplineID=%20'+discipline_id+'%20&academicYearID=%20'+academic_year_id+'%20&levelID=%20'+level_id;
                console.log(data)

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    beforeSend: function() {
                        $('#loadingImagePrint').css('display','block');
                        $("#debtors_listing").css('display','none');
                    },
                    complete:function(){
                        $('#loadingImagePrint').css('display','none');
                        $("#debtors_listing").css('display','block');
                    },
                    url: url,
                    data: JSON.stringify(data),
                    type: 'GET',
                    contentType: 'application/json; charset=utf-8',
                    success: function (data) {
                        // $("#debtors_listing").html(data);
                        // $('#example1').DataTable();
                       if(data){
                           window.open(url);
                       }
                    }
                });
            });
        });
    </script>

    <script>

        $('#tabs-nav li:first-child').addClass('active');
        $('.tab-content').hide();
        $('.tab-content:first').show();

        // Click function
        $('#tabs-nav li').click(function(){
            $('#tabs-nav li').removeClass('active');
            $(this).addClass('active');
            $('.tab-content').hide();

            var activeTab = $(this).find('a').attr('href');
            $(activeTab).fadeIn();
            return false;
        });

        $('#debtorNav').click(function(){
            $('.debtorsTable').DataTable();
        });
    </script>

@endsection
