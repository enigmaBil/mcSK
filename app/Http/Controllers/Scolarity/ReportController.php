<?php
namespace App\Http\Controllers\Scolarity;
use App\Repositories\Scolarity\InscriptionRepository;
use App\Repositories\Scolarity\PaymentRepository;
use App\Repositories\Scolarity\SliceRepository;


use App\Repositories\Configuration\DisciplineLevelStudyRepository;
use App\Repositories\Configuration\DisciplineRepository;
use App\Repositories\Scolarity\StudentRepository;
use App\Repositories\Scolarity\Academic_yearRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Scolarity\Inscription;
use Illuminate\Support\Facades\Validator;
use DateTime;

class ReportController extends Controller{
        
    private $inscriptionRepository;
    private $paymentRepository;
    private $sliceRepository;


    private $studentRepository;
    private $discipline_level_studyRepository;
    private $academic_yearRepository;
    private $disciplineRepository;

	public function __construct(SliceRepository $sliceRepository,PaymentRepository $paymentRepository,InscriptionRepository $inscriptionRepository, StudentRepository $studentRepository,DisciplineRepository $disciplineRepository,
    DisciplineLevelStudyRepository $discipline_level_studyRepository,
    Academic_yearRepository $academic_yearRepository){
        $this->inscriptionRepository= $inscriptionRepository;
        $this->paymentRepository= $paymentRepository;
        $this->sliceRepository= $sliceRepository;


		$this->studentRepository= $studentRepository;
		$this->disciplineRepository= $disciplineRepository;
        $this->discipline_level_studyRepository= $discipline_level_studyRepository;
        $this->academic_yearRepository=$academic_yearRepository;
        $this->middleware('auth');
        /*$this->middleware('role:0');*/

    }
       public function index(){
        toggleDatabase(); 
        $disciplines=$this->disciplineRepository->getAll();
               // $inscriptions =$this->inscriptionRepository->getTop();
                $paymentRepository=$this->paymentRepository;
                $slices=$this->sliceRepository->getAll();
                $passedSlices=[];
                foreach($slices as $slice){
                    if(new DateTime>new DateTime($slice->deadline)){
                        array_push($passedSlices,$slice->name);
                    }
                }
                //dd($passedSlices);
                $inscriptionsNbre =$this->inscriptionRepository->getAll()->count();
                $inscriptionRepository =$this->inscriptionRepository;
                //dd($inscriptionsNbre);

                /*$students = \DB::table('inscription')
                ->join('student', 'inscription.student_id', '=', 'student.id')
                ->get()->count();
                $tmp = \DB::table('inscription')
                ->join('discipline_level_study', 'inscription.discipline_level_study_id', '=', 'discipline_level_study.id')
                ->get();
                $elts=[];
                foreach ($disciplines as $discipline) {
                    $elts[]=[
                        'name'=>$discipline["name"],
                        'number'=> \DB::table('inscription')->join('discipline_level_study', 'inscription.discipline_level_study_id', '=', 'discipline_level_study.id')->where('discipline_level_study.discipline_id', $discipline["id"])->get()->count()
                    ];
                }
                 $classes=$this->discipline_level_studyRepository->getAll();
                $classesNbre=$this->discipline_level_studyRepository->getAll()->count();
                $academic_years=$this->academic_yearRepository->getAll();*/

                //$departments =$this->departmentRepository->getSomeDepartement(5);

				return view('scolarity.report.index',compact('passedSlices','slices','paymentRepository', "inscriptionsNbre","disciplines",'inscriptionRepository'));
            }
            public function show($id)
            {
                toggleDatabase(); 
                $inputs= $this->inscriptionRepository->getById($id);        
                return response()->json([
                    'error' => false,
                    'inscription'  => $inputs,
                ], 200);
            }
        
            public function update(Request $request, $id)
            {
                toggleDatabase(); 
                $validator = Validator::make($request->input(), array(
					'discipline_level_study_id' => 'required',
                    'student_id'=> 'required ',
                ));
        
                if ($validator->fails()) {
                    return response()->json([
                        'error'    => true,
                        'messages' => $validator->errors(),
                    ], 422);
                }
        
                
                $inputs = $request->post();
                $inputs['user_updated_id'] = \Auth::user()->id;
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
        
