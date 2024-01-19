<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CustomAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'min:2 | max:45',
            'email' => 'email|required|unique:users',
            'password' => 'min:6|max:20',
          //  'password' => ['min:6', 'max:20'],
        ]);
        // redirect()->back()->withErrors()->withInput()
        // v 10 publier le dossier lang / php artisan lang:publish

        // User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => $request->password,
        // ]);

        $user = new User;
        $user->fill($request->all()); 
        $user->password = Hash::make($request->password);
        $user->save();

        $to_name = $request->name;
        $to_email = $request->email;
        $body = "<a href='http://www.localhost:8000'>Cliquez ici pour confirmer votre compte.</a>";

        //return view('email.mail',['name'=> $to_name, 'body'=>$body]);

        Mail::send('email.mail',['name'=> $to_name, 'body'=>$body], 
            function($message) use ($to_name, $to_email){
                $message->to($to_email, $to_name)->subject('Test Laravel'); 
            });
        
        return redirect(route('login'))->withSuccess('Utilisateur enregistré!');

    }

    public function authentication(Request $request){
        
        $request->validate([
            'email' => 'email|required|exists:users',
            'password' => 'min:6|max:20',
        ]);
        
        $credentials = $request->only('email', 'password');

        
        if(!Auth::validate($credentials)):
            return redirect(route('login'))->withErrors(trans('auth.password'))->withInput();
        endif;

        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        Auth::login($user);
        Auth::user()->roles()->detach();

        if($user->role == 1){
            $user->assignRole('Admin');
         }elseif($user->role == 2){
            $user->assignRole('Editor');
         }

        return redirect()->intended(route('blog.index'));

    }

    public function logout(){
        Auth::logout();
        return redirect(route('login'));
    }

    public function userList(){

        if(Auth::user()->can('edit-users')){

            $users = User::Select('id','name')
            ->orderBy('name')
            ->paginate(5);

        return view('auth.user-list', compact('users'));
        }else{
            return 'Domage';
        }

    }

    public function forgotPassword(){
        return view('auth.forgot-password');
    }

    public function tempPassword(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users'
        ]);

        $user = User::where('email', $request->email)->first();
        $userId = $user->id;
        
        $tempPassword = str::random(45);

        $user->temp_password = $tempPassword;
        $user->save();

        $to_name = $user->name;
        $to_email = $user->email;
        $body = "<a href='".route('new.password', [$userId, $tempPassword])."'>Cliquez ici pour réinitializer votre mot de passe.</a>";

       // return $body;

        //return view('email.mail',['name'=> $to_name, 'body'=>$body]);

        Mail::send('email.mail',['name'=> $to_name, 'body'=>$body], 
            function($message) use ($to_name, $to_email){
                $message->to($to_email, $to_name)->subject('Reset Password'); 
            });

        return redirect(route('login'))->withSuccess('Verifier votre courriel');
    }

    public function newPassword(User $user, $tempPassword){

       // return  $user->temp_password." ".$tempPassword;

        if($user->temp_password === $tempPassword){
            return view('auth.new-password');
        }
        return redirect('forgot-password')->withErrors(trans('auth.failed'));
    }

    public function storeNewPassword(User $user, $tempPassword, Request $request){
        
        if($user->temp_password === $tempPassword){
            $request->validate([
                'password' => 'required|min:6|max:20|confirmed'
            ]);
            $user->password = Hash::make($request->password);
            $user->temp_password = null;
            $user->save();
            return redirect(route('login'))->withSuccess('Mot de passe modifié');
        }
        return redirect('forgot-password')->withErrors(trans('auth.failed'));
    }

}
