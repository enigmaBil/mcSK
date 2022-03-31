<?php

namespace App\Http\Controllers\Mark;

use App\Repositories\Configuration\DisciplineRepository;
use App\Repositories\Configuration\DepartmentRepository;
use App\Repositories\Configuration\TeacherRepository;
use App\Repositories\Configuration\SequenceRepository;
use App\Repositories\Mark\MarkRepository;
use App\Repositories\Configuration\DisciplineLevelStudyRepository;
use App\Repositories\Configuration\CourseRepository;
use App\Repositories\Configuration\LevelStudiesRepository;
use App\Repositories\Scolarity\SessionRepository;
use App\Repositories\Scolarity\Academic_yearRepository;
use App\Repositories\Scolarity\InscriptionRepository;
use App\Repositories\Scolarity\StudentRepository;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Configuration\Mark;
use App\Repositories\Configuration\ModuleRepository;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Mobility\InstitutionRepository;
use App\Repositories\Scolarity\SliceRepository;
use PDF;

class Report_cardController extends Controller
{
    private $institutionRepository;
    private $markRepository;
    private $teacherRepository;
    private $discipline_level_studyRepository;
    private $courseRepository;
    private $levelRepository;
    private $sessionRepository;
    private $academic_yearRepository;
    private $inscriptionRepository;
    private $sliceRepository;
    private $studentRepository;
    private $disciplineRepository;
    private $departmentRepository;
    private $sequenceRepository;
    private $moduleRepository;
    public function __construct(InstitutionRepository $institutionRepository, ModuleRepository $moduleRepository, DepartmentRepository $departmentRepository, SequenceRepository $sequenceRepository,  DisciplineRepository $disciplineRepository, MarkRepository $MarkRepository, TeacherRepository $teacherRepository, DisciplineLevelStudyRepository $discipline_level_studyRepository, CourseRepository $CourseRepository, LevelStudiesRepository $levelRepository, SessionRepository $sessionRepository, Academic_yearRepository $academic_yearRepository, InscriptionRepository $inscriptionRepository, SliceRepository $sliceRepository, StudentRepository $studentRepository)
    {
        toggleDatabase();
        $this->markRepository = $MarkRepository;
        $this->institutionRepository = $institutionRepository;
        $this->teacherRepository = $teacherRepository;
        $this->discipline_level_studyRepository = $discipline_level_studyRepository;
        $this->courseRepository = $CourseRepository;
        $this->levelRepository = $levelRepository;
        $this->sessionRepository = $sessionRepository;
        $this->academic_yearRepository = $academic_yearRepository;
        $this->inscriptionRepository = $inscriptionRepository;
        $this->sliceRepository = $sliceRepository;
        $this->departmentRepository = $departmentRepository;
        $this->disciplineRepository = $disciplineRepository;
        $this->moduleRepository = $moduleRepository;
        $this->studentRepository = $studentRepository;
        $this->sequenceRepository = $sequenceRepository;
        $this->middleware('auth');
    }
    /*public function kprintPDF()
    {
        $companyId = \Auth::user()->institution_id;

        $institution = $this->institutionRepository->getById($companyId);
        toggleDatabase();

        // This  $data array will be passed to our PDF blade
        $data = [
            'company_logo' => $institution->logo,
            'company_name' => $institution->name,
            'BP' => $institution->postal_box . " " . $institution->address . "-" . $institution->city,
            'tel' => $institution->phone,
            'email' => $institution->email,
            'Marks' => $this->MarkRepository->getAllWithCourse(),
            'teachers' => $this->teacherRepository->getAll(),
            'Discipline_level_studys' => $this->Discipline_level_studyRepository->getAll(),
            'Courses' => $this->CourseRepository->getAll(),
            'levels' => $this->levelRepository->getAll(),
            'search' => null
        ];
        PDF::setOptions(['dpi' => 1000, 'defaultFont' => 'sans-serif']);

        $pdf = PDF::loadView('configuration.Mark.pdf', $data);
        $output = $pdf->output();
        return $pdf->download('configuration_Mark.pdf');
    }*/
    public function printPDF($id)
    {
        $companyId = \Auth::user()->institution_id;

        $institution = $this->institutionRepository->getById($companyId);
        toggleDatabase();

        $studentId = $this->inscriptionRepository->getById($id)['student_id'];
        $classroomId = $this->inscriptionRepository->getById($id)['discipline_level_study_id'];
        $student = $this->studentRepository->getById($id);

        $data = [
            'company_logo' => $institution->logo,
            'company_name' => $institution->name,
            'BP' => $institution->postal_box . " " . $institution->address . "-" . $institution->city,
            'tel' => $institution->phone,
            'email' => $institution->email,
            'notes' => $this->markRepository->getByStudent($studentId),
            'courses' => $this->courseRepository->getByClassroom($classroomId),
            'academic_year' => $this->academic_yearRepository->getCurrent(),
            'sequences' => $this->sequenceRepository->getAll(),                                                                                      
            'studentId' => $id,
            'student' => $student,
            'classroom' => $this->levelRepository->getById($classroomId),
        ];

        $company_logo = $institution->logo;
        $company_name = $institution->name;
        $BP = $institution->postal_box . " " . $institution->address . "-" . $institution->city;
        $tel = $institution->phone;
        $email = $institution->email;
        $notes = $this->markRepository->getByStudent($studentId);
        $courses = $this->courseRepository->getByClassroom($classroomId);
        $academic_year = $this->academic_yearRepository->getCurrent();
        $sequences = $this->sequenceRepository->getAll();                                                                                     
        $studentId = $id;
        $student = $student;
        $classroom = $this->levelRepository->getById($classroomId);

        //dd($data);
        PDF::setOptions(['dpi' => 300, 'defaultFont' => 'sans-serif']);
        $pdf = PDF::loadView('mark.reportCard.reportCardPdf', $data);
        $output = $pdf->output();
        $filename = __('report card').'_'.$student->first_name.'_'.$student->last_name.date('Y-m-d H:i:s').'.pdf';
        return $pdf->stream($filename);
        //return view('mark.reportCard.reportCardPdf', compact('company_logo', 'company_name', 'student',
            //'BP', 'tel', 'email', 'notes', 'courses', 'academic_year', 'sequences', 'studentId', 'classroom' ));
    }

