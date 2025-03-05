<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PartiesPrenantesController extends Controller
{
    public function index(){
        return view('myApp.admin.links.partiesPrenantes');
    }
}