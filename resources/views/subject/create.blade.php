@extends('layouts.master')

@section('body_content')
  <h4>Create Subject</h4>
  <form action="{{ route('subject.store') }}" method="POST">
    {{ csrf_field() }}
    <div class="form-group mt-2">
      <label for="name">Name</label>
      <input class="form-control w-50" required type="text" name="name" placeholder="Enter subject name">
    </div>
    <div class="form-group mt-2">
      <label for="description">Description (Optional)</label>
      <textarea class="form-control w-50" name="description" placeholder="Enter subject description"></textarea>
    </div>
    <input class="btn btn-primary mt-2" type="submit" value="Create Subject">
  </form>
@endsection
