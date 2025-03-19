@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Mon Panier</h2>

    @if(session('cart') && count(session('cart')) > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach(session('cart') as $id => $item)
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['price'] }} DH</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>{{ $item['total'] }} DH</td>
                        <td>
                            <a href="{{ route('cart.remove', $id) }}" class="btn btn-danger btn-sm">Retirer</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-between">
            <a href="{{ route('cart.clear') }}" class="btn btn-warning">Vider le panier</a>
            <a href="{{ route('orders.store') }}" class="btn btn-success">Passer la commande</a>
        </div>
    @else
        <p class="text-center">Votre panier est vide.</p>
    @endif
</div>
@endsection
