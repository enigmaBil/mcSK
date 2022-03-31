@extends('layouts.index')
@section('create')
@if(isset($name)) 
@include('configuration.sequence.create_in_session') 
    
@else
  @include('configuration.sequence.create') 

@endif
@endsection
@section('nom')
@if(isset($name)) 
{{__('sequences of the session')}} :{{$name}};

@endif

@endsection
@section('nom2')
    {{__('sequenceList')}}
@endsection
@section('data')
<thead>
    <tr>
      <th alt='une sequence'>{{__('entitled')}}</th>
      <th>{{__('start_date')}}</th>
      <th>{{__('end_date')}}</th>
      <th>{{__('session')}}</th>
      <th>{{__('rattrapage')}} ?</th>

      <th>{{__('actions')}}</th>
    </tr>
    </thead>
    <tbody id="tbody">
  
  @foreach ($sequences as $sequence)

  
  <tr id={{"tr".$sequence->id}}>
    <form action="" id="{{$sequence->id}}">
    <td id={{"name".$sequence->id}} contenteditable="false">
            {{$sequence->name}}
        </td>
        <td id={{"start_date".$sequence->id}} contenteditable="false">
            <div> {{$sequence->start_date}}</div>
          </td>
         <td id={{"end_date".$sequence->id}} contenteditable="false">
          <div> {{$sequence->end_date}}</div>
        </td>
        <td contenteditable="false">
            <select class="form-control select2" id={{"session_id".$sequence->id}}  disabled>
              @foreach ($sessions as $item)
                <option  value="{{$item->id}}" @if ($item->id == $sequence->session_id) selected @endif >{{$item->name}}</option>
              @endforeach
            </select>
        </td> 
       
        <td  class="rattrapage" contenteditable="false">
                
          @if ($sequence->status==0)          
          <a id ={{"status".$sequence->id}} onclick="createrattrapage({{$sequence->id}})">
            <i class="icon fa fa-close"></i>

            @else
            <a id ={{"status".$sequence->id}} >
              <span class="glyphicon glyphicon-ok"></span>

        
          @endif
          </a>
          
          </td>

        <td>
            <div class="form-group">
              <a title={{__("edit")}} onclick="edit({{$sequence->id}})">
                <i class="fa fa-fw fa-pencil"></i>
              </a>
                <a title={{__("save")}} onclick="validate({{$sequence->id}},'Mise à jour effectuée avec succès' )">
                    <i class="icon fa fa-check"></i>
                  </a>

              <a title={{__("go_back_to_what_you_had")}} onclick="back({{$sequence->id}},'{{$sequence->name}}','{{$sequence->start_date}}','{{$sequence->end_date}}','{{$sequence->session_id}}')">
                <i class="icon fa fa-reply"></i>
              </a>

              <a title={{__('destroy')}} onclick="destroy({{$sequence->id}})">
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
 <script src="{{ asset('/js/configuration/sequence.js')}}"></script> 
  
@endsection