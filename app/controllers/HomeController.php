<?php

class HomeController extends BaseController {

    public function home($friend_user_id = false)
    {
        $firstName = Auth::user()->first_name;  
        
        $postModel = new Post();
      
        if ($friend_user_id) {
             $userID = $friend_user_id;
            
            $friend = User::find($userID);
            $friendName = $friend->first_name.' '.$friend->last_name;
            $firstName = "to $friendName's Page";
        } else {
            $userID = Auth::user()->id;
        }
      
//         $allMyPosts = $postModel->getAllMyPosts($userID);
        $allMyPosts = $postModel->getPosts($userID);
      
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
