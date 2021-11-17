@extends('layouts.master')

@section('body_content')
  <h4>Create Forum</h4>
  <form action="{{ route('forum.store') }}" method="POST">
    {{ csrf_field() }}
    <select class="form-select w-50" name="subject_id" aria-label="Default select example" required>
      <option selected>Select subject</option>
      @foreach ($subjects as $subject)
        <option value="{{ $subject['id'] }}">{{ $subject['name'] }} #{{ $subject['id'] }}</option>
      @endforeach
    </select>
    <div class="form-group mt-2">
      <label for="name">Name</label>
      <input class="form-control w-50" required type="text" name="name" placeholder="Enter subject name">
    </div>
    <div class="form-group mt-2">
      <label for="description">Description (Optional)</label>
      <textarea class="form-control w-50" name="description" placeholder="Enter subject description"></textarea>
    </div>
    <input class="btn btn-primary mt-2" type="submit" value="Create Forum">
  </form>
@endsection

