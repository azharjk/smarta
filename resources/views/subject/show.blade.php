@extends('layouts.master')

@section('title', $subject['name'])

@section('body_content')
  <h4>Subject: {{ $subject['name'] }}</h4>
  <p>{{ is_null($subject['description']) ? 'No description provided' : $subject['description'] }}</p>
  @foreach ($subject['forums'] as $forum)
    <div class="row border-bottom p-2">
      <h5>{{ $forum['name'] }}</h5>
      <a href="{{ route('forum.show', ['subject_id' => $subject['id'], 'forum_id' => $forum['id']]) }}">Visit</a>
    </div>
  @endforeach
@endsection
