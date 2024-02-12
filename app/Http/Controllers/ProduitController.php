<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\DetailsCommande;
use App\Models\Commande;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Commencez par récupérer tous les produits
        $query = Produit::query();
    
        // Appliquez les filtres de recherche s'ils sont présents dans la requête
        if ($request->has('nom_produit')) {
            $query->where('nom_produit', 'like', '%' . $request->input('nom_produit') . '%');
        }
    
        if ($request->has('stock')) {
            $query->where('stock', '>=', $request->input('stock'));
        }
    
        if ($request->has('prix')) {
            $query->where('prix', '<=', $request->input('prix'));
        }
        // Ajoutez la condition pour l'état 0
    $query->where('etat', 0);
    
        // Obtenez les produits filtrés
        $produits = $query->get();
    
        // Passez les produits filtrés à la vue
        return view('admin.index', compact('produits'));
    }
    
    public function addProduit()
    {
      return view('admin.addProduit');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function ajouterProduit(Request $request)
    {
        // Valider les données du formulaire
       // die($request);
        $request->validate([
            'nom_produit' => 'required|string|max:255',
            'description' => 'required|string',
            'stock' => 'required|integer|min:0',
            'prix' => 'required|numeric|min:0.01',
        ]);

        // Créer un nouveau produit dans la base de données
        Produit::create([
            'nom_produit' => $request->nom_produit,
            'description' => $request->description,
            'stock' => $request->stock,
            'prix' => $request->prix,
        ]);

        // Rediriger vers une page de confirmation ou ailleurs
        return redirect()->route('produits.index')->with('success', 'Produit ajouté avec succès!');
    }
    public function modifierProduit($id)
    {
        $produit = Produit::findOrFail($id);
        return view('admin.modifier-produit', compact('produit'));
    }

    public function mettreAjourProduit(Request $request, $id)
    {
        $request->validate([
            'nom_produit' => 'required|string|max:255',
            'description' => 'required|string',
            'stock' => 'required|integer|min:0',
            'prix' => 'required|numeric|min:0.01',
        ]);

        $produit = Produit::findOrFail($id);

        // Mettre à jour les attributs du produit
        $produit->update([
            'nom_produit' => $request->nom_produit,
            'description' => $request->description,
            'stock' => $request->stock,
            'prix' => $request->prix,
        ]);

        return redirect()->route('produits.index')->with('success', 'Produit mis à jour avec succès!');
    }

    public function supprimerProduit($id)
    {
        // Trouver le produit
        $produit = Produit::findOrFail($id);
    
        // Mettre à jour l'état du produit au lieu de le supprimer
        $produit->update([
            'etat' => 10, // Assurez-vous que votre modèle de produit a une colonne "etat"
        ]);
    
        // Rediriger vers la page d'accueil ou ailleurs
        return redirect()->route('produits.index')->with('success', 'Produit supprimé avec succès!');
    }
    

    public function showInCommande($idCommande, $idProduit)
    {
        $produit = Produit::findOrFail($idProduit);

        // Récupérez les détails spécifiques du produit dans la commande
        $detailsProduitCommande = DetailsCommande::where('id_produit', $idProduit)
        ->where('id_commande', $idCommande)
        ->first();
    
    $commande = Commande::find($idCommande);
    
    if (!$detailsProduitCommande || !$commande) {
        // Gérer le cas où les détails de la commande ou la commande ne sont pas trouvés
        abort(404); // Ou redirigez ou affichez une page d'erreur
    }
    
        // Passez les données à la vue correspondante
        return view('produit.show_in_commande', compact('produit', 'detailsProduitCommande', 'commande'));
    }
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
