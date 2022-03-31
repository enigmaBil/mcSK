<!-- Add Inscription Form HTML -->
<div class="box box-primary" id="addTaskModal">
        <form id="frmAddInscription">
            <div class="box-header">
                    <h4 class="modal-title">
                        {{__('add Inscription')}}
                    </h4>
                </div>
            <div class="box-body">
                <div class="row"> 
                    <div class="col-sm-4">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <label>{{__('student')}}</label>
                            </div>
                           
                            <select class="form-control select2" id= "student_id"  style="width: 100%;">
                                @foreach ($students as $student )
                                <option value="{{$student->id}}">{{$student->code." : ".$student->first_name." ".$student->last_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> 
                    <div class="col-sm-4">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <label>{{__ ('classroom')}} <span class="required">*</span></label>
                            </div>
                                <select onchange="amount_load();" class="form-control select2" id= "classe" name="classe" style="width: 100%;">
                                    @foreach ($classes as $classe )
                                    <option value="{{$classe->id}}">{{$classe->oneDiscipline->name." : ".$classe->oneLevel->name}}</option>
                                    @endforeach
                                    
                                </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                            <div class="input-group">
                                <label class="input-group-addon">{{__('reduction')}}</label>
                                <input type="text" class="form-control" id="reduction" name="reduction">
                            </div>
                    </div>
                </div>
                   
                <br>
                <div class="row">
                        <div class="col-sm-4">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <label>{{__('academicYear')}} </label>
                                    </div>
                                    <select id="academic_year"class="form-control select2" style="width: 100%;" >
                                            @foreach ($academic_years as $year )
                                            <option value="{{$year->id}}">{{$year->name." : ".$year->start_date." / ".$year->end_date}}</option>
                                            @endforeach
                                    </select>
                                </div>
                        </div>
                        
                        
                        <div class="col-sm-4">
                                <div class="input-group">
                                    <span class="input-group-addon">{{__('education amount')}} </span>
                                    <input disabled type="text" class="form-control" id="amount_education" name="amount">
                                </div>
                        </div>

                        
                </div>
                 <br>
                <div class="row">
                        <div class="col-sm-4">
                                <div class="form-group">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <label>{{__('date')}} </label>
                                        </div>
                                        <input type="datetime-local" class="form-control pull-right" id="date" name="date">
                                    </div>
                                    <!-- /.input group -->
                                </div>
                        </div>
                    <div class="col-sm-4">
                        <div class="input-group">
                            <span class="input-group-addon">{{__('inscription amount')}} </span>
                            <input disabled type="text" class="form-control" id="amount_inscription" >
                        </div>
                    </div>
                   
                </div>
                <div class="modal-footer">
                    <input class="btn btn-default" data-dismiss="modal" onclick="return $('#create_new_').toggle(1000);" type="reset" value="{{__('cancel')}}">
                        <button class="btn btn-info" id="btn-add" type="button" value="add" onclick="create(); this.disabled=true;">
                            {{__ ('save')}}
                        </button>
                </div>
            </div>
        </form>
</div>