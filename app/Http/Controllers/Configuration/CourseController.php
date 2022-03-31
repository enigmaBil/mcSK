<?php
namespace App\Http\Controllers\Configuration;
use App\Repositories\Configuration\TeacherRepository;
use App\Repositories\Configuration\CourseRepository;
use App\Repositories\Configuration\DisciplineRepository;
use App\Repositories\Configuration\ModuleRepository;
use App\Repositories\Configuration\LevelStudiesRepository;
use App\Repositories\Scolarity\SessionRepository;
use App\Repositories\Configuration\SequenceRepository;
use App\Repositories\Mark\Course_sequenceRepository;


use App\Repositories\Scolarity\Academic_yearRepository;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Configuration\Course;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Mobility\InstitutionRepository;

use PDF;
class CourseController extends Controller{
private $institutionRepository;
 private $courseRepository;
 private $teacherRepository;
 private $disciplineRepository;
 private $moduleRepository;
 private $levelRepository;
 private $sessionRepository;
 private $sequenceRepository;
 private $course_sequenceRepository;
 private $academic_yearRepository;
    public function __construct(Course_sequenceRepository $course_sequenceRepository ,InstitutionRepository $institutionRepository,CourseRepository $courseRepository, TeacherRepository $teacherRepository, DisciplineRepository $disciplineRepository, ModuleRepository $moduleRepository, LevelStudiesRepository $levelRepository, SequenceRepository $sequenceRepository, SessionRepository $sessionRepository, Academic_yearRepository $academic_yearRepository){
        toggleDatabase(); 
        $this->course_sequenceRepository=$course_sequenceRepository;
        $this->sequenceRepository= $sequenceRepository;
        $this->courseRepository= $courseRepository;
        $this->institutionRepository= $institutionRepository;
        $this->teacherRepository= $teacherRepository;
        $this->disciplineRepository= $disciplineRepository;
        $this->moduleRepository= $moduleRepository;
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
          'courses'=>$this->courseRepository->getAllWithModule(),
        'teachers'=>$this->teacherRepository->getAll(),
       'disciplines'=>$this->disciplineRepository->getAll(),
       'modules'=>$this->moduleRepository->getAll(),
       'levels'=>$this->levelRepository->getAll(),
       'search'=>null
        ];
        PDF::setOptions(['dpi' => 1000, 'defaultFont' => 'sans-serif']);

$pdf = PDF::loadView('configuration.course.pdf', $data); 
$output = $pdf->output(); 
       return $pdf->download('configuration_course.pdf');
    
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
            'courses'=>$this->courseRepository->getAllWithModule(),
            'teachers'=>$this->teacherRepository->getAll(),
            'disciplines'=>$this->disciplineRepository->getAll(),
            'modules'=>$this->moduleRepository->getAll(),
            'levels'=>$this->levelRepository->getAll(),
            'search' =>$search
        ];
        PDF::setOptions(['dpi' => 600, 'defaultFont' => 'sans-serif']);
        $pdf = PDF::loadView('configuration.course.pdf', $data); 
        $output = $pdf->output(); 
        return $pdf->download('configuration_course.pdf');
    
    }


    public function viewPDF(){
        toggleDatabase();   
        $courses=$this->courseRepository->getAllWithModule();
        $teachers=$this->teacherRepository->getAll();
        $disciplines=$this->disciplineRepository->getAll();
        $modules=$this->moduleRepository->getAll();
        $levels=$this->levelRepository->getAll();
        $search=null;
        return view('configuration.course.pdf',compact("search","courses","teachers","disciplines", "modules", "levels" ));
   
    }
   

            public function index()
            {
                $academic_yearId=[];
                $sessions=[];
                toggleDatabase();   
                $courses=$this->courseRepository->getAllWithModule();
                $teachers=$this->teacherRepository->getAll();
                $disciplines=$this->disciplineRepository->getAll();
                $modules=$this->moduleRepository->getAll();
                $levels=$this->levelRepository->getAll();
                $sequences=$this->sequenceRepository->getAll();
                $academic_year=$this->academic_yearRepository->getCurrent();
                $sessions=$this->sessionRepository->getAll();
    
                return view('configuration.course.index',compact("sequences","courses","teachers","disciplines", "modules", "levels", "sessions", "academic_yearId" ));
            }
       
            public function store(Request $request)
            {
                toggleDatabase();
                $validator = Validator::make($request->input(), array(
                    'name' => 'required',
                    'teacher_id' => 'required',
                    'module_id' => 'required | integer',
                    'coefficient' => 'integer|required',
                    'amount_hour' => ' integer|required',

                ));
        
                if ($validator->fails()) {
                    return response()->json([
                        'error'    => true,
                        'messages' => $validator->errors(),
                    ], 422);  
                }
                $course = $this->courseRepository->store($request->all());
       // dd($request);
        foreach ($request->course_sequences as $course_sequence){
         if($course_sequence!=null){
            
            if($course_sequence["choice"]=="true"){
                $course_sequencet=["sequence_id"=> $course_sequence['sequence_id'],"percentage"=> $course_sequence['percentage'],
                "course_id"=> $course->id,"display"=>1];
                 $this->course_sequenceRepository->store($course_sequencet);
            }}
        }
                return response()->json([
                    'error' => false,
                    'course'  => $course,
                ], 200);
            }
        
            public function show($id)
            {
                toggleDatabase();
                $task = Course::find($id);
        
                return response()->json([
                    'error' => false,
                    'course'  => $task,
                ], 200);
            }
            public function course_sequence($id){
                toggleDatabase();
                $task = Course::find($id);
                $sequences=$this->sequenceRepository->getAll();
                return response()->json([
                    'error' => false,
                    'course_sequences'  => $task->course_sequences,
                    'sequences'  => $task->sequences,
                    'Allsequences'=> $sequences,
                ], 200);
            }
        
            public function postcourse_sequence(Request $request ){
                toggleDatabase();
                
                $course = Course::find($request->course_id);
                foreach($course->course_sequences as $course_sequence ){
                    $course_sequence->delete();
                }
                foreach($request->course_sequences as $course_sequence){
                    $this->course_sequenceRepository->store($course_sequence);

                }
                return response()->json([
                    'error' => false,
                    'msg'=> "{{__('all was done successfully')}}",
                ], 200);
                        }
            public function update(Request $request, $id)
            { 
                $inputs['user_updated_id'] = \Auth::user()->id;

                toggleDatabase();
                $inputs = $request->post();
                $validator = Validator::make($request->input(), array(
                    'name' => 'required',
                    'teacher_id' => 'required',
                    'module_id' => 'required | integer',
                    'coefficient' => ' integer|required',
                    'amount_hour' => ' integer|required',
                ));
        
                if ($validator->fails()) {
                    return response()->json([
                        'error'    => true,
                        'messages' => $validator->errors(),
                    ], 422);
                }
                $this->courseRepository->update($id,$inputs);
        
                return response()->json([
                    'error' => false,
                    'course'  => $inputs,
                ], 200);
            }
        
            public function destroy($id)
            { //$inputs['user_updated_id'] = \Auth::user()->id;
                toggleDatabase();
               
                $inputs['display'] = 0;
                $this->courseRepository->update($id, $inputs);
        
                return response()->json([
                    'error' => false,
                    'msg'  => 'Element supprimé avec succès',
                ], 200);
            }


            public function disciplineLevel(Request $request){
                toggleDatabase();
                $input=$request->input()["discipline_id"];
                $levels=$this->levelRepository->getByDiscipline($input);
                return response()->json([
                    'error' => false,
                    'levels'  => $levels,
                ], 200);
            }
            public function levelModule(Request $request){
                toggleDatabase();
                $discipline_id=$request->input()["discipline_id"];
                $level_id=$request->input()["level_id"];
                $levels=$this->disciplineRepository->getById($discipline_id)->level_studies;
                foreach ($levels as $level) {
                    if($level->id==$level_id){
                        $leveli=$level;
                    }
                }
                $modules=$leveli->pivot->modules;
                return response()->json([
                    'error' => false,
                    'modules'  => $modules,
                ], 200);
            }
            public function departmentDiscipline(Request $request){
                
                toggleDatabase();
                $department_id=$request->post()["department_id"];
                $discipline = $this->disciplineRepository->getDisciplineByDepartment($department_id);
                
                return response()->json([
                    'error' => false,
                    'disciplines'  => $discipline,
                ], 200);
            }
        }
        
