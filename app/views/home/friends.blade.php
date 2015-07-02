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

friend list

@stop