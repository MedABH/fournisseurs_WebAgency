<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

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

    /*public function changePassword(Request $request)
    {
        $rules = [
            'password' => 'required|string|min:9',
            'newPassword' => 'required|string|min:9|confirmed',
            'newPassword_confirmation' => 'required|string|min:9',
        ];

        $messages = [
            'password.required' => "L'ancien mot de passe est obligatoire!",
            'password.min' => "L'ancien mot de passe doit contenir au moins 9 caractères!",
            'newPassword.required' => "Le nouveau mot de passe est obligatoire!",
            'newPassword.min' => "Le nouveau mot de passe doit contenir au moins 9 caractères!",
            'newPassword.confirmed' => "La confirmation du nouveau mot de passe ne correspond pas!",
            'newPassword_confirmation.required' => "La confirmation du nouveau mot de passe est obligatoire!",
            'newPassword_confirmation.min' => "Le nouveau mot de passe doit contenir au moins 9 caractères!",
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->with('modalType', 'updatePassword')
                ->withErrors($validator, 'updatePassword');
        }

        if (!Hash::check($request->password, auth()->user()->password)) {
            return redirect()->back()
                ->withInput()
                ->with('modalType', 'updatePassword')
                ->withErrors(['password' => "L'ancien mot de passe est incorrect !"], 'updatePassword');
        }

        $user = auth()->user();
        $user->password = Hash::make($request->newPassword);
        $user->save();

        alert()->success('Succès', "Le mot de passe a été mis à jour avec succès.");

        return redirect()->back();
    }*/

    public function updateSecurity(Request $request)
    {
        // Validation des données
        $validatedData = $request->validate([
            'email' => 'nullable|email|unique:users,email',
            'old_password' => 'required',
            'new_password' => 'nullable|min:8|confirmed',
        ]);

        // Vérification de l'ancien mot de passe
        $user = Auth::user();

        // Vérifier l'ancien mot de passe
        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->back()->withErrors(['old_password' => 'L\'ancien mot de passe est incorrect.']);
        }

        // Mettre à jour l'email si nécessaire
        if ($request->filled('email')) {
            $user->email = $request->email;
        }

        // Mettre à jour le mot de passe si nécessaire
        if ($request->filled('new_password')) {
            $user->password = Hash::make($request->new_password);
        }

        // Sauvegarder les modifications
        $user->save();

        // Retourner une réponse de succès
        return redirect()->back()->with('success', 'Les informations ont été mises à jour avec succès.');
    }
}
