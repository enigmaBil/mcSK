@extends('layouts.create')
@section('create_content')


<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">

        <li class=""><a href="#new" data-toggle="tab" aria-expanded="false">{{__('new')}}</a></li>
        <li class="active"><a href="#course_sequence" data-toggle="tab" aria-expanded="true">{{__('configure percentages')}}</a></li>

    </ul>
    <div class="tab-content">
        <!-- /.tab-pane -->

        <div class="tab-pane active" id="course_sequence">
            <script>
                course_sequence = [];
            </script>
            <div class="box-body">
                <div class="row">

                    <div style="overflow: scroll" class="col-sm-12">
                        @foreach ($sessions as $session)
                        <br>

                        <div class="row"> @if(count($session->sequences))
                            <div style="color: #00a65a;font-size: large;"><b> {{"session: ".$session->name}} </b></div>@endif
                            <br>
                            @foreach ($session->sequences as $sequence)
                            <script type="text/javascript">
                                function load() {
                                    <?php echo "var id=" . $sequence->id; ?>;
                                    course_sequence[id] = {
                                        'sequence_id': id,
                                        'choice': false,
                                        'percentage': 0
                                    };
                                    console.log(course_sequence)
                                }
                                load()
                            </script>

                            <div>
                                <div class="col-sm-6"> <input type="checkbox" onchange="loadcheck({{$sequence->id}})" name="" id="">

                                    <b style="font-size: medium"> {{$sequence->name}}</b>
                                </div>
                                <div class="col-sm-6"><label for="percentage"> <b>{{('percentage')}}</b></label>
                                    <input list="percentag" style="width:10%;" value="0" id={{"cpercentage".$sequence->id}} required="" type="text">%
                                    <datalist id="percentag">
                                        @for ($i =0 ; $i <=100 ; $i++) <option value="{{$i}}">
                                            @endfor
                                    </datalist>

                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endforeach
                    </div>
                </div>


            </div>



        </div>
        <div class="tab-pane" id="new">
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>{{__('choose a module')}}</label>
                            <select name="" id="Createmodule">
                                @foreach ($modules as $module)
                                @if( $module->classroom->oneDiscipline->display==1 && $module->classroom->oneDiscipline->oneDepartment->display==1 && $module->classroom->oneLevel->display==1 && $module->display==1)
                                <option value="{{$module->id}}">
                                    {{$module->name}}
                                </option>
                                @endif
                                @endforeach
                            </select>
                            <a href="/configuration/moduleIndex">
                                <i class="fa fa-reply-all"></i>
                            </a>
                        </div>
                        <div class="form-group">
                            <label>{{__('choose a teacher')}}</label>
                            <select class="select2" name="" id="Createteacher">
                                @foreach ($teachers as $teacher)
                                <option value="{{$teacher->id}}">
                                    {{$teacher->name}}
                                </option>
                                @endforeach
                            </select>
                            <a href="/configuration/enseignant">
                                <i class="fa fa-reply-all"></i>
                            </a>
                        </div>
                        <div class="form-group">
                            <label>
                                {{__('name')}}
                            </label>
                            <input class="form-control" id="Createname" required="" type="text">
                        </div>
                        <div class="form-group">
                            <label>
                                {{__('amount_hour')}}
                            </label>
                            <input value='0' class="form-control" id="Createamount_hour" required="" type="text">
                        </div>
                        <div class="form-group">
                            <label>
                                {{__('coefficient')}}
                            </label>
                            <input value='0' class="form-control" id="Createcoefficient" required="" type="text">
                        </div>
                        <div class="form-group">
                            <label>
                                {{__('session')}}
                            </label>
                            <select name="" id="Createsession">
                                @if($sessions)
                                @foreach ($sessions->where('display', 1) as $session)
                                <option value="{{$session->id}}">
                                    {{$session->name}}
                                </option>
                                @endforeach
                                @endif
                            </select>
                            <a href="{{ route('session.index') }}" ,>
                                <i class="fa fa-reply-all"></i>
                            </a>
                        </div>

                    </div>
                    <div class="box-footer">
                        <input class="btn btn-default" onclick="return $('#create_new_').toggle(1000);" type="reset" value="Annuler">
                        <tr>
                            <button class="btn btn-info" id="btn-add" type="button" onclick="add()" type="button">
                                {{__('add ')}}
                            </button>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection