@extends('layouts.layout')
@section('css')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
   


@parent
<link rel="stylesheet" href="{{ asset('/mdb/css/mdb.min.css')}}">
<link rel="stylesheet" href="{{ asset('/mdb/css/style.min.css')}}">
    
<style type="text/css">
        html,
        body,
        header,
        .carousel {
          height: 60vh;
        }
    
        @media (max-width: 740px) {
    
          html,
          body,
          header,
          .carousel {
            height: 100vh;
          }
        }
    
        @media (min-width: 800px) and (max-width: 850px) {
    
          html,
          body,
          header,
          .carousel {
            height: 100vh;
          }
        }
</style>

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
@section('page_header')
     <div class="col">
         @if (Session::get('status') == 'success')
             <div class="alert alert-success alert-block" style="text-align: center;">
                 <button type="button" class="close" data-dismiss="alert">x</button>
                 <strong>{{Session::get('message')}}</strong>
             </div>
         @endif
         @if($errors->any())
             <div class="alert alert-info alert-block" style="text-align: center;">
                 <button type="button" class="close" data-dismiss="alert">x</button>
                 <strong>{{$errors->first()}}</strong>
             </div>
         @endif
         @if (Session::get('status') == 'danger')
             <div class="alert alert-danger alert-block" style="/*padding-top: 50px; */text-align: center;">
                 <button type="button" class="close" data-dismiss="alert">x</button>
                 <strong>{{Session::get('message')}}</strong>
             </div>
         @endif

         @if (Session::get('status') == 'info')
             <div class="alert alert-info alert-block" style="/*padding-top: 50px; */text-align: center;">
                 <button type="button" class="close" data-dismiss="alert">x</button>
                 <strong>{{Session::get('message')}}</strong>
             </div>
         @endif
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#Profile" data-toggle="tab" aria-expanded="true">{{__('profile')}}</a></li>
            <li class=""><a href="#Localisation" data-toggle="tab" aria-expanded="false">{{__('Localisation')}}</a></li>
            <li class=""><a href="#changePassword" data-toggle="tab" aria-expanded="false">{{__('Change the logo')}} </a></li>
          </ul>
          <div class="tab-content">
                <!-- /.tab-pane -->
                <div class="tab-pane active" id="Profile">
                        <div class="box-body">
                            <div class="col-sm-8">
                                {{--<form method="PUT" action="{ route('institution.update', $institution->id ) }}">--}}
                                {!! Form::model($institution, ['route' => ['institution.update', $institution->id], 'method' => 'put']) !!}
                                    <div class="mdb-form">
                                        <b>  <span class="mdb-form-addon">{{__('name')}}</span></b>
                                            <input  required value="{{$institution->name}}" name="name" id ="name" type="text" class="form-control" placeholder="{{__('enter....')}}">
                                    </div>
                                    <div class="mdb-form">
                                        <b> <span class="mdb-form-addon">{{__('email')}}</span></b>
                                        <input  value="{{$institution->email}}" name="email" id ="email" type="email" class="form-control" placeholder="{{__('enter....')}}">
                                    </div>
                                    <div class="mdb-form">
                                        <b>  <span class="mdb-form-addon">{{__('access link')}}</span></b>
                                            <input disabled value="{{$institution->domain.""}}" name="domain" id="domain" type="text" class="form-control" placeholder="{{__('enter....')}}">
                                    </div>
                                  {{--  <div class="mdb-form">
                                            <b>  <span class="mdb-form-addon">{{__('activities')}}</span></b>
                                                <input value="{{$institution->activities.""}}" name="activity" id="activities" type="text" class="form-control" placeholder="{{__('enter....')}}">
                                        </div>--}}
                                    <div class="mdb-form">
                                        <b>    <span class="mdb-form-addon">{{__('activity domaine')}}</span></b>
                                            <input value="{{$institution->activity.""}}" name="activity" id ="activity" type="text" class="form-control" placeholder="{{__('enter....')}}">
                                    </div>
                                   {{-- <div class="mdb-form">
                                            <b>    <span class="mdb-form-addon">{{__('creation title')}}</span></b>
                                                <input value="{{$institution->creation_title.""}}" name="creation_title" id ="creation_title" type="text" class="form-control" placeholder="{{__('enter....')}}">
                                    </div>--}}
                                    <div class="form-group row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('validate') }}
                                                </button>
                                            </div>
                                    </div>
                                {!! Form::close() !!}
                                {{--</form>--}}
                            </div>
                        </div>
                </div>

                <div class="tab-pane" id="Localisation">
                    <div class="box-body">
                            @if ($errors->any())
                            <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            </div><br>
                        @endif
                        <div class="col-sm-8">
                            <form method="POST" action="{{ route('institution.update', $institution->id ) }}">
                                    @method('PATCH') 
                                    @csrf
                                <div class="mdb-form">
                                    <b><span class="mdb-form-addon">{{__('address')}}</span></b>
                                        <input name="address" id ="address" type="text" class="form-control" value="{{$institution->address}}">
                                </div>
                                <div class="mdb-form">
                                    <b><span class="mdb-form-addon">{{__('postal-box')}}</span></b>
                                        <input name="postal_box" id ="postal-box" type="text" class="form-control" value="{{$institution->postal_box}}">
                                </div>
                                <div class="mdb-form">
                                    <b> <span class="mdb-form-addon">{{__('country')}}</span></b>
                                        <input value="{{$institution->country}}" name="country" id ="country" type="text" class="form-control" >
                                </div>
                                <div class="mdb-form">
                                    <b> <span class="mdb-form-addon">{{__('region')}}</span></b>
                                        <input value="{{$institution->region}}" name="region" id ="region" type="text" class="form-control" placeholder="{{__('enter....')}}">
                                </div>
                                <div class="mdb-form">
                                    <b><span class="mdb-form-addon">{{__('city')}}</span></b>
                                        <input value="{{$institution->city}}" name="city" id ="city" type="text" class="form-control" placeholder="{{__('enter....')}}">
                                </div>
                                <div class="mdb-form">
                                    <b> <span class="mdb-form-addon">{{__('phone')}}</span></b>

                                        <input value="{{$institution->phone}}" name="phone" id ="phone" type="text" class="form-control" placeholder="{{__('enter....')}}">
                                </div>
                                <div class="mdb-form">
                                        <b><span class="mdb-form-addon">{{__('website')}}</span></b>
                                            <input name="website" id ="website" type="text" class="form-control" value="{{$institution->website}}">
                                    </div>
                                <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('validate') }}
                                            </button>
                                        </div>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                
                </div>
            
                <!-- /.tab-pane -->

                <div class="tab-pane" id="changePassword">
                    <div class="row">
                        <br>
                            <div class="col-sm-6 text-center">
                                    <div class="kv-avatar">
                                        <div class="file-loading">
                                            <input id="input-b1" name="logo" type="file" required>
                                        </div>
                                    </div>
                            </div>
                            <div class="col-sm-6 text-center">
                                    <img src="{{ asset('/images/institutions/'.$institution->logo)}}" width="35%" alt="" srcset="">
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
                uploadUrl: '/configuration/institutionPic/'+ {{$institution->id}},
                uploadExtraData: function() {
                    return {
                        _token: "{{csrf_token() }}",
                    };
                },
                defaultPreviewContent: '<img src="{{asset('images/institutions/'.$institution->logo)}}" width="250px">',
                allowedFileExtensions: ['jpg', 'png', 'gif','jpeg'],
                overwriteInitial: false,
                'previewFileType':'any',
            });
        });
     
</script>
 @parent

 <script src="{{ asset('/js/configuration/institution.js')}}"></script> 
  
@endsection