<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Fournisseur;
use App\Models\Categorie;
use App\Models\SousCategorie;
use App\Models\SousCategorieUser;
use App\Models\Prospect;
use App\Models\Client;
use App\Models\FournisseurClient;
use App\Models\Historique;

class ChartController extends Controller
{
    public function index()
    {
        $sumUsers = User::count();
        $sumSuppliers = Fournisseur::count();
        $sumCategories = Categorie::count();
        $sumTiers = Prospect::count();
        $sumClients = Client::count();
        $sumFournClients = FournisseurClient::count();

        $categories = Categorie::withCount('sousCategories')->get();
        $categoryNames = $categories->pluck('nom_categorie');
        $subcategoryCounts = $categories->pluck('sous_categories_count');
        $suppliersNumberByCategory = Categorie::withCount('fournisseurs')->take(6)->get();


        $lastUsers = User::orderBy('created_at', 'desc');
        $lastLogin = Historique::orderBy('created_at', 'desc')
            ->take(6)->get();

        $historiques = \App\Models\Historique::with('user')
            ->orderBy('login_at', 'desc')
            ->take(6)->get();


        return view('myApp.admin.links.chart', compact(
            'sumUsers',
            'sumSuppliers',
            'sumCategories',
            'categoryNames',
            'subcategoryCounts',
            'suppliersNumberByCategory',
            'lastUsers',
            'sumTiers',
            'sumClients',
            'sumFournClients',
            'lastLogin',
            'historiques',
        ));
    }
}
