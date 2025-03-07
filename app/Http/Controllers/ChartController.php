<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
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
    // Get the current count of prospects (Les Tiers)
    $currentTiersCount = Prospect::count();
    
    // Get the previous count of prospects stored in session, or default to the current count
    $previousTiersCount = session('previousTiersCount', $currentTiersCount);
    
    // Calculate the change in count
    $tiersChange = $currentTiersCount - $previousTiersCount;
    
    // Store the current count in session for the next request
    session(['previousTiersCount' => $currentTiersCount]);

    // Fetch other data for the dashboard
    $sumUsers = User::count();
    $sumSuppliers = Fournisseur::count();
    $sumCategories = Categorie::count();
    $sumClients = Client::count();
    $sumFournClients = FournisseurClient::count();
    $sumTiers = $currentTiersCount; // Define the $sumTiers variable

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

    // Return the view with all the data, including the tiers change
    return view('myApp.admin.links.chart', compact(
        'sumUsers',
        'sumSuppliers',
        'sumCategories',
        'categoryNames',
        'subcategoryCounts',
        'suppliersNumberByCategory',
        'lastUsers',
        'sumClients',
        'sumFournClients',
        'lastLogin',
        'historiques',
        'sumTiers', // Add sumTiers to the compact
        'tiersChange'  // Add the tiersChange to the compact
    ));
}



    public function getDataForChartsByDate()
    {
        // Fetch and group by date for each table
        $clients = DB::table('clients')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
            ->groupBy('date')
            ->get();

        $prospects = DB::table('prospects')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
            ->groupBy('date')
            ->get();

        $fournisseurs = DB::table('fournisseurs')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
            ->groupBy('date')
            ->get();

        $fournisseurClients = DB::table('fournisseur_clients')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
            ->groupBy('date')
            ->get();

        // Merge all results into one collection
        $combinedData = collect();

        foreach ([$clients, $prospects, $fournisseurs, $fournisseurClients] as $dataset) {
            foreach ($dataset as $entry) {
                $combinedData->push($entry);
            }
        }

        // Group by date and sum the counts
        $groupedData = $combinedData->groupBy('date')->map(function ($entries) {
            return $entries->sum('count');
        });

        return response()->json($groupedData);
    }
}
