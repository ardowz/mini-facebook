<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Friend extends Eloquent {
  
    protected $table = 'friends';
  
    public function acceptRequest($requestID)
    {
        
    }
  
    public function getFriends($userID)
    {
        $friends = DB::table('friends')
              ->join('users', 'users.id', '=', 'friends.friend_user_id')
              ->where('friends.user_id', '=', $userID)
//               ->where('friends.isAccepted', '=', 1)
              ->select('friends.friend_user_id as user_id', 'users.first_name', 'users.last_name')
              ->get();
      
        return $friends;
    }
}