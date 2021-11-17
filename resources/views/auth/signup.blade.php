@extends('layouts.bootstrap')

@section('title', 'Sign Up')

@section('content')
  <div class="vw-100 vh-100 d-flex justify-content-center align-items-center">
    <div class="signup__container-size container shadow-sm border rounded bg-light mx-2">
      <h3 class="mt-5">Sign Up</h3>
      <p><span class="text-muted">Smartan</span>. The way you start.</p>
      <form class="mt-5" method="POST" action="{{ route('auth.register') }}">
        @csrf
        <div class="signup__form-group-size d-flex">
          <div class="form-group" style="margin-right: .5rem">
            <label for="first-name">First name</label>
            <input class="form-control" type="text" name="first_name" placeholder="Enter your first name">
          </div>
          <div class="form-group">
            <label for="last-name">Last name</label>
            <input class="form-control" type="text" name="last_name" placeholder="Enter your last name">
          </div>
        </div>
        <div class="signup__form-group-size d-block mt-2">
          <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" placeholder="Enter your email">
          </div>
        </div>
        <div class="signup__form-group-size d-flex mt-2">
          <div class="form-group" style="margin-right: .5rem">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" placeholder="Enter your password">
          </div>
          <div class="form-group">
            <label for="confirm-password">Confirm password</label>
            <input class="form-control" type="password" name="confirm_password" placeholder="Confirm your password">
          </div>
        </div>
        <div class="signup__form-group-size d-flex justify-content-between align-items-center mt-5">
          <a href="{{ url('signin') }}"><small>Sign In instead</small></a>
          <button class="btn btn-primary px-5">Sign Up</button>
        </div>
      </form>
    </div>
  </div>
@endsection
