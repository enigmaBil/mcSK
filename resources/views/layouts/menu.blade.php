
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar main-menu">

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">      

          

          <!-- Optionally, you can add icons to the links -->
          <li>
            <a href="{{ url('/scolarity/report')}}">
                <i class="fa fa-dashboard sidebar-left-icon" style="background-color: #000;"></i> <span>{{__('Dashboard')}}</span>
            </a>
          </li>
          
          <li class="treeview">
            <a href="#"><i class="fa fa-id-card-o sidebar-left-icon" style="background-color: #ff6000;"></i> <span>{{__('scolarity')}}</span>
              <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{url('/scolarity/student')}}">{{__('student')}}</a></li>
              <li><a href="{{url('/scolarity/inscription')}}">{{__('inscription')}} </a></li>
              <li><a href="{{ url('/scolarity/payment')}}">{{__('payment')}} </a></li>
              <li class="treeview"><a href="#"><span>{{__('report')}}</span><span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('/scolarity/report')}}">{{__('Dashboard')}}</a></li>
                        <li><a href="{{ route('report_accounting.index')}}">Comptabilité </a></li>

                    </ul>
                </li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#"><i class="fa fa-edit sidebar-left-icon" style="background-color: #00a65a;"></i> <span>{{__('markManagement')}}</span>
              <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{ url('/mark/startmark')}}">{{__('note student')}} </a></li>
              <li><a href="{{ url('/mark/rattrapage')}}">{{__('note rattrapage')}} </a></li>
              <li><a href="{{ url('/mark/report_card')}}">{{__('report card')}} </a></li>
              
            </ul>
          </li>
          <li class="treeview">
              <a href="#"><i class="fa fa-gears sidebar-left-icon" style="background-color: rgb(255, 0, 0);"></i> <span>{{__('configuration')}}</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
              </a>
              <ul class="treeview-menu">
                  <li><a href="{{ url('/configuration/institution')}}">{{__('institution')}} </a></li>
                  @if(checkCredential('0'))<li><a href="{{ url('configuration/user') }}">{{__('users')}}</a></li>@endif
                  <li><a href="{{ url('scolarity/session') }}">{{__('sessions')}} </a></li>
                  <li><a href="{{ url('/scolarity/academic_year')}}">{{__('academicYears')}}</a></li>
                <li><a href="{{ url('configuration/sequence') }}">{{__('sequences')}} </a></li>
                  <li><a href="{{ url('/configuration/enseignant')}}">{{__('teachers')}} </a></li>
                  <li><a href="{{ url('configuration/department') }}">{{__('departments')}} </a></li>
                  <li><a href="{{ url('configuration/discipline') }}">{{__('disciplines')}} </a></li>
                <li><a href="{{ url('/configuration/level_study')}}">{{__('levels')}}</a></li>
                <li><a href="{{url('/scolarity/slice')}}">{{__('slice')}} </a></li>
                <li><a href="{{ url('configuration/classroom') }}">{{__('classrooms')}} </a></li>
                

                <li><a href="{{ route('module.custom.index') }}">{{__('modules')}} </a></li>
                <li><a href="{{ url('/configuration/course') }}">{{__('courses')}} </a></li>
  
              </ul>
            </li>
        </ul>
        <!-- /.sidebar-menu -->
      </section>
      <!-- /.sidebar -->