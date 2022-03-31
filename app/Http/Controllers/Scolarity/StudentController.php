<?php
namespace App\Http\Controllers\Scolarity;
use App\Repositories\Scolarity\StudentRepository;
use App\Repositories\Configuration\DisciplineRepository;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Scolarity\Student;
use Illuminate\Support\Facades\Validator;
class StudentController extends Controller{
    
 private $StudentRepository,$DisciplineRepository;

            public function __construct(StudentRepository $StudentRepository,DisciplineRepository $DisciplineRepository){
                $this->StudentRepository= $StudentRepository;
                $this->DisciplineRepository= $DisciplineRepository;

                $this->middleware('auth');

            }

       public function index()
            {
                toggleDatabase(); 
                $students =$this->StudentRepository->getAll();
                $disciplines =$this->DisciplineRepository->getAll();

                return view('scolarity.student.index',compact("disciplines","students"));
            }
        
            public function store(Request $request){
                toggleDatabase(); 
                    $validator = Validator::make($request->input(), array(
                        'chosen_discipline' => 'required',
                      //  'tutor_contact' => 'required',
                        'last_name' => 'required',
                       // 'diploma_average' => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
                    ));
            
                    if ($validator->fails()) {
                        return response()->json([
                            'error'    => true,
                            'messages' => $validator->errors(),
                        ], 422);  
                    }
            
                    $inputs = $this->StudentRepository->store($request->all());
            
                    return response()->json([
                        'error' => false,
                        'msg'  => "L'étudiant ".$inputs->name." a été enregistré avec succès!",
                        'Student'  => $inputs,
                    ], 200);
            }
        
            public function show($id)
            {
                toggleDatabase(); 
                $inputs = $this->StudentRepository->getById($id);
          //dd($inputs);
                return response()->json([
                    'error' => false,
                    'Student'  => $inputs,
                ], 200);
            }
        
            public function update(Request $request, $id)
            {
                toggleDatabase(); 
                $validator = Validator::make($request->input(), array(
                   // 'entrance_diploma_year' => 'integer|nullable',
                   // 'diploma_average' => 'nullable|regex:/^\d+(\.\d{1,2})?$/',

                ));

        
                if ($validator->fails()) {
                    return response()->json([
                        'error'    => true,
                        'messages' => $validator->errors(),
                    ], 422);
                }
        
                $inputs = $request->post();
              //  dd($request->post());
                $inputs['user_updated_id'] = \Auth::user()->id;
                $this->StudentRepository->update($id,$inputs);
        
                return response()->json([
                    'error' => false,
                    'msg'  => 'Mise a jour effectue avec succes!',
                    'student'  => $inputs,

                ], 200);
            }
            public function updateM(Request $request, $id)
            {
                toggleDatabase(); 
                $validator = Validator::make($request->input(), array(
                    'first_name' => 'required',
                ));

        
                if ($validator->fails()) {
                    return response()->json([
                        'error'    => true,
                        'messages' => $validator->errors(),
                    ], 422);
                }
        
                $inputs = $request->post();
              //  dd($request->post());
                $inputs['user_updated_id'] = \Auth::user()->id;
                $this->StudentRepository->update($id,$inputs);
        
                return response()->json([
                    'error' => false,
                    'msg'  => 'Mise a jour effectue avec succes!',
                    'student'  => $inputs,

                ], 200);
            }
        
            public function destroy($id)
            {
                toggleDatabase(); 
                $inputs['user_updated_id'] = \Auth::user()->id;
                $inputs['display'] = 0;
                $this->StudentRepository->update($id,$inputs);
                return response()->json([
                    'error' => false,
                    'msg'  => 'Element supprimé avec succès',
                ], 200);
            }

            public function updatePhoto (Request $request, $id){
                toggleDatabase(); 
                $image = $request->file('photo');
                $student = $this->StudentRepository->getById($id);
                $newName = \Auth::user()->id.'_photo'.time().'.'.request()->photo->getClientOriginalExtension();
                $destinationPath = public_path('/storage/student');
                $image->move($destinationPath, $newName);
                $student->photo = $newName;
                $student->save();
                return response()->json([
                    'success' => true,
                    'msg'  => 'image enregistrée avec succès',
                ], 200);
            }
        }
        
