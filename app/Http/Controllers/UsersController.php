<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\District;
use Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use URL;

class UsersController extends Controller
{
    protected $page_title = "Performance Tracking System | Users";

	public function index(){
        if(auth()->user()) {
            if(auth()->user()->role_id == 1){
    		    return redirect()->to('/admin/dashboard');
            } else if(auth()->user()->role_id == 2){
                return redirect()->to('/bank/index');
            } else {
                return redirect()->to('/company/index');
            }
        }

        $this->page_title = "Performance Tracking System | User Login";

        return view('users.login')
            ->with('page_title', $this->page_title);
	}

    public function forgetpassword(){
        $this->page_title = "Performance Tracking System | Forget Password";

        return view('users.forget')
            ->with('page_title', $this->page_title);
    }

    public function verifyemail(Request $request){
        $email = $request->input('email');

        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', '=', $email)->first();

        if($user){
            if($user->role_id == 3) {
                return Redirect::to('users/resetpassword/'.$email);
            }
        }
        return redirect()->to('users/forgetpassword')->withErrors([
                'message' => 'Error! Your email does not exist in the database. Please try again later or try a differnt email to proceed.'
            ]);
    }

    public function resetpassword($email){
        $this->page_title = "Performance Tracking System | Reset Password";

        return view('users.resetpassword')
            ->with('email', $email)
            ->with('page_title', $this->page_title);
    }

    public function setnewpassword(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');

        $request->validate([
                'password' => [
                'required',
                'string',
                'min:8',             // must be at least 8 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[0-9]/',      // must contain at least one digit
            ],
            'confirm_password' => 'required|min:8|same:password'
        ]);

        $key = 'SuperSecretKey';
        $user = User::where('email', '=', $email)->first();
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return redirect()->to('users/login')
                ->with('message', 'Your password has been resetted successfully. Please logging in with the new password.');
    }

    public function register(){
        $districts = District::where('is_specific_quota', 0)->get();

        $this->page_title = "Performance Tracking System | Register User";

        return view('users.register')
            ->with('districts', $districts)
            ->with('page_title', $this->page_title);
    }

    public function storeuser(Request $request){
        $validator = Validator::make($request->all(), User::$rules_createuser);

        if($validator->passes()) {

            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->district_id = $request->input('district_id');
            $user->role_id = 3;
            $user->save();

            return redirect()->to('users/login')
                ->with('message', 'Thankyou for creating a new account. Pleas Sign in to continue.');
        }

        return redirect()->to('users/register')
            ->with('message', 'Something went wrong')
            ->withErrors($validator)
            ->withInput();
    }

	public function signin() {


		$remember = request('remember') == 1 ? true:false;

		if (auth()->attempt(request(['email', 'password']), $remember) == false) {
            return back()->withErrors([
                'message' => 'The email or password maybe incorrect, please try again later.'
            ]);
        }

        if(auth()->user()->role_id == 1){
            return redirect()->to('admin/dashboard');
        } else if(auth()->user()->role_id == 2) {
            return redirect()->to('bank/index')->with('message', 'Hi '. auth()->user()->name. ', Thanks for signing in.');
        } else{
            return redirect()->to('company/index')->with('message', 'Hi '. auth()->user()->name. ', Thanks for signing in.');
        }


	}

    public function signout()
    {
        auth()->logout();
        return redirect()->to('/users/login');
    }


    public function permissiondenied(){
        $this->page_title = "Performance Tracking System | Permission Denied";
        return view('errors.550')
            ->with('page_title', $this->page_title);
    }
}
