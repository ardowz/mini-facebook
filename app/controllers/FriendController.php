<?php
Class FriendController extends BaseController {

    public function friends()
    {
        
        $searchString = Input::get('search_user_string');
        $userID = Auth::user()->id;
        
        $foundUsers = $this->findUsers($searchString, $userID);
        $friendList = $this->getFriends($userID);
        $friendsWaiting = $this->getWaitingFriends($userID);
      
        return View::make('home.friends', array(
            'foundUsers' => $foundUsers,
            'friendList' => $friendList,
            'searchString' => $searchString,
            'friendsWaiting' => $friendsWaiting,
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
                $users = User::LikeEmail($searchString)->NotMyself($userID)->get();
              
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
  
    public function getWaitingFriends($userID)
    {
        $output = array();
        $friendModel = new Friend();
        $friends = $friendModel->getWaitingFriends($userID);
        
        if (count($friends) > 0) {
            foreach($friends as $friend) {
                $output[$friend->request_id] = $friend->first_name.' '.$friend->last_name;
            }
        } 
      
        return $output;
    }
  
    public function friendAction()
    {
        $friendRequestID = Input::get('request_id');
        $isAccept = Input::get('approve_function');
      
        if ($isAccept) {
              $friendModel = new Friend();
              $friendModel->acceptRequest($friendRequestID);
              return Redirect::to('friends')->with('message', 'Request Accepted');
        } else {
              $friendModel = Friend::find($friendRequestID);
              $friendModel->delete();
              return Redirect::to('friends')->with('message', 'Request Declined');
        }
    }
  
    public function friendDeleteAction()
    {
        $friendUserID = Input::get('friend_user_id');
        $userID = Auth::user()->id;
      
        $friendModel = new Friend();
        $friendModel->deleteFriend($userID, $friendUserID);
      
        return Redirect::to('friends')->with('message', 'Friend Removed');
    }
}