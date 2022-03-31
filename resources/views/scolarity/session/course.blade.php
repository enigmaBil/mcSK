@extends('layouts.index')
@section('create')
    @include('configuration.course.create') 
@endsection
@section('nom')
   {{__('course')}}
@endsection
@section('nom2')
    {{__('courseList')}}
@endsection
@section('data')
<thead>
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
      <th>{{__('actions')}} </th>
      <th> <a href="{{route('course.viewpdf')}}"><i class="fa fa-print"></i></a>
      </th>

 


    </tr> 
    </thead>
    <tbody id="tbody">
  @foreach ($courses as $course)
  @if( $course->oneModule->classroom->oneDiscipline->display==1 && $course->oneModule->classroom->oneDiscipline->oneDepartment->display==1 &&  $course->oneModule->classroom->oneLevel->display==1 &&  $course->oneModule->display==1)
  <tr id={{"tr".$course->id}}>
    <form action="" id="{{$course->id}}">
        <td id={{"name".$course->id}} contenteditable="false">{{$course->name}}</td>
        <td id={{"amount_hour".$course->id}} contenteditable="false">{{$course->amount_hour}}</td>
        <td id={{"coefficient".$course->id}} contenteditable="false">{{$course->coefficient}}</td>
        <td id={{"ses".$course->id}} contenteditable="false">
            <select class="form-control select2" id={{"session".$course->id}} disabled>
                @foreach ($sessions->where('display', 1) as $item)
                    <option  value="{{$item->id}}" @if ($item->id==$course->session_id) selected @endif >{{$item->name}}</option>
                @endforeach
              </select>  
        
        </td>
         <td  contenteditable="false">
          <select class="form-control select2" id={{"teacher".$course->id}} disabled>
            @foreach ($teachers as $item)

                <option  value="{{$item->id}}" @if ($item->id==$course->oneteacher->id) selected @endif >{{$item->name}}</option>
            @endforeach
          </select>
        
        
        </td>
        <td contenteditable="false">
            <select class="form-control select2" id={{"discipline".$course->id}} onchange= "return disciplineLevel({{$course->id}})" disabled>
                @foreach ($disciplines as $item)
                    <option  value="{{$item->id}}" @if ($item->id == $course->oneModule->classroom->oneDiscipline->id) selected @endif >{{$item->name}}</option>
                @endforeach
              </select>  
        
        </td> 
        <td  contenteditable="false">
          
            <select class="form-control select2" id={{"level".$course->id}} onchange= "return moduleLevel({{$course->id}})" disabled>
                @foreach ($levels as $item)
                    <option  value="{{$item->id}}" @if ($item->id == $course->oneModule->classroom->oneLevel->id) selected @endif >{{$item->name}}</option>
                @endforeach
              </select>
          </td>    
        <td contenteditable="false">
            <select class="form-control select2" id={{"module".$course->id}}  disabled>
                @foreach ($modules as $item)
                    <option  value="{{$item->id}}" @if ($item->id == $course->oneModule->id) selected @endif >{{$item->name}}</option>
                @endforeach
              </select>
          </td> 
        <td  contenteditable="false">
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
        <td>
            <div class="form-group">
              <a  onclick="edit({{$course->id}})">
                <i class="fa fa-fw fa-pencil"></i>
              </a>
              <a  onclick="validate('{{$course->id}}', '{{$course->oneteacher->id}}',  ' {{$course->oneModule->id}}',
                '{{$course->oneModule->classroom->oneDiscipline->id}}', '{{$course->oneModule->classroom->oneLevel->id}}')">
                  <i class="icon fa fa-check"></i>
              </a>
              <a onclick="back( '{{$course->id}}', '{{$course->name}}', '{{$course->amount_hour}}', '{{$course->coefficient}}', '{{$course->session_id}}', '{{$course->status}}',
              '{{$course->oneteacher->id}}',  ' {{$course->oneModule->id}}',
              '{{$course->oneModule->classroom->oneDiscipline->id}}', '{{$course->oneModule->classroom->oneLevel->id}}'  )">
                <i class="icon fa fa-reply"></i>
              </a>
              <a  onclick="destroy({{$course->id}})">
                  <i class="fa fa-fw fa-trash"></i>
              </a>
            </div>
        </td>
      </form>
  </tr>
  @endif
  @endforeach
</tbody>
@endsection
@section('js')
 @parent
 <script src="{{ asset('/js/configuration/course.js?v=',time())}}"></script> 

<script>
function disciplineLevel(id){
  $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('')
            }
        });
        $.ajax({
            type: 'GET',
            url: '/configuration/disciplineLevel',
            data: {
                discipline_id: $("#discipline"+id).val(),
            },
            dataType: 'json',
            success: function(data) {
             levels=data["levels"]
             option=''
             levels.forEach(element => {
               option += "<option value= '"+element.id+"'> "+element.name+"</option>"
             });
             $('#level'+id)
              .find('option')
              .remove()
              .end()
              .append(option)
            },
            error: function(data) {
                var errors = $.parseJSON(data.responseText);
                
                $.each(errors.messages, function(key, value) {
                    toastada.error(value+"");
                });
            }
        });
}
function moduleLevel(id){
  $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('')
            }
        });
        $.ajax({
            type: 'GET',
            url: '/configuration/levelModule',
            data: {
                discipline_id: $("#discipline"+id).val(),
                level_id: $("#level"+id).val(),
            },
            dataType: 'json',
            success: function(data) {
             modules=data["modules"]
             option=''
             modules.forEach(element => {
               option += "<option value= '"+element.id+"'> "+element.name+"</option>"
             });
             $('#module'+id)
              .find('option')
              .remove()
              .end()
              .append(option)
            },
            error: function(data) {
                var errors = $.parseJSON(data.responseText);
                
                $.each(errors.messages, function(key, value) {
                    toastada.error(value+"");
                });
            }
        });
}
</script>


@endsection