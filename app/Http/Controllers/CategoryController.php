<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function __construct()
    {
        
        $this->middleware(function ($request, $next) {
            
            if (!auth()->check() || auth()->user()->role !=='admin'){
                abort(403, 'Accès interdit');
            }
            return $next($request);
        })->only(['create','store']);
    }


    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
        ]);

        Category::create(['name' => $request->name]);

        return redirect()->route('products.create')->with('success', 'Catégorie ajoutée avec succès!');
    }
}
