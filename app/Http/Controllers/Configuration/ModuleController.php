<?php
namespace App\Http\Controllers\Configuration;
use App\Repositories\Configuration\CourseRepository;
use App\Repositories\Configuration\DisciplineRepository;
use App\Repositories\Configuration\ModuleRepository;
use App\Repositories\Configuration\LevelStudiesRepository;
use App\Repositories\Scolarity\SessionRepository;
use App\Repositories\Scolarity\Academic_yearRepository;
use App\Repositories\Mobility\InstitutionRepository;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Configuration\Module;
use Illuminate\Support\Facades\Validator;
class ModuleController extends Controller{
    
 
private $institutionRepository;
private $courseRepository;
private $teacherRepository;
private $disciplineRepository;
private $moduleRepository;
private $levelRepository;
private $sessionRepository;
private $academic_yearRepository;

    public function __construct(InstitutionRepository $institutionRepository,CourseRepository $courseRepository, DisciplineRepository $disciplineRepository, ModuleRepository $moduleRepository, LevelStudiesRepository $levelRepository, SessionRepository $sessionRepository, Academic_yearRepository $academic_yearRepository){
        toggleDatabase(); 
        $this->courseRepository= $courseRepository;
        $this->institutionRepository= $institutionRepository;
        $this->disciplineRepository= $disciplineRepository;
        $this->moduleRepository= $moduleRepository;
        $this->levelRepository= $levelRepository;
        $this->sessionRepository= $sessionRepository;
        $this->academic_yearRepository= $academic_yearRepository;
        $this->middleware('auth');

    }
    
    public function getDisciplineLevelStudyId ($levelId, $disciplineId){
        $levels=$this->disciplineRepository->getById($disciplineId)->level_studies;
//dd($levelId, $disciplineId,$levels);
        $leveli = null;
        foreach ($levels as $level) {
            if($level->id==$levelId){
                $leveli = $level;
            }
        }

        if(!$leveli){
            return $leveli;
        }
        return $leveli->pivot->id;
    }

       public function moduleIndex()
            {
                $academic_yearId=[];
                $sessions=[];
                toggleDatabase();   
                $courses=$this->courseRepository->getAllWithModule();
                $disciplines=$this->disciplineRepository->getAll();
                $modules=$this->moduleRepository->getAll();
                if(isset($disciplines[0])){
                    $levels = $disciplines[0]->level_studies;
                }else{
                    $levels = [];
                }

                //$academic_year=$this->academic_yearRepository->getCurrent();
                $academic_yearId=$this->academic_yearRepository->getCurrent()["id"];

                if($sessions!=null){
                    $sessions = $this->sessionRepository->getAll();
                }else{
                    $sessions=null;
                }

                return view('configuration.module.indexModule',compact('levels',"courses","disciplines", "modules", "sessions", "academic_yearId" ));
            }
        
            public function store(Request $request)
            {
                toggleDatabase(); 
                $validator = Validator::make($request->input(), array(
                    'name' => 'required',
                    'discipline_level_study_id' => 'required | integer',

                ));
        
                if ($validator->fails()) {
                    return response()->json([
                        'error'    => true,
                        'messages' => $validator->errors(),
                    ], 422);  
                }
        
                $task = $this->moduleRepository->store($request->all());
        
                return response()->json([
                    'error' => false,
                    'module'  => $task,
                ], 200);
            }
        
            public function save(Request $request){
                $input = $request->post();

                toggleDatabase();
                $validator = Validator::make($input, array(
                ));

                if ($validator->fails()) {
                    return response()->json([
                        'error'    => true,
                        'messages' => $validator->errors(),
                    ], 422);  
                }
                $discipline_id= $input["discipline_id"];
                $level_id= $input["level_id"];
                $studyLevel = $this->getDisciplineLevelStudyId($level_id, $discipline_id);

               if(!$studyLevel) {
                   return response()->json([
                       'error' => true,
                       'message' => 'Discipline level not found',
                   ], 422);
               }

                try{
                    $module = [
                                'name'=>$input['name'],
                                'description'=>$input['description'],
                                'discipline_level_study_id'=>$studyLevel,
                                'status'=>'0'
                            ];
                    //dd($module);
                    $task = $this->moduleRepository->store($module);

                    return response()->json([
                        'error' => false,
                    ], 200);
                }catch (\Exception $exception){
                    return response()->json([
                        'error' => true,
                        'message' => $exception->getMessage(),
                    ], 422);
                }
            }

            public function show($id)
            {
                toggleDatabase(); 
                $task = Module::find($id);
        
                return response()->json([
                    'error' => false,
                    'module'  => $task,
                ], 200);
            }
        
            public function update(Request $request, $id)
            {
                toggleDatabase(); 
                $validator = Validator::make($request->input(), array(
                    'name'=> 'required',

                ));
        
                if ($validator->fails()) {
                    return response()->json([
                        'error'    => true,
                        'messages' => $validator->errors(),
                    ], 422);
                }
                $task = Module::find($id);
                $task->status =  $request->input('status');
                $task->name = $request->input('name');
                $task->user_updated_id = $request->input('user_updated_id');
                $task->updated_at = $request->input('updated_at');
                $task->description = $request->input('description');
                $task->discipline_level_study_id= $request->input('discipline_level_study_id');

                $task->save();
                return response()->json([
                    'error' => false,
                    'module'  => $task,
                ], 200);
            }
            public function updateModule(Request $request, $id)
            {
                toggleDatabase(); 
                $validator = Validator::make($request->input(), array(
                    'name'=> 'required',
                ));
        
                if ($validator->fails()) {
                    return response()->json([
                        'error'    => true,
                        'messages' => $validator->errors(),
                    ], 422);
                }
                $task = Module::find($id);
                $task->status =  $request->input('status');
                $task->name = $request->input('name');
                $task->user_updated_id = $request->input('user_updated_id');
                $task->updated_at = $request->input('updated_at');
                $task->description = $request->input('description');
                $task->discipline_level_study_id= $this->getDisciplineLevelStudyId ($request->input('level_id'), $request->input('discipline_id'));
                $task->save();
                return response()->json([
                    'error' => false,
                    'module'  => $task,
                ], 200);
            }
            public function destroy($id){
                $inputs['user_updated_id'] = \Auth::user()->id;
                $inputs['display'] = 0;
                toggleDatabase(); 
                $this->moduleRepository->update($id,$inputs);
                return response()->json([
                    'error' => false,
                    'msg'  => 'Element supprimé avec succès',
                ], 200);
            }
        }
        
