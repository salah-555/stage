
@if(!empty(session('cart')))
    <a href="{{ route('orders.store') }}" class="btn btn-success mt-3">
        <i class="fas fa-shopping-cart"></i> Passer la commande
    </a>
@endif