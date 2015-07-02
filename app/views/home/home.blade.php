@extends('layouts.homelayout')

@section('friends')

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
    <div class='row'>
        <div class='col-md-8'>
          feed
        </div>
    </div>
  </div>


@stop