@extends('layouts.index')

@section('create')
    @include('configuration.level_study.create') 
@endsection
@section('nom')
{{__('level')}}

@endsection

@section('data')
<thead>
    <tr>
      <th>{{__('level')}}</th>
      <th>{{__('description')}}</th>
      <th>{{__('action')}}</th>

    </tr>
    </thead>
    <tbody id="tbody">
  
  @foreach ($level_studies as $level)
 @php
 /**adapter sur la nouvelle interface de carole et faire attention parceque le js etait deja prêt**/
    $levelId= $level->id;

 @endphp
  <tr id={{"tr".$levelId}}>
    <form action="" id="{{$levelId}}">
        <td id={{"name".$levelId}} contenteditable="false">
          {{$level->name}}
        </td>
         <td id={{"description".$levelId}} contenteditable="false">
          <div> {{$level->description}}</div></td>
       
        <td>
            <div class="form-group">
              <a  onclick="edit({{$levelId}})">
                <i class="fa fa-fw fa-pencil"></i>
              </a>
                <a  onclick="validate({{$level->id}}, 'Mise à jour effectuée avec succès')">
                    <i class="icon fa fa-check"></i>
                  </a>

              <a onclick="back('{{$levelId}}','{{$level->name}}',
                '{{$level->description}}')">
                <i class="icon fa fa-reply"></i>
              </a>
              <a  onclick="destroy({{$level->id}})">
                  <i class="icon fa fa-trash"></i>
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
 <script src="{{ asset('/js/configuration/level.js')}}"></script> 
  
@endsection