@extends('layouts.master')

@section('title', $forum['name'])

@section('body_content')
  <h4>Subject: {{ $subject['name'] }}</h4>
  <h5>Forum: {{ $forum['name'] }}</h5>
  <p class="mt-4">{{ $forum['description'] }}</p>
@endsection
