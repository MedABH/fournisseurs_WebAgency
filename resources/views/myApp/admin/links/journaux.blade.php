@extends('myApp.admin.adminLayout.adminPage')

@section('parties-prenantes')
<div class="row g-3 mb-4 align-items-center justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0" style="color: #404242">JOURNAUX</h1>
    </div>
</div><!--//row-->
    <nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
        <a href="/historique" class="flex-sm-fill text-sm-center nav-link">Historique</a>
        <a href="journaux" class="flex-sm-fill text-sm-center nav-link active">Journaux</a>
    </nav>
@endsection
@section('content')
<div class="tab-content" id="orders-table-tab-content">
    <div class="tab-pane fade show active" id="orders-paid" role="tabpanel" aria-labelledby="orders-paid-tab">
        <div class="app-card app-card-orders-table mb-5">
            <div class="app-card-body">
                <div class="table-responsive">
                   
                    <table class="table mb-0 text-center">
                        <thead>
                            <tr>
                                <th class="cell">Nom</th>
                                <th class="cell">Role</th>
                                <th class="cell">Table</th>
                                <th class="cell">Action</th>
                                <th class="cell">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($logs as $log)
                                <tr>
                                    <td class="cell">{{ $log->user ? $log->user->name : 'Système' }}</td>
                                    <td class="cell">{{ $log->user ? $log->user->role ?? 'Role inconnu' : 'Utilisateur inconnu' }}</td>
                                    <td class="cell">{{ $log->type }}</td>
                                    <td class="cell">{{ $log->description }}</td>
                                    <td class="cell">{{ $log->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
