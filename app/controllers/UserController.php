<?php

class UserController extends BaseController {

    public function signup() 
    {
        return View::make('users.signup');
    }
  
    public function signupAction()
    {
        $firstName = Input::get('first_name');
        $lastName = Input::get('last_name');
        $email = Input::get('email');
        $password = Input::get('password');
        $passwordVerify = Input::get('password_verify');
      
        $validator = Validator::make(
            array(
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $email,
                'password' => $password,
                'password_verify' => $passwordVerify,
            ),
            array(
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8',
                'password_verify' => 'required|min:8|same:password',
                
            )
        );
      
        if ($validator->fails()) {
            return Redirect::route('signup')
              ->withErrors($validator);
        }
      
        $userModel = new User;
        $userModel->first_name = $firstName;
        $userModel->last_name = $lastName;
        $userModel->email = $email;
        $userModel->password = Hash::make($password);
        $userModel->save();
      
        return Redirect::to('login')->with('message', 'Sign up complete, please sign in');
    }
  
    public function login() 
    {
        return View::make('users.login');
    }
  
    public function loginAction()
    {
        $email = Input::get('email');
        $password = Input::get('password');
      
        if (Auth::attempt(array('email' => $email, 'password' => $password))) {
            return Redirect::to('home');
        } else {
            return Redirect::to('login')->with('message', 'Invalid Login');
        }
    }
  
    public function logoutAction()
    {
        Auth::logout();
        return Redirect::to('home')->with('message', 'Successfully logged out');
    }
}