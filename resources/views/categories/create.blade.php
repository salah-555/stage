@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4">Ajouter une Nouvelle Catégorie</h2>

    <div class="card shadow-lg">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nom de la Catégorie</label>
                    <input type="text" name="name" class="form-control" id="name" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('products.create') }}" class="btn btn-secondary">Retour</a>
                    <button type="submit" class="btn btn-success">Ajouter la Catégorie</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
