@extends('layouts.master')

@section('title', 'Welcome')

@section('content')
  <div class='jumbotron'>
    <center>
      <h1>Welcome to my mfacebook</h1>
    </center>
  </div>
  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-3">
        <?php echo link_to_route('signup', 'Sign Up', array(), array('class' => 'btn btn-default', 'role' => 'button')); ?>
    </div>
    <div class="col-md-3">
      <?php echo link_to_route('login', 'Login', array(), array('class' => 'btn btn-default', 'role' => 'button')); ?>
    </div>
    <div class="col-md-3"></div>
  </div>
@stop