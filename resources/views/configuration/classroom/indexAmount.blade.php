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


@section('nom')
{{__('slice')}}
@endsection


@section('main')
<div class="box box-info">
  <div class="box-header">
    <h3 class="box-title"> {{__('sliceList')}} </h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body table-responsive">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>{{__('pattern')}}</th>
          <th>{{__('deadline')}}</th>
          <th>{{__('amount')}}</th>
          <th>{{__('actions')}} </th>
        </tr>
      </thead>
      <tbody id="tbody">
        @foreach ($slices as $slice)
        <tr id={{"tr".$slice->id}}>
          <td id="{{"name".$slice->oneSlice->id}}" contenteditable="false">{{$slice->oneSlice->name}}</td>
          <td id="{{"deadline".$slice->oneSlice->id}}" contenteditable="false">{{$slice->oneSlice->deadline}}</td>
          <td id="{{"value".$slice->id}}" contenteditable="false">{{$slice->value}}</td>
          <td>
            <div class="form-group">
              <a onclick="editAmount({{$slice->id}})">
                <i class="fa fa-fw fa-pencil"></i>
              </a>
              <a onclick="validateAmount('{{$slice->id}}', '{{__('updateSuccess')}}')">
                <i class="icon fa fa-check"></i>
              </a>
              <a onclick="backAmount( '{{$slice->id}}', '{{$slice->value}}')">
                <i class="icon fa fa-reply"></i>
              </a>
            </div>
          </td>
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
<script src="{{ asset('js/configuration/classroom.js')}}"></script>
@endsection