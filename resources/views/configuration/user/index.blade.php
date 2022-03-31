@extends('layouts.index')
@section('create')
    @include('configuration.user.create') 
@endsection
@section('nom')
    {{__('user')}}
@endsection
@section('nom2')
    {{__('userList')}}
@endsection
@section('data')
<thead>
    <tr>
      <th>{{__('name')}}</th>
      <th>{{__('email')}}</th>
      <th>{{__('username')}}</th>
      <th>{{__('phone')}}</th>
      <th>{{__('address')}}</th>
      <th>{{__('role')}}</th>
      <th>{{__('actions')}}</th>
    </tr>
</thead>
    <tbody id="tbody">
        @foreach ($users as $user)
            <tr id={{"tr".$user->id}} >
                <form action="" id="{{$user->id}}">
                    <td id={{"name".$user->id}} contenteditable="false">
                    {{$user->name}}
                    </td>
                    <td id={{"email".$user->id}} contenteditable="false">
                    <div> {{$user->email}}</div></td>
                    <td id={{"username".$user->id}} contenteditable="false">
                        <div> {{$user->username}}</div>
                    </td>
                    <td id={{"phone".$user->id}} contenteditable="false">
                            <div> {{$user->phone}}</div>
                    </td>
                    <td id={{"address".$user->id}} contenteditable="false">
                        <div> {{$user->address}}</div></td>
                    <td id={{"role".$user->id}} contenteditable="false">
                        <div class="id_100"> 
                            <select class="form-control select2" name="role" id={{"profile".$user->id}} disabled>
                                @foreach ($profiles as $profile)
                                    <option value="{{$profile->id}}" @if ($profile->id==$user->profile_id)
                                        selected
                                    @endif> {{__($profile->name)}} </option>
                                @endforeach
                             </select>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                        <a  onclick="edit({{$user->id}})">
                            <i class="fa fa-fw fa-pencil"></i>
                        </a>
                            <a  onclick="validate({{$user->id}}, 'Mise à jour effectuée avec succès')">
                                <i class="icon fa fa-check"></i>
                            </a>

                        <a onclick="back('{{$user->id}}','{{$user->name}}','{{$user->email}}','{{$user->username}}','{{$user->phone}}','{{$user->address}}','{{$user->profile_id}}')">
                            <i class="icon fa fa-reply"> </i>
                        </a>

                        <a  onclick="destroy({{$user->id}})">
                                <i class="fa fa-fw fa-trash"></i>
                        </a>
                        </div>

                    </td>
                </form>
            </tr>
        @endforeach
</tbody>
@endsection

@section('js')
<script >//src="{{ asset('/js/configuration/user.js?v=',time())}}"></script> 
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
<!-- DataTables -->
<

<!-- page script -->
<script>
    $(function () {
      $('#example1').DataTable()
      $('#example2').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false
      })
    })
  </script>

  @endsection