<!-- Add sequence Form HTML -->

<div class="box box-primary" id="addTaskModal">
        <form id="frmAddInscription">
            <div class="box-header">
                    <h4 class="modal-title">
                        {{__('add sequence')}}
                    </h4>
                </h4>
            </div>
            <div class="box-body">
                <div class="row">
                        <div class="col-sm-6">
                                <div class="input-group">
                                        <label for="choix_session">{{('session entitled')}} <span class="required">*</span></label>
                                            <select id="session_id">
                                            @foreach ($sessions as $session )
                                            @if($session->display==1)
                                            <option  value="{{$session->id}}">{{$session->name}}
                                             </option>
                                             @endif
                                            @endforeach
                                        </select>
                                </div>

                        </div>
                        <div class="col-sm-6">
                                <div class="input-group">
                                    <label for="name" class="input-group-addon"><b>{{__('entitled ')}} <span class="required">*</b></span></label>
                                    <input id ="name" type="text" class="form-control" placeholder="{{__('enter....')}}">
                                </div>
                        </div>
                        
                        
                </div>
                <br>
                <div class="row">
                        <div class="col-sm-6">
                                <div class="input-group">
                                    <label for="start_date" class="input-group-addon"><b>{{__('start date ')}} <span class="required">*</b></span></label>
                                    <input id ="start_date" type="date"class="form-control" placeholder="{{__('enter....')}}">
                                </div>
                        </div>
                            <div class="col-sm-6">
                                    <div class="input-group">
                                        <label for="end_date" class="input-group-addon"><b>{{__('end date ')}} <span class="required">*</b></span></label>
                                        <input id ="end_date" type="date" class="form-control" placeholder="{{__('enter....')}}">
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
