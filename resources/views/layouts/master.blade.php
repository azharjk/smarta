@extends('layouts.bootstrap')

@section('content')
  <div class="offcanvas offcanvas-start show bg-light" data-bs-keyboard="false" data-bs-backdrop="false" tabindex="-1">
    <div class="offcanvas-header">
      <h5>Smarta</h5>
    </div>
    <div class="offcanvas-body">
      <div class="d-flex align-items-center">
        <img class="sidebar__profile-image" src="{{ !is_null(Auth::user()->image_url) ? Auth::user()->image_url : asset('images/profile_default.png') }}" alt="Profile image">
        <p class="mb-0">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</p>
      </div>
      <h5 class="mt-5">Menu</h5>
      <a class="d-block mt-3" href="{{ url('/') }}">Dashboard</a>
      <a class="d-block mt-2" href="{{ route('subject.my') }}">My Subjects</a>
      <a class="d-block mt-2" href="{{ route('subject.create') }}">Create Subject</a>
      <a class="d-block mt-2" href="{{ route('forum.create') }}">Create Forum</a>
      <a class="d-block mt-2" href="{{ route('subject.followed') }}">Followed Subjects</a>
      <a class="d-block mt-5" href="{{ route('auth.logout') }}">Logout</a>
    </div>
  </div>
  <div class="sidebar__margin container p-2">
    @yield('body_content')
  </div>
@endsection
