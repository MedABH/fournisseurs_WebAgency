<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use App\Models\FournisseurClient;
use App\Models\Prospect;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Categorie;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Dompdf\Dompdf;
use Dompdf\Options;



class ClientController extends Controller
{

    public function store (Request $request) {

        $rules = [
            'nom_client' => ['nullable','max:50','string'],
            'email_client' => ['nullable','email','string','max:266','unique:clients,email_client'],
            'tele_client' => ['nullable','regex:/^\+?[0-9]{9,15}$/','unique:clients,tele_client'],
            'adresse_client' => ['nullable','max:266','string'],
            'ville_client' => ['required','max:60','string'],
            'nomSociete_client' => ['nullable','max:200','unique:clients,nomSociete_client'],
            'GSM1_client' => ['nullable','regex:/^\+?[0-9]{9,15}$/','unique:clients,GSM1_client'],
            'GSM2_client' => ['nullable','regex:/^\+?[0-9]{9,15}$/','unique:clients,GSM2_client'],
            'categorie_id' => ['required','integer','exists:categories,id'],
        ];

        $messages = [
            // 'nom_client.required' => 'Le nom est obligatoire!',
            'nom_client.string' => 'Le nom doit être en chaine de caractère!',
            // 'email_client.required' => "L'émail est obligatoire!",
            'email_client.email' => "Veuillez fournir une adresse émail valide!",
            'email_client.string' => "L'émail doit être en chaine de caractère!",
            'email_client.unique' => "L'émail doit être unique!",
            'ville_client.required' => "La ville est obligatoire!",
            'ville_client.string' => 'La ville doit être en chaine de caractère!',
            // 'tele_client.required' => 'Le contact est obligatoire!',
            'tele_client.regex' => 'Le numéro de téléphone doit être valide!',
            'tele_client.unique' => 'Le contact doit être unique!',
            'GSM1_client.regex' => 'Le numéro de téléphone doit être valide!',
            'GSM1_client.unique' => 'Le contact de la societe doit être unique!',
            'GSM2_client.regex' => 'Le numéro de téléphone doit être valide!',
            'GSM2_client.unique' => 'Le contact de la societe doit être unique!',
            // 'adresse_client.required' => "L'adresse est obligatoire!",
            'adresse_client.string' => "L'adresse doit être en chaine de caractère!",
            'nomSociete_client.unique' => "Le nom de la société doit être unique!",
            'categorie_id.required' => 'La catégorie est obligatoire!',
            'categorie_id.integer' => 'La catégorie doit être un entier!',
            'categorie_id.exists' => 'Cette catégorie n\'existe pas!',
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if ($validator->fails()){
            // dd($validator);
            return redirect()->back()
                   ->withInput()
                   ->with('modalType','default')
                   ->withErrors($validator);
        }

        $client = new Client();
        $client->nom_client = $request->nom_client ?? '';
        $client->adresse_client = $request->adresse_client ?? '';
        $client->ville_client = $request->ville_client;
        $client->tele_client = $request->tele_client ?? '';
        $client->GSM1_client = $request->GSM1_client ?? '' ;
        $client->GSM2_client = $request->GSM2_client ?? '';
        $client->email_client = $request->email_client ?? '';
        $client->nomSociete_client = $request->nomSociete_client ?? '';
        $client->groupId_client = Str::uuid();
        $client->save();

        $categorie = Categorie::find($request->categorie_id);
        $categorie->clients()->attach($client->id);

        alert()->success('succès', $client->nom_client." ".'a été enregistrée avec succès.');
        return redirect()->to(url()->previous());
    }

    public function updateUserClient(Request $request, $id)
        {

            $request->validate([
                'user_id' => 'nullable|exists:users,id',
            ]);


            $client = Client::findOrFail($id);

            $clients = Client::where('groupId_client', $client->groupId_client)->get();

            foreach ($clients as $c) {
                $c->user_id = $request->user_id ?? $c->user_id;
                $c->save();
            }


            return redirect()->back();        }

            public function updateRemarkClient(Request $request, $id)
            {
                $validator = Validator::make($request->all(), [
                    'remark' => ['nullable','string',function ($attribute, $value, $fail) {
                        $wordCount = str_word_count($value);
                        if ($wordCount > 100) {
                            $fail('La description ne doit pas dépasser 100 mots.');
                        }
                    }]

                ]
            
                ,[
                    "remark.string" => "La remarque doit etre de type chaine de caractere" 
                ]);

                if ($validator->fails()) {
                    return redirect()->back()
                    ->withInput()
                    ->with('modalType', 'remark')
                    ->withErrors($validator);
                }

                $client = Client::findOrFail($id);

                $clients = Client::where('groupId_client', $client->groupId_client)->get();

                foreach ($clients as $c) {
                    $c->remark = $request->remark ;
                    $c->save();
                }

                return redirect()->back();        }
    public function index (Request $request) {

        $perPage = $request->get('per_page',10);
        $clients = Client::with('categories','categorieClients.categorie','utilisateur')->paginate($perPage);

        $categories = Categorie::with('sousCategories')->get();


        foreach ($clients as $client) {
            $client->allCategories = $client->allCategories();
        }

        $select = ['Fournisseur','Tiers','Client et Fournisseur'];

        return view('myApp.admin.links.clients',compact('categories','clients','select','perPage'));
    }

    public function clientsPdf()
    {

            $clients = Client::with('categorieClients.categorie')->get();

            $options = new Options();
            $options->set('defaultFont', 'Courier');
            $dompdf = new Dompdf($options);

            $html = view('myApp/admin/pdf/clients', compact('clients'))->render();

            $dompdf->loadHtml($html);

            $dompdf->setPaper('A4', 'portrait');

            $dompdf->render();

            return response($dompdf->output(), 200)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'attachment; filename="clients-list.pdf"');
    }




