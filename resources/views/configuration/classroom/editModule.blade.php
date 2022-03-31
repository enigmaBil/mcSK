<!-- Add Task Modal Form HTML -->
<div class="modal fade" id="editModuleModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="frmEditModule">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            {{__('Ajouter un Nouveau Module dans cette classe ')}}
                        </h4>
                        <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                            ×
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger" >
                            <ul id="add-task-errors">
                            </ul>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>
                                            {{__('name')}}
                                    </label>
                                    <input class="form-control" name="name"  value="s">
                                </div>
                                <div class="form-group">
                                    <label>
                                            {{__('description')}}
                                    </label>
                                    <input name="description" class="form-control"   required="" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6" >
                                <label for="">{{__('status of the module')}}</label>
                                <div id ="Modulestatus">

                                </div>
                                <div class="form-group">
                                    <label for="">{{__('study level')}}</label>
                                    <select name="" id="SelectLevel">
                                            @if($allLevels)
                                            @foreach ($allLevels as $level)
                                                        <option value={{$level->id}}>
                                                            {{$level->name}}
                                                        </option>
                                            @endforeach
                                             
                                            @endif
                                        </select>
                                    </div>     
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input class="btn btn-default" data-dismiss="modal" type="reset" value="{{__('cancel')}}">
                            <button class="btn btn-info" id="btn-editModule" type="button" >
                                    {{__('modify module')}}
                            </button>
                    </div>
                </form>
            </div>
        </div>
    </div>