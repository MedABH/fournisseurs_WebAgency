@extends('myApp.admin.adminLayout.adminPage')

@section('parties-prenantes')
<div class="card-header">
    <h4 class="card-title">L'historique</h4>
</div>
    <nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
        <a href="/historique" class="flex-sm-fill text-sm-center nav-link active">Historique</a>
        <a href="/journaux" class="flex-sm-fill text-sm-center nav-link">Journaux</a>
    </nav>
@endsection
@section('content')
<div class="tab-content" id="orders-table-tab-content">
    <div class="tab-pane fade show active" id="orders-all" role="tabpanel"
        aria-labelledby="orders-all-tab">
        <div class="app-card app-card-orders-table shadow-sm mb-5">
            <div class="app-card-body">
                <div class="table-responsive">
                    <table class="table app-table-hover mb-0 text-center">
                        <thead>
                            <tr>
                                <th class="cell">Nom</th>
                                <th class="cell">Role</th>
                                <th class="cell">Historique de Connexion</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($historiques as $historique)
                                <tr>
                                    <td class="cell">{{ $historique->user->name }}</td>
                                    <td class="cell">{{ $historique->user->role }}</td>
                                    <td class="cell">{{ \Carbon\Carbon::parse($historique->login_at)->timezone('Africa/Casablanca')->format('d/m/Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
@endsection
