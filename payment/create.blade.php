<!-- Add Inscription Form HTML -->
<div class="box box-primary" id="addTaskModal">
        <form id="frmAddInscription">
            <div class="box-header">
                    <h4 class="modal-title">
                        {{__('add payment')}}
                    </h4>
                </div>
            <div class="box-body">
                <div class="row"> 
                   
                    <div class="col-sm-4">
                            <div class="input-group">
                                <span class="input-group-addon">Inscription N°</span>
                                <input type="text" id="inscriptionId" class="form-control"@if(isset($inscriptionId)) value={{$inscriptionId}} @endif name="reduction">
                            </div>
                    </div>
                    <div class="col-sm-4">
                            <div class="input-group">
                                <span class="input-group-addon">{{__('amount')}} </span>
                                <input type="text" class="form-control" id="amount" name="amount">
                            </div>
                    </div>
                </div>
                   
                <br>
                
              
                <div class="modal-footer">
                    <input class="btn btn-default" data-dismiss="modal" onclick="return $('#create_new_').toggle(1000);" type="button" value="{{__('cancel')}}">
                        <button class="btn btn-info" id="btn-add" type="button" value="add" @if(isset($inscriptionId))onclick="create({{$inscriptionId}});"@endif @if(!isset($inscriptionId)) onclick="create()"@endif>
                            {{__ ('add new inscription')}}
                        </button>
                </div>
            </div>
        </form>
</div>