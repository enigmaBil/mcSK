<?php
namespace App\Http\Controllers\Scolarity;
use App\Repositories\Scolarity\InscriptionRepository;
use App\Model\Configuration\Level_study;
use App\Repositories\Configuration\LevelStudiesRepository;
use App\Repositories\Configuration\DisciplineRepository;
use App\Repositories\Scolarity\Academic_yearRepository;
use App\Repositories\Scolarity\PaymentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Mobility\InstitutionRepository;
use App\Repositories\Scolarity\SliceRepository;
use App\Repositories\Scolarity\StudentRepository;
use PDF;
use DateTime;

class ReportAccountingController extends Controller{
        
    private $inscriptionRepository;
    private $disciplineRepository;
    private $level_studyRepository;
    private $academic_yearRepository;
    private $paymentRepository;
    private $institutionRepository;
    private $sliceRepository;
    private $studentRepository;


	public function __construct(SliceRepository $sliceRepository,StudentRepository $studentRepository, InscriptionRepository $inscriptionRepository,InstitutionRepository $institutionRepository,DisciplineRepository $disciplineRepository,LevelStudiesRepository $level_studyRepository,Academic_yearRepository $academic_yearRepository,PaymentRepository $paymentRepository){
        $this->inscriptionRepository= $inscriptionRepository;
        $this->disciplineRepository= $disciplineRepository;
        $this->level_studyRepository= $level_studyRepository;
        $this->academic_yearRepository= $academic_yearRepository;
        $this->paymentRepository= $paymentRepository;
        $this->institutionRepository= $institutionRepository;
        $this->sliceRepository= $sliceRepository;
        $this->studentRepository= $studentRepository;


    }
    public function searchdebtor(Request $request){

    $discipline_id = $request->get('disciplineID');
    $academic_year_id = $request->get('academicYearID');
    $level_id = $request->get('levelID');
    toggleDatabase();
    $slices=$this->sliceRepository->getAll();
    $debtors=$this->disciplineRepository->getWithStudyLevel($discipline_id);

    $irregularStudents=[];
    $passedSlices=[];
    foreach($slices as $slice){
        if(new DateTime>new DateTime($slice->deadline)){
            array_push($passedSlices,$slice->name);
        }
    }
    foreach ($debtors  as $discipline ) {
        $regular = 0;
        foreach ($discipline->discipline_level_studies as $class) {
            foreach ($class->inscriptions as $inscription) {
                $payed = [];
               /* foreach ($inscription->payments as $payment) {
                    if($payment->payment_reason==1)
                        array_push($payed, $payment->slice->name);
                }*/
                if (array_intersect($payed, $passedSlices) == $passedSlices) {
                    $regular += 1;
                } else {
                    array_push($irregularStudents, $inscription);
                }
            }
        }
    }
    $searchView = view('scolarity.report_accounting.debtors',compact('level_id','academic_year_id','discipline_id','irregularStudents'))->render();

    return $searchView;
}

    public function searchpayment(Request $request){

        $payment_type_id = $request->get('paymentID');
        $discipline_id = $request->get('disciplineID');
        $academic_year_id = $request->get('academicYearID');
        $level_id = $request->get('levelID');
        //dd($payment_type_id,$academic_year_id,$discipline_id,$level_id);

        toggleDatabase();
        $studentsPayments = $this->paymentRepository->paymentDisciplineAcademicYearLevel($payment_type_id);


        $searchView = view('scolarity.report_accounting.payment',compact('level_id','academic_year_id','discipline_id','studentsPayments'))->render();

        return $searchView;
    }

