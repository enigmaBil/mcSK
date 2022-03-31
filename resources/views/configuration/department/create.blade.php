@extends('layouts.create')
@section('create_content')
 <h4 class="modal-title">{{__('addDepartment')}}</h4>
<div class="box-body">
    <div class="row">
        <div class="col-sm-9">
            <div class="input-group">
                <span class="input-group-addon">{{__('entitled')}}<span class="required">*</span></span>
                <input id ="name" type="text" class="form-control">
            </div>
        </div>
        <div class="col-sm-9">
            <div class="input-group">
                <label for="name" class="input-group-addon">{{__('head_of_department')}} 
                    <span class="required">*</span>
                    <a href="/configuration/enseignant" title="{{__('gotoTeacher')}} ">
                        <i class="fa fa-reply-all"></i>
                    </a> 
                </label>
                <select id="head_of_department" class="form-control" name="head_of_department" required>
                    @foreach ($teachers as $teacher)
                        @if ($teacher->id !=1)
                            <option value="{{$teacher->id}}">{{__($teacher->name)}}</option> 
                           
                        @else
                        <option value="{{$teacher->id}}">{{__('no head of Department')}}</option> 

                            
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="input-group">
                <span class="input-group-addon">{{__('amountScolarity')}}</span>
                <input id="scolarity" type="number" class="form-control" value="0">
            </div>
        </div>                        
    </div>
    <div class="box-footer">
        <input class="btn btn-default" onclick="return $('#create_new_').toggle(1000);" type="reset" value="{{__('cancel')}}"> <tr>
            <button onclick="add();" class="btn btn-info" id="btn-add"  type="reset" value="add">
                    {{__('save')}}
            </button>
    </div>
</div>
@endsection
                   
      
