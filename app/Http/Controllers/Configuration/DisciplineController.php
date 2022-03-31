<?php
namespace App\Http\Controllers\Configuration;
use App\Repositories\Configuration\DisciplineRepository;
use App\Repositories\Configuration\DepartmentRepository;
use App\Repositories\Configuration\DisciplineLevelStudyRepository;
use App\Repositories\Configuration\ModuleRepository;
use App\Repositories\Configuration\LevelStudiesRepository;
use App\Repositories\Configuration\TeacherRepository;
use App\Repositories\Scolarity\SessionRepository;
use App\Repositories\Scolarity\Academic_yearRepository;
use App\Repositories\Scolarity\SliceRepository;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Configuration\Discipline;
use App\Model\Configuration\Module;
use App\Model\Configuration\Course;


use Illuminate\Support\Facades\Validator;
class DisciplineController extends Controller{
    
 private $disciplineRepository ,$departmentRepository ,$ModuleRepository,$levelsRepository,
 $teacherRepository;
 private $sessionRepository;
 private $academic_yearRepository;
 private $sliceRepository;

    public function __construct(DepartmentRepository $departmentRepository,DisciplineRepository $disciplineRepository, ModuleRepository $module,DisciplineLevelStudyRepository $disciplineLevelStudyRepository, TeacherRepository $teacherRepository,
    SliceRepository $sliceRepository, LevelStudiesRepository $levels, SessionRepository $sessionRepository, Academic_yearRepository $academic_yearRepository){
        
        $this->disciplineRepository= $disciplineRepository;
        $this->departmentRepository= $departmentRepository;
        $this->disciplineLevelStudyRepository=$disciplineLevelStudyRepository;
        $this->ModuleRepository=$module;
        $this->sliceRepository= $sliceRepository;
        $this->levelsRepository=$levels;
        $this->teacherRepository=$teacherRepository;
        $this->sessionRepository= $sessionRepository;
        $this->academic_yearRepository= $academic_yearRepository;
        $this->middleware('auth');

    }
     public function level_index($id){
        toggleDatabase(); 
        $levelss=[$this->disciplineRepository->getbyId_with_level_studies($id)];
        $level=($levelss[0]->level_studies);
        $name=($levelss[0]["name"]);
        $allLevels=$this->levelsRepository->getAll();
        $discipline_level= $this->disciplineLevelStudyRepository;
        $disciplines= $this->disciplineRepository->getAll();
        $teachers=$this->teacherRepository->getAll();
        $academic_yearId=$this->academic_yearRepository->getCurrent()["id"];
        $sessions = $this->sessionRepository->getAll();
        $slices=$this->sliceRepository->getAll();
        return view('configuration.classroom.index',compact("levelss","name","allLevels","discipline_level","teachers","disciplines", "academic_yearId", "sessions", "slices"));

    }


       public function index()
            {
                toggleDatabase();
                $departments=$this->departmentRepository->getAll();
                $disciplines=$this->disciplineRepository->getAll();
                $teachers=$this->teacherRepository->getAll();
               
                return view('configuration.discipline.index',compact("disciplines","departments", "teachers"));
        
            }
        
            public function store(Request $request)
            {
                toggleDatabase(); 
                $validator = Validator::make($request->input(), array(
                    'name' => 'required|unique:discipline',
                    'code' => 'required|unique:discipline',
                    'description'=> 'nullable ',
                    'department_id'=> 'required |integer',
                ));
        
                if ($validator->fails()) {

                    return response()->json([
                        'error'    => true,
                        'messages' => $validator->errors(),

                    ], 422);  
                }
        
                $inputs = $this->disciplineRepository->store($request->all());
                return response()->json([
                    'error' => false,
                    'msg'=>"La discipline ".$inputs->name." a été enregistré avec succès!",
                ], 200);
        }
        
            public function show($id)
            {
                toggleDatabase(); 
                $inputs = $this->disciplineRepository->getById($id);
        
                return response()->json([
                    'error' => false,
                    'msg'  => $inputs,
                ], 200);
            }
        
            public function update(Request $request, $id)
            { 
                //$inputs['user_updated_id'] = \Auth::user()->id;
                toggleDatabase(); 
                $validator = Validator::make($request->input(), array(
                    'status' => 'required',
                    'department_id'=> 'required |integer ',
                    'description'=> 'nullable ',
                    'code' => 'required',
                    'name'=> 'required|unique:discipline,name,'.$id,
                ));
        
                if ($validator->fails()) {
                    return response()->json([
                        'error'    => true,
                        'msg' => $validator->errors(),
                    ], 422);
                }
        
                $inputs = $request->post();
               
                $this->disciplineRepository->update($id,$inputs);
                return response()->json([
                    'error' => false,
                    'msg'  => 'Mise a jour effectue avec succes!',
                ], 200);
            }
        
            public function destroy($id)
            {
                toggleDatabase(); 
               // $inputs['user_updated_id'] = \Auth::user()->id;
                $inputs['display'] = 0;
                $this->disciplineRepository->update($id,$inputs);
        
                return response()->json([
                    'error' => false,
                    'msg'  => 'Element supprimé avec succès',
                ], 200);
            }
        }
        
