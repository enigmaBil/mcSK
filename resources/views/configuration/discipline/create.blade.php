<!-- Add discipline Form HTML -->

<div class="box box-primary" id="addTaskModal">
        <form id="frmAddInscription">
            <div class="box-header">
                    <h4 class="modal-title">
                        {{__('add discipline')}}
                    </h4>
                </h4>
            </div>
            <div class="box-body">
                <div class="row">
                        <div class="col-sm-4">
                                <div class="input-group">
                                        <label for="choix_department" class="input-group-addon">{{__('department')}} <span class="required">*</span></label>
                                        <input list="departments" class="form-control" type="text" id="choix_department" required>
                                        <datalist id="departments">
                                            <select class="form-control" id="select">
                                            @foreach ($departments as $department )
                                            @if($department->display==1)
                                            <option data-id="{{$department->id}}" value="{{$department->name}}">
                                                {{$department->name}}
                                             </option>
                                             @endif
                                            @endforeach
                                        </select>
                                        </datalist>
                                </div>
                        </div>
                        <div class="col-sm-4">
                                <div class="input-group">
                                    <label for="name" class="input-group-addon">{{__('responsible')}} 
                                        <span class="required">*</span>
                                        <a href="/configuration/enseignant" title="{{__('gotoTeacher')}} ">
                                            <i class="fa fa-reply-all"></i>
                                        </a> 
                                    </label>
                                    <select id="responsible" class="form-control" name="responsible" required>
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
                </div>
                <br>
                <div class="row">
                       
                        <div class="col-sm-4">
                            <div class="input-group">
                                <label for="name" class="input-group-addon"><b>{{__('entitled')}} <span class="required">*</b></span></label>
                                <input id ="name" type="text" class="form-control" placeholder="{{__('enter....')}}">
                            </div>
                        </div>
                        <div class="col-sm-4">
                                <div class="input-group">
                                    <label for="code" class="input-group-addon"><b>{{__('initiale of the discipline')}} <span class="required">*</b></span></label>
                                    <input id ="code" type="text" class="form-control" placeholder="{{__('enter....')}}">
                                </div>
                            </div>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <label for="description" class="input-group-addon"><b>{{__('description')}}</b></label>
                                <input id="description" type="text" class="form-control" placeholder="{{__('enter....')}}" value=" ">
                            </div>
                        </div>
                        
                </div>                        
            </div>
                <div class="box-footer">
                    <input class="btn btn-default" onclick="return $('#create_new_').toggle(1000);" type="reset" value="{{__('cancel')}}"> <tr>
                        <button  onclick="add2();" class="btn btn-info" id="btn-add" type="reset" value="add">
                                {{__('save')}}
                        </button>
                </div>
        </form>
</div>
