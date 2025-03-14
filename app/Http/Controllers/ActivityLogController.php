<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class ActivityLogController extends Controller
{
    public static function logActivity($action, $type, $description = null)
    {
        ActivityLog::create([
            'action' => $action,
            'type' => $type,
            'description' => $description,
            'user_id' => Auth::id(), // ID de l'utilisateur connecté
        ]);
    }

public function index()
{
    $logs = ActivityLog::latest()->get(); // Récupère tous les logs, triés par date décroissante
    return view('myApp.admin.links.journaux', compact('logs'));
}

}

