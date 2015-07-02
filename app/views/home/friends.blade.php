@extends('layouts.friendlayout')

@section('findUser')

  @if ($searchString)
  <div class='row'>
    <div class='col-md-10'>
      <h2>Results for: {{ $searchString }}</h2>
    </div>
    @if (count($foundUsers) > 0)
      @foreach($foundUsers as $userID => $name)
        <div class='col-md-8'>
            {{ $name }}
        </div>
        <div class='col-md-2'>
            {{ Form::open(array('route' => 'addFriendAction')) }}
              {{ Form::hidden('user_id', $userID) }}
              <button type='submit' class='btn btn-default'>Add Friend</button>
            {{ Form::close() }}
        </div>
      @endforeach
    @else
    <div class='col-md-10'>
      <h3>No results found..</h3>
    </div>
    @endif
  </div>
  @endif

@stop

@section('friends')

  <h3>Friend List</h3>
  @if (count($friendList) > 0)
    @foreach ($friendList as $userID => $friend)
      <div class='row'>
          <div class='col-md-7'>{{ link_to_route('home', $friend, array($userID)); }}</div>
          <div class='col-md-2'>
              {{ Form::open(array('route' => 'friendDeleteAction')) }}
                {{ Form::hidden('friend_user_id', $userID) }}
                <button type='submit' class='glyphicon glyphicon-remove-sign'></button>
              {{ Form::close() }}
          </div>
      </div>
    @endforeach
  @endif

@stop

@section('friendsWaiting')

  @if (count($friendsWaiting) > 0)
  <h3>Friends Waiting Approval</h3>
    @foreach($friendsWaiting as $requestID => $friend)
      <div class='row'>
        <div class='col-md-7'>{{ $friend }}</div>
        <div class='col-md-2'>
            {{ Form::open(array('route' => 'friendAction')) }}
                {{ Form::hidden('request_id', $requestID) }}
                {{ Form::hidden('approve_function', 1) }}
                <button type='submit' class='glyphicon glyphicon-ok-sign'></button>
            {{ Form::close() }}
        </div>
        <div class='col-md-2'>
            {{ Form::open(array('route' => 'friendAction')) }}
              {{ Form::hidden('request_id', $requestID) }}
              {{ Form::hidden('approve_function', 0) }}
              <button type='submit' class='glyphicon glyphicon-remove-sign'></button>
            {{ Form::close() }}
        </div>
      </div>
    @endforeach
  @endif

@stop