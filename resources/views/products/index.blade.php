@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center">Liste des Produits</h2>

    {{-- Boutons pour ajouter un produit et une catégorie --}}
    <div class="d-flex flex-wrap justify-content-end mb-3">
        <a href="{{ route('products.create') }}" class="btn btn-success me-2 mb-2">
            <i class="fas fa-plus"></i> Ajouter un produit
        </a>
        <a href="{{ route('categories.create') }}" class="btn btn-primary mb-2">
            <i class="fas fa-plus"></i> Ajouter une catégorie
        </a>
    </div>

    {{-- Affichage en cartes responsives --}}
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        @foreach($products as $product)
        <div class="col">
            <div class="card h-100 shadow-sm">
                {{-- Image du produit --}}
                <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/default.png') }}" 
                    class="card-img-top" 
                    alt="Image du produit" 
                    style="height: 200px; object-fit: cover;"> 
                    
            

                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">
                        <strong>Prix :</strong> {{ $product->price }} DH<br>
                        <strong>Stock :</strong> {{ $product->stock }} unités<br>
                        <strong>Catégorie :</strong> {{ $product->category->name }}
                    </p>

                    {{-- Boutons d'action responsifs --}}
                    <div class="d-grid gap-2">
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-info">
                            <i class="fas fa-eye"></i> Voir les détails
                        </a>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Modifier
                        </a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" 
                            onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-10">
                                <i class="fas fa-trash"></i> Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-3">
        {{ $products->links() }}
    </div>
</div>
@endsection
