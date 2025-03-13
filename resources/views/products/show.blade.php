@extends('layouts.app')

@section('content')
<!-- resources/views/products/show.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - Détails du produit</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="product-container">
    <div class="product-card">
        <div class="product-image">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
        </div>
        <div class="product-details">
            <h1>{{ $product->name }}</h1>
            <p class="category">Catégorie : {{ $product->category->name }}</p>
            <p class="description">{{ $product->description }}</p>
            <p class="price">Prix : {{ number_format($product->price, 2) }} DH</p>
            <p class="stock {{ $product->stock > 0 ? 'in-stock' : 'out-of-stock' }}">
                {{ $product->stock > 0 ? 'En Stock' : 'Rupture de Stock' }}
            </p>
            <a href="#" class="btn">Ajouter au panier</a>
            <a href="{{ route('products.index') }}" class="btn back-btn">Retour</a>
        </div>
    </div>
</div>

</body>
</html>

@endsection