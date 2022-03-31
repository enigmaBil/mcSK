@extends('layouts.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
        folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/skins/_all-skins.min.css')}}">
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/Ionicons/css/ionicons.min.css')}}">


@endsection
@section('page_header')
    <section class="content-header">
        <h1>
          {{__('payments')}}
          @if(isset($inscriptionId)) <small>{{__('inscripition')}} N° {{$inscriptionId}} {{__('student')}}: {{$Studentname}} </small>@endif
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
          <li class="active">Here</li>
        </ol>
      </section>
@endsection

@section('create')
    @include('scolarity.payment.create') 
@endsection
@section('nom')
   {{__('payment')}}
@endsection
@section('nom2')
    {{__('paymentList')}}
@endsection
@section('data')
<thead>
    <tr>
      <th>{{('student')}}</th>
      <th>{{('created at')}}</th>
      <th>{{__('payment')}} N°</th>
      <th>{{__('inscription')}} N°</th>
      <th>{{__('amount')}}</th>
      <th>status</th>
      <th> </th>
    </tr>
</thead>
    <tbody>
      @foreach ($payments as $payment)

        <tr>

            <form id={{"frmEditpayment".$payment->id}}>
              <td>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">  
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg')}}" class="user-image" alt="User Image">
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs">{{$payment->oneInscription->oneStudent->code}} : {{$payment->oneInscription->oneStudent->first_name}} 
                                    {{$payment->oneInscription->oneStudent->last_name}}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- The user image in the menu -->
                                <li class="user-header">
                                    <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
                    
                                    <p style="color:mediumblue;">
                                        {{$payment->oneInscription->oneStudent->first_name}}
                                    <small>description de l'etudiant</small>

                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <table>
                                            
                                        <tbody>
                                                <tr><td><b>sexe:</b> {{$payment->oneInscription->oneStudent->sex}}</td> </tr>
                                                <tr><td><b>date de naissance:</b> {{$payment->oneInscription->oneStudent->birth_date}}</td></tr>
                                                <tr><td><b>Adresse:</b> loncak</td>
                                                    </tr>
                                                <tr><td><b>assurance:</b>{{($payment->oneInscription->oneStudent->assurance==1)? "ok" : "no"}} </td></tr>
                                                <tr><td><b>diplome:</b> {{$payment->oneInscription->oneStudent->entrance_diploma}}</td></tr>

                                                <tr><td><b>Nationalité:</b> {{$payment->oneInscription->oneStudent->nationality}}</td></tr>
                                                <tr> <td><b>Contact primaire:</b> {{$payment->oneInscription->oneStudent->primary_contact}}</td></tr>
                                                <tr><td><b>Contact secondaire:</b> {{$payment->oneInscription->oneStudent->secondary_contact}}</td></tr>
                                                <tr><td><b>nom du père:</b> {{$payment->oneInscription->oneStudent->father_name}}</td></tr>
                                                <tr><td><b>Nom de la mère:</b>{{$payment->oneInscription->oneStudent->mother_name}}</td></tr>
                                        </tbody>
                                    </table>
                                    <!-- /.row -->
                                </li>
                                <!--supprimer  Menu Footer si on veux ajouter-->

                            </ul>
                        </li>
                    </ul>
                </div>
              </td>
              <td contenteditable="false">{{$payment->created_at}}</td>
              <td contenteditable="false">{{$payment->id}}</td>
              <td contenteditable="false">{{$payment->inscription_id}}</td>
            

                    <td contenteditable="false">{{$payment->amount}}</td>
              <td>
                   

                @php
                if ($payment->status==1)
                    echo '<span class="glyphicon glyphicon-ok"></span>';
                else {
                  echo '<i class="icon fa fa-reply"></i>';
                }
                @endphp
                
                
                </td>

            </form>
        <td> <a href="{{route('payment.printpdf',$payment->id)}}"><i class="fa fa-print"></i></a></td>
        </tr>
      @endforeach

    </tbody>
  
@endsection



@section('js')
@parent
    <script src="{{ asset('js/scolarity/payment.js?v=',time())}}"></script>


 
@endsection


