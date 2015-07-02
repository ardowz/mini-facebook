<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Friend extends Eloquent {
  
    protected $table = 'friends';
  
    public function acceptRequest($requestID)
    {
        DB::transaction(function() use ($requestID){
            $friendModel = Friend::find($requestID);
        
            $requestingUserID = $friendModel->user_id;
            $acceptingUserID = $friendModel->friend_user_id;

            $friendModel->isAccepted = 1;
            $friendModel->save();

            $newFriendModel = new Friend;
            $newFriendModel->user_id = $acceptingUserID;
            $newFriendModel->friend_user_id = $requestingUserID;
            $newFriendModel->isAccepted = 1;
            $newFriendModel->save();  
        });
      
        return true;
    }
  
    public function getFriends($userID)
    {
        $friends = DB::table('friends')
              ->join('users', 'users.id', '=', 'friends.friend_user_id')
              ->where('friends.user_id', '=', $userID)
              ->where('friends.isAccepted', '=', 1)
              ->select('friends.friend_user_id as user_id', 'users.first_name', 'users.last_name')
              ->get();
      
        return $friends;
    }
  
    public function getWaitingFriends($userID)
    {
        $friends = DB::table('friends')
              ->join('users', 'users.id', '=', 'friends.user_id')
              ->where('friends.friend_user_id', '=', $userID)
              ->where('friends.isAccepted', '=', 0)
              ->select('friends.id as request_id', 'users.first_name', 'users.last_name')
              ->get();
      
        return $friends;
    }
  
    public function deleteFriend($userID, $friendUserID)
    {
        DB::transaction(function() use ($userID, $friendUserID){
            $friendModel = Friend::where('user_id', '=', $userID)
              ->where('friend_user_id', '=', $friendUserID)
              ->delete();
        
            $inverseFriendModel = Friend::where('user_id', '=', $friendUserID)
              ->where('friend_user_id', '=', $userID)
              ->delete();
        });
      
        return true;
    }
}