<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // Commencez par récupérer tous les utilisateurs
        $query = User::query();
    
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
        $users = $query->get();
    
        // Passez les utilisateurs filtrés à la vue
        return view('users', compact('users'));
    }
    public function ajouterUsers()
    {
      return view('ajouterusers');
    }
    public function ajouterUtilisateur(Request $request)
    {
        // Valider les données du formulaire
       // die($request);
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenoms' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string|max:255',
            'adresse' => 'required|string',
            'role' => 'required|string',
            'photo' => 'required|string|max:255',
            'etat' => 'integer',
            
    ]);

        // Créer un nouveau users dans la base de données
        User::create([
            'nom' => $request->nom,
            'prenoms' => $request->prenoms,
            'email' => $request->email,
            'password' => $request->password,
            'adresse' => $request->adresse,
            'role' => $request->role,
            'photo' => $request->photo,
            'etat' => 0
        ]);

        // Rediriger vers une page de confirmation ou ailleurs
        //return redirect()->route('users')->with('success', 'Utilisateur ajouté avec succès!');
        return view('ajouterusers');
    }
    
    
}
