<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Client;
use App\Models\Prospect;
use App\Models\Fournisseur;
use App\Models\FournisseurClient;

class ExportController extends Controller
{
    public function allDataPdf()
    {
        // Récupération des données de toutes les tables
        $clients = Client::with('categorieClients.categorie')->get();
        $prospects = Prospect::all();
        $fournisseurs = Fournisseur::all();
        $fcs = FournisseurClient::all();

        // Configuration de DomPDF
        $options = new Options();
        $options->set('defaultFont', 'Courier');
        $dompdf = new Dompdf($options);

        // Chargement de la vue avec les données
        $html = view('myApp/admin/pdf/all_data', compact('clients', 'prospects', 'fournisseurs', 'fcs'))->render();
        $dompdf->loadHtml($html);

        // Configuration du format de la page
        $dompdf->setPaper('A4', 'portrait');

        // Génération du PDF
        $dompdf->render();

        // Téléchargement du fichier PDF
        return response($dompdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="all_data.pdf"');
    }
}
