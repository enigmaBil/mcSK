@extends('layouts.index')
@section('create')
    @include('scolarity.academic_year.create') 
@endsection
@section('nom')
   {{__('academicYear')}}
@endsection
@section('nom2')
    {{__('academic_yearList')}}
@endsection
@section('data')
<thead>
    <tr>
      <th>{{__('name')}}</th>
      <th>{{__('start_date')}}</th>
      <th>{{__('end_date')}}</th>
      <th>{{__('deadline')}}</th>
      <th>{{__('status')}}</th>
      <th>{{__('actions')}}</th>
    </tr> 
</thead>
<tbody id="tbody">
  @foreach ($academic_years as $academic_year)
        <tr id={{"tr".$academic_year->id}}>
          <form action="" id="{{$academic_year->id}}">
              <td contenteditable="false">
                <a title={{('click_to_go_to_his_sessions')}} id={{"name".$academic_year->id}} href="{{ route('academic_year_session.index',$academic_year->id) }}">{{$academic_year->name}}</a>
              </td>
              <td id={{"start_date".$academic_year->id}} contenteditable="false">
                <div> {{$academic_year->start_date}}</div>
              </td>
              <td id={{"end_date".$academic_year->id}} contenteditable="false">
                <div> {{$academic_year->end_date}}</div>
              </td>
              <td id={{"deadline".$academic_year->id}} contenteditable="false">
                <div> {{$academic_year->deadline}}</div>
              </td>
              <td  contenteditable="false">
                  <a  id="{{"status".$academic_year->id}}"> 
                    @php
                      if($academic_year->status ==0){
                          echo("<i title='active' class='icon fa fa-eye-slash'></i>");
                        }
                        else {
                          echo("<i title='inactive' class='icon fa fa-eye'></i>");
                        }                          
                    @endphp
                  </a>
              </td>
              <td>
                  <div class="form-group">
                    <a title="edit"  onclick="edit({{$academic_year->id}})">
                      <i class="fa fa-fw fa-pencil"></i>
                    </a>
                      <a  title='validate' onclick="validate({{$academic_year->id}}, 'Mise à jour effectuée avec succès')">
                          <i class="icon fa fa-check"></i>
                        </a>

                    <a title='back' onclick="back({{$academic_year->id}},'{{$academic_year->name}}','{{$academic_year->start_date}}','{{$academic_year->end_date}}','{{$academic_year->deadline}}','{{$academic_year->status}}')">
                      <i class="icon fa fa-reply"></i>
                    </a>
                    <a  onclick="destroy({{$academic_year->id}})">
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
 <script >//src="{{ asset('/js/scolarity/academic_year.js?v=',time())}}"></script> 
 <script src="{{ asset('/js/scolarity/academic_year.js')}}"></script> 

@endsection