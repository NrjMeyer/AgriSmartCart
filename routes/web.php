<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ProduitController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/users', [UserController::class, 'index'])->name('users');

Route::get('/ajout-users', [UserController::class, 'ajouterUsers'])->name('ajouterUsers');
Route::post('/ajouter-utilisateur', [UserController::class, 'ajouterUtilisateur']);

Route::get('/produit', [ProduitController::class, 'index'])->name('produit');

Route::get('/ajout-produit', [ProduitController::class, 'ajoutProduit'])->name('ajoutProduit');
Route::post('/ajouter-produit', [ProduitController::class, 'ajouterProduit']);


Route::get('/categorie', [CategorieController::class, 'index'])->name('categorie');

Route::get('/ajout-categorie', [CategorieController::class, 'ajouterCategorie'])->name('ajouterCategorie');
Route::post('/ajouter-categorie', [CategorieController::class, 'ajouterCat']);



Route::get('/commande', function () {
    return view('commande');
})->name('commande');


Route::get('/historique', function () {
    return view('historique');
})->name('historique');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
