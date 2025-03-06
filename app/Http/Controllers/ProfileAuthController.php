<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;


class ProfileAuthController extends Controller
{
    public function showUpdateForm()
    {
        $user = Auth::user();
        return view('myApp.admin.links.profileUser', compact('user'));
    }

    public function updateUser(Request $request)
    {
        $rules = [
            'newName' => 'required|string|max:155',
            'newContact' => 'required|string|max:50',
            'newAdresse' => 'required|string|max:266',
            'newRole' => 'required|string|in:super-admin,admin,utilisateur',
        ];

        $parametres = [
            'newName.required' => 'Le nom est obligatoire!',
            'newContact.required' => 'Le contact est obligatoire!',
            'newAdresse.required' => "L'adresse est obligatoire!",
            'role.required' => "Le rôle est obligatoire!",
            'role.in' => "Le rôle sélectionné n'est pas valide!",
        ];

        $validator = Validator::make($request->all(), $rules, $parametres);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->with('form', 'updateAuthUser')
                ->withErrors($validator);
        }

        $user = Auth::user();

        // Check if the data is identical before updating
        $changes = false;
        $fieldsToUpdate = ['newName', 'newContact', 'newAdresse', 'newRole'];

        foreach ($fieldsToUpdate as $field) {
            if ($user->{$field} !== $request->{$field}) {
                $changes = true;
                break;
            }
        }

        if (!$changes) {
            alert()->error('Erreur', 'Les mêmes informations existent déjà. Veuillez modifier au moins un champ.');
            return redirect()->back()->withInput();
        }

        try {
            // Update the user details
            $user->update([
                'name' => $request->newName,
                'contact' => $request->newContact,
                'adresse' => $request->newAdresse,
                'role' => $request->newRole,
            ]);

            alert()->success('Succès', "La mise à jour a été effectuée avec succès.");
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', "Erreur : " . $e->getMessage());
        }

        return redirect()->back();
    }


    public function updateSecurity(Request $request)
{
    // Validation des données
    $validated = $request->validate([
        'email' => 'nullable|email|unique:users,email,' . auth()->id(),
        'old_password' => 'nullable',
        'new_password' => 'nullable|confirmed|min:8',
    ]);

    // Vérifiez si l'ancien mot de passe est correct
    $user = auth()->user();

    // Si l'ancien mot de passe est fourni, vérifier sa validité
    if ($request->old_password && !Hash::check($request->old_password, $user->password)) {
        // Return back with errors and keep the modal open
        return back()->withErrors(['old_password' => 'L\'ancien mot de passe est incorrect.'])
                     ->withInput(); // Preserve form inputs
    }

    try {
        // Mise à jour de l'email et du mot de passe uniquement si ils sont fournis
        $userData = [];

        // Si un nouvel email est fourni, on le met à jour
        if ($request->has('email') && $request->email) {
            $userData['email'] = $request->email;
        }

        // Si un nouveau mot de passe est fourni, on le met à jour
        if ($request->has('new_password') && $request->new_password) {
            $userData['password'] = Hash::make($request->new_password); // Hachage du mot de passe
        }

        // Si des informations ont été modifiées, on les met à jour dans la base de données
        if (!empty($userData)) {
            $user->update($userData);
            return back()->with('success', 'Les informations ont été mises à jour avec succès.');
        } else {
            return back()->withErrors(['update' => 'Aucune modification n\'a été effectuée.']);
        }
    } catch (\Exception $e) {
        // Si une erreur se produit lors de la mise à jour
        Log::error('Erreur lors de la mise à jour de la sécurité : ' . $e->getMessage());
        return back()->withErrors(['update' => 'Une erreur est survenue lors de la mise à jour des informations.']);
    }
}

}
