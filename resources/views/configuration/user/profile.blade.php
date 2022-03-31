
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>

<style>
        .kv-avatar .krajee-default.file-preview-frame,.kv-avatar .krajee-default.file-preview-frame:hover {
            margin: 0;
            padding: 0;
            border: none;
            box-shadow: none;
            text-align: center;
        }
        .kv-avatar {
            display: inline-block;
        }
        .kv-avatar .file-input {
            display: table-cell;
            width: 213px;
        }
        .kv-reqd {
            color: red;
            font-family: monospace;
            font-weight: normal;
        }
        </style>
@endsection

@extends('layouts.index')
    @section('main')
    <div class="col">
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#Profile" data-toggle="tab" aria-expanded="false">Profile</a></li>
                <li class=""><a href="#changePassword" data-toggle="tab" aria-expanded="false">{{__('reset Password')}} </a></li>
              </ul>
              <div class="tab-content">
                <!-- /.tab-pane -->
                <div class="tab-pane active" id="Profile">
                                <div class="box-header">
                                    <h3 class="box-title">
                                        {{__('Profile')}}
                                        <a  onclick="editProfile()">
                                            <i class="fa fa-fw fa-pencil"></i>
                                        </a>
                                    </h3>
                                </div>
                                <div class="box-body">
                                <div class="col-sm-8">
                                    <div class="row">
                                            <div class="col-sm-11">
                                                <div class="input-group">
                                                    <span class="input-group-addon">{{__('name')}}</span>
                                                    <input id ="name" name="name" type="text" class="form-control" value="{{$user->name}}" disabled>
                                                </div>
                                            </div>
                                    </div> <br>
                                    <div class="row">
                                            <div class="col-sm-11">
                                                <div class="input-group">
                                                <span class="input-group-addon">{{__('username')}}</span>
                                                        <input id ="username" name="username" type="text" class="form-control" value="{{$user->username}}" disabled>
                                                </div>
                                            </div>
                                    </div> <br>
                                    <div class="row">
                                            <div class="col-sm-11">
                                                <div class="input-group">
                                                <span class="input-group-addon">{{__('email')}}</span>
                                                        <input id ="email" name="email" type="text" class="form-control" value="{{$user->email}}" disabled>
                                                </div>
                                            </div>
                                    </div> <br>
                                    <div class="row">
                                        <div class="col-sm-11">
                                            <div class="input-group">
                                                <span class="input-group-addon">{{__('phone')}}</span>
                                                <input id ="phone" name="phone" type="text" class="form-control" value="{{$user->phone}}" disabled>
                                            </div>
                                        </div>
                                    </div> <br>
                                    <div class="row">
                                        <div class="col-sm-11">
                                            <div class="input-group">
                                                <span class="input-group-addon">{{__('address')}}</span>
                                                <input id ="address" name="address" type="text" class="form-control" value="{{$user->address}}" disabled>
                                            </div>
                                        </div>
                                    </div> <br>
                                    <div class="row">
                                        <div class="col-sm-11">
                                            <div class="input-group">
                                                <span class="input-group-addon">{{__('role')}}</span>
                                                <select class="form-control select2" name="profile" id="profile" disabled>
                                                        @foreach ($profiles as $profile)
                                                            <option value="{{$profile->id}} " @if ($profile->id==$user->profile_id)
                                                                selected
                                                            @endif >{{__($profile->name)}}</option>
                                                        @endforeach
                                                </select>                           
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-footer" style="display:none;" id="validate">
                                        <input class="btn btn-default" type="button" onclick="back('{{$user->id}}','{{$user->name}}','{{$user->email}}','{{$user->username}}','{{$user->phone}}','{{$user->address}}','{{$user->profile_id}}');" value="{{__('cancel')}}"><tr> <tr>
                                            <button onclick="validateProfile({{$user->id}}, 'Profil mis à jour avec succès');" class="btn btn-success" id="buttonAdd" type="button" value="add">
                                                {{__('Save')}}
                                            </button>
                                </div>
                                </div>
                                <div class="col-sm-4 text-center">
                                        <div class="kv-avatar">
                                            <div class="file-loading">
                                                <input id="input-b1" name="avatar" type="file" required>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            
                </div>
                <!-- /.tab-pane -->
  
                <div class="tab-pane" id="changePassword">
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Preveiw Password') }}</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>
                                <div class="col-md-6">
                                    <input id="newPassword" type="password" class="form-control @error('password') is-invalid @enderror" name="newPassword" required autocomplete="new-password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                                <div class="col-md-6">
                                    <input id="confirmPassword" type="password" class="form-control" name="password_confirmation" required autocomplete="confirmPassword">
                                </div>
                            </div>
    
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <input type="button" onclick="changePassword();" class="btn btn-primary" value="{{__('save')}} ">
                                </div>
                            </div>
                    </div>
                </div>
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
 @endsection


@section('js')

<script src="{{ asset('/js/configuration/user.js')}}"></script> 

@parent
<!-- jQuery 3 -->
<!-- Bootstrap 3.3.7 -->
<!-- DataTables -->
<script src="{{ asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{ asset('adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{ asset('adminlte/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('adminlte/dist/js/demo.js')}}"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>
<script src='https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/themes/fa/theme.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" type="text/javascript"></script>
<script>
    $(function(){
        $("#input-b1").fileinput({
            language: 'fr',
            theme: 'fa',
            uploadUrl: "{{route('profile.image')}}",
            uploadExtraData: function() {
                return {
                    _token: "{{csrf_token() }}",
                };
            },
            defaultPreviewContent: '<img src="{{asset('storage/avatar/'.auth()->user()->avatar)}}" width="250px">',
            allowedFileExtensions: ['jpg', 'png', 'gif','jpeg'],
            overwriteInitial: false,
            'previewFileType':'any',
        });
    });
 
</script>
@endsection
