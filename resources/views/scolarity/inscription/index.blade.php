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
          {{__('inscription')}}
        </h1>
      </section>
@endsection

@section('create')
    @include('scolarity.inscription.create') 
@endsection
@section('nom')
   {{__('inscription')}}
@endsection
@section('nom2')
    {{__('inscriptionList')}}
@endsection
@section('data')
<thead>
    <tr>
      <th>{{__('student')}}</th>
      <th>N°</th>
      <th>{{__('status')}}</th>
      <th>{{__('discipline')}}</th>
      <th>{{__('level')}}</th>
      <th>{{__('inscription amount')}}</th>
      <th>{{__('education amount')}}</th>
      <th>{{__('reduction')}}</th>
      <th>{{__('rest')}}</th>
      <th>{{__('inscriptionDate')}}</th>
      <th>{{__('deadline')}}</th>
      <th>{{__('academicYear')}}</th>
      


    </tr>
</thead>
    <tbody>
      @foreach ($inscriptions as $inscription)

        <tr id={{"tr".$inscription->id}}>

            <form id={{"frmEditinscription".$inscription->id}}>
              <td>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">  
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg')}}" class="user-image" alt="User Image">
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs">{{$inscription->oneStudent->code}} : {{$inscription->oneStudent->first_name}} 
                                    {{$inscription->oneStudent->last_name}}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- The user image in the menu -->
                                <li class="user-header">
                                    <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
                    
                                    <p style="color:mediumblue;">
                                        {{$inscription->oneStudent->first_name}}
                                    <small>{{__('studentDescription')}}</small>

                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <table>
                                            
                                        <tbody>
                                                <tr><td><b>sexe:</b> {{$inscription->oneStudent->sex}}</td> </tr>
                                                <tr><td><b>date de naissance:</b> {{$inscription->oneStudent->birth_date}}</td></tr>
                                                <tr><td><b>Adresse:</b> loncak</td>
                                                    </tr>
                                                <tr><td><b>assurance:</b>{{($inscription->oneStudent->assurance==1)? "ok" : "no"}} </td></tr>
                                                <tr><td><b>diplome:</b> {{$inscription->oneStudent->present_diploma}}</td></tr>

                                                <tr><td><b>Nationalité:</b> {{$inscription->oneStudent->nationality}}</td></tr>
                                                <tr> <td><b>Contact primaire:</b> {{$inscription->oneStudent->primary_contact}}</td></tr>
                                                <tr><td><b>Contact secondaire:</b> {{$inscription->oneStudent->secondary_contact}}</td></tr>
                                                <tr><td><b>nom du père:</b> {{$inscription->oneStudent->father_name}}</td></tr>
                                                <tr><td><b>Nom de la mère:</b>{{$inscription->oneStudent->mother_name}}</td></tr>
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
              <td contenteditable="false">{{$inscription->id}}</td>
              <td class="validable">
                @php
                if ($inscription->status==1)
                    echo '<span   class="glyphicon glyphicon-ok"></span>';
                else {
                  echo '<i  onclick="validate('.$inscription->id.')" class=" icon fa fa-close"></i>';
                }
                @endphp
                
                
                </td>
              <td contenteditable="false">{{$inscription->oneClass->oneDiscipline->name}}</td>
              <td contenteditable="false"  >{{$inscription->oneClass->oneLevel->name}}</td>
              <td contenteditable="false">   
                  {{number_format($inscription->oneClass->inscription_amount, 2, ',', ' ')}}                        </td>
              <td>{{number_format($inscription->oneClass->education_amount, 2, ',', ' ')}}
              </td>
              <td contenteditable="false">
                  {{$inscription->reduction}}    </td>

                  
              <td  >    <a href={{"/scolarity/inscription/payments/".$inscription->id}}> {{number_format($inscription->rest, 2, ',', ' ')}} </a>
             
              </td>
              <td>{{$inscription->creation_date}}</td>
              <td contenteditable="false">{{$inscription->oneAcademic_year->deadline}}
              </td>
              <td>
                  {{$inscription->oneAcademic_year->name." : ".$inscription->oneAcademic_year->start_date." / ".$inscription->oneAcademic_year->end_date}}
              </td>
              @if($inscription->status==1)<td> <a href="{{route('inscription.printpdf',$inscription->id)}}"><i class="fa fa-print"></i></a></td>
              @endif
            </form>
        </tr>
      @endforeach

    </tbody>
  
@endsection



@section('js')
@parent
    <script src="{{ asset('js/scolarity/inscription.js')}}"></script>


    
<script type="text/javascript">
  $(document).ready(function(){
    <?php $jsclasses = json_encode($classes);
       echo "var listclasses= ".$jsclasses.";";
    ?>;
    inscription=listclasses[0]["inscription_amount"];
       education=listclasses[0]["education_amount"];

       $("#amount_inscription").val(inscription);
      $("#amount_education").val(education);       
});
var choice,choice1,choice2;
 
   function amount_load(){
     

       selector=document.getElementById("classe");
       <?php $jsclasses = json_encode($classes);
       echo "var listclasses= ".$jsclasses.";";
    ?>;
       choice=selector.options[selector.selectedIndex].val;
      
       inscription=listclasses[selector.selectedIndex]["inscription_amount"];
       education=listclasses[selector.selectedIndex]["education_amount"];
      $("#amount_inscription").val(inscription);
      $("#amount_education").val(education);

   } 
 
</script>

@endsection


