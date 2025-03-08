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
use Illuminate\Support\Facades\Log;

class ChartController extends Controller
{
    public function index()
    {
        //suppliers&client PART DASHBORD
        $currentFournClientsCount = FournisseurClient::count();
        $setting = Setting::where('key', 'FournisseurClientTracking')->first();
        if (!$setting) {
            $setting = Setting::create([
                'key' => 'FournisseurClientTracking',
                'value' => $currentFournClientsCount,
                'addedToday' => 0,
                'deletedToday' => 0,
            ]);
        }

        // Calculate the changes in suppliers (additions and deletions)
        $FournClientsAddedToday = $setting->addedToday;
        $FournClientsDeletedToday = $setting->deletedToday;

        $fournClientsChange = ($FournClientsAddedToday - $FournClientsDeletedToday);

        // Update the suppliers count in settings
        $setting->update([
            'value' => $currentFournClientsCount, // Update the total suppliers count
            'addedToday' => 0, // Reset added count for the day
            'deletedToday' => 0, // Reset deleted count for the day
        ]);




        //suppliers PART DASHBORD
        // Get the current count of suppliers
        $currentSuppliersCount = Fournisseur::count();

        // Retrieve the current settings for suppliers tracking
        $setting = Setting::where('key', 'suppliersTracking')->first();

        // If settings are not found, initialize them
        if (!$setting) {
            $setting = Setting::create([
                'key' => 'suppliersTracking',
                'value' => $currentSuppliersCount,
                'addedToday' => 0,
                'deletedToday' => 0,
            ]);
        }

        // Calculate the changes in suppliers (additions and deletions)
        $suppliersAddedToday = $setting->addedToday;
        $suppliersDeletedToday = $setting->deletedToday;

        $suppliersChange = ($suppliersAddedToday - $suppliersDeletedToday);

        // Update the suppliers count in settings
        $setting->update([
            'value' => $currentSuppliersCount, // Update the total suppliers count
            'addedToday' => 0, // Reset added count for the day
            'deletedToday' => 0, // Reset deleted count for the day
        ]);



        //CLIENTS PART DASHBORD
        // Get the current count of clients
        $currentClientsCount = Client::count();

        // Retrieve the current settings for clients tracking
        $setting = Setting::where('key', 'clientsTracking')->first();

        // If settings are not found, initialize them
        if (!$setting) {
            $setting = Setting::create([
                'key' => 'clientsTracking',
                'value' => $currentClientsCount,
                'addedToday' => 0,
                'deletedToday' => 0,
            ]);
        }

        // Get the previous count of clients
        $previousClientsCount = $setting->value;

        // Calculate the changes in clients (additions and deletions)
        $clientsAddedToday = $setting->addedToday;
        $clientsDeletedToday = $setting->deletedToday;

        $clientsChange = ($clientsAddedToday - $clientsDeletedToday);

        // Update the clients count in settings
        $setting->update([
            'value' => $currentClientsCount, // Update the total clients count
            'addedToday' => 0, // Reset added count for the day
            'deletedToday' => 0, // Reset deleted count for the day
        ]);



        //TIERS PART DASHBORD
        // Get the current count of prospects (Les Tiers)
        $currentTiersCount = Prospect::count();

        // Retrieve the current settings for tiers tracking
        $setting = Setting::where('key', 'tiersTracking')->first();

        // If settings are not found, initialize them
        if (!$setting) {
            $setting = Setting::create([
                'key' => 'tiersTracking',
                'value' => $currentTiersCount,
                'addedToday' => 0,
                'deletedToday' => 0,
            ]);
        }

        // Get the previous count of tiers
        $previousTiersCount = $setting->value;

        // Calculate the changes in tiers (additions and deletions)
        $addedToday = $setting->addedToday;
        $deletedToday = $setting->deletedToday;

        $tiersChange = ($addedToday - $deletedToday);

        // Update the tiers count in settings
        $setting->update([
            'value' => $currentTiersCount, // Update the total tiers count
            'addedToday' => 0, // Reset added count for the day
            'deletedToday' => 0, // Reset deleted count for the day
        ]);



        //ALL PART DASHBORD
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
            'tiersChange',
            'clientsChange',
            'suppliersChange',
            'fournClientsChange'
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
            $setting->increment('addedToday');
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

        // Update the 'deletedToday' in the settings table
        $setting = Setting::where('key', 'tiersTracking')->first();
        if ($setting) {



            $setting->increment('deletedToday');
        }

        return redirect()->back()->with('message', 'Prospect deleted successfully.');
    }

