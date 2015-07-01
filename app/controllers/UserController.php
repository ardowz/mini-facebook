<?php

class UserController extends BaseController {

    public function signup() {
        return View::make('users.signup');
    }
}