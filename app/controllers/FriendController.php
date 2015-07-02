<?php
Class FriendController extends BaseController {

    public function friends()
    {
        
        $searchString = Input::get('search_user_string');
        $foundUsers = $this->findUsers($searchString, Auth::user()->id);
        
        $friendList = $this->getFriends(Auth::user()->id);
      
        return View::make('home.friends', array(
            'foundUsers' => $foundUsers,
            'friendList' => $friendList,
            'searchString' => $searchString,
            'firstName' => Auth::user()->first_name,
        ));
    }
  
    public function findUsers($searchString, $userID)
    {
        if (empty($searchString)) {
            return array(); 
        } else {
            $validator = Validator::make(
                array('email' => $searchString),
                array('email' => 'email')
            );
            
            if ($validator->fails()) {
                $userModel = new User();
                $users = $userModel->searchName($searchString, $userID);
            } else {
                $users = User::LikeEmail($searchString)->NotMyself->get();
              
            }
            
            $output = array();
          
            foreach($users as $user) {
                $output[$user->id] = $user->first_name.' '.$user->last_name;
            }
            
            return $output;
        }
    }
  
    public function addFriendAction()
    {
        $prospectFriendUserID = Input::get('user_id');
        
        $friendModel = new Friend;
        $friendModel->user_id = Auth::user()->id;
        $friendModel->friend_user_id = $prospectFriendUserID;
        $friendModel->save();
      
        return Redirect::to('home')->with('message', 'Friend Request Sent');
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
}