    public function trackClientAdded(Request $request)
    {
        // Create a new client
        Client::create([
            'nom_client' => $request->nom_client,
            'email_client' => $request->email_client,
            'tele_client' => $request->tele_client,
            'adresse_client' => $request->adresse_client,
            'user_id' => $request->user_id,
        ]);

        // Retrieve the settings for client tracking
        $setting = Setting::where('key', 'clientsTracking')->first();
        if ($setting) {


            // Increment the 'addedToday' count
            $setting->increment('addedToday');

            // Recalculate clientsChange after adding the client
            $clientsAddedToday = $setting->addedToday;
            $clientsDeletedToday = $setting->deletedToday;
            $clientsChange = $clientsAddedToday - $clientsDeletedToday;

            // Pass the updated value back to the view
            return redirect()->back()->with('message', 'Client added successfully.')
                ->with('clientsChange', $clientsChange);
        }

        return redirect()->back()->with('message', 'Client added successfully.');
    }



    public function trackClientDeleted($id)
    {
        // Delete the client
        Client::destroy($id);

        // Retrieve the settings for client tracking
        $setting = Setting::where('key', 'clientsTracking')->first();
        if ($setting) {


            // Increment the 'deletedToday' count
            $setting->increment('deletedToday');

            // Recalculate clientsChange after deleting the client
            $clientsAddedToday = $setting->addedToday;
            $clientsDeletedToday = $setting->deletedToday;
            $clientsChange = $clientsAddedToday - $clientsDeletedToday;

            // Pass the updated value back to the view
            return redirect()->back()->with('message', 'Client deleted successfully.')
                ->with('clientsChange', $clientsChange);
        }

        return redirect()->back()->with('message', 'Client deleted successfully.');
    }

    public function trackSupplierAdded(Request $request)
    {
        // Create a new supplier
        Fournisseur::create([
            'nom_fournisseur' => $request->nom_fournisseur,
            'email_fournisseur' => $request->email_fournisseur,
            'tele_fournisseur' => $request->tele_fournisseur,
            'adresse_fournisseur' => $request->adresse_fournisseur,
            'user_id' => $request->user_id,
        ]);

        // Retrieve the settings for supplier tracking
        $setting = Setting::where('key', 'suppliersTracking')->first();
        if ($setting) {


            // Increment the 'addedToday' count
            $setting->increment('addedToday');
        } else {
            // Handle the case where the setting is not found
            dd('Setting not found');
        }

        // Redirect back with a success message
        return redirect()->back()->with('message', 'Supplier added successfully.');
    }

    public function trackSupplierDeleted($id)
    {
        // Delete the supplier by ID
        Fournisseur::destroy($id);

        // Retrieve the settings for supplier tracking
        $setting = Setting::where('key', 'suppliersTracking')->first();
        if ($setting) {


            // Increment the 'deletedToday' count
            $setting->increment('deletedToday');
        }

        // Redirect back with a success message
        return redirect()->back()->with('message', 'Supplier deleted successfully.');
    }

    public function trackFournClientsAdded(Request $request)
    {
        // Create a new FournisseurClient
        FournisseurClient::create([
            'nom_fournisseur' => $request->nom_fournisseur,
            'email_fournisseur' => $request->email_fournisseur,
            'tele_fournisseur' => $request->tele_fournisseur,
            'ville_fournisseur' => $request->ville_fournisseur,
            'nomSociete_fournisseur' => $request->nomSociete_fournisseur,
            'user_id' => $request->user_id, // assuming this field exists
            'remark' => $request->remark, // if applicable
        ]);

        // Get the setting for FournisseurClient tracking
        $setting = Setting::where('key', 'FournisseurClientTracking')->first();
        if ($setting) {
            // Increment the 'addedToday' count in the settings
            $setting->increment('addedToday');
        } else {
            // Handle case where the setting is not found
            dd('Setting not found');
        }

        return redirect()->back()->with('message', 'FournisseurClient added successfully.');
    }

    public function trackFournClientsDeleted($id)
    {
        // Delete the FournisseurClient
        FournisseurClient::destroy($id);

        // Update the 'deletedToday' count in the settings table
        $setting = Setting::where('key', 'FournisseurClientTracking')->first();
        if ($setting) {
            // Increment the 'deletedToday' count in the settings
            $setting->increment('deletedToday');
        }

        return redirect()->back()->with('message', 'FournisseurClient deleted successfully.');
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
