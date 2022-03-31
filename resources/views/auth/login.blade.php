@extends('layouts.app')

@section('title', 'Connexion')
<link href="{{ asset("css/bootstrap-social.css") }}" rel="stylesheet" type="text/css" />
@section('content')
    <div id="welcome">
        @if (session('credentials'))
            <div class="alert alert-success col-md-8" data-dropdown-in="lightSpeedIn" data-dropdown-out="lightSpeedOut" >
                <a class="panel-close close" data-dismiss="alert">×</a>
                <strong>{{ session('credentials') }}</strong>
            </div>
        @endif
        <div class="row" style="padding-top: 50px;">
            <div class="row" style="">
                <div class="col-sm-12 col-xs-12 col-md-6 col-md-offset-6  ZoomIn animated">
                    <div class="box-connexion">
                        <br />
                        <br />
                        <div class="box-body">
                            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                {{ csrf_field() }}
                                <div class="" style="">
                                    <h2 class="box-title">MC-SKOOL</h2>
                                    <br>
                                </div>
                                <div class="form-group ">
                                    <div class="col-xs-12 ">

                                        <div class="{!! $errors->has('username') ? 'has-error' : '' !!}">
                                            <input id="username" type="text" class="gate form-control" name="username" value="{{ old('username') }}"
                                                   placeholder="Entrer votre login" required /><label for="username">{{__('username')}}</label>
                                            @if ($errors->has('username'))
                                                <span class="help-block" style="line-height: 13px;font-size: 12px;">
                                                    {{ $errors->first('username') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-xs-12 ">

                                        <div class="{{ $errors->has('password') ? ' has-error' : '' }}">
                                            <input id="password" type="password" class="gate form-control" name="password"
                                                   placeholder="Entrer votre mot de passe" required><label for="password">{{__('password')}}</label>
                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{__('rememberMe')}}
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-sign-in">
                                            {{__('login')}}
                                        </button>

                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                                <span style="color: #fff;">
                                                    {{__('forgotPassword')}}
                                                </span>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <div class='row'>
                        <ul class="navbar-nav mr-auto">
                                    <div id="flags" class="dropdown-menu" aria-labelledby="navbarDropdownFlag">
                                        @foreach(['en', 'fr'] as $locale)
                                            @if($locale != session('locale'))
                                                <a class="dropdown-item" href="{{ route('language', $locale) }}">
                                                    <img width="32" height="32" alt="{{ session('locale') }}"
                                                            src="{!! asset('images/flags/' . $locale . '.png') !!}"/>
                                                </a>
                                            @endif
                                        @endforeach
                                    </div>
                            </ul>
                </div>

                <div class="col-sm-12 col-xs-12 col-md-6 col-md-offset-6"  style="text-align: center; color: #fff; text-shadow: 1px 1px #0085c7;">
                    &copy; Mobility Cloud 2019. {{__('all Rights reserved')}}.
                </div>
            </div>
            
        </div>
    </div>
@endsection
@section('jsL')
    
<script src="{{ asset('adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{ asset('adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{ asset('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('adminlte/bower_components/fastclick/lib/fastclick.js')}}"></script>
<script src="{{ asset('adminlte/dist/js/adminlte.min.js')}}"></script>
<script src="{{ asset('adminlte/dist/js/demo.js')}}"></script>
<script src="{{ asset('toast/index.js')}}"></script> 
<script src="{{ asset('toast/script.js')}}"></script>
<script src="{{ asset('adminlte/dist/js/pages/dashboard2.js')}}"></script>
<script src="{{ asset('adminlte/dist/js/pages/dashboard.js')}}"></script>


@endsection