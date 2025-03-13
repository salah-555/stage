@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center my-4">Modifier le produit</h2>

    <div class="card shadow p-4">
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="row g-3">
            @csrf
            @method('PUT')

            <!-- Nom du produit -->
            <div class="col-md-6">
                <label for="name" class="form-label">Nom du produit</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}" required>
            </div>

            <!-- Catégorie -->
            <div class="col-md-6">
                <label for="category" class="form-label">Catégorie</label>
                <select id="category" name="category_id" class="form-select" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Description -->
            <div class="col-12">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" name="description" class="form-control" rows="3" required>{{ old('description', $product->description) }}</textarea>
            </div>

            <!-- Prix -->
            <div class="col-md-6">
                <label for="price" class="form-label">Prix (DH)</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01" value="{{ old('price', $product->price) }}" required>
            </div>

            <!-- Stock -->
            <div class="col-md-6">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" required>
            </div>

            <!-- Image du produit -->
            <div class="col-md-6">
                <label for="image" class="form-label">Image du produit</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>

            <!-- Aperçu de l'image -->
            <div class="col-md-6 text-center">
                @if($product->image)
                    <p>Image actuelle :</p>
                    <img src="{{ asset('storage/' . $product->image) }}" class="img-thumbnail" width="120">
                @endif
            </div>

            <!-- Boutons -->
            <div class="col-12 d-flex justify-content-end mt-3">
                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary me-2">Annuler</a>
                <button type="submit" class="btn btn-primary">Mettre à jour</button>
            </div>
        </form>
    </div>
</div>
@endsection
