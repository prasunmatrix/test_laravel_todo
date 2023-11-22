<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User, PasswordReset, Todo};
// use App\Models\Branch;
// use App\Models\Tender;
// use App\Models\KnowledgeCorner;
use Auth;
use Redirect;
use Validator;
use Hash;
use Illuminate\Support\Str;


class AdminController extends Controller
{
  public function index(Request $request)
  {
    //dd('test');
    $this->data['page_title'] = 'Control Panel:Login';
    $this->data['panel_title'] = 'Control Panel:Login';
    if (Auth::guard('admin')->check()) {
      // If admin is logged in, redirect him to dashboard page //
      return \Redirect::route('admin.dashboard');
    } else {
      return view('admin.login.admin_login', $this->data);
    }
  }
  public function verifylogin(Request $request)
  {
    //dd('test');
    if (Auth::guard('admin')->check()) {
      // If admin is logged in, redirect him/her to dashboard page //
      return Redirect::Route('admin.dashboard');
    } else {
      try {
        if ($request->isMethod('post')) {
          // Checking validation
          $validationCondition = array(
            'email' => 'required',
            'password' => 'required',
          );
          $Validator = Validator::make($request->all(), $validationCondition);

          if ($Validator->fails()) {
            // If validation error occurs, load the error listing
            return Redirect::route('admin.login')->withErrors($Validator);
          } else {
            $rememberMe = false; // set default boolean value for remember me

            if ($request->input('remember_me')) // if user checked remember me
              $rememberMe = true; // set user value

            $email = $request->input('email');
            $password = $request->input('password');

            /* Check if user with same email exists, who is:-
                    1. Blocked or Not
                      */
            $userExists = User::where(
              array(
                'email' => $email,
                'status' => 'A',
              )
            )->count();


            if ($userExists > 0) {
              // if user exists, check the password
              $auth = auth()->guard('admin')->attempt([
                'email' => $email,
                'password' => $password,
              ], $rememberMe);

              if ($auth) {
                return Redirect::Route('admin.dashboard');
              } else {
                $request->session()->flash('error', 'Invalid Password');
                return Redirect::Route('admin.login');
              }
            } else {
              $request->session()->flash('error', 'You are not an authorized user');
              return Redirect::Route('admin.login');
            }
          }
        }
      } catch (Exception $e) {
        return Redirect::Route('admin.login')->with('error', $e->getMessage());
      }
    }
  }
  public function dashboardView()
  {
    $this->data['page_title'] = 'Admin | Dashboard';
    $this->data['panel_title'] = 'Admin Dashboard';

    // $this->data['total_branch'] = Branch::where('is_deleted', '=', '0')
    //   ->get()
    //   ->count();
    // $this->data['total_tender'] = Tender::where('is_deleted', '=', '0')
    //   ->get()
    //   ->count();

    $this->data['total_user'] = User::get()->count();
    $loginUserId = Auth::guard('admin')->user()->id;
    //dd($loginUserId);
    $this->data['total_task_logedin_user'] = Todo::where('user_id', '=', $loginUserId)->count();
   
    return view('admin.dashboard.index', $this->data);
  }
  public function logout()
  {
    // echo "aaa";die;
    if (Auth::guard('admin')->logout()) {
      return Redirect::Route('admin.login');
    } else {
      return Redirect::Route('admin.dashboard');
    }
  }
  public function register(Request $request)
  {
    $this->data['page_title'] = 'Admin:Registration';
    $this->data['panel_title'] = 'Admin:Registration';
    if (Auth::guard('admin')->check()) {
      // If admin is logged in, redirect him to dashboard page //
      return \Redirect::route('admin.dashboard');
    } else {
      return view('admin.register.register', $this->data);
    }
  }
  public function postRegister(Request $request)
  {
    //dd($request->all());  
    $validator = Validator::make(
      $request->all(),
      [
        'first_name'             => 'required',
        'last_name'              => 'required',
        //'business_name'          => 'required',
        'email'                => 'required|email|unique:users',
        //'phone'           => 'required|min:10|max:10|unique:users',
        //'password'              => 'required|confirmed|min:8',
        'password'              => 'required|min:8',
        'confirm_password'       => 'same:password',
      ],
      [
        'required' => 'The :attribute field is required',
        'email.unique'   => 'This email has already been registered',
        'email'    => 'This is not a valid email format',
        //'phone.unique'   => 'This phone number has already been taken',
        //'phone.min' => 'Phone Number has to be :min chars long',
        //'phone.max' => 'Phone Number can be maximum :max chars long',
        'password.min' => 'Password must be at least :min characters',
        //'password.confirmed' => 'Password & Confirm Password must be same',
        'confirm_password.same' => 'Password & Confirm Password must be same',
      ]
    );

    if ($validator->fails()) {
      /*echo 'Failed';
      exit();*/
      return Redirect::back()
        ->withErrors($validator)
        ->withInput();
    } else {
      $first_name = trim($request->get('first_name'));
      $last_name = trim($request->get('last_name'));
      $business_name = trim($request->get('business_name'));
      $email = trim($request->get('email'));
      //$phone = trim($request->get('phone'));
      $password = trim($request->get('password'));
      $fullname = $first_name . " " . $last_name;

      $adminUser = User::create([
        'name' => $fullname,
        'company_name' => $business_name,
        'email' => $email,
        'usertype' => 'SA',
        'password' => $password,
        'status' => 'A'
      ]);
      if ($adminUser != null) {
        // $token = Str::random(60);
        // $frontendUser->userkey = $token;
        // $frontendUser->save();

        // $data['token'] = $token;
        // $data['email'] = $frontendUser->email;
        // //dd($data);
        // //Mail::to($email)->send(new FrontEndUserWelcomeMail($data));
        // Mail::send('email.frontenduser-email-register', $data, function($message) use ($data)
        //   {
        //       $message->from('no-reply@mellobridge.com', "Mello Bridge");
        //       $message->subject("Welcome to Mello Bridge");
        //       $message->to($data['email']);
        //   });
        //$successMsg = 'Thank you '.$adminUser->name.'. PLEASE CHECK YOUR EMAIL to confirm your email address';
        $successMsg = 'Thank you ' . $adminUser->name . ' for your registration,please login with your credential.';
        return Redirect::back()
          ->withSuccess($successMsg);
      } else {
        $errMsg = array();
        $errMsg['registrationerror'] = 'Something went wrong, please try again';
        return Redirect::back()
          ->withErrors($errMsg)
          ->withInput();
      }
    }
  }
  public function showChangePasswordForm()
  {
    $this->data['page_title'] = 'Admin | Change Password';
    $this->data['panel_title'] = 'Change Password';
    return view('admin.dashboard.changepassword', $this->data);
  }
  public function changePassword(Request $request)
  {
    //dd($request->all());
    if (!(Hash::check($request->get('current_password'), Auth::guard('admin')->user()->password))) {
      // The passwords matches
      return redirect()->back()->with("error", "Your current password does not matches with the password you provided. Please try again.");
    } else {
      try {

        $validationCondition = [
          'new_password' => 'required',
          'confirm_password' => 'required|same:new_password',
        ];

        $validationMessages = array(
          'new_password.required' => 'New Password is required.',
          'confirm_password.required' => 'Confirm Password is required.',
          'confirm_password.same' => 'Confirm Password should be same as new password.',
        );

        $Validator = Validator::make($request->all(), $validationCondition, $validationMessages);
        if ($Validator->fails()) {
          // If validation error occurs, load the error listing
          return redirect()->back()->withErrors($Validator);
        } else {
          $user = User::findOrFail(Auth::guard('admin')->user()->id);
          $user->password = Hash::make($request->new_password);
          $saveResposne = $user->save();
          if ($saveResposne == true) {
            return redirect()->back()->with("success", "Password changed successfully !");
          } else {
            return redirect()->back()->with("error", "Password changed successfully !");
          }
        }
      } catch (Exception $e) {
        return Redirect::Route('admin.changePassword')->with('error', $e->getMessage());
      }
    }
  }
  public function forgetPassword(Request $request)
  {
    $data['page_title'] = 'Admin | Recover Password';
    $data['panel_title'] = 'Recover Password';
    if (Auth::guard('admin')->check()) {
      // If admin is logged in, redirect him to dashboard page //
      return \Redirect::route('admin.dashboard');
    } else {
      return view('admin.login.forgotpassword', $data);
    }
  }
  public function postForgetPassword(Request $request)
  {
    //dd($request->all());
    $validator = Validator::make(
      $request->all(),
      [
        'resetemail'                 => 'required|email',
      ],
      [
        'resetemail.required'       => 'An email is required',
        'resetemail.email'          => 'This is an invalid email format',
      ]
    );
    if ($validator->fails()) {
      $resetEmailErr = array();
      $resetEmailErr['resetemailerror'] = $validator->errors()->first();
      return Redirect::back()
        ->withErrors($resetEmailErr)
        ->withInput();
    }
    $userEmail = trim($request->get('resetemail'));
    $user = User::where('email', $userEmail)->first();
    if ($user == null) {
      $resetEmailErr = array();
      $resetEmailErr['resetemailerror'] = 'You are not a registered user';
      return Redirect::back()
        ->withErrors($resetEmailErr)
        ->withInput();
    }
    $userStatus = $user->status;
    if ($userStatus == 'I') {
      $resetEmailErr = array();
      $resetEmailErr['resetemailerror'] = 'Please confirm your email first';
      return Redirect::back()
        ->withErrors($resetEmailErr)
        ->withInput();
    } else {
      $token = Str::random(250);
      //dd($token);
      $passwordResetExists = PasswordReset::where('email', $userEmail)->first();
      //dd($passwordResetExists);
      if ($passwordResetExists == null) {
        PasswordReset::create([
          'email'      => $userEmail,
          'token'      => $token
        ]);
      } else {
        PasswordReset::where('email', $userEmail)->update([
          'token' => $token
        ]);
      }
      \Mail::send(
        'email_templates.password_reset',
        [
          'user' => $userEmail,
          'app_config' => [
            'token'      => $token,
            //'appLink'       => Helper::getBaseUrl(),
            'controllerName' => 'user',
            'subject'       => 'A password reset request was made.',
          ],
        ],
        function ($m) use ($userEmail) {
          $m->to($userEmail)->subject('Password Reset');
        }
      );
      $successMsg = "A password reset link has been sent to your email";
      return Redirect::back()
        ->withSuccess($successMsg);
    }
  }
  public function getResetPassword($token)
  {
    if (Auth::guard('admin')->check()) {
      // If admin is logged in, redirect him to dashboard page //
      return \Redirect::route('admin.dashboard');
    } else {
      if (is_null($token)) {
        return Redirect::to('admin');
      } else {
        $token = trim($token);
        $tokenExists = PasswordReset::where('token', $token)->first();
        //dd($tokenExists);
        if ($tokenExists == null) {
          return Redirect::to('admin');
        } else {
          $data['page_title'] = 'Recover Password';
          $data['panel_title'] = 'Recover Password';
          $data['tok3n'] = $token;
          return view('admin.login.resetpassword', $data);
        }
      }
    }
  }
  public function postResetPassword(Request $request)
  {
    if (Auth::guard('admin')->check()) {
      // If admin is logged in, redirect him/her to dashboard page //
      return Redirect::Route('admin.dashboard');
    } else {
      $validator = Validator::make(
        $request->all(),
        [
          'password'              => 'required|confirmed|min:8',
          'tok3n'                 => 'required',
        ],
        [
          'password.min'          => 'Password must be :min chars long',
          'password.confirmed'    => 'Password & Confirm Password must be same',
          'tok3n.required'        => 'Token Missing',
        ]
      );
      if ($validator->fails()) {
        return Redirect::back()
          ->withErrors($validator)
          ->withInput();
      } else {
        $resetToken = trim($request->get('tok3n'));
        //dd($resetToken);
        $newPassword = trim($request->get('password'));
        $passwordResetExists = PasswordReset::where('token', $resetToken)->first();
        if ($passwordResetExists == null) {
          $resetPasswordErr = array();
          $resetPasswordErr['reseterror'] = 'Invalid Token';
          return Redirect::back()
            ->withErrors($resetPasswordErr)
            ->withInput();
        } else {
          $resetEmail = $passwordResetExists->email;
          //dd($resetEmail);
          $user = User::where('email', $resetEmail)->first();
          if ($user == null) {
            $resetPasswordErr = array();
            $resetPasswordErr['reseterror'] = 'You are not a registered user';
            return Redirect::back()
              ->withErrors($resetPasswordErr)
              ->withInput();
          } else {
            // $user->update([
            //   'password' => $newPassword,
            // ]);
            // $user->save();
            $newPasswordHash = Hash::make($newPassword);
            //dd($newPasswordHash);
            $userPass = User::where('email', $resetEmail)->update(['password' => $newPasswordHash]);
            //dd($userPass);
            PasswordReset::where('email', $resetEmail)->delete();
            // $request->session()->flash('alert-success', 'New Password has been set successfully');
            // return redirect()->route('admin.login');
            $successMsg = 'New Password has been set successfully';
            return Redirect('admin')
              ->withSuccess($successMsg);
          }
        }
      }
    }
  }
}