    public function destroy($id){
        $client = Client::find($id);
        $client->delete();
        return redirect()->to(url()->previous());
    }

    public function search(Request $request){
        $select = ['Fournisseur','Tiers','Client et Fournisseur'];
        $search = $request->input('search');
        $client = Client::with(['categories.sousCategories','utilisateur'])
        ->where('nom_client','LIKE',"%{$search}%")
        ->orWhere('nomSociete_client','LIKE',"%{$search}%")
        ->get();
        return response()->json([
            'clients' => $client,
            'selectOptions' => $select
        ]);
    }

    public function update (Request $request) {

        $client = Client::find((int)$request->id);

        $rules = [
            'newNom_client' => ['nullable','max:50','string'],
            'newEmail_client' => ['nullable','email:rfc,dns','string','max:266'],
            'newTele_client' => ['nullable','regex:/^\+?[0-9]{9,15}$/'],
            'newAdresse_client' => ['nullable','max:266','string'],
            'newVille_client' => ['required','max:60','string'],
            'newNomSociete_client' => ['nullable','max:200'],
            'newGSM1_client' => ['nullable','regex:/^\+?[0-9]{9,15}$/'],
            'newGSM2_client' => ['nullable','regex:/^\+?[0-9]{9,15}$/'],
            'newCategorie_id' => ['required','integer','exists:categories,id'],
        ];

        $messages = [
            // 'newNom_client.required' => 'Le nom est obligatoire!',
            'newNom_client.string' => 'Le nom doit être en chaine de caractère!',
            // 'newEmail_client.required' => "L'émail est obligatoire!",
            'newEmail_client.string' => "L'émail doit être en chaine de caractère!",
            'newVille_client.required' => "La ville est obligatoire!",
            'newVille_client.string' => 'La ville doit être en chaine de caractère!',
            // 'newTele_client.required' => 'Le contact est obligatoire!',
            'newTele_client.regex' => 'Le numéro de téléphone doit être valide!',
            'newGSM1_client.regex' => 'Le numéro de téléphone doit être valide!',
            'newGSM2_client.regex' => 'Le numéro de téléphone doit être valide!',
            // 'newAdresse_client.required' => "L'adresse est obligatoire!",
            'newAdresse_client.string' => "L'adresse doit être en chaine de caractère!",
            'newCategorie_id.required' => 'La catégorie est obligatoire!',
            'newCategorie_id.integer' => 'La catégorie doit être un entier!',
            'newCategorie_id.exists' => 'Cette catégorie n\'existe pas!',
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if ($validator->fails()){
            return redirect()->back()
                   ->withInput()
                   ->with('modalType','update')
                   ->withErrors($validator);
        }

        $nomSociety = $request->newNomSociete_client ?? '';
        $GSM1 = $request->newGSM1_client ?? '';
        $GSM2 = $request->newGSM2_client ?? '';
        $adresse = $request->newAdresse_client ?? '';
        $email =$request->newEmail_client?? '';
        $name = $request->newNom_client ?? '';
        $tele = $request->newTele_client ?? '';

        $newCategorieId = $request->newCategorie_id;
        $existingClient = Client::
        where('nom_client', $name)
        ->where('email_client', $email)
        ->where('tele_client', $tele)
        ->where('adresse_client', $adresse)
        ->where('ville_client', $request->newVille_client)
        ->where('nomSociete_client', $nomSociety)
        ->where('GSM1_client', $GSM1)
        ->where('GSM2_client', $GSM2)
        ->whereHas('categories', function ($query) use ($newCategorieId) {
            $query->where('categories.id', $newCategorieId);
        })
        ->first();

        if ($existingClient) {
            alert()->error('Erreur', 'Une version avec les mêmes informations existe déjà. Veuillez modifier au moins un champ.');
            return redirect()->back()->withInput();
        }

        if ($newCategorieId && !$this->hasOtherChanges($client, $request)) {
            $newClient = $client->replicate();
            $newClient->groupId_client = $client->groupId_client;
            $newClient->version_client = $client->version_client + 1;
            $newClient->save();

            $newClient->categories()->sync([$newCategorieId]);

            alert()->success('Succès', "La catégorie a été modifiée et une nouvelle version a été créée.");
            return redirect()->back();
        }

        $client->nom_client = $request->newNom_client ?? '';
        $client->email_client = $request->newEmail_client ?? '';
        $client->tele_client = $request->newTele_client ?? '';
        $client->adresse_client = $request->newAdresse_client ?? '';
        $client->ville_client = $request->newVille_client;
        $client->nomSociete_client = $request->newNomSociete_client ?? '';
        $client->GSM1_client = $request->newGSM1_client ?? '';
        $client->GSM2_client = $request->newGSM2_client ?? '';

        if ($client->save()) {
            alert()->success('Succès', 'Le fournisseur a été mis à jour avec succès.');
        }

        $clientsSimilaires = Client::where('groupId_client', $client->groupId_client)
        ->where('id', '!=', $client->id)
        ->get();

       foreach ($clientsSimilaires as $similarClient) {
        $similarClient->nom_client = $request->newNom_client ?? '';
        $similarClient->email_client = $request->newEmail_client ?? '';
        $similarClient->tele_client = $request->newTele_client ?? '';
        $similarClient->adresse_client = $request->newAdresse_client ?? '';
        $similarClient->ville_client = $request->newVille_client;
        $similarClient->nomSociete_client = $request->newNomSociete_client ?? '';
        $similarClient->GSM1_client = $request->newGSM1_client ?? '';
        $similarClient->GSM2_client = $request->newGSM2_client ?? '';
        if ($similarClient->save()) {
            alert()->success('Succès', 'Le fournisseur a été mis à jour avec succès.');
        }
    }

        return redirect()->back();
    }

    private function hasOtherChanges($client, $request)
    {

        return $client->nom_client !== ($request->newNom_client ?? '')||
               $client->email_client !== ($request->newEmail_client ?? '')||
               $client->tele_client !== ($request->newTele_client ?? '')||
               $client->adresse_client !== ($request->newAdresse_client ?? '')||
               $client->ville_client !== $request->newVille_client||
               $client->nomSociete_client !== ($request->newNomSociete_client ?? '') ||
               $client->GSM1_client !== ($request->newGSM1_client ?? '') ||
               $client->GSM2_client !== ($request->newGSM2_client ?? '');
    }

    public function client (Request $request, $id){

        $selectedStatus = $request->input('status');

        $client = Client::find($id);

        $clientsGroup = Client::where('groupId_client',$client->groupId_client)->get();

        if ($selectedStatus === 'Fournisseur') {
            foreach ($clientsGroup as $clientItem) {
                $fournisseur = new Fournisseur();
                $fournisseur->nom_fournisseur = $clientItem->nom_client;
                $fournisseur->email_fournisseur= $clientItem->email_client;
                $fournisseur->tele_fournisseur= $clientItem->tele_client;
                $fournisseur->adresse_fournisseur= $clientItem->adresse_client;
                $fournisseur->ville_fournisseur= $clientItem->ville_client;
                $fournisseur->nomSociete_fournisseur= $clientItem->nomSociete_client;
                $fournisseur->GSM1_fournisseur= $clientItem->GSM1_client;
                $fournisseur->GSM2_fournisseur= $clientItem->GSM2_client;
                $fournisseur->user_id= $clientItem->user_id;
                $fournisseur->remark= $clientItem->remark;
                $fournisseur->groupId_fournisseur= $clientItem->groupId_client;

                $fournisseur->save();

                if ($clientItem->categories) {
                    foreach ($clientItem->categories as $category) {
                        $fournisseur->categories()->attach($category->id);
                    }
                }

                $clientItem->delete();
            }
        } else if ($selectedStatus === 'Tiers') {

            foreach ($clientsGroup as $clientItem) {
                $prospect = new Prospect();
                $prospect->nom_prospect = $clientItem->nom_client;
                $prospect->email_prospect= $clientItem->email_client;
                $prospect->tele_prospect= $clientItem->tele_client;
                $prospect->adresse_prospect= $clientItem->adresse_client;
                $prospect->ville_prospect= $clientItem->ville_client;
                $prospect->nomSociete_prospect= $clientItem->nomSociete_client;
                $prospect->GSM1_prospect= $clientItem->GSM1_client;
                $prospect->GSM2_prospect= $clientItem->GSM2_client;
                $prospect->user_id= $clientItem->user_id;
                $prospect->remark= $clientItem->remark;
                $prospect->groupId_prospect= $clientItem->groupId_client;

                $prospect->save();

                if ($clientItem->categories) {
                    foreach ($clientItem->categories as $category) {
                        $prospect->categories()->attach($category->id);
                    }
                }

                $clientItem->delete();
            }

        } else if ($selectedStatus === 'Client et Fournisseur'){

            foreach ($clientsGroup as $clientItem) {
                $fc = new FournisseurClient();
                $fc->nom_fournisseurClient = $clientItem->nom_client;
                $fc->email_fournisseurClient= $clientItem->email_client;
                $fc->tele_fournisseurClient= $clientItem->tele_client;
                $fc->adresse_fournisseurClient= $clientItem->adresse_client;
                $fc->ville_fournisseurClient= $clientItem->ville_client;
                $fc->nomSociete_fournisseurClient= $clientItem->nomSociete_client;
                $fc->GSM1_fournisseurClient= $clientItem->GSM1_client;
                $fc->GSM2_fournisseurClient= $clientItem->GSM2_client;
                $fc->user_id= $clientItem->user_id;
                $fc->remark= $clientItem->remark;
                $fc->groupId_fournisseurClient= $clientItem->groupId_client;
                $fc->save();

                if ($clientItem->categories) {
                    foreach ($clientItem->categories as $category) {
                        $fc->categories()->attach($category->id);
                    }
                }

                $clientItem->delete();
            }
        }

        return redirect()->to(url()->previous());

    }
}
