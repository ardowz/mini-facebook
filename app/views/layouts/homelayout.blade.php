@extends('layouts.master')

@section('title', 'Home')

@section('content')

  <div class='row'>
    <div class='col-md-1'></div>
    <div class='col-md-10'>
      <div class='jumbotron'>Welcome {{{ $firstName }}},</div>
    </div>
    <div class='col-md-1'>
      <ul>
        <li>{{ link_to_route('logout', 'Logout') }}</li>
        <li>{{ link_to_route('home', 'Home') }}</li>
      </ul>
    </div>
  </div>
  
  @include('layouts.flash')

  <div class='row'>
    <div class='col-md-1'></div>
    <div class='col-md-2'>@yield('friends')</div>
    <div class='col-md-8'>@yield('posts')</div>
    <div class='col-md-1'></div>
  </div>
@stop