<?php
namespace App\Http\Controllers\Scolarity;
use App\Repositories\Scolarity\InscriptionRepository;
use App\Repositories\Configuration\DisciplineLevelStudyRepository;
use App\Repositories\Scolarity\StudentRepository;
use App\Repositories\Scolarity\Academic_yearRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Scolarity\Inscription;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Scolarity\SliceRepository;
use App\Repositories\Mobility\InstitutionRepository;

use PDF;
class InscriptionController extends Controller{
    
 private $inscriptionRepository;
  private $studentRepository;
private $discipline_level_studyRepository;
private $academic_yearRepository;
private $institutionRepository;
private $sliceRepository;

	public function __construct(SliceRepository $sliceRepository,InscriptionRepository $inscriptionRepository,InstitutionRepository $institutionRepository,
	StudentRepository $studentRepository,
    DisciplineLevelStudyRepository $discipline_level_studyRepository,
    Academic_yearRepository $academic_yearRepository){
        $this->inscriptionRepository= $inscriptionRepository;
        $this->sliceRepository= $sliceRepository;

		$this->studentRepository= $studentRepository;
        $this->discipline_level_studyRepository= $discipline_level_studyRepository;
        $this->institutionRepository= $institutionRepository;
        $this->academic_yearRepository=$academic_yearRepository;
        $this->middleware('auth');
        /*$this->middleware('role:0');*/

    }
    public function printPDF($id)
    {
        $companyId= \Auth::user()->institution_id;
       
        $institution=$this->institutionRepository->getById($companyId);
        toggleDatabase();
        
        $inscription =$this->inscriptionRepository->getById($id);
       // This  $data array will be passed to our PDF blade
       $data = [
          'company_logo' => $institution->logo,
          'company_name'=>$institution->name,
          'BP'=>$institution->postal_box." ".$institution->address."-".$institution->city,
          'tel'=> $institution->phone,
          'email'=> $institution->email,
          'reçu'=> $inscription->code,
          'amount'=> $inscription->oneClass->inscription_amount,
          'student'=> $inscription->oneStudent->code.":".$inscription->oneStudent->first_name." ".$inscription->oneStudent->last_name,
          'inscription'=> $inscription->id,
          'department'=> $inscription->oneClass->oneDiscipline->oneDepartment->name,
          'discipline'=> $inscription->oneClass->oneDiscipline->name,
          'level'=> $inscription->oneClass->oneLevel->name,
          'date'=> $inscription->created_at,
          'econome'=> $inscription->oneCreator,
          'rest'=> $inscription->rest,
        ];
        if($data["econome"]!=null){
            $data["econome"]=$data["econome"]->name;
        }
            $inscription= $inscription->id;
        $pdf = PDF::loadView('scolarity.inscription.pdf', $data);

       return $pdf->download('inscription'.$inscription.'.pdf');
     // return view('scolarity.payment.pdf');
    }
     public function payments_index($id){
        toggleDatabase(); 
        $inscription =$this->inscriptionRepository->getwithPayments($id);
        $payments=$inscription->payments;
        $Studentname=$inscription->oneStudent->code." :".$inscription->oneStudent->first_name." ".$inscription->oneStudent->last_name;
        $inscriptionId=$inscription->id;
        $slices =$this->sliceRepository->getAll();

        return view('scolarity.payment.index',compact("slices","payments","Studentname","inscriptionId"));

     }

       public function index()
            {
                toggleDatabase(); 
				$inscriptions =$this->inscriptionRepository->getAll();
				$students=$this->studentRepository->getAll();
                $classes=$this->discipline_level_studyRepository->getAll();
                $academic_years=$this->academic_yearRepository->getAll();

				return view('scolarity.inscription.index',compact("inscriptions",
			"students","classes","academic_years"));
            }
        
    public function store(Request $request)
            {
                toggleDatabase(); 
                $validator = Validator::make($request->input(), array(
                    'discipline_level_study_id' => 'required',
                    'student_id'=> 'required ',
                    'academic_year_id'=> 'required ',
                ));
        
                if ($validator->fails()) {
                    return response()->json([
                        'error'    => true,
                        'messages' => $validator->errors(),
                    ], 422);  
                }
                $inputs = $this->inscriptionRepository->store($request->all());
                $date =$this->inscriptionRepository->getById($inputs->id)->oneAcademic_year->start_date;
                $date = date_parse($date);
                $jour = $date['day'];
                $mois = $date['month'];
                $annee = $date['year'];    

                $code=$annee."".$this->inscriptionRepository->getById($inputs->id)->oneClass->oneDiscipline->code."".$inputs->id;
                $id=$inputs->id;
                $code=["code"=>$code];
                 $this->inscriptionRepository->update($id,$code);
                if($this->inscriptionRepository->getById($inputs->id)->oneStudent->status==0){
                  
                    $id=$this->inscriptionRepository->getById($inputs->id)->oneStudent->id;
                    $code["status"]=1;
                   
                    $this->studentRepository->update($id,$code);
                }
                return response()->json([
                    'error' => false,
                    'inscription'  => $inputs,
                    'msg'  => "Le inscription ".$inputs->code."a été enregistré avec succès!",
                ], 200);
            }
        
            public function show($id)
            {
                toggleDatabase(); 
                $inputs=$this->inscriptionRepository->getById($id);        
                return response()->json([
                    'error' => false,
                    'inscription'  => $inputs,
                ], 200);
            }
        
            public function update(Request $request, $id)
            { $inputs['user_updated_id'] = \Auth::user()->id;
                toggleDatabase(); 
                $validator = Validator::make($request->input(), array(
					
                ));
        
                if ($validator->fails()) {
                    return response()->json([
                        'error'    => true,
                        'messages' => $validator->errors(),
                    ], 422);
                }
        
                
                $inputs = $request->post();
               
                $this->inscriptionRepository->update($id,$inputs);
                return response()->json([
                    'error' => false,
                    'msg'  => 'Mise a jour effectue avec succes!',
                ], 200);
            }
        
            public function destroy($id)
            {
                toggleDatabase(); 
                $inputs['user_updated_id'] = \Auth::user()->id;
                $inputs['display'] = 0;
                $this->inscriptionRepository->update($id,$inputs);
        
                return response()->json([
                    'error' => false,
                    'msg'  => 'Element supprimé avec succès',
                ], 200);
            }
        }
        
