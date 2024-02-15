<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index(Request $request)
    {
        // Commencez par récupérer tous les utilisateurs
        $query = Categorie::query();
    
        // Appliquez les filtres de recherche s'ils sont présents dans la requête
        if ($request->has('nom')) {
            $query->where('nom', 'like', '%' . $request->input('nom_produit') . '%');
        }
    
        // if ($request->has('stock')) {
        //     $query->where('stock', '>=', $request->input('stock'));
        // }
    
        // if ($request->has('prix')) {
        //     $query->where('prix', '<=', $request->input('prix'));
        // }
        // Ajoutez la condition pour l'état 0
    //$query->where('role', "client");
    
        // Obtenez les utilisateurs filtrés
        $categorie = $query->get();
    
        // Passez les utilisateurs filtrés à la vue
        return view('categorie', compact('categorie'));
    }

    public function ajouterCategorie()
    {
      return view('ajoutercategorie');
    }
    public function ajouterCat(Request $request)
    {
        // Valider les données du formulaire
       // die($request);
        $request->validate([
            'nom' => 'required|string|max:255',
            
    ]);

        // Créer un nouveau users dans la base de données
        Categorie::create([
            'nom' => $request->nom,
        ]);

        // Rediriger vers une page de confirmation ou ailleurs
        //return redirect()->route('users')->with('success', 'Utilisateur ajouté avec succès!');
        return view('ajoutercategorie');
    }
   
}
