@extends('layouts.master')

@section('title', 'Followed Subjects')

@section('body_content')
  <h4>Followed Subjects</h4>
  <div class="container">
    @foreach ($subjects_chunk as $subjects)
      <div class="row p-2">
        @foreach ($subjects as $subject)
          <div class="col">
            <div class="card">
              <div class="card-body">
                <h5>{{ $subject['name'] }} #{{ $subject['id'] }}</h5>
                <p><small>{{ $subject['user']['first_name'] . ' ' . $subject['user']['last_name'] . '<' . $subject['user']['email'] . '>' }}</small></p>
                <p>{{ is_null($subject['description']) ? 'No description provided' : $subject['description'] }}</p>
                <a href="{{ route('subject.show', ['subject_id' => $subject['id']]) }}">Visit</a>
              </div>
            </div>
          </div>
        @endforeach
        @for ($i = 0; $i < (3 - count($subjects)); $i++)
          <div class="col"></div>
        @endfor
      </div>
    @endforeach
@endsection

