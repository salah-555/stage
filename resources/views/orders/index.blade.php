@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Mes Commandes</h2>
    @foreach($orders as $order)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Commande #{{ $order->id }} - {{ $order->status }}</h5>
                <p>Total : {{ $order->total_price }} DH</p>
                <p>Passée le : {{ $order->created_at->format('d/m/Y') }}</p>

                @if(auth()->guard('admin')->check())
                    <form action="{{ route('orders.update', $order->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <select name="status" onchange="this.form.submit()">
                            <option value="en attente" {{ $order->status == 'en attente' ? 'selected' : '' }}>En attente</option>
                            <option value="en cours" {{ $order->status == 'en cours' ? 'selected' : '' }}>En cours</option>
                            <option value="livrée" {{ $order->status == 'livrée' ? 'selected' : '' }}>Livrée</option>
                            <option value="annulée" {{ $order->status == 'annulée' ? 'selected' : '' }}>Annulée</option>
                        </select>
                    </form>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection
