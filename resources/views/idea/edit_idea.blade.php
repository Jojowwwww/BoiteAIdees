@extends('layouts.app')

@section('content')
<br>
<h2>Mettre à jour une idée</h2>
<div class="card mt-4">
    <div class="card-body">
        <form action="{{ route('idea.update', $idea) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Entrez le nouveau nom de l'idée" id="title" name="title" value="{{ old('title', $idea->title) }}">
                @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                <label for="description" class="form-label">Contenu</label>
                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                    placeholder="Contenu de la note..." rows="3">{{ old('description', $idea->description) }}</textarea>
                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                        <option value="Soumise" {{ old('status', $idea->status) === 'Soumise' ? 'selected' : '' }}>Soumise</option>
                        <option value="En attente" {{ old('status', $idea->status) === 'En attente' ? 'selected' : '' }}>En attente</option>
                        <option value="En traitement" {{ old('status', $idea->status) === 'En traitement' ? 'selected' : '' }}>En traitement</option>
                    </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-4">
                <button class="btn btn-success btn-sm" type="submit">Mettre à jour l'idée</button>
            </div>
        </form>
    </div>
</div>
@endsection