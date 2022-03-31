<?php
namespace App\Http\Controllers\Scolarity;
use App\Repositories\Scolarity\PaymentRepository;
use App\Repositories\Scolarity\InscriptionRepository;
use App\Repositories\Scolarity\SliceRepository;
use App\Repositories\Scolarity\StudentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Scolarity\payment;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Mobility\InstitutionRepository;

use PDF;
class PaymentController extends Controller{
    
 private $paymentRepository;
 private $inscriptionRepository;
 private $institutionRepository;
 private $sliceRepository;
 private $studentRepository;


            public function __construct(StudentRepository $studentRepository,InstitutionRepository $institutionRepository,InscriptionRepository $inscriptionRepository,PaymentRepository $paymentRepository, SliceRepository $sliceRepository){
                $this->inscriptionRepository=$inscriptionRepository;
                $this->paymentRepository= $paymentRepository;
                $this->sliceRepository= $sliceRepository;
                $this->institutionRepository= $institutionRepository;
                $this->studentRepository= $studentRepository;
                $this->middleware('auth');

            }
            public function printPDF($id)
            {
                $companyId= \Auth::user()->institution_id;
               
                $institution=$this->institutionRepository->getById($companyId);
                toggleDatabase();
                
                $payment =$this->paymentRepository->getById($id);
               // This  $data array will be passed to our PDF blade
               $data = [
                  'company_logo' => $institution->logo,
                  'company_name'=>$institution->name,
                  'BP'=>$institution->postal_box." ".$institution->address."-".$institution->city,
                  'tel'=> $institution->phone,
                  'email'=> $institution->email,
                  'reçu'=> $payment->id,
                  'amount'=> $payment->amount,
                  'student'=> $payment->oneInscription->oneStudent->code.":".$payment->oneInscription->oneStudent->first_name." ".$payment->oneInscription->oneStudent->last_name,
                  'inscription'=> $payment->oneInscription->code,
                  'department'=> $payment->oneInscription->oneClass->oneDiscipline->oneDepartment->name,
                  'discipline'=> $payment->oneInscription->oneClass->oneDiscipline->name,
                  'level'=> $payment->oneInscription->oneClass->oneLevel->name,
                  'date'=> $payment->created_at,
                  'econome'=> $payment->oneCreator,
                  'rest'=> $payment->oneInscription->rest,
                ];
                if($data["econome"]!=null){
                    $data["econome"]=$data["econome"]->name;
                }
                $pdf = PDF::loadView('scolarity.payment.pdf', $data);  
               return $pdf->download('medium.pdf');
             // return view('scolarity.payment.pdf');
            }
       public function index()
            {
                toggleDatabase(); 
                $payments =$this->paymentRepository->getAll();
                $slices =$this->sliceRepository->getAll();
                $inscriptions =$this->inscriptionRepository->getAll();
                $payment_reasons = __('settings.payment-reason');
                return view('scolarity.payment.index',compact("inscriptions","payments", "slices","payment_reasons"));
            }
        
            public function store(Request $request){
                $inputs['user_created_id'] = \Auth::user()->id;

                toggleDatabase(); 
                    $validator = Validator::make($request->input(), array(
                        'amount' => 'required|integer',
                        'inscription_id' => 'required|integer',

                    ));
            
                    if ($validator->fails()) {
                        return response()->json([
                            'error'    => true,
                            'messages' => $validator->errors(),
                        ], 422);  
                    }
            //dd($request->all());
                    $inputs = $this->paymentRepository->store($request->all());
                    //test 
                    $inscription_id=$inputs->inscription_id;
                    $rest= $this->inscriptionRepository->getById($inscription_id)->rest -$inputs->amount;
                    $Inscriptioninputs=["rest"=> $rest];
                    $this->inscriptionRepository->update($inscription_id,$Inscriptioninputs);
                   // dd();
            
                    return response()->json([
                        'error' => false,
                        'msg'  => "L\'le payement N°".$inputs->id." a été enregistré avec succès!",
                        'payment'  => $inputs,
                    ], 200);
            }
        
            public function show($id)
            {
                toggleDatabase(); 
                $inputs = $this->paymentRepository->getById($id);
        
                return response()->json([
                    'error' => false,
                    'payment'  => $inputs,
                ], 200);
            }
        
            public function update(Request $request, $id)
            {        //  $inputs['user_updated_id'] = \Auth::user()->id;

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
                $this->paymentRepository->update($id,$inputs);
        
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
                $this->paymentRepository->update($id,$inputs);
                return response()->json([
                    'error' => false,
                    'msg'  => 'Element supprimé avec succès',
                ], 200);
            }
        }
        
