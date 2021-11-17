@extends('layouts.bootstrap')

@section('title', 'Sign In')

@section('content')
  <div class="vw-100 vh-100 d-flex justify-content-center align-items-center">
    <div class="signin__container-size container shadow-sm border rounded bg-light mx-2">
      <h3 class="mt-5">Sign In</h3>
      <p><span class="text-muted">Smartan</span>. The way you in.</p>
      <form class="mt-5" method="POST" action="{{ route('auth.login') }}">
        @csrf
        <div class="form-group">
          <label for="email">Email</label>
          <input class="form-control" type="email" name="email" placeholder="Enter your email">
        </div>
        <div class="form-group mt-2">
          <label for="password">Password</label>
          <input class="form-control" type="password" name="password" placeholder="Enter your password">
        </div>
        <button class="btn btn-primary w-100 mt-2" type="submit">Sign In</button>
        <div class="d-flex w-100 justify-content-between mt-5">
          <a href="#"><small>Forgot account</small></a>
          <a href="{{ route('auth.signup') }}"><small>Sign Up instead</small></a>
        </div>
      </form>
    </div>
  </div>
@endsection