    public function index(Request $request){
           $id = $request->get('clientID');
        toggleDatabase();
        $slices=$this->sliceRepository->getAll();
        $studentsPayments = $this->paymentRepository->paymentDisciplineAcademicYearLevel(null);
        //$studentsPayments = $this->studentRepository->getStudentsByDiscipline(null);
           $disciplines=$this->disciplineRepository->getAll();
        $debtors=$this->disciplineRepository->getWithStudyLevel(null);
           $level_studies =$this->level_studyRepository->getAll();
           $academic_years =$this->academic_yearRepository->getAll();
           $payment_reasons = __('settings.payment-reason');

          // dd($studentsPayments);
         $irregularStudents=[];
                 $passedSlices=[];
                foreach($slices as $slice){
                    if(new DateTime>new DateTime($slice->deadline)){
                        array_push($passedSlices,$slice->name);
                    }
                }
                foreach ($debtors  as $discipline ) {

                    $inscris = 0;
                    $regular = 0;
                    foreach ($discipline->discipline_level_studies as $class) {
                        $inscris += $class->inscriptions->count();
                        foreach ($class->inscriptions as $inscription) {
                            $payed = [];
                          /*  foreach ($inscription->payments as $payment) {
                                if ($payment->payment_reason == 1)
                                    array_push($payed, $payment->slice->name);
                            }*/
                            if (array_intersect($payed, $passedSlices) == $passedSlices) {
                                $regular += 1;
                            } else {
                                array_push($irregularStudents, $inscription);
                            }
                        }
                    }
                }
				return view('scolarity.report_accounting.index',compact('debtors','studentsPayments','disciplines','irregularStudents','level_studies','academic_years','payment_reasons'));
            }
    public function printPDF(Request $request)
    {

        $companyId= \Auth::user()->institution_id;
        $discipline_id = $request->get('disciplineID');
        $academic_year_id = $request->get('academicYearID');
        $level_id = $request->get('levelID');
        $totalDebt =0;

        $institution=$this->institutionRepository->getById($companyId);
        toggleDatabase();
         $company_logo = $institution->logo;
        $company_name = $institution->name;
        $BP = $institution->postal_box . " " . $institution->address . "-" . $institution->city;
        $tel = $institution->phone;
        $email = $institution->email;

        $slices=$this->sliceRepository->getAll();
        $debtors=$this->disciplineRepository->getWithStudyLevel($discipline_id);

        $irregularStudents=[];
        $passedSlices=[];
        foreach($slices as $slice){
            if(new DateTime>new DateTime($slice->deadline)){
                array_push($passedSlices,$slice->name);
            }
        }
        foreach ($debtors  as $discipline ) {
            $regular = 0;
            foreach ($discipline->discipline_level_studies as $class) {
                foreach ($class->inscriptions as $inscription) {
                    $payed = [];
                   /* foreach ($inscription->payments as $payment) {
                        if($payment->payment_reason==1)
                            array_push($payed, $payment->slice->name);
                    }*/
                    if (array_intersect($payed, $passedSlices) == $passedSlices) {
                        $regular += 1;
                    } else {
                        array_push($irregularStudents, $inscription);
                    }
                }
            }
        }

        PDF::setOptions(['dpi' => 1000, 'defaultFont' => 'sans-serif']);
        $pdf = PDF::loadView('scolarity.report_accounting.printDebtors', compact('company_logo','company_name','BP','tel','email','academic_year_id','level_id','irregularStudents','totalDebt'));

        return $pdf->download('print_irregular_students.pdf');

    }

    public function printPaymentPDF(Request $request)
    {

        $companyId= \Auth::user()->institution_id;
        $payment_type_id = $request->get('paymentID');
        $discipline_id = $request->get('disciplineID');
        $academic_year_id = $request->get('academicYearID');
        $level_id = $request->get('levelID');
       // dd($payment_type_id,$academic_year_id,$discipline_id,$level_id);

        $institution=$this->institutionRepository->getById($companyId);
        toggleDatabase();
        $company_logo = $institution->logo;
        $company_name = $institution->name;
        $BP = $institution->postal_box . " " . $institution->address . "-" . $institution->city;
        $tel = $institution->phone;
        $email = $institution->email;
        $studentsPayments = $this->paymentRepository->paymentDisciplineAcademicYearLevel($payment_type_id);



        PDF::setOptions(['dpi' => 1000, 'defaultFont' => 'sans-serif']);
        $pdf = PDF::loadView('scolarity.report_accounting.printPayments', compact('company_logo', 'company_name','BP','tel','email','studentsPayments','level_id','discipline_id','academic_year_id'));

        return $pdf->download('print_payment.pdf');

    }



}
        
