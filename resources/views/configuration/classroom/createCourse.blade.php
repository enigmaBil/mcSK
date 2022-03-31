



    <div class="modal fade" id="addCourse">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="frmAddTask">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            {{__('add a new course to this module')}}
                        </h4>
                        <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                            ×
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger" id="Courseadd-error-bag">
                            <ul id="add-task-errors">
                            </ul>
                        </div>
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#course_sequence" data-toggle="tab" aria-expanded="true">{{__('configure percentages')}}</a></li>

                                <li class=""><a href="#new" data-toggle="tab" aria-expanded="false">{{__('new')}}</a></li>

                            </ul>
                            <div class="tab-content">
                                
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
                                <div class="tab-pane " id="new">
                                    <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>
                                                                Nom
                                                            </label>
                                                            <input class="form-control" id="Coursename" required="" type="text">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>
                                                                {{__('content')}}
                                                            </label>
                                                            <input class="form-control" id="Coursecontent" required="" type="text">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>
                                                                {{__('teacher')}}
                                                            </label>
                                                            <select name="" id="AddCourseteacher">
                                                                @foreach ($teachers as $teacher )
                                                                <option value={{$teacher->id}}>{{$teacher->name}}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                            <a href="/configuration/enseignant"> <i class="fa fa-reply-all"></i></a>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>
                                                                {{__('amount hours')}}
                                                            </label>
                                                            <input class="form-control" value="0" id="Courseamount_hour" type="number">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>
                                                                {{__('coefficient')}}
                                                            </label>
                                                            <input class="form-control" id="Coursecoefficient" value="0" name="description" required="" type="number">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>
                                                                {{__('session')}}
                                                            </label>
                                                            <select name="" id="coursesession">
                                                                @if($sessions)
                                                                @foreach ($sessions->where('display', 1) as $session)
                                                                <option value="{{$session->id}}">
                                                                    {{$session->name}}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                            @endif
                                                        </div>
                                                    </div>
                                    </div>
                                    <div class="modal-footer">
                                                <input class="btn btn-default" data-dismiss="modal" type="button" value="{{__('cancel')}}">
                                                <button class="btn btn-info" onclick="addCourse()" type="reset" value="add">
                                                    {{__('save')}}
                                                </button>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>