@extends('myApp.admin.adminLayout.adminPage')
@section('search-bar')
    <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
            <h1 class="app-page-title mb-0" style="color: #404242">HISTORIQUE</h1>
        </div>
        <div class="col-auto">
            <div class="page-utilities">
                <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                    <div class="col-auto">
                        <form action="{{ route('search.users') }}" method="GET" class="table-search-form row gx-1 align-items-center">
                            <div class="col-auto">
                                <input type="text" name="search"
                                    class="form-control search-orders" placeholder="Search ... ">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn app-btn-secondary">Search</button>
                            </div>
                        </form>

                    </div><!--//col-->

                    <div class="col-auto">
                        <a class="btn app-btn-secondary" href="{{ route('users.pdf') }}">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download me-1"
                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                <path fill-rule="evenodd"
                                    d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                            </svg>

                        </a>
                    </div>
                </div><!--//row-->
            </div><!--//table-utilities-->
        </div><!--//col-auto-->
    </div><!--//row-->


@endsection

@section('parties-prenantes')

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
