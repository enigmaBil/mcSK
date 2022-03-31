<?php
namespace App\Http\Controllers\Scolarity;
use App\Repositories\Scolarity\Class_sliceRepository;
use App\Repositories\Scolarity\InscriptionRepository;
use App\Repositories\Configuration\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Configuration\Slicet;
use Illuminate\Support\Facades\Validator;

class Class_sliceController extends Controller{
    
    private $sliceRepository;
    private $userRepository;
    private $inscriptionRepository;

    public function __construct(Class_sliceRepository $class_sliceRepository, InscriptionRepository $inscriptionRepository, UserRepository $userRepository){
        toggleDatabase(); 
        $this->sliceRepository= $class_sliceRepository;
        $this->inscriptionRepository=$inscriptionRepository;
        $this->userRepository= $userRepository;
        $this->middleware('auth');

    }

    public function store(Request $request){
        toggleDatabase();
        $validator = Validator::make($request->input(), array(
        ));
        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);  
        }
        $inputs = $this->sliceRepository->store($request->all());
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
    public function getAmount(Request $request){
        toggleDatabase();
        $inputs = $request->post();
        $class=$this->inscriptionRepository->getById($inputs["inscription_id"])['discipline_level_study_id'];
        $amount=$this->sliceRepository->getbySliceClass($class, $inputs["slice_id"])['value'];
        return response()->json([
            'error' => false,
            'amount'  => $amount,
        ], 200);    }
}
        
