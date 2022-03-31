
  <div class="box-body table-responsive">
      <div class="form-group">
          <a title={{__("edit")}} onclick="edit()">
              <i class="fa fa-fw fa-pencil"></i>
          </a>
          <a title={{__("save")}} onclick="validate({{$course->id}},{{$course->oneModule->classroom->id}})">
              <i class="icon fa fa-check"></i>
          </a>
      </div>
    <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th colspan="3">{{__('students')}}</th>
            @foreach ($academic_year->sessions as $session )
            <th colspan="{{count($session->session->sequences)+1}}"> {{$session->session->name}}</th>

            @endforeach
          
            <th rowspan="2"><a href="http://"> <i class="fa fa-check"></i></a>{{('general')}} {{__('avg')}}</th>
          </tr>
          <tr>
          <td>{{__('matricule')}}</td>
          <td>{{__('last name')}}</td>
          <td>{{__('first name')}}</td>


            @foreach ( $academic_year->sessions as $session)
            @foreach ($session->session->sequences as $sequence )
            <td><b>{{$sequence->name}} </b></td>

            @endforeach
            <th>{{__('avg')}}</th>
            @endforeach
          </tr> 
      </thead>
      <tbody id="tbody">
        <script>students=[];</script>
        @foreach ($course->oneModule->classroom->students as $student )
        <tr id={{"".$student->id}}>
          <script>students.push( <?php echo $student->id ?>)</script>
        <td>{{$student->code}}</td>

        <td>{{$student->last_name}}</td>
        <td>{{$student->first_name}}</td>

        @php $moy_annuelle=0;@endphp
            @foreach ( $academic_year->sessions as $session)
                  @php
                  $moy=0;$session_percentage=0;
                      $flag=false;                @endphp
                @foreach ($session->session->sequences as $sequence )
                  @php $flag=false;@endphp
                  @foreach($course->sequences as $courseSequence)
                      @if($courseSequence->id==$sequence->id)
                          @php $flag=true;$sequence=$courseSequence;
                          $session_percentage+=$courseSequence->pivot->percentage;
                          @endphp
                      @endif
                  @endforeach
                  @if($flag)
                    <td id={{"std: ".$student->id."sess: ".$session->id."seq: ".$sequence->id}} class="editable" student_id="{{$student->id}}" course_id="{{$course->id}}" session_id="{{$session->id}}" sequence_id="{{$sequence->id}}">
                      @if ($markRepository->getcurrentnote_student_course($student->id,$course->id,$session->id,$sequence->id)->isEmpty())
                      /
                      @else
                      {{$markRepository->getcurrentnote_student_course($student->id,$course->id,$session->id,$sequence->id)[0]->note}}
                       @php $note_sequence=$markRepository->getcurrentnote_student_course($student->id,$course->id,$session->id,$sequence->id)[0]->note;
                      $moy=$moy+($note_sequence*$sequence->pivot->percentage/100);
                        @endphp
                      @endif
                    </td>

                  @else
                    <td id={{"std: ".$student->id."sess: ".$session->id."seq: ".$sequence->id}} class="editable" student_id="{{$student->id}}" course_id="{{$course->id}}" session_id="{{$session->id}}" sequence_id="{{$sequence->id}}">/</td>
                  @endif
                @endforeach
                  <td>@if($session_percentage==0) {{$moy}}@else{{$moy*100/$session_percentage}}@endif</td>
                  @php $moy_annuelle+=$moy;@endphp
            @endforeach
            <td>{{$moy_annuelle}}</td>
        </tr> 
        @endforeach
              
      </tbody>
    </table>
  </div>

