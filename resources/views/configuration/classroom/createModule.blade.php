<!-- Add Task Modal Form HTML -->
<div class="modal fade" id="addModule">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="frmAddTask">
                    <div class="modal-header">
                        <h4 class="modal-title">
                                {{__('add this module in this classroom')}}
                        </h4>
                        <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                            ×
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger" id="Moduleadd-error-bag">
                            <ul id="add-task-errors">
                            </ul>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>
                                            {{__('name')}}
                                    </label>
                                    <input class="form-control" id="modulename" required="" type="text">
                                </div>
                                <div class="form-group">
                                    <label>
                                            {{__('description')}}
                                    </label>
                                    <input class="form-control" id="moduledescription"  required="" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input class="btn btn-default" data-dismiss="modal" type="reset" value="{{__('cancel')}}">
                            <button class="btn btn-info" id="btn-addModule" type="reset" >
                                    {{__('save')}}
                            </button>
                    </div>
                </form>
            </div>
        </div>
    </div>