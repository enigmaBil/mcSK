
  <div class="box-body table-responsive">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th colspan="3">{{__('students')}}</th>
                <th colspan="{{count($sequenceRattrapage->oneSession->sequences)+2}}"> {{$sequenceRattrapage->oneSession->name}}</th>
    
              
              <th>{{('actions')}}</th>
              </tr>
              <tr>
              <td>{{('matricule')}}</td>
              <td>{{('last name ')}}</td>
              <td>{{('first name')}}</td>
    
                
                @foreach ($sequenceRattrapage->oneSession->sequences as $sequence )
                <td><b>{{$sequence->name}} </b></td>
                
                @endforeach
              <th>{{__('rattrapage')}} {{$sequenceRattrapage->name}}</th>
                <th>{{__('avg')}}</th>
    
                  
                  <td>
                      <div class="form-group">
                          <a title={{__("edit")}} onclick="edit()">
                            <i class="fa fa-fw fa-pencil"></i>
                          </a>
                            <a title={{__("save")}} onclick="validate({{$course->id}},{{$course->oneModule->classroom->id}})">
                                <i class="icon fa fa-check"></i>
                              </a>
                      </div>
                  </td>
              </tr> 
          </thead>
          <tbody id="tbody">
            <script>students=[];</script>
            @foreach ($studentsRattrapage as $student )
            <tr id={{"".$student->id}}>
              <script>students.push( <?php echo $student->id ?>)</script>
            <td>{{$student->code}}</td>
    
            <td>{{$student->last_name}}</td>
            <td>{{$student->first_name}}</td>
    
                      @php
                        $moy=0;$session_percentage=0;
                      @endphp
                    @foreach ($sequenceRattrapage->oneSession->sequences as $sequence )
                      @php $flag=false;@endphp
                      @foreach($course->sequences as $courseSequence)
                        @if($courseSequence->id==$sequence->id)
                        @php ;$flag=true;$sequence=$courseSequence;
                        $session_percentage+=$sequence->pivot->percentage;break;

                        @endphp
                        @endif
                      @endforeach
                      @if($flag)
                      
                        <td   student_id={{"".$student->id}} course_id={{$course->id.""}} session_id={{"".$session_academic_year->id}} sequence_id={{"".$sequence->id}}>
                          @if ($markRepository->getcurrentnote_student_course($student->id,$course->id,$session_academic_year->id,$sequence->id)->isEmpty())
                          /
                          @else
                          
                            {{$markRepository->getcurrentnote_student_course($student->id,$course->id,$session_academic_year->id,$sequence->id)[0]->note}}
                            @if($sequence->id!=$sequenceRattrapage->id)
                              @php $note_sequence=$markRepository->getcurrentnote_student_course($student->id,$course->id,$session_academic_year->id,$sequence->id)[0]->note;
                                $moy=$moy+($note_sequence*$sequence->pivot->percentage/100);
                              @endphp
                            @else
                            @php $sequencePivot= $sequence @endphp
                            @endif
                          @endif
                        </td>
                        
                      @else
                        <td>/</td>
                      @endif
                        
                    
                    @endforeach
                    @if ($markRepository->getcurrentnote_student_course($student->id,$course->id,$session_academic_year->id,$sequenceRattrapage->id)->isEmpty())
                        <td>/</td>
                    @else
                    <td @if (new DateTime() < new DateTime($academic_year->end_date) ) class="editable"@endif note_id={{"".$markRepository->getcurrentnote_student_course($student->id,$course->id,$session_academic_year->id,$sequenceRattrapage->id)[0]->id}}>
                            
                      
                          @if($markRepository->getcurrentnote_student_course($student->id,$course->id,$session_academic_year->id,$sequenceRattrapage->id)[0]->note_rattrapage->isEmpty())
                            0
                          @else
                            {{$markRepository->getcurrentnote_student_course($student->id,$course->id,$session_academic_year->id,$sequenceRattrapage->id)[0]->note_rattrapage[0]->note}}
                            @php $note_sequence=$markRepository->getcurrentnote_student_course($student->id,$course->id,$session_academic_year->id,$sequenceRattrapage->id)[0]->note_rattrapage[0]->note;
                              $moy=$moy+($note_sequence*$sequencePivot->pivot->percentage/100);
                            @endphp
                          @endif
                      
                    </td>
                    @endif
                      <td>@if($session_percentage==0) {{$moy}}@else{{$moy*100/$session_percentage}}@endif</td>
            </tr> 
            @endforeach
                  
          </tbody>
        </table>
      </div>
    
    