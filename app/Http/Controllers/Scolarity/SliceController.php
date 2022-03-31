<?php
namespace App\Http\Controllers\Scolarity;
use App\Repositories\Scolarity\SliceRepository;
use App\Repositories\Scolarity\Class_sliceRepository;
use App\Repositories\Configuration\DisciplineLevelStudyRepository;
use App\Repositories\Configuration\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Configuration\Slice;
use Illuminate\Support\Facades\Validator;

class SliceController extends Controller{
    
    private $sliceRepository;
    private $userRepository;
    private $disciplineLevelStudyRepository;
    private $class_sliceRepository;

    public function __construct(SliceRepository $sliceRepository, UserRepository $userRepository, DisciplineLevelStudyRepository $disciplineLevelStudyRepository, Class_sliceRepository $class_sliceRepository){
        toggleDatabase(); 
        $this->sliceRepository= $sliceRepository;
        $this->class_sliceRepository= $class_sliceRepository;
        $this->userRepository= $userRepository;
        $this->disciplineLevelStudyRepository= $disciplineLevelStudyRepository;
        $this->middleware('auth');

    }

    public function index(){
        toggleDatabase();
        $slices =$this->sliceRepository->getAll();
        return view('scolarity.slice.index',compact("slices"));
    }
    public function store(Request $request){
        toggleDatabase();
        $validator = Validator::make($request->input(), array(
            'name' => 'required',
        ));
        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);  
        }
        $inputs = $this->sliceRepository->store($request->all());
        $sliceId = $this->sliceRepository->getLast()["id"];
        $classrooms=$this->disciplineLevelStudyRepository->getAll();
        foreach ($classrooms as $classroom) {
            $elt = [
                'value' => 0,
                'slice_id' => $sliceId,
                'discipline_level_study_id' => $classroom["id"],
            ];
            $task = $this->class_sliceRepository->store($elt);
        }
        return response()->json([
            'error' => false,
            'slice'  => $inputs,
            'msg'  => __('the_pattern').$inputs->name.__('was_saved_with_success'),
        ], 200);
    }
    public function show($id){
        toggleDatabase();
        $inputs=$this->sliceRepository->getById($id);        
        return response()->json([
            'error' => false,
            'slice'  => $inputs,
        ], 200);
    }
    public function update(Request $request, $id){ 
        //$inputs['user_updated_id'] = \Auth::user()->id;
        $validator = Validator::make($request->input(), array(
            'name'=> 'required',
        ));
        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }
        toggleDatabase();
        $inputs = $request->post();
        $inputs['user_updated_id'] = \Auth::user()->id;
        $this->sliceRepository->update($id,$inputs);
        return response()->json([
            'error' => false,
            'msg'  => 'Mise a jour effectue avec succes!',
        ], 200);
    }
    public function destroy($id){
        toggleDatabase();
        $inputs['user_updated_id'] = \Auth::user()->id;
        $inputs['display'] = 0;
        $this->sliceRepository->update($id,$inputs);
        return response()->json([
            'error' => false,
            'msg'  => 'Element supprimé avec succès',
        ], 200);
    }
}
        
