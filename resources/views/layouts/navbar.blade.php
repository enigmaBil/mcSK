<header class="main-header">    
        <!-- Logo -->
        <a class="logo" href="{{route('home')}}">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>MC</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>MC-</b>SKOOL</span>
        </a>
    
        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                    <li class="dropdown messages-menu">
                        <a class="nav-link" href="#" id="navbarDropdownFlag" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <img width="27" height="25" alt="{{ session('locale') }}"
                                    src="{!! asset('images/flags/' . session('locale') . '.png') !!}" alt="User Image"/>
                        </a>
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
                    </li>
              <!-- Messages: style can be found in dropdown.less-->
              {{-- <li class="dropdown messages-menu">
                <!-- Menu toggle button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-envelope-o"></i>
                  <span class="label label-success">4</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 4 messages</li>
                  <li>
                    <ul class="menu">
                      <li>
                        <a href="#">
                          <div class="pull-left">
                            
                            <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
                          </div>
                          
                          <h4>
                            Support Team
                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                          </h4>
                         
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li>
                     
                    </ul>
                    
                  </li>
                  <li class="footer"><a href="#">See All Messages</a></li>
                </ul>
                </li
                <li class="dropdown notifications-menu">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bell-o"></i>
                    <span class="label label-warning">10</span>
                  </a>
                  <ul class="dropdown-menu">
                    <li class="header">You have 10 notifications</li>
                    <li>
                      <ul class="menu">
                        <li>
                          <a href="#">
                            <i class="fa fa-users text-aqua"></i> 5 new members joined today
                          </a>
                        </li>
                      </ul>
                    </li>
                    <li class="footer"><a href="#">View all</a></li>
                  </ul>
                </li>
                <li class="dropdown tasks-menu">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-flag-o"></i>
                    <span class="label label-danger">9</span>
                  </a>
                  <ul class="dropdown-menu">
                    <li class="header">You have 9 tasks</li>
                    <li>
                      <ul class="menu">
                        <li>
                          <a href="#">
                            <h3>
                              Design some buttons
                              <small class="pull-right">20%</small>
                            </h3>
                            <div class="progress xs">
                              <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                                  aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                <span class="sr-only">20% Complete</span>
                              </div>
                            </div>
                          </div>
                        </a>
                      </li>
                      <!-- end task item -->
                    </ul>
                  </li>
                  <li class="footer">
                    <a href="#">View all tasks</a>
                  </li>
                </ul>
              </li>--}}
              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
                  <img src="{{asset('storage/avatar/'.auth()->user()->avatar)}}" class="user-image" alt="User Image">
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs">{{auth()->user()->name}}</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- Menu Footer-->
                  <li class="">
                      <a href="{{ route('profile.index')}}" class="">{{__('profile')}}</a>
                  </li>
                  <li>
                      <a class="" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> {{ __('logout') }}</a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="#" data-toggle="control-sidebar" style="display: none;"><i class="fa fa-gears"></i></a>
              </li>
            </ul>
          </div>
        </nav>
</header>