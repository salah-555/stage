@extends('layouts.app')

@section('content')
<div class="container mt-7" style="margin-top: 100px;">
    <h2 class="mb-4">📦 Mes Commandes</h2>
    
    @if(auth()->guard('admin')->check())
        <h3>Liste des commandes</h3>
        @foreach($orders as $order)
        <div class="card shadow-sm mb-4 border-0">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <span>Commande #{{ $order->id }} - Client: {{ $order->client->name }} ({{ $order->client->email}}) </span>

                <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <select name="status" class="form-select form-select-sm d-inline w-auto" onchange="this.form.submit()">
                        <option value="en attente" {{ $order->status == 'en attente' ? 'selected' : '' }}>En attente</option>
                        <option value="en cours" {{ $order->status == 'en cours' ? 'selected' : '' }}>En cours</option>
                        <option value="livrée" {{ $order->status == 'livrée' ? 'selected' : '' }}>Livrée</option>
                        <option value="annulée" {{ $order->status == 'annulée' ? 'selected' : '' }}>Annulée</option>
                    </select>
                </form>

            </div>
            <div class="card-body">
                <p><strong>Lieu de livraison :</strong> {{ $order->client->address }}</p>
                <p><strong>Passée le :</strong> {{ $order->created_at->format('d/m/Y') }}</p>
                <h5>Produits :</h5>
                <ul>
                    @foreach($order->products as $product)
                        <li>{{ $product->name }} - {{ $product->pivot->quantity }} x {{ number_format($product->pivot->price, 2) }} DH</li>
                    @endforeach
                </ul>
                <p><strong>Total :</strong> {{ number_format($order->total_price, 2) }} DH</p>
            </div>
        </div>
        @endforeach
    @else
        @foreach($orders as $order)
        <div class="card shadow-sm mb-4 border-0">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <span>Commande #{{ $order->id }}</span>
                <span class="badge 
                    @if($order->status == 'en attente') bg-warning 
                    @elseif($order->status == 'en cours') bg-info 
                    @elseif($order->status == 'livrée') bg-success 
                    @elseif($order->status == 'annulée') bg-danger 
                    @endif">
                    {{ ucfirst($order->status) }}
                </span>
            </div>
            <div class="card-body">
                <h5>Produits :</h5>
                <ul>
                    @foreach($order->products as $product)
                        <li>{{ $product->name }} - {{ $product->pivot->quantity }} x {{ number_format($product->pivot->price, 2) }} DH</li>
                    @endforeach
                </ul>
                <p><strong>Total :</strong> {{ number_format($order->total_price, 2) }} DH</p>
                <p><strong>Passée le :</strong> {{ $order->created_at->format('d/m/Y') }}</p>
                
                @if($order->status == 'en attente')
                    <form action="{{route('orders.cancel', $order->id)}}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment annuler cette commande ?')">
                            Annuler la commande
                        </button>
                    </form>
                @endif
            </div>
        </div>
        @endforeach
    @endif
</div>
@endsection