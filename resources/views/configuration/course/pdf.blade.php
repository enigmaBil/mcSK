<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MC School Manager</title>

</head>
<link rel="stylesheet" 
href="{{ ltrim(public_path('adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css'), '/') }}"
>


<style>
#invoice{
    padding: 30px;
}

.invoice {
    position: relative;
    background-color: #FFF;
    min-height: 680px;
    padding: 15px
}

.invoice header {
    padding: 10px 0;
    margin-bottom: 20px;
    border-bottom: 1px solid #3989c6
}


.invoice footer {
    width: 100%;
    text-align: center;
    color: #777;
    border-top: 1px solid #aaa;
    padding: 8px 0
}


    
#example td, #example th {
  border: 1px solid #ddd;
  padding: 8px;
}

#example tr:nth-child(even){background-color: #f2f2f2;}

#example tr:hover {background-color: #ddd;}

#example th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
}
  </style>
<body>
        <div id="invoice">
 
                <header>
                    <div class="toolbar hidden-print">
                        <div class="text-left">
                                <a href="#" id="lien"  onclick="print();"><i class="glyphicon glyphicon-print"></i>print</a>
                          <b>{{__('Listes des cours basée sur la recherche :')}}</b>
                        </div>
                        <hr>
                    </div>
                </header>
                  
                  <div class="invoice overflow-auto">
    <table id="example" class="display" style="width:100%">
            <thead ><b>
                    <tr>
                      <th>{{__('name')}}</th>
                      <th>{{__('amountHour')}}</th>
                      <th>{{__('coefficient')}}</th>
                      <th>{{__('session')}}</th>
                      <th>{{__('teacher')}}</th>
                      <th>{{__('discipline')}}</th>
                      <th>{{__('level')}}</th>
                      <th>{{__('module')}}</th>
                      <th>{{__('status')}}</th>
                      </tr></b>
            </thead>
    <tbody>
        @foreach ($courses as $course)
        <tr >
                    <td >{{$course->name}}</td>
                    <td >{{$course->amount_hour}}</td>
                    <td >{{$course->coefficient}}</td>
                    <td >{{$course->session}}</td>
                     <td  >
            
                           {{$course->oneteacher->name}}
                    
                    </td>
                    <td >
                       {{$course->oneModule->classroom->oneDiscipline->name}}
                    </td> 
                    <td  >
                        {{$course->oneModule->classroom->oneLevel->name}}
                      
                      </td>    
                    <td >
                       {{$course->oneModule->name}}
                      </td> 
                    <td  >
                        <a  id="{{"status".$course->id}}"> 
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
                    
        </tr>
        @endforeach
    </tbody>
    
    </table>
    <footer>
        footer
    </footer>
</body>

<script src="{{ asset('adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>

<script src="{{ asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<!-- SlimScroll -->
    <script>
      <?php if( $search!=null) {
  echo ('var search='.$search.';');
echo('$("#example").DataTable().search(search+"");');
};
      ?>
      $(document).ready(function(){
<?php if( $search!=null) {
  echo ('var search='.$search.';');
echo('$("#example").DataTable().search(search+"");');
};
      ?>
 });
  function print(){
    document.links[0].href="/configuration/course/print-pdf/"+$('#example').DataTable().search();

 


  }
        $('#example').DataTable({
        'paging'      : false,
        'lengthChange': false,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true
      });
      alert($("#example").DataTable().search());

        </script>
</html>