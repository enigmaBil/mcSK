@extends('layouts.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/skins/_all-skins.min.css')}}">
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/Ionicons/css/ionicons.min.css')}}">
@endsection

@section('page_header')
    <section class="content-header">
        <h1>
          {{__('patterns')}}
        </h1>
      </section>
@endsection

@section('create')
    @include('scolarity.slice.create') 
@endsection

@section('nom')
   {{__('slice')}}
@endsection

@section('nom2')
    {{__('sliceList')}}
@endsection

@section('data')
<thead>
    <tr>
      <th>{{__('pattern')}}</th>
      <th>{{__('deadline')}}</th>
      <th>{{__('status')}} </th>
      <th>{{__('actions')}} </th>
    </tr>
</thead>
    <tbody id="tbody">
      @foreach ($slices as $slice)
        <tr id={{"tr".$slice->id}}>
                <td id="{{"name".$slice->id}}" contenteditable="false">{{$slice->name}}</td>
                <td id="{{"deadline".$slice->id}}" contenteditable="false">{{$slice->deadline}}</td>
                <td  contenteditable="false">
                    <a  id="{{"status".$slice->id}}"> 
                        @php
                            if($slice->status ==0){
                                echo("<i class='icon fa fa-eye-slash'></i>");
                            }
                            else {
                                echo("<i class='icon fa fa-eye'></i>");
                            }                  
                        @endphp
                    </a>
                </td>
                <td>
                    <div class="form-group">
                        <a  onclick="edit({{$slice->id}})">
                            <i class="fa fa-fw fa-pencil"></i>
                        </a>
                        <a  onclick="validate('{{$slice->id}}', '{{__('updateSuccess')}}')">
                            <i class="icon fa fa-check"></i>
                        </a>
                        <a onclick="back( '{{$slice->id}}', '{{$slice->name}}', '{{$slice->deadline}}', '{{$slice->status}}')">
                            <i class="icon fa fa-reply"></i>
                        </a>
                        <a  onclick="destroy({{$slice->id}})">
                            <i class="fa fa-fw fa-trash"></i>
                        </a>
                    </div>
                </td>
        </tr>
      @endforeach

    </tbody>
  
@endsection



@section('js')
@parent
    <script src="{{ asset('js/scolarity/slice.js')}}"></script>
@endsection


