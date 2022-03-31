<?php
namespace App\Http\Controllers\Mark;
use App\Repositories\Configuration\TeacherRepository;
use App\Repositories\Mark\MarkRepository;
use App\Repositories\Configuration\DisciplineLevelStudyRepository;
use App\Repositories\Configuration\CourseRepository;
use App\Repositories\Configuration\LevelStudiesRepository;
use App\Repositories\Scolarity\SessionRepository;
use App\Repositories\Scolarity\Academic_yearRepository;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Mark\Mark;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Mobility\InstitutionRepository;

use PDF;
class MarkController extends Controller{
private $institutionRepository;
 private $MarkRepository;
 private $teacherRepository;
 private $Discipline_level_studyRepository;
 private $CourseRepository;
 private $levelRepository;
 private $sessionRepository;
 private $academic_yearRepository;
    public function __construct(InstitutionRepository $institutionRepository,MarkRepository $MarkRepository, TeacherRepository $teacherRepository, DisciplineLevelStudyRepository $Discipline_level_studyRepository, CourseRepository $CourseRepository, LevelStudiesRepository $levelRepository, SessionRepository $sessionRepository, Academic_yearRepository $academic_yearRepository){
        toggleDatabase(); 
        $this->MarkRepository= $MarkRepository;
        $this->institutionRepository= $institutionRepository;
        $this->teacherRepository= $teacherRepository;
        $this->Discipline_level_studyRepository= $Discipline_level_studyRepository;
        $this->CourseRepository= $CourseRepository;
        $this->levelRepository= $levelRepository;
        $this->sessionRepository= $sessionRepository;
        $this->academic_yearRepository= $academic_yearRepository;
        $this->middleware('auth');

    }
    public function kprintPDF()
    {
        $companyId= \Auth::user()->institution_id;
       
        $institution=$this->institutionRepository->getById($companyId);
        toggleDatabase();
  
       // This  $data array will be passed to our PDF blade
       $data = [
          'company_logo' => $institution->logo,
          'company_name'=>$institution->name,
          'BP'=>$institution->postal_box." ".$institution->address."-".$institution->city,
          'tel'=> $institution->phone,
          'email'=> $institution->email,
          'Marks'=>$this->MarkRepository->getAllWithCourse(),
        'teachers'=>$this->teacherRepository->getAll(),
       'Discipline_level_studys'=>$this->Discipline_level_studyRepository->getAll(),
       'Courses'=>$this->CourseRepository->getAll(),
       'levels'=>$this->levelRepository->getAll(),
       'search'=>null
        ];
        PDF::setOptions(['dpi' => 1000, 'defaultFont' => 'sans-serif']);

$pdf = PDF::loadView('configuration.Mark.pdf', $data); 
$output = $pdf->output(); 
       return $pdf->download('configuration_Mark.pdf');
    
    }
    public function printPDF($search)
    {
        $companyId= \Auth::user()->institution_id;
       
        $institution=$this->institutionRepository->getById($companyId);
        toggleDatabase();
        
       // This  $data array will be passed to our PDF blade
       $data = [
          'company_logo' => $institution->logo,
          'company_name'=>$institution->name,
          'BP'=>$institution->postal_box." ".$institution->address."-".$institution->city,
          'tel'=> $institution->phone,
          'email'=> $institution->email,
          'Marks'=>$this->MarkRepository->getAllWithCourse(),
        'teachers'=>$this->teacherRepository->getAll(),
       'Discipline_level_studys'=>$this->Discipline_level_studyRepository->getAll(),
       'Courses'=>$this->CourseRepository->getAll(),
       'levels'=>$this->levelRepository->getAll(),
         'search' =>$search
        ];
        PDF::setOptions(['dpi' => 600, 'defaultFont' => 'sans-serif']);
      $pdf = PDF::loadView('configuration.Mark.pdf', $data); 
      $output = $pdf->output(); 
       return $pdf->download('configuration_Mark.pdf');
    
    }



    public function viewPDF(){
        toggleDatabase();   
        $Marks=$this->MarkRepository->getAllWithCourse();
        $teachers=$this->teacherRepository->getAll();
        $Discipline_level_studys=$this->Discipline_level_studyRepository->getAll();
        $Courses=$this->CourseRepository->getAll();
        $levels=$this->levelRepository->getAll();
        $search=null;
        return view('configuration.Mark.pdf',compact("search","Marks","teachers","Discipline_level_studys", "Courses", "levels" ));
   
    }
   
        public function index1(){
            toggleDatabase();   
          
            $courses=$this->CourseRepository->getAll();
            $academic_years=$this->academic_yearRepository->getAll();

            return view('mark.mark.index',compact("courses","academic_years"));

        }
        
       public function index($course_id,$a_year_id)
            {
                toggleDatabase();   
                $marks=$this->MarkRepository->getAll();
                $teachers=$this->teacherRepository->getAll();
                $classes=$this->Discipline_level_studyRepository->getAll();
                //dd($course_id);
                $course=$this->CourseRepository->getById($course_id);
                $levels=$this->levelRepository->getAll();
                $academic_year=$this->academic_yearRepository->getById($a_year_id);
                $markRepository=$this->MarkRepository;
                return view('mark.mark.ajax_call.index_notes',compact("markRepository","course","marks","academic_year","classes"))->render();
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
                $markRepository=$this->MarkRepository;
                foreach ($request->notes as $note){
                  $bdnote=$markRepository->getcurrentnote_student_course($note["student_id"],$note["course_id"],$note["session_academic_year_id"],$note["sequence_id"]);
                  if($bdnote->isNotEmpty()){
                      if($note["note"]!=$bdnote[0]->note){  
                  //$bdnote[0]->delete();
                   $this->MarkRepository->update($bdnote[0]->id,$note);}
                }
                   else{
                       if($note["note"]!=0){$this->MarkRepository->store($note);}
                    
                }
                }
                
        
                //$task = $this->MarkRepository->store($request->all());
        
                return response()->json([
                    'error' => false,
                    'Mark'  => "ok",
                ], 200);
            }
        
            public function show($id)
            {
                toggleDatabase();
                $task = Mark::find($id);
        
                return response()->json([
                    'error' => false,
                    'Mark'  => $task,
                ], 200);
            }
        
            public function update(Request $request, $id)
            { $inputs['user_updated_id'] = \Auth::user()->id;

                toggleDatabase();
                $inputs = $request->post();
                $validator = Validator::make($request->input(), array(
                    'name' => 'required',
                    'teacher_id' => 'required',
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
                $this->MarkRepository->update($id,$inputs);
        
                return response()->json([
                    'error' => false,
                    'Mark'  => $inputs,
                ], 200);
            }
        
            public function destroy($id)
            { //$inputs['user_updated_id'] = \Auth::user()->id;
                toggleDatabase();
               
                $inputs['display'] = 0;
                $this->MarkRepository->update($id, $inputs);
        
                return response()->json([
                    'error' => false,
                    'msg'  => 'Element supprimé avec succès',
                ], 200);
            }}


           