<?php
namespace App\Http\Controllers\Configuration;
use App\Repositories\Configuration\DepartmentRepository;
use App\Repositories\Configuration\TeacherRepository;
use App\Repositories\Configuration\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Configuration\Department;
use Illuminate\Support\Facades\Validator;
class DepartmentController extends Controller{
    
    private $departmentRepository;
    private $teacherRepository;
    private $userRepository;

    public function __construct(DepartmentRepository $departmentRepository, UserRepository $userRepository, TeacherRepository $teacherRepository){
        toggleDatabase(); 
        $this->departmentRepository= $departmentRepository;
        $this->teacherRepository= $teacherRepository;
        $this->userRepository= $userRepository;
        $this->middleware('auth');

    }
     public function disciplines_index($id){
        toggleDatabase();
        $department =$this->departmentRepository->getDisciplines($id);
        $disciplines=$department->disciplines->where('display', 1);
        $teachers =$this->teacherRepository->getAll();
        $name=$department->name;
        $departmentId=$department->id;
        return view('configuration.discipline.index',compact("disciplines","name","departmentId", "teachers"));
     }

       public function index()
            {
                toggleDatabase();
                $departments =$this->departmentRepository->getAll();
                $teachers =$this->teacherRepository->getAll();
                return view('configuration.department.index',compact("departments", "teachers"));
            }
        
            public function store(Request $request)
            {
                toggleDatabase();
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
        
                $inputs = $this->departmentRepository->store($request->all());
        
                return response()->json([
                    'error' => false,
                    'department'  => $inputs,
                    'msg'  => __("theDepartment ").$inputs->name." a été enregistré avec succès!",
                ], 200);

            }
        
            public function show($id)
            {
                toggleDatabase();
              $inputs=  $this->departmentRepository->getById($id);        
                return response()->json([
                    'error' => false,
                    'department'  => $inputs,
                ], 200);
            }
        
            public function update(Request $request, $id)
            { //$inputs['user_updated_id'] = \Auth::user()->id;

                $validator = Validator::make($request->input(), array(
                    'status' => 'required',
                    'scolarity'=> 'nullable | integer',
                    'name'=> 'required',
                ));
        
                if ($validator->fails()) {
                    return response()->json([
                        'error'    => true,
                        'messages' => $validator->errors(),
                    ], 422);
                }
        
                toggleDatabase();
                $inputs = $request->post();
        //        $inputs['user_updated_id'] = \Auth::user()->id;
                $this->departmentRepository->update($id,$inputs);
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
                $this->departmentRepository->update($id,$inputs);
        
                return response()->json([
                    'error' => false,
                    'msg'  => 'Element supprimé avec succès',
                ], 200);
            }
        }
        
