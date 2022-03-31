<?php
namespace App\Http\Controllers\Configuration;
use App\Repositories\Configuration\SequenceRepository;
use App\Repositories\Scolarity\SessionRepository;
use App\Repositories\Scolarity\Academic_yearRepository;
use App\Repositories\Scolarity\SliceRepository;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Configuration\sequence;
use App\Model\Configuration\Session;


use Illuminate\Support\Facades\Validator;
class sequenceController extends Controller{
    
 private $sequenceRepository ,$SessionRepository 
 ;
    public function __construct(SessionRepository $SessionRepository,sequenceRepository $sequenceRepository){
        
        $this->sequenceRepository= $sequenceRepository;
        $this->SessionRepository= $SessionRepository;
      
        $this->middleware('auth');

    }
     
       public function index()
            {
                toggleDatabase();
                $sessions=$this->SessionRepository->getAll();
                $sequences=$this->sequenceRepository->getAll();
               
                return view('configuration.sequence.index',compact("sequences","sessions"));
        
            }
        
            public function store(Request $request)
            {
                toggleDatabase(); 
                $validator = Validator::make($request->input(), array(
                    'name' => 'required|unique:sequence',
                    'session_id'=> 'required |integer',
                    'start_date'=> 'required |date',
                    'end_date'=> 'required |date',



                ));
        
                if ($validator->fails()) {

                    return response()->json([
                        'error'    => true,
                        'messages' => $validator->errors(),

                    ], 422);  
                }
        
                $inputs = $this->sequenceRepository->store($request->all());
                return response()->json([
                    'error' => false,
                    'sequence'  => $inputs,
                    'msg'=>"La sequence ".$inputs->name." a été enregistré avec succès!",
                ], 200);
        }
        
            public function show($id)
            {
                toggleDatabase(); 
                $inputs = $this->sequenceRepository->getById($id);
        
                return response()->json([
                    'error' => false,
                    'msg'  => $inputs,
                ], 200);
            }
        public function rattrapage(Request $request){
            toggleDatabase();
            $id=$request->sequence_id;
            $inputs=["status"=>1];
            $task=$this->sequenceRepository->update($id,$inputs);
            return response()->json([
                'error' => false,
                'msg'  => 'Mise a jour effectue avec succes!',
            ], 200);

        }
            public function update(Request $request, $id)
            { 
                //$inputs['user_updated_id'] = \Auth::user()->id;
                toggleDatabase(); 
                $validator = Validator::make($request->input(), array(
                    'start_date' => 'required|date',
                    'end_date' => 'required|date',
                    'session_id'=> 'required |integer ',
                    'name'=> 'required|unique:sequence,name,'.$id,
                ));
        
                if ($validator->fails()) {
                    return response()->json([
                        'error'    => true,
                        'msg' => $validator->errors(),
                    ], 422);
                }
        
                $inputs = $request->post();
               
                $this->sequenceRepository->update($id,$inputs);
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
                $this->sequenceRepository->update($id,$inputs);
        
                return response()->json([
                    'error' => false,
                    'msg'  => 'Element supprimé avec succès',
                ], 200);
            }
        }
        
