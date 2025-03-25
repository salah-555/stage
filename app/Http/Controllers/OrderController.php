<?php

namespace App\Http\Controllers;

use auth;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

   
    public function index()
    {
        // // dd(auth()->guard('clients')->user());// dd(auth()->guard('clients')->check());
        $user = auth()->guard('clients')->user();

        if (!$user) {
            return redirect()->route('client.login')->with('error', 'Vous devez être connecté pour voir vos commandes.');
        }

        if (auth()->guard('admin')->check()) {
            // l'admin voit toutes les commandes 
            $orders = Order::with('client', 'products')->latest()->get();
        } else {
            // Un client voit uniquement ses propres commandes 
            $orders = Order::where('client_id',  auth('clients')->id())->with('products')->get();
        }

        $orders = $user->orders()->latest()->get();
        return view('orders.index', compact('orders'));
       
    }

    public function store()
    {
        $cart = session('cart', []);
    
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Votre panier est vide.');
        }
    
        $user = auth()->guard('clients')->user();
    
        if (!$user) {
            return redirect()->route('client.login')->with('error', 'Vous devez être connecté pour passer une commande.');
        }
    
        $order = Order::create([
            'client_id' => $user->id,
            'total_price' => array_sum(array_column($cart, 'price')), // Corrigé pour prendre le total correct
            'status' => 'en attente',
        ]);
    
        foreach ($cart as $product_id => $details) {
            $order->products()->attach($product_id, [
                'quantity' => $details['quantity'],
                'price' => $details['price'],
            ]);
        }
    
        session()->forget('cart'); // On vide le panier après validation de la commande
    
        return redirect()->route('orders.index')->with('success', 'Commande passée avec succès.');
    }

    // une fonction cancel pour gerer l'annulation d'une commande
    public function cancel(Order $order)
    {
        if (auth('clients')->id() !== $order->client_id) {
            return redirect()->back()->with('error', 'Vous ne pouvez annuler que vos propres commandes .');
        }

        //Supprimer la commande 
        $order->delete();

        // if ($order->status !=='en attente') {
        //     return redirect()->back()->with('error', 'Seules les commandes en attente peuvent être annulées');
        // }

        // $order->update(['status'=> 'annulée']);

        return redirect()->back()->with('success', 'Votre commande a ete annulee avec success');
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:en attente,en cours,livrée,annulée'
        ]);
    
        $order->status = $request->status;
        $order->save();
    
        return redirect()->back()->with('success', 'Statut de la commande mis à jour.');
    }
    

}
