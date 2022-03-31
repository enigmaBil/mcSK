<!-- Add session Form HTML -->

<div class="box box-primary" id="addTaskModal">
    <form id="frmAddInscription">
        <div class="box-header">
                <h4 class="modal-title">
                    {{__('add session')}}
                </h4>
            </h4>
        </div>
        <div class="box-body">
                <div class="col-sm-9">
                    <div class="input-group">
                            <label for="name" class="input-group-addon">{{__('entitled')}} <span class="required">*</span></label>
                            <input list="dates" class="form-control"  id="name" required>
                            <datalist id="dates">
                                    @php
                                    $anne=["january","febuary","mars","april","may",
                                    "june","jully","august","september","october","november","december"]
                                    @endphp
                                @foreach ($anne as $month)
                                <option  value={{("".$month)}}>
                                @endforeach
                            </datalist>       
                         
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="input-group">
                        <span for="start_date" class="input-group-addon">{{__('start_date')}}<span class="required">*</span></span>
                        <input id="start_date" type="date" class="form-control" placeholder="{{__('enter....')}}">
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="input-group">
                        <span for="end_date"  class="input-group-addon">{{__('end_date')}} <span class="required">*</span></span>
                        <input id="end_date" type="date" class="form-control" placeholder="{{__('enter....')}}">
                    </div>
                </div>                       
        </div>
            <div class="box-footer">
                <input class="btn btn-default" onclick="return $('#create_new_').toggle(1000);" type="button" value="{{__('cancel')}}"> <tr>
                    <button  onclick="add();" class="btn btn-info" id="btn-add" type="button" value="add">
                            {{__('add session')}}
                    </button>
            </div>
    </form>
</div>
