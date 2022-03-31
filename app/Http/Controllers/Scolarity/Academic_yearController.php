<?php
namespace App\Http\Controllers\Scolarity;
use App\Repositories\Scolarity\Academic_yearRepository;
use App\Repositories\Scolarity\SessionRepository;
use App\Repositories\Scolarity\Session_academic_yearRepository;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Scolarity\Academic_year;
use Illuminate\Support\Facades\Validator;
class Academic_yearController extends Controller{
    
 private $academic_yearRepository;
 private $sessionRepository;
 private $session_academic_yearRepository;

    public function __construct( Session_academic_yearRepository  $session_academic_yearRepository,Academic_yearRepository $academic_yearRepository, SessionRepository $sessionRepository){
        $this->academic_yearRepository= $academic_yearRepository;
        $this->sessionRepository = $sessionRepository;
        $this->session_academic_yearRepository = $session_academic_yearRepository;

        $this->middleware('auth');
        /*$this->middleware('role:0');*/

    }
     public function sessions_index($id){
        toggleDatabase(); 
        $academic_year =$this->academic_yearRepository->getById($id);
        $sessionsA=[];
        foreach($academic_year->sessions as $session){
            $sessionsA[]=[$session->session->id];
        }
        $sessions=$this->sessionRepository->getAll('display', 1) ;
        $name=$academic_year->name;
        $academic_yearId=$academic_year->id;
        return view('scolarity.session_academic_year.index',compact("sessionsA","sessions","name","academic_yearId"));

     }
     public function store_session_academic_year(Request $request){
        toggleDatabase();
        $inputs = $this->session_academic_yearRepository->store($request->all());
        return response()->json([
                    'error' => false,
                    'academic_year'  => $inputs,
                    'msg'  => "session  ".$inputs->session->name." enregistrée avec succès pour le compte de cette année académique!",
                ], 200);
     }
    public function index(){
        toggleDatabase(); 
        $academic_years =$this->academic_yearRepository->getAll();
        return view('scolarity.academic_year.index',compact("academic_years"));
    }
        
    public function store(Request $request){
        toggleDatabase();
        ///GET ALL SESSOINS
        $sessions = $this->sessionRepository->getAll();
        if (!$sessions) {
            return response()->json([
                'error'    => true,
                'messages' => 'Aucune session créée. Veuillez créer la session et reéssayez de nouveau',
            ], 422);
        }
        $validator = Validator::make($request->input(), array(
            'name' => 'required',
            'start_date'=>'required|unique:academic_year',
            'end_date'=>'required|unique:academic_year',
        ));
        
        if ($validator->fails()) {
            return response()->json([
                    'error'    => true,
                'messages' => $validator->errors(),
            ], 422);  
        }
        $inputs = $this->academic_yearRepository->store($request->all());


        foreach($sessions as $session){
            $sessionAcademicYearImputs = [
                                    'session_id'=>$session->id,
                                    'academic_year_id'=>$inputs->id
            ];
            $this->session_academic_yearRepository->store($sessionAcademicYearImputs);
        }
        return response()->json([
                    'error' => false,
                    'academic_year'  => $inputs,
                    'msg'  => "Année académique ".$inputs->name." enregistrée avec succès!",
                ], 200);
    }
        
    public function show($id){
        toggleDatabase(); 
        $inputs=$this->academic_yearRepository->getById($id);        
        return response()->json([
                'error' => false,
                'academic_year'  => $inputs,
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
        dd($inputs);

        $this->academic_yearRepository->update($id,$inputs);
        return response()->json([
            'error' => false,
            'msg'  => 'Mise a jour effectue avec succes!',
        ], 200);
    }
        
    public function destroy($id){
        toggleDatabase(); 
        $inputs['user_updated_id'] = \Auth::user()->id;
        $inputs['display'] = 0;
        $this->academic_yearRepository->update($id,$inputs);
        return response()->json([
            'error' => false,
            'msg'  => 'Element supprimé avec succès',
        ], 200);
    }
}
        
