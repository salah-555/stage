@extends('layouts.app')

@section('content')

<!-- Hero Section -->


<div class="hero-section text-center text-white">
    <div class="container">
        <h1>Équipez-vous avec les meilleurs équipements sportifs !</h1>
        <p>Découvrez nos dernières collections et profitez des meilleures offres.</p>
        <a href="{{ route('products.index') }}" class="btn btn-lg btn-primary">Voir les Produits</a>
    </div>
</div>

<!-- Catégories en Vedette -->
<div class="container my-5">
    <h2 class="text-center mb-4">Catégories Populaires</h2>
    <div class="row">
        @foreach($categories as $category)
            <div class="col-md-4">
                <div class="category-card">
                    {{-- <img src="{{ Storage::url($category->image) }}" class="img-fluid"> --}}
                    <h4>{{ $category->name }}</h4>
                    <a href="{{ route('products.index', ['category' => $category->id]) }}" class="btn btn-outline-primary">Découvrir</a>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Produits Populaires -->
<div class="container my-5">
    <h2 class="text-center mb-4">Nos Meilleurs Produits</h2>
    <div class="row">
        @foreach($products as $product)
            <div class="col-md-3">
                <div class="product-card">
                    <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid">
                    <h5>{{ $product->name }}</h5>
                    <p class="price">{{ $product->price }} DH</p>
                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary">Voir Détails</a>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Promotions -->
<div class="container my-5">
    <div class="promotion-banner text-white">
        <h2>Jusqu'à -50% sur une sélection d'articles !</h2>
        <a href="{{ route('products.index', ['discount' => true]) }}" class="btn btn-light">Voir les Offres</a>
    </div>
</div>

<!-- Avis Clients -->
<div class="container my-5">
    <h2 class="text-center mb-4">Ce que disent nos clients</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="testimonial">
                <p>🔥 "Super qualité et livraison rapide !"</p>
                <h6>- Amine B.</h6>
            </div>
        </div>
        <div class="col-md-4">
            <div class="testimonial">
                <p>🏆 "Les meilleurs équipements pour mon entraînement."</p>
                <h6>- Sarah K.</h6>
            </div>
        </div>
        <div class="col-md-4">
            <div class="testimonial">
                <p>💯 "Très satisfait, je recommande !" </p>
                <h6>- Yassir D.</h6>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="{{ asset('css/custom.css') }}">

@endsection
