<?php
Class PostController extends BaseController {

    public function newAction()
    {
        $userID = Auth::user()->id;
        $post = Input::get('post');
      
        $postModel = new Post;
        $postModel->user_id = $userID;
        $postModel->post_data = $post;
        $postModel->save();

        return Redirect::to('home');
    }
}