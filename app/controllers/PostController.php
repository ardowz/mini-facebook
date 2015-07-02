<?php
Class PostController extends BaseController {

    public function newAction()
    {
        $userID = Auth::user()->id;
        $post = Input::get('post');
      
        //default true
        $isREST = isset(Input::get('isRest') ? Input::get('isRest') : true);
        if ($isRest) {
          
        } else {
            return Redirect::to('home');
        }
        
    }
}