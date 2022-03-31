@extends('layouts.layout')
@section('page_header')
    <section class="content-header">
        <h1>
            {{__('modules')}}
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
          <li class="active">Here</li>
        </ol>
      </section>
@endsection
@section('main')
    <button  class="btn bg-green" onclick="return $('#create_new_').toggle(1000);">
        <span class="fa fa-plus"></span> {{__('new')}}
    </button> <br>
    @yield('task_menu')
    <div id="create_new_" style="display:none;"> 
    <br> @include('configuration.module.create') </div>
        
    </div>
    <br><div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">{{__('modules')}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>{{__('name')}}</th>
                  <th>{{__('description')}}</th>
                  <th>{{__('statut')}}</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td contenteditable="false"><a href="{{ url('configuration/module') }}"> msp</a> </td>
                  <td contenteditable="false">Genie info</td>
                  <td contenteditable="false"><i class="icon fa fa-reply"></i></td>
                </tr>
                <tr>
                  <td contenteditable="false"><a href="{{ url('configuration/module') }}"> msp</a> </td>
                  <td contenteditable="false">Genie info</td>
                  <td contenteditable="false"><i class="icon fa fa-reply"></i></td>
                </tr>
                <tr>
                  <td contenteditable="false"><a href="{{ url('configuration/module') }}"> msp</a> </td>
                  <td contenteditable="false">Genie info</td>
                  <td contenteditable="false"><i class="icon fa fa-reply"></i></td>
                </tr>
                 
                </tbody>
                <tfoot>
                <tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
    </div>
    <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Niveau 2</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nom</th>
                  <th>Description</th>
                  <th>Statut</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td contenteditable="false"><a href="{{ url('configuration/module') }}"> Physiques</a> </td>
                  <td contenteditable="false">Genie info</td>
                  <td contenteditable="false"><i class="icon fa fa-reply"></i></td>
                </tr>
                <tr>
                  <td contenteditable="false"><a href="{{ url('configuration/module') }}"> Chimie</a> </td>
                  <td contenteditable="false">Genie info</td>
                  <td contenteditable="false"><i class="icon fa fa-reply"></i></td>
                </tr>
                <tr>
                  <td contenteditable="false"><a href="{{ url('configuration/module') }}"> Mathématiques</a> </td>
                  <td contenteditable="false">Genie info</td>
                  <td contenteditable="false"><i class="icon fa fa-reply"></i></td>
                </tr>
                 
                </tbody>
                <tfoot>
                <tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
    </div>
          <!-- /.box -->
@endsection