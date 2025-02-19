<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>La liste des clients</title>
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
    <h1>Liste des Clients</h1>
    <table>
        <thead>
            <tr>
                <th>Nom de la société</th>
                <th>GSM1</th>
                <th>GSM2</th>
                <th>Personne à contacter</th>
                <th>Téléphone</th>
                <th>Email</th>
                <th>Adresse</th>
                <th>Ville</th>
                <th>Catégorie</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($clients as $client)
            <tr>
                <td>{{ !empty($client->nomSociete_client) ? $client->nomSociete_client : 'Particulier' }}
                <td>{{ !empty($client->GSM1_client) ? $client->GSM1_client : 'Non disponible' }}
                <td>{{ !empty($client->GSM2_client) ? $client->GSM2_client : 'Non disponible' }}
                <td>{{ $client->nom_client }}</td>
                <td>{{ $client->tele_client}}</td>
                <td>{{ $client->email_client}}</td>
                <td>{{ $client->adresse_client}}</td>
                <td>{{ $client->ville_client}}</td>
                <td>
                    @forelse ($client->categorieClients as $assoc)
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