    /*

    public function viewPDF()
    {
        toggleDatabase();
        $Marks = $this->MarkRepository->getAllWithCourse();
        $teachers = $this->teacherRepository->getAll();
        $Discipline_level_studys = $this->Discipline_level_studyRepository->getAll();
        $Courses = $this->CourseRepository->getAll();
        $levels = $this->levelRepository->getAll();
        $search = null;
        return view('configuration.Mark.pdf', compact("search", "Marks", "teachers", "Discipline_level_studys", "Courses", "levels"));
    }
*/

    public function index()
    {
        toggleDatabase();
        $students = $this->studentRepository->getAll();
        $classes = $this->discipline_level_studyRepository->getAll();
        $academic_years = $this->academic_yearRepository->getAll();
        $academic_year = $this->academic_yearRepository->getCurrent();
        $marks = $this->markRepository->getAll();
        $teachers = $this->teacherRepository->getAll();
        $courses = $this->courseRepository->getAll();
        $levels = $this->levelRepository->getAll();
        $departments = $this->departmentRepository->getAll();
        $disciplines = $this->disciplineRepository->getAll();
        $inscriptions = $this->inscriptionRepository->getByAcademic_year($academic_year['id']);
        return view('mark.reportCard.index', compact("marks", "departments", "levels", "disciplines", "teachers", "courses", "classes", "inscriptions", "students", "academic_year", "academic_years"));
    }
    public function reportCard($id)
    {
        toggleDatabase();
        $studentId = $this->inscriptionRepository->getById($id)['student_id'];
        $classroomId = $this->inscriptionRepository->getById($id)['discipline_level_study_id'];
        $notes = $this->markRepository->getByStudent($studentId);
        $modules = $this->moduleRepository->getByClassroom($classroomId);
        $academic_year = $this->academic_yearRepository->getCurrent();
        $sequences = $this->sequenceRepository->getAll();
        $studentId = $id;
        return view('mark.reportCard.reportcard', compact("notes", "modules", "sequences", "studentId"));
    }
    public function getStudentByAcademic_year($a_year_id)
    {
        toggleDatabase();
        $inscriptions = $this->inscriptionRepository->getByAcademic_year($a_year_id);

        return view('mark.reportCard.ajax_call.indexReportCard', compact("inscriptions"))->render();
    }

    public function getStudentByDepartment($department)
    {
        toggleDatabase();
        $inscriptions = $this->inscriptionRepository->getByDepartment($department);
        return view('mark.reportCard.ajax_call.indexReportCard', compact("inscriptions"))->render();
    }
    public function getStudentByDiscipline($discipline)
    {
        toggleDatabase();
        $inscriptions = $this->inscriptionRepository->getByDiscipline($discipline);
        return view('mark.reportCard.ajax_call.indexReportCard', compact("inscriptions"))->render();
    }
    public function getStudentByLevel_study($level)
    {
        toggleDatabase();
        $inscriptions = $this->inscriptionRepository->getByLevel($level);
        return view('mark.reportCard.ajax_call.indexReportCard', compact("inscriptions"))->render();
    }

    public function getStudentByClassroom($levelid, $discipline)
    {
        toggleDatabase();
        $levels = $this->disciplineRepository->getById($discipline)->level_studies;
        foreach ($levels as $level) {
            if ($level->id == $levelid) {
                $leveli = $level;
            }
        }
        $leveli->pivot->id;
        $inscriptions = $this->inscriptionRepository->getByClassroom($leveli->pivot->id);
        return view('mark.reportCard.ajax_call.indexReportCard', compact("inscriptions"))->render();
    }

    public function show($id)
    {
        toggleDatabase();
        $task = Mark::find($id);

        return response()->json([
            'error' => false,
            'Mark'  => $task,
        ], 200);
    }
}
