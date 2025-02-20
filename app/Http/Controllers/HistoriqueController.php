<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class HistoriqueController extends Controller
{
     public function showHistorique()
     {
         // Récupérer tous les historiques avec les utilisateurs associés et trier par login_at (desc)
         $historiques = \App\Models\Historique::with('user')
             ->orderBy('login_at', 'desc')
             ->get();
     
         return view('myApp.admin.links.historiques', compact('historiques'));
     }
     
}
