<?php
namespace App\Http\Controllers\Configuration;
use App\Repositories\Configuration\TeacherRepository;
use App\Repositories\Configuration\DepartmentRepository;

use App\Repositories\Configuration\CourseRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Configuration\Teacher;
use Illuminate\Support\Facades\Validator;
class TeacherController extends Controller{
    
 private $teacherRepository;
 private $courseRepository;
 private $departmentRepository;


            public function __construct(DepartmentRepository $departmentRepository,CourseRepository $courseRepository,TeacherRepository $teacherRepository){
                $this->teacherRepository= $teacherRepository;
                $this->courseRepository= $courseRepository;
                $this->departmentRepository= $departmentRepository;

                $this->middleware('auth');

            }

       public function index()
            {
                toggleDatabase(); 
                $teachers =$this->teacherRepository->getAllWithCourses();
                $courses =$this->courseRepository->getAll();
                $departments =$this->departmentRepository->getAll();
                return view('configuration.teacher.index',compact("departments","teachers","courses"));
            }
        
            public function store(Request $request){
                toggleDatabase(); 
                    $validator = Validator::make($request->input(), array(
                        'name' => 'required',
                        'code' => 'required|unique:teacher',
                    ));
            
                    if ($validator->fails()) {
                        return response()->json([
                            'error'    => true,
                            'messages' => $validator->errors(),
                        ], 422);  
                    }
            
                    $inputs = $this->teacherRepository->store($request->all());
            
                    return response()->json([
                        'error' => false,
                        'msg'  => "L\'enseignant".$inputs->name." a été enregistré avec succès!",
                        'teacher'  => $inputs,
                    ], 200);
            }
        
            public function show($id)
            {
                toggleDatabase(); 
                $inputs = $this->teacherRepository-getById($id);
        
                return response()->json([
                    'error' => false,
                    'teacher'  => $inputs,
                ], 200);
            }
        
            public function update(Request $request, $id)
            {
                toggleDatabase(); 
                $validator = Validator::make($request->input(), array(
                    'code' => 'required|unique:teacher,code,'.$id,
                    'name'=> 'required',
                ));
        
                if ($validator->fails()) {
                    return response()->json([
                        'error'    => true,
                        'messages' => $validator->errors(),
                    ], 422);
                }
        
                $inputs = $request->post();
                //$inputs['user_updated_id'] = \Auth::user()->id;
                $this->teacherRepository->update($id,$inputs);
        
                return response()->json([
                    'error' => false,
                    'msg'  => 'Mise a jour effectue avec succes!',
                ], 200);
            }
        
            public function destroy($id)
            {
                toggleDatabase(); 
                //$inputs['user_updated_id'] = \Auth::user()->id;
                $inputs['display'] = 0;
                $this->teacherRepository->update($id,$inputs);
                return response()->json([
                    'error' => false,
                    'msg'  => 'Element supprimé avec succès',
                ], 200);
            }
        }
        
