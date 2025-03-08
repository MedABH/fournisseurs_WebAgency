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
use App\Models\Setting;
use Carbon\Carbon;

class ChartController extends Controller
{
    public function index()
    {
        // Get the current count of prospects (Les Tiers)
        $currentTiersCount = Prospect::count();

        // Retrieve the current settings for tiers tracking
        $setting = Setting::where('key', 'tiersTracking')->first();

        // If settings are not found, initialize them
        if (!$setting) {
            $setting = Setting::create([
                'key' => 'tiersTracking',
                'value' => $currentTiersCount,
                'tiersAddedToday' => 0,
                'tiersDeletedToday' => 0,
            ]);
        }

        // Get the previous count of tiers
        $previousTiersCount = $setting->value;

        // Calculate the changes in tiers (additions and deletions)
        $tiersAddedToday = $setting->tiersAddedToday;
        $tiersDeletedToday = $setting->tiersDeletedToday;

        $tiersChange = ($tiersAddedToday - $tiersDeletedToday);

        // Update the tiers count in settings
        $setting->update([
            'value' => $currentTiersCount, // Update the total tiers count
            'tiersAddedToday' => 0, // Reset added count for the day
            'tiersDeletedToday' => 0, // Reset deleted count for the day
        ]);

        // Fetch other data for the dashboard (same as before)
        $sumUsers = User::count();
        $sumSuppliers = Fournisseur::count();
        $sumCategories = Categorie::count();
        $sumClients = Client::count();
        $sumFournClients = FournisseurClient::count();
        $sumTiers = $currentTiersCount;

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
            'sumTiers',
            'tiersChange'
        ));
    }

    // Call this method when a tier is added
    public function trackTierAdded(Request $request)
    {
        /*// Create a new prospect
        Prospect::create($request->all());*/
        Prospect::create([
            'nom_prospect' => $request->nom_prospect,
            'email_prospect' => $request->email_prospect,
            'tele_prospect' => $request->tele_prospect,
            'ville_prospect' => $request->ville_prospect,
            'nomSociete_prospect' => $request->nomSociete_prospect,
            'user_id' => $request->user_id,
            'remark' => $request->remark,
        ]);


        $setting = Setting::where('key', 'tiersTracking')->first();
        if ($setting) {
            // Make sure the increment works properly
            $setting->increment('tiersAddedToday');
        } else {
            // Handle case where setting is not found
            dd('Setting not found');
        }


        return redirect()->back()->with('message', 'Prospect added successfully.');
    }

    public function trackTierDeleted($id)
{
    // Delete the prospect
    Prospect::destroy($id);

    // Update the 'tiersDeletedToday' in the settings table
    $setting = Setting::where('key', 'tiersTracking')->first();
    if ($setting) {
        $setting->increment('tiersDeletedToday');
    }

    return redirect()->back()->with('message', 'Prospect deleted successfully.');
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
