<?php
namespace App\Http\Controllers\Course_sequence;
use App\Repositories\Configuration\TeacherRepository;
use App\Repositories\Mark\Course_sequenceRepository;
use App\Repositories\Configuration\DisciplineLevelStudyRepository;
use App\Repositories\Mark\CourseRepository;
use App\Repositories\Configuration\LevelStudiesRepository;
use App\Repositories\Scolarity\SessionRepository;
use App\Repositories\Scolarity\Academic_yearRepository;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Mark\Course_sequence;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Mobility\InstitutionRepository;

use PDF;
class Course_sequenceController extends Controller{
private $institutionRepository;
 private $Course_sequenceRepository;
 private $teacherRepository;
 private $Discipline_level_studyRepository;
 private $CourseRepository;
 private $levelRepository;
 private $sessionRepository;
 private $academic_yearRepository;
    public function __construct(InstitutionRepository $institutionRepository,Course_sequenceRepository $Course_sequenceRepository, TeacherRepository $teacherRepository, DisciplineLevelStudyRepository $Discipline_level_studyRepository, CourseRepository $CourseRepository, LevelStudiesRepository $levelRepository, SessionRepository $sessionRepository, Academic_yearRepository $academic_yearRepository){
        toggleDatabase(); 
        $this->Course_sequenceRepository= $Course_sequenceRepository;
        $this->institutionRepository= $institutionRepository;
        $this->teacherRepository= $teacherRepository;
        $this->Discipline_level_studyRepository= $Discipline_level_studyRepository;
        $this->CourseRepository= $CourseRepository;
        $this->levelRepository= $levelRepository;
        $this->sessionRepository= $sessionRepository;
        $this->academic_yearRepository= $academic_yearRepository;
        $this->middleware('auth');

    }
   
    public function getsequence($id){
        toggleDatabase();   
                $Course_sequences=$this->Course_sequenceRepository->getAll()->where('course_id='.$id);
                return response()->json([
                    'error' => false,
                    'sequences'  => $Course_sequences,
                ], 200);    
            }

       public function index()
            {
                toggleDatabase();   
                $Course_sequences=$this->Course_sequenceRepository->getAll();
                $teachers=$this->teacherRepository->getAll();
                $classes=$this->Discipline_level_studyRepository->getAll();
                $Courses=$this->CourseRepository->getAll();
                $course=$Courses[0];
                $classe=$classes[0];
                $course=$classe->modules[0]->courses[0];
                dd($classes[0]->students);
                $levels=$this->levelRepository->getAll();
                $academic_year=$this->academic_yearRepository->getCurrent();
                
          //   dd(count($academic_year[0]->sessions[0]->sequences));
                return view('Course_sequence.index',compact("Course_sequences","academic_year","classes"));
            }
        
            public function store(Request $request)
            {
                toggleDatabase();
                $validator = Validator::make($request->input(), array(
                    'name' => 'required',
                    'teacher_id' => 'required',
                    'Course_id' => 'required | integer',
                    'coefficient' => 'integer|required',
                    'amount_hour' => ' integer|required',

                ));
        
                if ($validator->fails()) {
                    return response()->json([
                        'error'    => true,
                        'messages' => $validator->errors(),
                    ], 422);  
                }
        
                $task = $this->Course_sequenceRepository->store($request->all());
        
                return response()->json([
                    'error' => false,
                    'Course_sequence'  => $task,
                ], 200);
            }
        
            public function show($id)
            {
                toggleDatabase();
                $task = Course_sequence::find($id);
        
                return response()->json([
                    'error' => false,
                    'Course_sequence'  => $task,
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
                $this->Course_sequenceRepository->update($id,$inputs);
        
                return response()->json([
                    'error' => false,
                    'Course_sequence'  => $inputs,
                ], 200);
            }
        
            public function destroy($id)
            { //$inputs['user_updated_id'] = \Auth::user()->id;
                toggleDatabase();
               
                $inputs['display'] = 0;
                $this->Course_sequenceRepository->update($id, $inputs);
        
                return response()->json([
                    'error' => false,
                    'msg'  => 'Element supprimé avec succès',
                ], 200);
            }}


           