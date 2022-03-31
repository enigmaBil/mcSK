@extends('layouts.create')
@section('create_content')
 <h4 class="modal-title">{{__('addAcademic_year')}}</h4>
<div class="box-body">
    <div class="row">
        <div class="col-sm-6">
            <div class="input-group">
                <label for="name" class="input-group-addon">{{__('entitled')}} <span class="required">*</span></label>
                    <input list="academic_date" type="text" id="name" required>
                    <datalist id="academic_date">
                            @php
                            $date=date('Y')."";
                         $anne=0;
                           $anne= intval($date);
                            $anne=$anne-1;

                            @endphp
                        @for ($i=0 ; $i<10 ; $i++)
                        @php
                            $anne=$anne+1;
                        @endphp
                     <option >{{date('Y')."/".$anne}}</option>
                        @endfor
                        
                                                </datalist>         
            </div>
        </div>
        <div class="col-sm-6">
            <div class="input-group">
                <label for="start_date" class="input-group-addon">{{__('start_date')}} <span class="required">*</span></label>
                <input id="start_date" type="date" class="form-control" >
            </div>
        </div>
        <div class="col-sm-6">
            <div class="input-group">
                <label for="end_date" class="input-group-addon">{{__('end_date')}} <span class="required">*</span></label>
                <input id="end_date" type="date" class="form-control" >
            </div>
        </div>   
        <div class="col-sm-6">
            <div class="input-group">
                <label for="deadline" class="input-group-addon">{{__('deadline')}} <span class="required">*</span></label>
                <input id="deadline" type="date" class="form-control" >
            </div>
        </div>                     
    </div>
    <div class="box-footer">
        <input class="btn btn-default" onclick="return $('#create_new_').toggle(1000);" type="reset" value="{{__('cancel')}}"> <tr>
            <button onclick="add();" class="btn btn-info" id="btn-add"  type="button" value="add">
                    {{__('save')}}
            </button>
    </div>
</div>
@endsection
                   
      
