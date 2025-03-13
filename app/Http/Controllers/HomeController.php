<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() 
    {
        $categories = Category::all();
        $products = Product::orderBy('created_at', 'desc')->take(8)->get(); // affihcer les 8 dernier produits

        return view('accueil', compact('categories', 'products'));
    }
}
