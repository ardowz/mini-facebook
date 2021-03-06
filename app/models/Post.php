<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Post extends Eloquent {
  
    protected $table = 'posts';
  
    public function user()
    {
        $this->belongsTo('User');
    }
  
    public function getPosts($userID)
    {
        $posts = DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->whereIn('posts.user_id', function($query) use ($userID) {
                $query->select('friend_user_id')
                    ->from('friends')
                    ->where('friends.user_id', '=', $userID)
                    ->where('isAccepted', '=', 1);
            })
            ->orWhere('posts.user_id', '=', $userID)
            ->select('users.id as user_id', 'users.first_name', 'users.last_name','posts.id as post_id' , 'posts.post_data', 'posts.updated_at')
            ->orderBy('posts.updated_at', 'desc')
            ->get();
      
        $output = array();
        
        foreach($posts as $post) {
            $output[] = array(
                'user_id' => $post->user_id,
                'name' => $post->first_name.' '.$post->last_name,
                'post' => $post->post_data,
                'datetime' => date('Y-m-d H:i:s', strtotime($post->updated_at)),
            );
        }
      
        return $output;
    }
    
    public function getAllMyPosts($userID)
    {
        $posts = DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->where('posts.user_id', '=', $userID)
            ->select('users.id as user_id', 'users.first_name', 'users.last_name','posts.id as post_id' , 'posts.post_data', 'posts.updated_at')
            ->orderBy('posts.updated_at', 'desc')
            ->get();
        
        $output = array();
        
        foreach($posts as $post) {
            $output[] = array(
                'user_id' => $post->user_id,
                'name' => $post->first_name.' '.$post->last_name,
                'post' => $post->post_data,
                'datetime' => date('Y-m-d H:i:s', strtotime($post->updated_at)),
            );
        }
      
        return $output;
    }
  
    public function scopeMyPosts($query, $userID)
    {
        return $query->where('user_id', '=', $userID);  
    }
}