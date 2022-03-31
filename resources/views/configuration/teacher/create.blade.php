<!-- Add discipline Form HTML -->
<div class="box box-primary" id="addTaskModal">
    <form id="frmAddInscription">
        <div class="box-header">
                <h4 class="modal-title">
                    {{__('addTeacher')}}
                </h4>
        </div>
        <div class="box-body">
            <div class="row">
                 <div class="col-sm-4">
                        <div class="input-group">
                            <label for="code" class="input-group-addon">{{__('code')}}</label>
                            <input id="code" type="text" class="form-control" placeholder="{{__('enter....')}}">
                        </div>
                        <div class="input-group">
                            <label for="name" class="input-group-addon">{{__('name')}}</label>
                            <input id="name" type="text" class="form-control" placeholder="{{__('enter....')}}">
                        </div>
                        <div class="input-group">
                            <label for="study_level" class="input-group-addon">{{__('diploma')}}</label>
                            <input id="study_level" type="text" class="form-control" placeholder="{{__('enter....')}}">
                        </div>
                        <div class="input-group">
                            <label for="speciality" class="input-group-addon">{{__('speciality')}}</label>
                            <input id="speciality" type="text" class="form-control" placeholder="{{__('enter....')}}">
                        </div>
                </div>
                <div class="col-sm-4">
                        <div class="input-group">   
                            <label for="address" class="input-group-addon">{{__('adress')}}</label>
                            <input id="address" type="text" class="form-control" placeholder="{{__('enter....')}}">
                        </div>
                        <div class="input-group">   
                            <label for="contact" class="input-group-addon">{{__('contact')}}</label>
                            <input id="contact" type="text" class="form-control" placeholder="{{__('enter....')}}">
                        </div>
                        <div class="input-group">
                            <label for="sex" class="input-group-addon">{{__('gender')}}</label>
                            <input id="sex" type="text" class="form-control" placeholder="Entrer M ou F">
                        </div>
                        <div class="input-group">
                            <label for="status"  class="input-group-addon"> {{('status')}}</label>
                            <select name="status" class="form-control" id="status">
                                <option value="0">{{__('inactive')}}</option>
                                <option value="1">{{__('permanent')}}</option>
                                <option value="2">{{__('vacataire')}} </option>
                            </select>
                        </div>   
                </div>
                <div class="col-sm-4">
                        <div class="input-group">   
                            <label for="address" class="input-group-addon">{{__('email')}}</label>
                            <input id="email" type="email" class="form-control" placeholder="{{__('enter....')}}">
                        </div>
                        <div class="input-group">   
                                <label for="address" class="input-group-addon">{{__('number_of_hour')}}</label>
                                <input id="number_of_hour" type="number" class="form-control" placeholder="{{__('enter....')}}">
                        </div>
                        <div class="input-group">   
                                <label for="address" class="input-group-addon">{{__('salary')}}</label>
                                <input id="salary" type="number" class="form-control" placeholder="{{__('enter....')}}">
                        </div>
                        <div class="input-group">
                            <label for="department" class="input-group-addon"  > {{__('department')}}</label>
                                <select name="department" class="form-control" id="department">
                                    <option value="0"></option>
                                    @foreach ($departments as $department )
                                        <option value={{$department->id}}>{{$department->name}}</option>
                                    @endforeach
                                </select>
                        </div>   

                </div>
            </div>
            <div class="box-footer">
                <input class="btn btn-default" onclick="return $('#create_new_').toggle(1000);" type="reset" value="{{__('cancel')}}"> <tr>
                    <button onclick="add();" class="btn btn-info" id="btn-add" type="button" value="add">
                        {{__('addTeacher')}}
                    </button>
            </div>
        </div>
    </form>
</div>
