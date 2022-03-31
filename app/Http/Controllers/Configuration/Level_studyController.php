<?php
namespace App\Http\Controllers\Configuration;
use App\Repositories\Configuration\LevelStudiesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Configuration\Level_study;
use Illuminate\Support\Facades\Validator;
class Level_studyController extends Controller{
    
 private $level_studyRepository;

    public function __construct(LevelStudiesRepository $level_studyRepository){
        $this->level_studyRepository= $level_studyRepository;
        $this->middleware('auth');

    }


       public function index()
            {
                toggleDatabase();    
                $level_studies =$this->level_studyRepository->getAll();

                return view('configuration.level_study.index',compact("level_studies"));
            }
        
            public function store(Request $request)
            {
                toggleDatabase(); 
                $validator = Validator::make($request->input(), array(
                    'name' => 'required',
                    'scolarity'=> 'nullable | integer',


                ));
        
                if ($validator->fails()) {
                    return response()->json([
                        'error'    => true,
                        'messages' => $validator->errors(),
                    ], 422);  
                }
               // dd($request->all());
        
                $task = $this->level_studyRepository->store($request->all());
        
                return response()->json([
                    'error' => false,
                    'level_study'  => $task,
                ], 200);
            }
        
            public function show($id)
            {
                toggleDatabase(); 
                $task = Level_study::find($id);
        
                return response()->json([
                    'error' => false,
                    'level_study'  => $task,
                ], 200);
            }
        
            public function update(Request $request, $id)
            {
                toggleDatabase(); 
                $validator = Validator::make($request->input(), array(
                    'scolarity'=> 'nullable | integer',
                    'name'=> 'required',
                ));
        
                if ($validator->fails()) {
                    return response()->json([
                        'error'    => true,
                        'messages' => $validator->errors(),
                    ], 422);
                }
        
                $task = Level_study::find($id);
        
                $task->name = $request->input('name');
                $task->user_updated_id = $request->input('user_updated_id');
                $task->updated_at = $request->input('updated_at');
                $task->description = $request->input('description');
                $task->save();
        
                return response()->json([
                    'error' => false,
                    'level_study'  => $task,
                ], 200);
            }
        
            public function destroy($id)
            {
                toggleDatabase(); 
                //$inputs['user_updated_id'] = \Auth::user()->id;
                $inputs['display'] = 0;
                $this->level_studyRepository->update($id,$inputs);
                return response()->json([
                    'error' => false,
                    'msg'  => 'Element supprimé avec succès',
                ], 200);
            }
        }
        
