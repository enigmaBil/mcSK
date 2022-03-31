<?php
namespace App\Http\Controllers\Configuration;
use App\Repositories\Mobility\InstitutionRepository;
use App\Repositories\Configuration\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Mobility\institution;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Mobility\ProfileRepository;

class InstitutionController extends Controller{
    
 private $institutionRepository;

 private $userRepository;
 private $profileRepository;

    public function __construct( ProfileRepository $profileRepository, InstitutionRepository $institutionRepository, UserRepository $userRepository){
        toggleDatabase(); 
        $this->institutionRepository= $institutionRepository;
        $this->userRepository= $userRepository;
        $this->profileRepository= $profileRepository;

        $this->middleware('auth');

    }

    public function updatePhoto (Request $request, $id){
        $image = $request->file('logo');
        $institution = $this->institutionRepository->getById($id);
        $newName =  'institution'.\Auth::user()->institution_id.'_photo'.time().'.'.request()->logo->getClientOriginalExtension();
        $destinationPath = public_path('/images/institutions');
        $image->move($destinationPath, $newName);
        $institution->logo = $newName;
        $institution->save();

        return response()->json([
            'success' => true,
            'msg'  => 'image enregistrée avec succès',
        ], 200);
    }

    public function index(){
                $companyId= \Auth::user()->institution_id;
       
                $institution=$this->institutionRepository->getById($companyId);

                return view('configuration.institution.index',compact("institution"));
    }
        
     public function store(Request $request)
            {
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
        
                $inputs = $this->institutionRepository->store($request->all());

                return response()->json([
                    'error' => false,
                    'institution'  => $inputs,
                    'msg'  => "Le département ".$inputs->name."a été enregistré avec succès!",
                ], 200);

     }

      public function update(Request $request, $id){
         /*   {  $request->validate([
                
            ]);*/
			 //dd($request);

            $inputs = $request->post();
            $inputs['user_updated_id'] = \Auth::user()->id;
			//$inputs['_method'] = 'POST';

             $this->institutionRepository->update($id,$inputs);

              return redirect(route('institution.index'))->with(['status'=>'success', 'message' => 'L\'institution a été enregistrer avec succés!']);
      }

      public function show($id)
            {
                //dd('jhjkh');
                $inputs=$this->institutionRepository->getById($id);        
                return response()->json([
                    'error' => false,
                    'institution'  => $inputs,
					//'msg'  => "Le département ".$inputs->name."a été enregistré avec succès!",
                ], 200);
      }


      public function destroy($id){
               // $inputs['user_updated_id'] = \Auth::user()->id;
                $inputs['display'] = 0;
                $this->institutionRepository->update($id,$inputs);
        
                return response()->json([
                    'error' => false,
                    'msg'  => 'Element supprimé avec succès',
                ], 200);
      }
 }
        
