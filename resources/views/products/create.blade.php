@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4">Ajouter un Nouveau Produit</h2>

    <div class="card shadow-lg">
        <div class="card-body">
            <!-- Affichage des erreurs -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Formulaire d'ajout -->
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Nom du produit -->
                <div class="mb-3">
                    <label for="name" class="form-label">Nom du Produit</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Entrez le nom du produit" value="{{ old('name') }}" required>
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" class="form-control" id="description" rows="3" placeholder="Entrez une description du produit">{{ old('description') }}</textarea>
                </div>

                <!-- Prix -->
                <div class="mb-3">
                    <label for="price" class="form-label">Prix (MAD)</label>
                    <input type="number" name="price" class="form-control" id="price" placeholder="Entrez le prix" value="{{ old('price') }}" required>
                </div>

                <!-- Stock -->
                <div class="mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" name="stock" class="form-control" id="stock" placeholder="Entrez la quantité en stock" value="{{ old('stock') }}" required>
                </div>

                <!-- Catégorie -->
                <div class="mb-3">
                    <label for="category_id" class="form-label">Catégorie</label>
                    <select name="category_id" id="category_id" class="form-select" required>
                        <option value="">Sélectionnez une catégorie</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Image du produit -->
                <div class="mb-3">
                    <label for="image" class="form-label">Image du Produit</label>
                    <input type="file" name="image" class="form-control" id="image">
                </div>

                <!-- Boutons d'action -->
                <div class="d-flex justify-content-between">
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">Annuler</a>
                    <button type="submit" class="btn btn-success">Ajouter le Produit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
