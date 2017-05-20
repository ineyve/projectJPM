<?php

namespace App\Http\Controllers\Auth;

use App\Department;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Mail;
use Illuminate\Http\Request;
use App\Mail\EmailVerification;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255|regex:/^[a-zA-Z ]+$/',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|numeric',
            'password' => 'required|string|min:8|confirmed',
            'department_id' => 'exists:departments,id',
            //'profile_url' => 'regex:/^((http[s]?|ftp):\/)?\/?([^:\/\s]+)((\/\w+)*\/)([\w\-\.]+[^#?\s]+)(.*)?(#[\w\-]+)?$/',
            'presentation' => 'regex:/^[a-zA-Z ]+$/'

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'department_id' => $data['department_id'],
            'phone' => $data['phone'],
            'profile_photo'=> $data['profile_photo'],
            'profile_url'=> $data['profile_url'],
            'presentation' => $data['presentation'],
            'admin' => 0,
            'blocked' => 0,
            'print_evals' => 0,
            'print_counts' => 0,
        ]);
    }

    public function showRegistrationForm()
    {
        $departments=Department::all();
        return view('auth.register', compact('departments'));
    }

    public function register(Request $request)
    {
        // Laravel validation
        $validator = $this->validator($request->all());
        if ($validator->fails())
        {
            $this->throwValidationException($request, $validator);
        }
        // Using database transactions is useful here because stuff happening is actually a transaction
        // I don't know what I said in the last line! Weird!
        DB::beginTransaction();
        try
        {
            $user = $this->create($request->all());
            // After creating the user send an email with the random token generated in the create method above
            $email = new EmailVerification($user);
            Mail::to($user->email)->send($email);
            DB::commit();
            return redirect()->route('home')->with('success', 'user created successfully');
        }
        catch(Exception $e)
        {
            DB::rollback();
            return back();
        }
    }

    public function verify($userid, $token)
    {
        // The verified method has been added to the user model and chained here
        // for better readability
        $user = User::where('id', $userid)->first();
        if(hash('md5', $user->created_at) == $token)
            $user->verified();
        return redirect()->route('login')->with('success', 'email verified successfully');
    }
}
