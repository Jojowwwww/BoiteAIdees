@extends('layouts.app')

@section('content')
    <br>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-3">Mes idées ({{ $nbIdeas }})</h2>

        <a href="{{ route('idea.create') }}" class="btn btn-outline-primary ms-auto">
            Proposer une idée
        </a>
    </div>

    <div class="card shadow-sm p-4">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <form method="GET" action="{{ route('dashboard') }}" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Rechercher une idée..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-outline-secondary">Rechercher</button>
            </div>
        </form>

        @forelse ($ideas as $idea)
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h5 class="card-title">{{ $idea->title }}</h5>
                        <p class="card-text text-muted">{{ $idea->description }}</p>
                    </div>
                    <span class="badge 
                        @if($idea->status == 'Soumise') bg-primary 
                        @elseif($idea->status == 'Acceptée') bg-success 
                        @elseif($idea->status == 'Rejetée') bg-danger 
                        @else bg-secondary 
                        @endif">
                        {{ $idea->status }}
                    </span>
                </div>

                @if ($idea->status == "Soumise")
                    <div class="mt-3 text-end">
                        <a href="{{ route('idea.edit', $idea) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('idea.destroy', $idea) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
        @empty
        <div class="text-center text-muted py-4">
            Aucune idée n'a été proposée pour le moment.
        </div>
        @endforelse
    </div>
@endsection