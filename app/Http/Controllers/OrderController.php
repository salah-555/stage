<?php

namespace App\Http\Controllers;

use auth;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->guard('client')->user()->orders()->latest()->get();
        return view('orders.index', compact('orders'));
    }

    public function store()
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Votre panier est vide.');
        }

        $order = Order::create([
            'client_id' => auth()->guard('client')->id(),
            'total_price' => array_sum(array_column($cart, 'total')),
            'status' => 'en attente',
        ]);

        foreach ($cart as $product_id => $details) {
            $order->products()->attach($product_id, [
                'quantity' => $details['quantity'],
                'price' => $details['price'],
            ]);
        }

        session()->forget('cart');
        return redirect()->route('orders.index')->with('success', 'Commande passée avec succès.');
    }

    public function update(Order $order, Request $request)
    {
        $request->validate(['status' => 'required|in:en attente,en cours,livrée,annulée']);
        $order->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Statut de la commande mis à jour.');
    }
}
