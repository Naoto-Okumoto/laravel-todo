@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <form action="{{ route('store') }}" method="post">
        @csrf
    
        <div class="row gx-2 mb-3">
            <div class="col">
                <input type="text" name="name" placeholder="Create a task" value="{{ old('name') }}" class="form-control" autofocus>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary w-100"><i class="fa-solid fa-plus"></i> Add</button>
            </div>
            @error('name')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>
    </form>

    <ul class="list-group">
        @foreach($home_tasks as $task)
            <li class="list-group-item d-flex align-items-center">
                <p class="mb-0 me-auto">{{ $task->name}}</p>
                <a href="{{ route('edit', $task->id) }}" class="btn btn-secondary btn-sm" title="Edit"><i class="fa-solid fa-pen"></i></a>
                <form action="{{ route('delete', $task->id) }}" method="post" class="ms-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" title="Delete"><i class="fa-solid fa-trash-can"></i></button>
                </form>
            </li>
        @endforeach
    </ul>
    
@endsection