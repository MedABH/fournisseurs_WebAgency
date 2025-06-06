<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>La liste des fournisseurs</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;

        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            word-wrap: break-word;
            max-width: 150px;
        }
        th {
            background-color: #f2f2f2;
        }
        td {
            overflow-wrap: break-word;
            white-space: normal;
        }
        body {
            font-size: 10px;
        }
    </style>
</head>
<body>
    <h1>Liste des Fournisseurs</h1>
    <table>
        <thead>
            <tr>
                <th>Nom de la société</th>
                <th>GSM1 De La Société</th>
                <th>GSM2 De La Société</th>
                <th>Personne à contacter</th>
                <th>Téléphone</th>
                <th>Email</th>
                <th>Ville</th>
                <th>Catégorie</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($fournisseurs as $fournisseur)
            <tr>
                <td>{{ !empty($fournisseur->nomSociete_fournisseur) ? $fournisseur->nomSociete_fournisseur : 'Particulier' }}
                <td>{{ $fournisseur->GSM1_fournisseur }}</td>
                <td>{{ $fournisseur->GSM2_fournisseur }}</td>
                <td>{{ $fournisseur->nom_fournisseur }}</td>
                <td>{{ $fournisseur->tele_fournisseur}}</td>
                <td>{{ $fournisseur->email_fournisseur}}</td>
                <td>{{ $fournisseur->ville_fournisseur}}</td>
                <td>
                    @forelse ($fournisseur->categorieFournisseur as $assoc)
                        @if ($assoc->categorie)
                            {{ $assoc->categorie->nom_categorie }}
                        @endif
                    @empty
                        Non catégorisé
                    @endforelse
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
