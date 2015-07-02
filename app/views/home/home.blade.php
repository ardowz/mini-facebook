@extends('layouts.homelayout')

@section('friends')
  
  {{ Form::open(array('route' => 'findUser')) }}

    {{ Form::label('searchUserString', 'Search User', array('class' => 'control-label')) }}
    {{ Form::text('search_user_string', null, array('class' => 'form-control', 'id' => 'searchUserString')) }}
    <div class='row'>
      <div class='col-md-8'></div>
      <div class='col-md-1'>
        <button type='submit' class='glyphicon glyphicon-search'></button>
      </div>
    </div>
  {{ Form::close() }}

  <h4>{{ link_to_route('friends', 'Friends') }}</h4>
  
  @if (count($friends) > 0)
    <ul class='list-group'>
      @foreach ($friends as $userID => $friend)
          <li class='list-group-item'>
            {{ link_to_route('home', $friend, array($userID)); }}
          </li>
      @endforeach
    </ul>
  @endif
@stop


@section('posts')
  <div class='row'>
    {{ Form::open(array('route' => 'newPost')) }}
    <div class='col-md-6'>
       {{ Form::textArea('post', null, array('class' => 'form-control', 'rows' => '3')) }}
    </div>
    <div class='col-md-2'>
        <button type='submit' class='btn btn-primary'>Submit</button>
    </div>
    {{ Form::close() }}
  </div>
  <hr/>
  <div class='feed'>
    @if (count($posts) > 0)
      @foreach ($posts as $post)
        <div class='row'>
            <div class='col-md-8'>
              <h3><p>{{ $post['post'] }}</p></h3>
              <small><p>{{ $post['name'] }} - {{ $post['datetime'] }}</p></small>
            </div>
        </div>
      @endforeach
    @endif
  </div>


@stop