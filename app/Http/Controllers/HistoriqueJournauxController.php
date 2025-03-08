<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistoriqueJournauxController extends Controller
{
    public function index(){
        return view('myApp.admin.links.historiqueJournauxSection');
    }
}
