<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');

    public function posts()
    {
        $this->hasMany('Post');
    }
  
    public function searchName($queryString, $userID)
    {
        $users = DB::table('users')
              ->leftJoin('friends', function ($join) use ($userID) {
                  $join->on('friends.friend_user_id', '=', 'users.id')
                      ->where('friends.user_id', '=', $userID);
              })
              ->where('users.id', '!=', $userID)
              ->where(function ($query) use ($queryString) {
                  $query->where('last_name', 'like', '%'.$queryString.'%')
                      ->orWhere('first_name', 'like', '%'.$queryString.'%');
                })
              ->whereNull('friends.id')
              ->select('users.id', 'users.first_name', 'users.last_name')
              ->get();
        return $users;
    }
  
    public function scopeNotMyself($query, $userID)
    {
        return $query->where('id', '!=', $userID);
    }

    public function scopeLikeFirstName($query, $name)
    {
        return $query->where('first_name', 'like', '%'.$name.'%');
    }
  
    public function scopeLikeLastName($query, $name)
    {
        return $query->where('last_name', 'like', '%'.$name.'%');
    }
  
    public function scopeLikeEmail($query, $email)
    {
        return $query->where('email', 'like', '%'.$email.'%');  
    }

}
