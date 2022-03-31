@extends('layouts.create')
@section('create_content')
 <h4 class="modal-title">{{__('createModule')}} </h4>
<div class="box-body">
        <div class="row">
                <div class="col-sm-9">
                    <div class="form-group">
                        <label >{{__('chooseDiscipline')}}</label>
                            <select name="discipline" id="discipline"  onchange= "leveld();">
                                    @foreach ($disciplines as $discipline)
                                         <option value="{{$discipline->id}}">
                                            {{$discipline->name}}
                                        </option>
                                    @endforeach
                                </select>
                                <a href="/configuration/discipline">
                                    <i class="fa fa-reply-all"></i>
                                </a>
                    </div>
                    <div class="form-group">
                            <label >{{__('chooseLevel')}}</label>
                                <select name="level" id="level">
                                        @foreach ($levels as $level)

                                            <option value="{{$level->id}}">
                                                {{$level->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                    <a href="/configuration/classroom">
                                        <i class="fa fa-reply-all"></i>
                                    </a>
                        </div>
                    <div class="form-group">
                        <label>
                                {{__('entitled')}}
                        </label>
                        <input class="form-control" id="name" required="" type="text">
                    </div>
                    <div class="form-group">
                            <label>
                                    {{__('description')}}
                            </label>
                            <input value='' class="form-control" id="description"  required="" type="text">
                    </div>
                </div>
            </div>
    <div class="box-footer">
        <input class="btn btn-default" onclick="return $('#create_new_').toggle(1000);" type="reset" value="Annuler"> <tr>
                <button class="btn btn-info" id="btn-addModule"  type ="button" onclick="addModule()" type="button" >
                        {{__('add ')}}
                    </button>
    </div>
</div>
@endsection
                   
      

















