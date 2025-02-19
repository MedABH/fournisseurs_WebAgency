<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class HistoriqueController extends Controller
{


public function showHistorique()
{
     $users = User::with(['historiques' => function($query) {
        $query->distinct();
    }])->get();


    //  dd($users);
     return view('myApp.admin.links.historiques', compact('users'));
}

}
