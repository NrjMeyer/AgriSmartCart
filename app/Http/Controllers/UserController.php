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
    $query->where('role', "fournisseur");
    
        // Obtenez les utilisateurs filtrés
        $users = $query->get();
    
        // Passez les utilisateurs filtrés à la vue
        return view('users', compact('users'));
    }
    
}
