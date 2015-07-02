@extends('layouts.master')

@section('title', 'Page Title')

@section('content')
<div class='jumbotron'>
    <center>
      <h1>Login</h1>
    </center>
  </div>
  @include('layouts.flash')
  {{ Form::open(array('route' => 'loginAction')) }}
    <div class='form-horizontal'>
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
        <div class='col-sm-offset-2 col-sm-10'>
          <button type='submit' class='btn btn-default'>Login</button>
        </div>
      </div>
    {{ Form::close() }}
  </div>

@stop