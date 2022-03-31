@extends('layouts.index')
@section('create')
@if(isset($name)) 
@include('configuration.discipline.create_in_department') 
    
@else
@include('configuration.discipline.create') 

@endif
@endsection
@section('nom')
@if(isset($name)) 
{{__('disciplines of the department')}} :{{$name}};

@endif

@endsection
@section('nom2')
    {{__('disciplineList')}}
@endsection
@section('data')
<thead>
    <tr>
      <th alt='une discipline'>{{__('discipline')}}</th>
      <th>{{__('initiale of the discipline')}}</th>
      <th>{{__('description')}}</th>
      <th>{{__('responsible')}}</th>
      <th>{{__('status')}}</th>
      <th>{{__('actions')}}</th>
    </tr>
    </thead>
    <tbody id="tbody">
  
  @foreach ($disciplines as $discipline)

  
  <tr id={{"tr".$discipline->id}}>
    <form action="" id="{{$discipline->id}}">
        <td contenteditable="false">
              <a title={{__('click_here_to_view_classes')}} id={{"name".$discipline->id}} href= "{{ route('discipline_level.index', $discipline->id) }}">
            {{$discipline->name}}</a>
        </td>
        <td id={{"code".$discipline->id}} contenteditable="false">
            <div> {{$discipline->code}}</div>
          </td>
         <td id={{"description".$discipline->id}} contenteditable="false">
          <div> {{$discipline->description}}</div>
        </td>
        <td contenteditable="false">
            <select class="form-control select2" id={{"responsible".$discipline->id}}  disabled>
              @foreach ($teachers as $item)
                <option  value="{{$item->id}}" @if ($item->id == $discipline->responsible) selected @endif >{{$item->name}}</option>
              @endforeach
            </select>
        </td> 
        <td  contenteditable="false">
            <a  id="{{"status".$discipline->id}}"> 
            
              @php

                if($discipline->status ==0){
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
              <a title={{__("edit")}} onclick="edit({{$discipline->id}})">
                <i class="fa fa-fw fa-pencil"></i>
              </a>
                <a title={{__("save")}} onclick="validate({{$discipline->id}},{{$discipline->department_id}},'Mise à jour effectuée avec succès' )">
                    <i class="icon fa fa-check"></i>
                  </a>

              <a title={{__("go_back_to_what_you_had")}} onclick="back({{$discipline->id}},'{{$discipline->name}}','{{$discipline->description}}','{{$discipline->responsible}}',{{$discipline->department_id}},{{$discipline->status}})">
                <i class="icon fa fa-reply"></i>
              </a>

              <a title={{__('destroy')}} onclick="destroy({{$discipline->id}})">
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
 <script src="{{ asset('/js/configuration/discipline.js')}}"></script> 
  
@endsection