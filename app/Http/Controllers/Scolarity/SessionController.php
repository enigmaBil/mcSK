<?php
namespace App\Http\Controllers\Scolarity;
use App\Repositories\Configuration\TeacherRepository;
use App\Repositories\Configuration\CourseRepository;
use App\Repositories\Configuration\DisciplineRepository;
use App\Repositories\Configuration\ModuleRepository;
use App\Repositories\Configuration\LevelStudiesRepository;
use App\Repositories\Scolarity\SessionRepository;
use App\Repositories\Scolarity\Academic_yearRepository;

use App\Model\Scolarity\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
class SessionController extends Controller{
 
    private $courseRepository;
    private $teacherRepository;
    private $disciplineRepository;
    private $moduleRepository;
    private $levelRepository;
    private $sessionRepository;
    private $academic_yearRepository;

    public function __construct(CourseRepository $courseRepository, TeacherRepository $teacherRepository, DisciplineRepository $disciplineRepository, ModuleRepository $moduleRepository, LevelStudiesRepository $levelRepository, SessionRepository $sessionRepository, Academic_yearRepository $academic_yearRepository){
        
        $this->courseRepository= $courseRepository;
        $this->teacherRepository= $teacherRepository;
        $this->disciplineRepository= $disciplineRepository;
        $this->moduleRepository= $moduleRepository;
        $this->levelRepository= $levelRepository;
        $this->sessionRepository= $sessionRepository;
        $this->academic_yearRepository= $academic_yearRepository;
        $this->middleware('auth');
        /*$this->middleware('role:0');*/

    }
    public function index(){
        toggleDatabase(); 
        $sessions =$this->sessionRepository->getAll();
        return view('scolarity.session.indexSession',compact("sessions"));
    }
        
    public function store(Request $request){
        toggleDatabase(); 
        $validator = Validator::make($request->input(), array(
            'name' => 'required',
            'start_date'=>'required',
            'end_date'=>'required',
        ));
        
        if ($validator->fails()) {
            return response()->json([
                    'error'    => true,
                'messages' => $validator->errors(),
            ], 422);  
        }
        $inputs = $this->sessionRepository->store($request->all());
        return response()->json([
                    'error' => false,
                    'session'  => $inputs,
                    'msg'  => "Session ".$inputs->name." enregistrée avec succès!",
                ], 200);
    }
        
    public function show($id){
        toggleDatabase(); 
        $inputs=$this->sessionRepository->getById($id);        
        return response()->json([
                'error' => false,
                'session'  => $inputs,
        ], 200);
    }
    public function update(Request $request, $id){
        toggleDatabase(); 
        $validator = Validator::make($request->input(), array(
            'status' => 'required',
            'name'=> 'required',
        ));
        
        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }
        $inputs = $request->post();
        $inputs['user_updated_id'] = \Auth::user()->id;
        $this->sessionRepository->update($id,$inputs);
        return response()->json([
            'error' => false,
            'msg'  => 'Mise a jour effectue avec succes!',
        ], 200);
    }
        
    public function destroy($id){
        toggleDatabase(); 
        $inputs['user_updated_id'] = \Auth::user()->id;
        $inputs['display'] = 0;
        $this->sessionRepository->update($id,$inputs);
        return response()->json([
            'error' => false,
            'msg'  => 'Element supprimé avec succès',
        ], 200);
    }

     
    public function sessionCourse($id){

        $sessions=[];
        toggleDatabase();   
        $courses=$this->courseRepository->getAllWithModule();
        $teachers=$this->teacherRepository->getAll();
        $disciplines=$this->disciplineRepository->getAll();
        $modules=$this->moduleRepository->getAll();
        $levels=$this->levelRepository->getAll();
        $sessions = $this->sessionRepository->getAll();
        return view('scolarity.session.course',compact("courses","teachers","disciplines", "modules", "levels", "sessions"));
        
    }
}
        