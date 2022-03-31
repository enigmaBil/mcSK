<?php
namespace App\Http\Controllers\Mark;
use App\Repositories\Mark\Course_sequenceRepository;
use App\Repositories\Mark\Notes_rattrapageRepository;
use App\Repositories\Mark\MarkRepository;

use App\Repositories\Configuration\DisciplineLevelStudyRepository;
use App\Repositories\Configuration\CourseRepository;

use App\Repositories\Configuration\SequenceRepository;
use App\Repositories\Scolarity\SessionRepository;
use App\Repositories\Scolarity\Academic_yearRepository;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Mark\Notes_rattrapage;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Mobility\InstitutionRepository;

use PDF;
class Notes_rattrapageController extends Controller{
private $institutionRepository;
 private $Notes_rattrapageRepository;
 private $markRepository;

 private $Course_sequenceRepository;
 private $Discipline_level_studyRepository;
 private $CourseRepository;
 private $sequenceRepository;
 private $sessionRepository;
 private $academic_yearRepository;
    public function __construct(InstitutionRepository $institutionRepository,MarkRepository $markRepository,Notes_rattrapageRepository $Notes_rattrapageRepository, Course_sequenceRepository $Course_sequenceRepository, DisciplineLevelStudyRepository $Discipline_sequenceRepository, CourseRepository $CourseRepository, sequenceRepository $sequenceRepository, SessionRepository $sessionRepository, Academic_yearRepository $academic_yearRepository){
        toggleDatabase(); 
        $this->Notes_rattrapageRepository= $Notes_rattrapageRepository;
        $this->markRepository= $markRepository;

        $this->institutionRepository= $institutionRepository;
        $this->Course_sequenceRepository= $Course_sequenceRepository;
        $this->Discipline_level_studyRepository= $Discipline_sequenceRepository;
        $this->CourseRepository= $CourseRepository;
        $this->sequenceRepository= $sequenceRepository;
        $this->sessionRepository= $sessionRepository;
        $this->academic_yearRepository= $academic_yearRepository;
        $this->middleware('auth');

    }
   
  
        public function index1(){
            toggleDatabase();   
          
            $courses=$this->CourseRepository->getAll();
            $academic_years=$this->academic_yearRepository->getAll();

                return view('mark.notes_rattrapage.index',compact("courses","academic_years"));

        }
        public function index2($a_year_id){
            toggleDatabase();
            $academic_year=$this->academic_yearRepository->getById($a_year_id);
            return view('mark.notes_rattrapage.ajax_call.sequences_select',compact("academic_year"))->render();
 
        }
        
       public function index($a_year_id,$sequence_id,$course_id)
            {
                toggleDatabase();   
                $Notes_rattrapages=$this->Notes_rattrapageRepository->getAll();
                $academic_year=$this->academic_yearRepository->getById($a_year_id);
                $course=$this->CourseRepository->getById($course_id);
                $sequenceRattrapage=$this->sequenceRepository->getById($sequence_id);
                $course_sequences=[];
                $studentsRattrapage=[];
                
                foreach($course->sequences as $sequence){
                    $course_sequences[]=$sequence->id;
                }
                
                $sequences_course=[];
                
                
                $classe=$course->oneModule->classroom;
               foreach($academic_year->sessions as $session){
                   if($session->session->id==$sequenceRattrapage->oneSession->id){
                       $session_academic_year=$session;
                   }
               }
                foreach($classe->students as $student){
                        $moy=0;$session_percentage= 0;
                        foreach($sequenceRattrapage->oneSession->sequences as $sequence){
                            if(in_array($sequence->id,$course_sequences)){
                                /***cette partie est couteuse en temps d'execution ca se fait en 4n au lieu de N lors d'une bonne utilisation du tableau et de la methode in_array */
                                foreach($course->sequences as $courseSequence){
                                    if($courseSequence->id==$sequence->id){
                                        $sequence=$courseSequence;
                                    }

                                }
                                /*** se n'est que cette partie fournissant le pivot */
                                $session_percentage+=$sequence->pivot->percentage;
                                if ($this->markRepository->getcurrentnote_student_course($student->id,$course->id,$session_academic_year->id,$sequence->id)->isNotEmpty())
                                {
                                    $note_sequence=$this->markRepository->getcurrentnote_student_course($student->id,$course->id,$session_academic_year->id,$sequence->id)[0]->note;
                                    $moy=$moy+($note_sequence*$sequence->pivot->percentage/100);
                                }
                            }

                        }
                        if($session_percentage!=0){
                            //TODO MAKE THE THRESHOLD CONFIGURABLE CURRENTLY ON 10
                    if(($moy*100/$session_percentage)<10){
                        $studentsRattrapage[]=$student;
                    }}
                }
                //dd($sequenceRattrapage->oneSession->sequences);
               // dd($studentsRattrapage);
            $markRepository=$this->markRepository;
                return view('mark.notes_rattrapage.ajax_call.index_notes',compact("academic_year","session_academic_year","markRepository","course","studentsRattrapage","sequenceRattrapage","classes"))->render();
            }
        
            public function store(Request $request)
            {
                toggleDatabase();
                $validator = Validator::make($request->input(), array(
                    'course_id' => 'required',
                    'class_id' => 'required',
                    'notes' => 'required ',
                   
                ));
        
                if ($validator->fails()) {
                    return response()->json([
                        'error'    => true,
                        'messages' => $validator->errors(),
                    ], 422);  
                }
                $markRepository=$this->markRepository;
                foreach ($request->notes as $note){
                  $bdnote=$markRepository->getById($note["note_id"])->note_rattrapage;
                  
                  if($bdnote->isNotEmpty()){
                      if($note["note"]!=$bdnote[0]->note){  
                  $bdnote[0]->delete();
                   $this->Notes_rattrapageRepository->store($note);
                }
                    }
                   else{
                       if($note["note"]!=0){$this->Notes_rattrapageRepository->store($note);}
                    
                }
                }
                
        
                //$task = $this->Notes_rattrapageRepository->store($request->all());
        
                return response()->json([
                    'error' => false,
                    'Notes_rattrapage'  => "ok",
                ], 200);
            }
        
            public function show($id)
            {
                toggleDatabase();
                $task = Notes_rattrapage::find($id);
        
                return response()->json([
                    'error' => false,
                    'Notes_rattrapage'  => $task,
                ], 200);
            }
        
            public function update(Request $request, $id)
            { $inputs['user_updated_id'] = \Auth::user()->id;

                toggleDatabase();
                $inputs = $request->post();
                $validator = Validator::make($request->input(), array(
                    'name' => 'required',
                    'Course_sequence_id' => 'required',
                    'Course_id' => 'required | integer',
                    'coefficient' => ' integer|required',
                    'amount_hour' => ' integer|required',
                ));
        
                if ($validator->fails()) {
                    return response()->json([
                        'error'    => true,
                        'messages' => $validator->errors(),
                    ], 422);
                }
                $this->Notes_rattrapageRepository->update($id,$inputs);
        
                return response()->json([
                    'error' => false,
                    'Notes_rattrapage'  => $inputs,
                ], 200);
            }
        
            public function destroy($id)
            { //$inputs['user_updated_id'] = \Auth::user()->id;
                toggleDatabase();
               
                $inputs['display'] = 0;
                $this->Notes_rattrapageRepository->update($id, $inputs);
        
                return response()->json([
                    'error' => false,
                    'msg'  => 'Element supprimé avec succès',
                ], 200);
            }}


           