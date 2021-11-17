@extends('layouts.master')

@section('title', 'Dashboard')

@section('body_content')
  <h4>Dashboard</h4>
  <div class="container">
    @foreach ($subjects_chunk as $subjects)
      <div class="row p-2">
        @foreach ($subjects as $subject)
          <div class="col">
            <div class="card">
              <div class="card-body">
                <h5>{{ $subject['name'] }} #{{ $subject['id'] }}</h5>
                <p><small>{{ $subject['user']['first_name'] . ' ' . $subject['user']['last_name'] . ' <' . $subject['user']['email'] . '>' }}</small></p>
                <p>{{ is_null($subject['description']) ? 'No description provided' : $subject['description'] }}</p>
                <a href="{{ route('subject.show', ['subject_id' => $subject['id']]) }}">Visit</a>
                {{-- Only frontend validation for creator follow his own subject --}}
                @if (Auth::user()->email !== $subject['user']['email'])
                  @if ($subject->followers()->where('follower_id', Auth::user()->id)->exists())
                    <a href="{{ route('dashboard.unfollow', ['subject_id' => $subject['id']]) }}">Unfollow</a>
                  @else
                    <a href="{{ route('dashboard.follow', ['subject_id' => $subject['id']]) }}">Follow</a>
                  @endif
                @endif
              </div>
            </div>
          </div>
        @endforeach
        @for ($i = 0; $i < (3 - count($subjects)); $i++)
          <div class="col"></div>
        @endfor
      </div>
    @endforeach
  </div>
@endsection

