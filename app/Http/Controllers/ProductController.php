<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    

    public function __construct()
    {
        // dd(auth()->user());
        
        // dd(Auth::check(), Auth::guard()->user(), Auth::guard('clients')->user(), session()->all());
        $this->middleware(function ($request, $next) {
            
            if (!auth()->check() || auth()->user()->role !=='admin'){
                abort(403, 'Accès interdit');
            }
            return $next($request);
        })->only(['create', 'store', 'edit', 'update', 'destroy']);
    }


   //affichier la liste des produit 
   public function index()
   {
       $products = Product::paginate(10); // Pagination de 10 produits par page
       return view('products.index', compact('products'));
   }

   public function show(Product $product)
   {
       return view('products.show', compact('product'));
   }

   // Afficher le formulaire pour ajouter un produit (Create - C)
   public function create()
   {
   
       $categories = Category::all();  // Récupérer toutes les catégories
       return view('products.create', compact('categories'));
   }



    // Enregistrer un nouveau produit (Create - C)
    public function store(Request $request)
    {
        // Validation des champs du formulaire
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Enregistrer l'image si elle existe
        $imagePath = $request->hasFile('image') ? $request->file('image')->store('images', 'public') : null;

        // Création du produit dans la base de données
        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imagePath,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('products.index')->with('success', 'Produit ajouté avec succès!');
    }



    // Afficher le formulaire pour modifier un produit (Update - U)
    public function edit(Product $product)
    {
        $categories = Category::all();  // Récupérer toutes les catégories
        return view('products.edit', compact('product', 'categories'));
    }


    // Mettre à jour un produit existant (Update - U)
    public function update(Request $request, Product $product)
    {
        // Validation des champs du formulaire
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Si une nouvelle image est téléchargée
        $imagePath = $request->hasFile('image') ? $request->file('image')->store('images', 'public') : $product->image;

        // Mettre à jour le produit
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imagePath,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('products.index')->with('success', 'Produit mis à jour avec succès!');
    }


    public function destroy(Product $product)
    {
        // Supprimer le produit
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produit supprimé avec succès!');
    }



}
