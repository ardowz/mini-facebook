<?php

class HomeController extends BaseController {

    public function home()
    {
        $firstName = Auth::user()->first_name;  
        
        $postModel = new Post();
      
        $userID = Auth::user()->id;
        $allMyPosts = $postModel->getAllMyPosts($userID);
        $myFriends = $this->getFriends($userID);
        
        return View::make('home.home', array(
            'firstName' => $firstName,
            'posts' => $allMyPosts,
            'friends' => $myFriends,
        ));
    }

    public function getFriends($userID)
    {
        $friendModel = new Friend();
        $friends = $friendModel->getFriends($userID);
        
        $output = array();
      
        if (count($friends) > 0) {
            foreach($friends as $friend) {
                $output[$friend->user_id] = $friend->first_name.' '.$friend->last_name;
            }
        } 
        
        return $output;
    }

    public function welcome()
    {
        return View::make('welcome');
    }
}
