@extends('layouts.create')
    @section('create_content')
            <div class="box-header">
                <h4 class="modal-title">{{__('addUser')}}</h4>
            </div>
 
            <div class="box-body">
                    <div class="row">
                            <div class="col-sm-11">
                                <div class="input-group">
                                <span class="input-group-addon">{{__('name')}}</span>
                                        <input id ="name" name="name" type="text" class="form-control" placeholder="{{__('enter....')}}">
                                </div>
                            </div>
                    </div> <br>
                    <div class="row">
                            <div class="col-sm-11">
                                <div class="input-group">
                                <span class="input-group-addon">{{__('username')}}</span>
                                        <input id ="username" name="username" type="text" class="form-control" placeholder="{{__('enter....')}}">
                                </div>
                            </div>
                    </div> <br>
                    <div class="row">
                            <div class="col-sm-11">
                                <div class="input-group">
                                <span class="input-group-addon">{{__('email')}}</span>
                                        <input id ="email" name="email" type="text" class="form-control" placeholder="{{__('enter....')}}">
                                </div>
                            </div>
                    </div> <br>
                    <div class="row">
                        <div class="col-sm-11">
                            <div class="input-group">
                            <span class="input-group-addon">{{__('phone')}}</span>
                                    <input id ="phone" name="phone" type="text" class="form-control" placeholder="{{__('enter....')}}">
                            </div>
                        </div>
                    </div> <br>
                    <div class="row">
                        <div class="col-sm-11">
                            <div class="input-group">
                            <span class="input-group-addon">{{__('address')}}</span>
                                    <input id ="address" name="address" type="text" class="form-control" placeholder="{{__('enter....')}}">
                            </div>
                        </div>
                    </div> <br>
                    <div class="row">
                            <div class="col-sm-11">
                                <div class="input-group">
                                <span class="input-group-addon">{{__('password')}}</span>
                                        <input id ="password" name="password" type="text" class="form-control" placeholder="{{__('enter....')}}">
                                </div>
                            </div>
                    </div><br>
                    <div class="row">
                        <div class="col-sm-11">
                            <div class="input-group">
                                <span class="input-group-addon">{{__('role')}}</span>
                                <select class="form-control select2" name="profile" id="profile">
                                        @foreach ($profiles as $profile)
                                            <option value="{{$profile->id}} ">{{__($profile->name)}}</option>
                                        @endforeach
                                </select>                           
                            </div>
                        </div>
                    </div>
            </div>
            <div class="box-footer">
                    <input class="btn btn-default" onclick="return $('#create_new_').toggle(1000);" type="reset" value="{{__('cancel')}}"> <tr>
                        <button onclick="add();" class="btn btn-info" id="buttonAdd" type="button" value="add">
                            {{__('addUser')}}
                        </button>
            </div>
    @endsection
