@extends('layouts.app')

@section('title', 'Edit Task')

@section('content')
    <h1 class="h3">Edit Task</h1>

    <form action="{{ route('update', $task->id) }}" method="post">
        @csrf
        @method('PATCH')

        <div class="row gx-2 mb-3">
            <div class="col">
                <input type="text" name="name" class="form-control" value="{{ old('name', $task->name) }}" autofocus>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-secondary w-100"><i class="fa-solid fa-check"></i> Update</button>
            </div>
            @error('name')
                <div class="text-danger small">{{ $message}}</div>
            @enderror
        </div>
    </form>

@endsection