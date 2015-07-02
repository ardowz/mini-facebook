<?php

class HomeController extends BaseController {

    public function home()
    {
        $firstName = Auth::user()->first_name;  
      
        return View::make('home.home', array(
            'firstName' => $firstName
        ));
    }

    public function welcome()
    {
        return View::make('welcome');
    }
}
