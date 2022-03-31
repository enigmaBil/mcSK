@extends('layouts.index')
@section('create')
    @include('configuration.department.create') 
@endsection
@section('nom')
   {{__('department')}}
@endsection
@section('nom2')
    {{__('departmentList')}}
@endsection
@section('data')
<thead>
    <tr>
      <th>{{__('departments')}}</th>
      <th>{{__('disciplines')}}</th>
      <th>{{__('amountScolarity')}}</th>
      <th>{{__('head_of_department')}}</th>
      <th>{{__('status')}}</th>
      <th>{{__('actions')}}</th>
    </tr> 
</thead>
<tbody id="tbody">
  @foreach ($departments as $department)
  <div class="divtr">
        <tr id={{"tr".$department->id}}>
          <form action="" id="{{$department->id}}">
              <td contenteditable="false">
                <a title="{{__('accessToDisciplines')}} " id={{"name".$department->id}} href="{{ route('departement_discipline.index',$department->id) }}">{{$department->name}}</a>
              </td>
              <td>
                <ul class="sidebar-menu tree" data-widget="tree">
                  <li class="treeview">
                      <a href="#" title="{{__('disciplineList')}} ">
                        <span>{{__('disciplines')}} </span><span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                          </span>
                        </span>
                      </a>
                      <ul class="treeview-menu">
                        @foreach ($department->disciplines as $item)
                          <li><a title="{{__('accessToClassroom')}} " href= "{{ route('discipline_level.index', $item->id) }}"> {{$item->name}} </a></li>
                        @endforeach
                      </ul>
                  </li>
                
                </ul>
                </td>
              <td id={{"scolarity".$department->id}} contenteditable="false">
                <div> {{$department->scolarity}}</div>
              </td>
              <td contenteditable="false">
                <select class="form-control select2" id={{"head_of_department".$department->id}}  disabled>
                  @foreach ($teachers as $item)
                    <option  value="{{$item->id}}" @if ($item->id == $department->head_of_department) selected @endif >{{$item->name}}</option>
                  @endforeach
                </select>
              </td> 
              <td  contenteditable="false">
                  <a  id="{{"status".$department->id}}"> 
                  
                    @php

                      if($department->status ==0){
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
                    <a  onclick="edit({{$department->id}})">
                      <i class="fa fa-fw fa-pencil"></i>
                    </a>
                      <a  onclick="validate({{$department->id}}, 'Mise à jour effectuée avec succès')">
                          <i class="icon fa fa-check"></i>
                        </a>

                    <a onclick="back({{$department->id}},
                      '{{$department->name}}',{{$department->scolarity}},{{$department->status}})">
                      <i class="icon fa fa-reply"></i>
                    </a>
                    <a  onclick="destroy({{$department->id}})">
                        <i class="fa fa-fw fa-trash"></i>
                    </a>
                  </div>

              </td>
            </form>
        </tr>
  </div>
  @endforeach
</tbody>
@endsection
@section('js')
 @parent
 <script src="{{ asset('/js/configuration/department.js')}}"></script> 
  
@endsection