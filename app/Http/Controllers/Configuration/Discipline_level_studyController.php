<?php

namespace App\Http\Controllers\Configuration;

use App\Repositories\Configuration\DisciplineLevelStudyRepository;
use App\Repositories\Configuration\DisciplineRepository;
use App\Repositories\Configuration\ModuleRepository;
use App\Repositories\Configuration\LevelStudiesRepository;
use App\Repositories\Configuration\TeacherRepository;
use App\Repositories\Scolarity\SessionRepository;
use App\Repositories\Scolarity\SliceRepository;
use App\Model\Scolarity\Class_slice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Configuration\Discipline_levelStudy;
use App\Repositories\Scolarity\Class_sliceRepository;
use Illuminate\Support\Facades\Validator;

class Discipline_level_studyController extends Controller
{
    private $sliceRepository;
    private $classroomRepository;
    private $disciplineLevelStudyRepository;
    private $disciplineRepository, $ModuleRepository, $levelsRepository, $teacherRepository;
    private $sessionRepository;
    private $class_sliceRepository;
    public function __construct(
        DisciplineLevelStudyRepository $classroom,
        DisciplineRepository $disciplineRepository,
        ModuleRepository $module,
        DisciplineLevelStudyRepository $disciplineLevelStudyRepository,
        TeacherRepository $teacherRepository,
        SliceRepository $sliceRepository,
        Class_sliceRepository $class_sliceRepository,
        LevelStudiesRepository $levels,
        SessionRepository $sessionRepository
    ) {
        $this->disciplineRepository = $disciplineRepository;
        $this->disciplineLevelStudyRepository = $disciplineLevelStudyRepository;
        $this->ModuleRepository = $module;
        $this->levelsRepository = $levels;
        $this->teacherRepository = $teacherRepository;
        $this->sessionRepository = $sessionRepository;
        $this->sliceRepository = $sliceRepository;
        $this->classroomRepository = $classroom;
        $this->class_sliceRepository = $class_sliceRepository;

        $this->middleware('auth');
    }

    public function discipline($id)
    {
        toggleDatabase();
        $discipline = $this->disciplineRepository->getById($id);
        //$discipline=$discipline->level_studies;
        $allLevels = $this->levelsRepository->getAll();
        $discipline_level = $this->disciplineLevelStudyRepository;
        $levels = null;

        foreach ($allLevels as $level) {
            if ($discipline_level->is_it_in($discipline->id, $level->id) == false) {
                $levels[] = $level;
            }
        }
        return response()->json([
            'error' => false,
            'levelsPrenable'  => $levels,
        ], 200);
    }
    public  function  index()
    {

        toggleDatabase();
        $disciplines = $this->disciplineRepository->getAll();
        $levelss = $disciplines;
        $sessions = [];
        $allLevels = $this->levelsRepository->getAll()->where('display', 1);
        $discipline_level = $this->disciplineLevelStudyRepository;
        $teachers = $this->teacherRepository->getAll();
        $slices = $this->sliceRepository->getAll();
        $sessions = $this->sessionRepository->getAll();
        return view('configuration.classroom.index', compact("levelss", "allLevels", "discipline_level", "teachers", "disciplines", "sessions", "slices"));
    }

    public  function  indexAmount($id)
    {
        toggleDatabase();
        $slices = $this->class_sliceRepository->getWithSlice($id);
        return view('configuration.classroom.indexAmount', compact("slices"));
    }



    public function store(Request $request)
    {
        $slices = $request->all()['amount'];
        $validator = Validator::make($request->input(), array(
            'discipline_id' => 'required | integer',
            'level_study_id' => 'required | integer',
            'education_amount' => 'integer|required',
            'inscription_amount' => 'integer|required',

        ));

        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }
        toggleDatabase();
        $task = $this->classroomRepository->store($request->all());
        $classroomId = $this->classroomRepository->getLast()["id"];
        foreach ($slices as $slice) {
            $elt = [
                'value' => $slice["amount"],
                'slice_id' => $slice['id'],
                'discipline_level_study_id' => $classroomId,
            ];
            $task = $this->class_sliceRepository->store($elt);
        }

        return response()->json([
            'error' => false,
            'classroom'  => $task,
        ], 200);
    }

    public function show($id)
    {
        toggleDatabase();
        $task = Discipline_levelStudy::find($id);

        return response()->json([
            'error' => false,
            'classroom'  => $task,
        ], 200);
    }

    public function update(Request $request, $id)
    {         //       $inputs['user_updated_id'] = \Auth::user()->id;

        toggleDatabase();
        $validator = Validator::make($request->input(), array(

            'education_amount' => 'integer|required',
            'inscription_amount' => 'integer|required',


        ));

        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }

        $inputs = $request->post();
        $this->classroomRepository->update($id, $inputs);
        return response()->json([
            'error' => false,
            'classroom'  => $inputs,
        ], 200);
    }

    public function destroy($id)
    {
        toggleDatabase();
        /*$task = Discipline_level_study::destroy($id);
        
                return response()->json([
                    'error' => false,
                    'classroom'  => $task,
                ], 200);
            }*/
        // $inputs['user_updated_id'] = \Auth::user()->id;
        $inputs['display'] = 0;
        $this->classroomRepository->update($id, $inputs);
        return response()->json([
            'error' => false,
            'msg'  => 'Element supprimé avec succès',
        ], 200);
    }
}