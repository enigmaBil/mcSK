<!-- Add Inscription Form HTML -->
<div class="box box-primary" id="addTaskModal">
        <form id="frmAddInscription">
            <div class="box-header">
                    <h4 class="modal-title">
                        {{__('add slice')}}
                    </h4>
                </div>
            <div class="box-body">
                <div class="row"> 
                    <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">{{__('entitled')}}<span class="required">*</span></span>
                                <input type="text" id="name" class="form-control" name="name">
                            </div>
                    </div>
                    <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">{{__('deadline')}} </span>
                                <input type="date" class="form-control" id="deadline" name="deadline">
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input class="btn btn-default" data-dismiss="modal" onclick="return $('#create_new_').toggle(1000);" type="reset" value="{{__('cancel')}}">
                        <button class="btn btn-info" id="btn-add" type="reset" value="add"  onclick="add()">
                            {{__ ('save')}}
                        </button>
                </div>
            </div>
        </form>
</div>
