@extends('layouts.index')
@section('create')
    @include('scolarity.session.create_in_academic_year') 
@endsection
@section('nom')
{{__('session')}} :
@php 
if(isset($name)){
  echo($name);
}

@endphp

@endsection
@section('nom2')
    {{__('sessionList')}}
@endsection
@section('data')
<thead>
  <tr>
    <th>{{__('name')}}</th>
    <th>{{__('start_date')}}</th>
    <th>{{__('end_date')}}</th>
    <th>{{__('status')}}</th>
    <th>{{__('actions')}}</th>
  </tr> 
    </tr>
    </thead>
    <tbody id="tbody">
  
  @foreach ($sessions as $session)
  <tr id={{"tr".$session->id}}>
    <form action="" id="{{$session->id}}">
        <td id={{"name".$session->id}} contenteditable="false">
         {{$session->name}}
        </td>
        <td id={{"start_date".$session->id}} contenteditable="false">
          <div> {{$session->start_date}}</div>
        </td>
        <td id={{"end_date".$session->id}} contenteditable="false">
          <div> {{$session->end_date}}</div>
        </td>
        <td  contenteditable="false">
            <a  id="{{"status".$session->id}}"> 
              @php
                if($session->status ==0){
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
              <a  onclick="edit({{$session->id}})">
                <i class="fa fa-fw fa-pencil"></i>
              </a>
                <a  onclick="validate({{$session->id}}, 'Mise à jour effectuée avec succès')">
                    <i class="icon fa fa-check"></i>
                  </a>

              <a onclick="back({{$session->id}},'{{$session->name}}','{{$session->start_date}}','{{$session->end_date}}', {{$session->status}}')">
                <i class="icon fa fa-reply"></i>
              </a>
              <a  onclick="destroy({{$session->id}})">
                  <i class="fa fa-fw fa-trash"></i>
              </a>
            </div>

        </td>
      </form>
  </tr>
  @endforeach
</tbody>
@endsection
@section('js')
 @parent
 <script src="{{ asset('/js/scolarity/session.js')}}"></script> 
  
@endsection