@extends('layouts.master')

@section('title', 'Page Title')

@section('content')
  <div class='jumbotron'>
    <center>
      <h1>Sign Up</h1>
    </center>
  </div>
  {{ Form::open(array('route' => 'signupAction')) }}
    <div class='form-horizontal'>
      <div class='form-group'>
        {{ Form::label('first_nameInput', 'First Name', array('class' => 'col-sm-2 control-label')) }}
        <div class="col-sm-10">
          {{ Form::text('first_name', null, array('class' => 'form-control', 'id' => 'first_nameInput')) }}
          {{ $errors->first('first_name') }}
        </div>
      </div>
      <div class='form-group'>
        {{ Form::label('last_nameInput', 'Last Name', array('class' => 'col-sm-2 control-label')) }}
        <div class="col-sm-10">
          {{ Form::text('last_name', null, array('class' => 'form-control', 'id' => 'last_nameInput')) }}
          {{ $errors->first('last_name') }}
        </div>
      </div>
      <div class='form-group'>
        {{ Form::label('emailInput', 'Email Address', array('class' => 'col-sm-2 control-label')) }}
        <div class="col-sm-10">
          {{ Form::email('email', null, array('class' => 'form-control', 'id' => 'emailInput')) }}
          {{ $errors->first('email') }}
        </div>
      </div>
      <div class='form-group'>
        {{ Form::label('passwordInput', 'Password', array('class' => 'col-sm-2 control-label')) }}
        <div class="col-sm-10">
          {{ Form::password('password', array('class' => 'form-control', 'id' => 'passwordInput', 'placeholder' => 'Password')) }}
          {{ $errors->first('password') }}
        </div>
      </div>
      <div class='form-group'>
        {{ Form::label('password_verifyInput', 'Verify Password', array('class' => 'col-sm-2 control-label')) }}
        <div class="col-sm-10">
          {{ Form::password('password_verify', array('class' => 'form-control', 'id' => 'password_verifyInput', 'placeholder' => 'Password')) }}
          {{ $errors->first('password_verify') }}
        </div>
      </div>
      <div class='form-group'>
        <div class='col-sm-offset-2 col-sm-10'>
          <button type='submit' class='btn btn-default'>Sign Up</button>
        </div>
      </div>
    {{ Form::close() }}
  </div>
@stop