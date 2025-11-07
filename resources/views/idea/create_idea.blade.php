@extends('layouts.app')

@section('content')
<br>
<h2>Proposer une nouvelle idée</h2>
<div class="card mt-4">
    <div class="card-body">
        <form action="{{ route('idea.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Titre de l'idée..." value="{{ old('title') }}">
                @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                    placeholder="Description de l'idée..." rows="3">{{ old('description') }}</textarea>
                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary btn-sm">Proposer l'idée</button>
        </form>
    </div>
</div>
@endsection