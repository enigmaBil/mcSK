@extends('layouts.index')
@section('create')
    @include('configuration.module.createModule') 
@endsection
@section('nom')
   {{__('module')}}
@endsection
@section('nom2')
    {{__('moduleList')}}
@endsection
@section('data')
<thead>
    <tr>
      <th>{{__('name')}}</th>
      <th>{{__('description')}}</th>
      <th>{{__('courses')}} </th>
      <th>{{__('discipline')}}</th>
      <th>{{__('level')}}</th>
      <th>{{__('status')}}</th>
      <th>{{__('actions')}} </th>
      </th>
    </tr> 
    </thead>
    <tbody id="tbody">
        @foreach ($modules as $module)
            <tr id={{"tr".$module->id}}>
                <td id="{{"name".$module->id}}" contenteditable="false">
                    {{$module->name}}
                </td>
                <td  id={{"description".$module->id}}>
                    {{$module->description}}
                </td>
                <td>
                        <ul class="sidebar-menu tree" data-widget="tree">
                                <li class="treeview">
                                    <a href="#" title="{{__('courseList')}} ">
                                      <span>{{__('courses')}} </span><span class="pull-right-container">
                                            <i class="fa fa-angle-left pull-right"></i>
                                          </span>
                                      </span>
                                    </a>
                                    <ul class="treeview-menu">
                                      @foreach ($module->courses as $item)
                                        <li> {{$item->name}}</li>
                                      @endforeach
                                    </ul>
                                </li>
                              
                              </ul>
                </td>
                <td contenteditable="false">
                        <select class="form-control select2" id={{"discipline".$module->id}} onchange= "return disciplineLevel({{$module->id}})" disabled>
                            @foreach ($disciplines as $item)
                                <option  value="{{$item->id}}" @if ($item->id == $module->classroom->oneDiscipline->id) selected @endif >{{$item->name}}</option>
                            @endforeach
                          </select>  
                    
                    </td> 
                    <td  contenteditable="false">
                      
                        <select class="form-control select2" id={{"level".$module->id}}   disabled>
                            @foreach ($levels as $item)
                                <option  value="{{$item->id}}" @if ($item->id == $module->classroom->oneLevel->id) selected @endif >{{$item->name}}</option>
                            @endforeach
                        </select>
                    </td> 
                    <td  contenteditable="false">
                        <a  id="{{"status".$module->id}}"> 
                            @php
          
                                if($module->status ==0){
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
                            <a  onclick="edit({{$module->id}})">
                                <i class="fa fa-fw fa-pencil"></i>
                            </a>
                            <a  onclick="validate({{$module->id}}, 'Mise à jour effectuée avec succès')">
                                <i class="icon fa fa-check"></i>
                            </a>
                            <a onclick="back({{$module->id}},'{{$module->name}}','{{$module->description}}', '{{$module->classroom->oneDiscipline->id}}', '{{$module->classroom->oneLevel->id}}', '{{$module->status}}')">
                                <i class="icon fa fa-reply"></i>
                            </a>
                            <a  onclick="destroy({{$module->id}})">
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
 <script src="{{ asset('/js/configuration/module.js')}}"></script> 

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
function leveld(){
  $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('')
            }
        });
        $.ajax({
            type: 'GET',
            url: '/configuration/disciplineLevel',
            data: {
                discipline_id: $("#discipline").val(),
            },
            dataType: 'json',
            success: function(data) {
             levels=data["levels"]
             option=''
             levels.forEach(element => {
               option += "<option value= '"+element.id+"'> "+element.name+"</option>";
             });
             $('#level')
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