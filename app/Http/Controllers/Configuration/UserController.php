<?php
namespace App\Http\Controllers\Configuration;
use App\Repositories\Configuration\UserRepository;
use App\Repositories\Mobility\ProfileRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Model\Configuration\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller{
 
    private $userRepository;
    private $profileRepository;
    public function __construct(UserRepository $userRepository, ProfileRepository $profileRepository) {
       
        $this->userRepository= $userRepository;
        $this->profileRepository= $profileRepository;
        $this->middleware('auth');
    }

       public function index()
            {
                $users = $this->userRepository->getAll();
                $profiles = $this->profileRepository->getAll();
                return view('configuration.user.index',compact("users", "profiles"));
            }
            public function profile(){
                $user = $this->userRepository->getById(\Auth::user()->id);
                $profiles = $this->profileRepository->getAll();
                return view('configuration.user.profile',compact("user", "profiles"));
        
             }
            
            public function store(Request $request)
            {
                $validator = Validator::make($request->input(), array(
                    'name' => ['required', 'string', 'max:255'],
                    'username' => ['required', 'string', 'max:255', 'unique:users'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'password' => ['required', 'string', 'min:8'],
                ));
        
                if ($validator->fails()) {
                    return response()->json([
                        'error'    => true,
                        'messages' => $validator->errors(),
                    ], 422);  
                }
                $input = $request->post();
                $user = User::create(
                    [
                        'name'=>$input['name'],
                        'email'=>$input['email'],
                        'phone'=>$input['phone'],
                        'address'=>$input['address'],
                        'username'=>$input['username'],
                        'password'=>Hash::make($input['password']),
                        'profile_id'=>$input['profile_id'],
                        'institution_id'=>\Auth::user()->institution_id
                    ]
                );
                try{
                    $email = $input['email'];
                     \Mail::send('mails.user',$input, function ($message) use ($email) {
                    $message->to($email)->subject('Account Creation from MC');
                    });
       
                    if (\Mail::failures()) {
                       return response()->json([
                           'error' => true,
                           'user'  => 'failed sending email to user please resend again!',
                           'msg'  => "L\'utilisateur a été enregistré avec succès!",
                       ], 500);
                    }else{
                        $profiles = $this->profileRepository->getAll();
                        return response()->json([
                            'error' => false,
                            'user'=>$user,
                            'profiles'=>$profiles,
                            'msg'  => "L\'utilisateur a été enregistré avec succès!",
                        ], 200);          
                   }
                }catch(\Exception $exception){
                   

                   return response()->json([
                       'error' => true,
                       'user'=>$user,
                       'msg'  => "L\'utilisateur a été enregistré avec succès!",
                   ], 200);
               }
                
            }
        
            public function show($id)
            {
                $inputs = $this->userRepository->getById($id);
        
                return response()->json([
                    'error' => false,
                    'user'  => $inputs,
                ], 200);
            }
        
            public function update(Request $request, $id)
            {
                $inputs = $request->input();
                $validator = Validator::make($request->input(), array(
                    'name' => ['string', 'max:255'],
                    'username' => ['string', 'max:255'],
                    'email' => ['string', 'email', 'max:255'],
                    'password' => ['string', 'min:8'],
                ));
        
                if ($validator->fails()) {
                    return response()->json([
                        'error'    => true,
                        'messages' => $validator->errors(),
                    ], 422);
                }
        
                $inputs['user_updated_id'] = \Auth::user()->id;
                $this->userRepository->update($id,$inputs);
        
                return response()->json([
                    'error' => false,
                    'msg'  => 'Mise a jour effectue avec succes!',
                ], 200);
            }
        
            public function destroy($id)
            {
                $inputs['user_updated_id'] = \Auth::user()->id;
                $inputs['display'] = 0;
                $this->userRepository->update($id,$inputs);
                return response()->json([
                    'error' => false,
                    'msg'  => 'Element supprimé avec succès',
                ], 200);
            }
            public function update_avatar (Request $request){

                $image = $request->file('avatar');
                $user = \Auth::user();
                $avatarName = $user->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();
                $destinationPath = public_path('/storage/avatar');
                $image->move($destinationPath, $avatarName);
                $user->avatar = $avatarName;
                $user->save();
                return response()->json([
                    'success' => true,
                    'msg'  => 'image enregistrée avec succès',
                ], 200);
            }

            public function changePassword(Request $request){
                $inputs = $request->input();
                $validator = Validator::make($request->input(), array(
                    'password' => ['required', 'string', 'max:255'],
                    'newPassword' => ['required', 'string', 'min:8'],
                    'confirmPassword' => ['required', 'string', 'min:8, required|same:newPassword'],
                ));
                if ($validator->fails()) {
                    return response()->json([
                        'error'    => true,
                        'messages' => $validator->errors(),
                    ], 422);  
                }
                $input = $request->post();
                $user = \Auth::user();
                dd($inputs['password']);
                dd($user->password.'     '. Hash::make($inputs['newPassword']) );
                if(Hash::make($inputs["password"]) ==  $user->password){
                    dd('pass');
                }
                $user->password= \Hash::make($input['password']);
                $user->save();
                return response()->json([
                    'success' => true,
                    'msg'  => 'Mot de passe modifié  avec succès',
                ], 200);

            }
    }
        
