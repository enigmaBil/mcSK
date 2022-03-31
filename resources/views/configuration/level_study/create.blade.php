<!-- Add discipline Form HTML -->
<div class="box box-primary" id="addTaskModal">
        <form id="frmAddInscription">
            <div class="box-header">
                    <h4 class="modal-title">
                            {{__('add level')}}

                    </h4>
            </div>
            <div class="box-body">
                <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">{{__('name')}}</span>
                                <input id="name" type="text" class="form-control" placeholder="{{__('enter....')}}">
                            </div>
                            <div class="input-group">
                                    <span class="input-group-addon">{{__('description')}}</span>
                                            <input id="description" type="text" class="form-control" placeholder="{{__('enter....')}}">
                                </div>
                        </div>
                        <div class="col-sm-6">
                            
                        </div>                        
                </div>
                <div class="box-footer">
                    <input class="btn btn-default" onclick="return $('#create_new_').toggle(1000);" type="reset" value="{{__('cancel')}}"> <tr>
                        <button onclick="add();" class="btn btn-info" id="btn-add" type="reset" value="add">
                                {{__('save')}}
                        </button>
                </div>
        </div>
        </form>
</div>
