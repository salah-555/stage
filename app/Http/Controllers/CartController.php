<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function addToCart(Request $request, $productId)
    {
        $product = Product::find($productId);
    
        if (!$product) {
            return redirect()->back()->with('error', 'Produit introuvable.');
        }
    
        $cart = session()->get('cart', []);
    
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                'name' => $product->name,
                'quantity' => 1,
                'price' => $product->price,
            ];
        }
    
        session()->put('cart', $cart);
    
        // Ajouter directement une commande avec le produit
        $user = auth()->guard('clients')->user();
        if (!$user) {
            return redirect()->route('client.login')->with('error', 'Vous devez être connecté.');
        }
    
        // Vérifier si l'utilisateur a déjà une commande en attente
        $order = Order::where('client_id', $user->id)->where('status', 'en attente')->first();
    
        if (!$order) {
            $order = Order::create([
                'client_id' => $user->id,
                'total_price' => 0,
                'status' => 'en attente',
            ]);
        }
    
        // Ajouter le produit à la commande
        $existingProduct = $order->products()->where('product_id', $productId)->first();
    
        if ($existingProduct) {
            // Si le produit existe déjà dans la commande, augmenter la quantité
            $order->products()->updateExistingPivot($productId, [
                'quantity' => $existingProduct->pivot->quantity + 1,
            ]);
        } else {
            // Sinon, ajouter le produit avec une nouvelle entrée
            $order->products()->attach($productId, [
                'quantity' => 1,
                'price' => $product->price,
            ]);
        }
    
        // Mettre à jour le total de la commande
        $order->update([
            'total_price' => $order->products()->sum(DB::raw('order_product.price * quantity')),
        ]);
    
        return redirect()->route('orders.index')->with('success', 'Produit ajouté au panier et commande mise à jour.');
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Produit retiré du panier.');
    }

    public function clearCart()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Panier vidé.');
    }
}
