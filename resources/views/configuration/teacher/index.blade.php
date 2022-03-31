@extends('layouts.index')
@section('create')
    @include('configuration.teacher.create') 
@endsection
@section('nom')
   {{__('teacher')}}
@endsection
@section('nom2')
    {{__('teacherList')}}
@endsection
@section('data')
  <thead>
    <tr>
      <th>{{__('code')}}</th>
      <th>{{__('name')}}</th>
      <th>{{__('speciality')}}</th>
      <th>{{__('studyLevel')}}</th>
      <th>{{__('course')}}</th>
      <th>{{__('gender')}}</th>
      <th>{{__('contact')}}</th>
      <th>{{__('address')}}</th>
      <th>{{__('status')}}</th>
      <th>{{__('department')}}</th>
      <th>{{__('email')}}</th>
      <th>{{__('number_of_hour')}}</th>
      <th>{{__('salary')}}</th>
      <th>{{__('actions')}}</th>
    </tr> 
  </thead>
    <tbody id="tbody">
  @foreach ($teachers as $teacher)
  <tr id={{"tr".$teacher->id}}>
    <form action="" id="{{$teacher->id}}">
            <td id={{"code".$teacher->id}} contenteditable="false">
                    {{__($teacher->code)}}
                  </td>
        <td id={{"name".$teacher->id}} contenteditable="false">
          {{__($teacher->name)}}
        </td>
        <td id={{"speciality".$teacher->id}} contenteditable="false">
           {{$teacher->speciality}}</td>
        <td id={{"study_level".$teacher->id}} contenteditable="false">
            {{$teacher->study_level}}</td>
        <td id={{"courses".$teacher->id}}>
            <ul class="sidebar-menu tree" data-widget="tree">
              <li class="treeview">
                  <a href="#" title="{{__('courseList')}} ">
                    <span>{{__('courses')}}</span><span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                      </span>
                  </a>
                  <ul class="treeview-menu">
                    @foreach ( $teacher->courses as $course )
                      <li> {{$course->name }}</li>
                    @endforeach
                  </ul>
              </li>
            
            </ul>
                </td>
        <td id={{"sex".$teacher->id}} contenteditable="false">
                    {{$teacher->sex}}</td>
         <td id={{"contact".$teacher->id}} contenteditable="false">
                        {{$teacher->contact}}</td>   
        <td id={{"address".$teacher->id}} contenteditable="false">
                            {{$teacher->address}}</td> 
       <td  contenteditable="false">
            <select class="form-control" disabled id="{{"status".$teacher->id}}"> 
                <option @if($teacher->status==0) selected @endif value="0">{{__('inactive')}}</option>
                <option @if($teacher->status==1) selected  @endif value="1">{{__('permanent')}}</option>
                <option @if($teacher->status==2) selected @endif value="2">{{__('vacataire')}} </option>
            </select>
        </td>
        <td id="depart" contenteditable="false">
            <select class="form-control" disabled id="{{"department".$teacher->id}}">
              <option value="0"></option>
              @foreach ($departments as $department )
              <option @if($teacher->department_id==$department->id) selected @endif value={{$department->id}}>{{$department->name}}</option>

              @endforeach
               
            </select>
        </td>
        <td id={{"email".$teacher->id}} contenteditable="false">
            {{$teacher->email}}</td> 
        
        <td id={{"number_of_hour".$teacher->id}} contenteditable="false">
                {{$teacher->number_of_hour}}</td> 
        <td id={{"salary".$teacher->id}} contenteditable="false">
                    {{$teacher->salary}}</td> 
        <td>
            <div class="form-group">
              <a  onclick="edit({{$teacher->id}})">
                <i class="fa fa-fw fa-pencil"></i>
              </a>
                <a  onclick="validate({{$teacher->id}})">
                    <i class="icon fa fa-check"></i>
                  </a>

              <a onclick="back({{$teacher->id}},'{{$teacher->code}}','{{$teacher->name}}','{{$teacher->speciality}}','{{$teacher->study_level}}','{{$teacher->sex}}','{{$teacher->contact}}',
              '{{$teacher->address}}',{{$teacher->status}})">
                <i class="icon fa fa-reply"></i>
              </a>
              <a  onclick="destroy({{$teacher->id}})">
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
 <script >//src="{{ asset('/js/configuration/teacher.js')}}"></script> 
  <script src="{{ asset('/js/configuration/teacher.js')}}"></script>
@endsection