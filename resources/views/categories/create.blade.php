@extends('layouts.admin')

@section('content')
<h1>Add Category</h1>
<form action="{{ route('categories.store') }}" method="POST">
    @csrf
    <label for="name">Category Name:</label>
    <input type="text" id="name" name="name" required>
    @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <button type="submit">Save</button>
</form>
@endsection