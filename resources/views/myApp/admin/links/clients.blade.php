@extends('myApp.admin.adminLayout.adminPage')
@section('search-bar')
    <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
            <h1 class="app-page-title mb-0">Les Clients</h1>
        </div>
        <div class="col-auto">
            <div class="page-utilities">
                <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                    <div class="col-auto">
                        <form action="{{ route('search.users') }}" method="GET"
                            class="table-search-form row gx-1 align-items-center">
                            <div class="col-auto">
                                <input type="text" name="search" class="form-control search-orders"
                                    placeholder="Search ... ">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn app-btn-secondary">Search</button>
                            </div>
                        </form>

                    </div><!--//col-->

                    <div class="col-auto">
                        @if (auth()->user()->role == 'super-admin')
                            <a class="btn app-btn-secondary" href="{{ route('clients.pdf') }}">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download me-1"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                    <path fill-rule="evenodd"
                                        d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                                </svg>

                            </a>
                        @elseif (auth()->user()->role == 'admin')
                            <a class="btn app-btn-secondary" href="{{ route('clients.pdf') }}">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download me-1"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                    <path fill-rule="evenodd"
                                        d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                                </svg>

                            </a>
                        @endif
                    </div>
                </div><!--//row-->
            </div><!--//table-utilities-->
        </div><!--//col-auto-->
    </div><!--//row-->
@endsection

@section('parties-prenantes')
    <nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
        <a href="/prospectsSection" class="flex-sm-fill text-sm-center nav-link">Les Tiers</a>
        <a href="/clientsSection" class="flex-sm-fill text-sm-center nav-link active">Les Clients</a>
        <a href="/suppliersSection" class="flex-sm-fill text-sm-center nav-link">Les Fournisseurs</a>
        <a href="/suppliersAndClientsSection" class="flex-sm-fill text-sm-center nav-link">Fournisseurs et Clients</a>
    </nav>
@endsection

@section('errorContent')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var modalType = document.getElementById('modals').getAttribute('data-error');

            if (modalType === 'default') {
                var addModal = new bootstrap.Modal(document.getElementById('add_client'));
                addModal.show();
            } else if (modalType === 'update') {
                var updateModal = new bootstrap.Modal(document.getElementById('update_client'));
                updateModal.show();
            } else if (modalType === 'remark') {
                var remark = new bootstrap.Modal(document.getElementById('remark'));
                remark.show();
            }
        });
    </script>
@endsection
@section('content')
    <div id="modals" style="display:none;" data-error="{{ session('modalType') }}"></div>
    <form action="{{ route('client.add') }}" method="POST">
        @csrf
        <div class="modal fade" id="add_client" tabindex="-1" aria-labelledby="clientModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="clientModalLabel">Ajouter un client</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label class="form-label"><strong class="det">Nom de la société</strong></label>
                        <input type="text" class="form-control" name="nomSociete_client"
                            placeholder="Entrer le nom de la société..." value="{{ old('nomSociete_client') }}" />
                        @error('nomSociete_client', 'default')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <label class="form-label"><strong class="det">GSM1 de la société</strong></label>
                        <input type="tel" class="form-control" name="GSM1_client" required
                            placeholder="Entrer le GSM1..." value="{{ old('GSM1_client') }}" />
                        @error('GSM1_client', 'default')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <label class="form-label"><strong class="det">GSM2 de la société</strong></label>
                        <input type="tel" class="form-control" name="GSM2_client" required
                            placeholder="Entrer le GSM2..." value="{{ old('GSM2_client') }}" />
                        @error('GSM2_client', 'default')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror


                        <label class="form-label"><strong class="det">Personne à contacter</strong></label>
                        <input type="text" class="form-control" name="nom_client" placeholder="Entrer le client..."
                            value="{{ old('nom_client') }}" />
                        @error('nom_client', 'default')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <label class="form-label"><strong class="det">Numero de telephone</strong></label>
                        <input type="tel" class="form-control" name="tele_client" required
                            placeholder="Entrer le contact..." value="{{ old('tele_client') }}" />
                        @error('tele_client', 'default')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <label class="form-label"><strong class="det">Email</strong></label>
                        <input type="email" class="form-control" name="email_client" placeholder="Entrer l'émail..."
                            value="{{ old('email_client') }}" />
                        @error('email_client', 'default')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror


                        <label class="form-label"><strong class="det">Ville</strong></label>
                        <input type="text" class="form-control" name="ville_client" placeholder="Entrer la ville..."
                            value="{{ old('ville_client') }}" />
                        @error('ville_client', 'default')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <label class="form-label"><strong class="det">Catégorie</strong></label>
                        <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                            name="categorie_id" style="color: #a6a6a6;">
                            <option value="">Selectionner la catégorie</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('categorie_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->nom_categorie }}
                                </option>
                            @endforeach
                        </select>
                        @error('categorie_id', 'default')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-success" value="Ajouter" data-bs-dismiss="modal">
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="app-card app-card-orders-table mb-5">
        <div class="app-card-body">
            <div class="table-responsive">
                <table id="basic-datatables" class="table app-table-hover mb-0 text-center">
                    <thead>
                        <tr>
                            <th class="cell">Nom de la société</th>
                            <th class="cell">GSM1 de la société</th>
                            <th class="cell">GSM2 de la société</th>
                            <th class="cell">Personne à contacter</th>
                            <th class="cell">Numero de telephone</th>
                            <th class="cell">Email</th>
                            <th class="cell">Ville</th>
                            <th class="cell">Catégorie</th>
                            <th class="cell">Contacté Par</th>
                            <th class="cell text-end">
                                @if (auth()->user()->role == 'super-admin')
                                    <button type="button" class="btn app-btn-secondary" data-bs-toggle="modal"
                                        data-bs-target="#add_client">
                                        Ajouter
                                    </button>
                                @elseif (auth()->user()->role == 'admin')
                                    <button type="button" class="btn app-btn-secondary" data-bs-toggle="modal"
                                        data-bs-target="#add_client">
                                        Ajouter
                                    </button>
                                @endif
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $utilisateurs = \App\Models\User::get();
                        @endphp
                        @foreach ($clients as $client)
                            <tr>
                                <td class="cell">
                                    {{ !empty($client->nomSociete_client) ? $client->nomSociete_client : 'Particulier' }}
                                </td>
                                <td class="cell">
                                    {{ !empty($client->GSM1_client) ? $client->GSM1_client : 'Non disponible' }}
                                </td>
                                <td class="cell">
                                    {{ !empty($client->GSM2_client) ? $client->GSM2_client : 'Non disponible' }}
                                </td>
                                <td class="cell">
                                    {{ !empty($client->nom_client) ? $client->nom_client : 'Non disponible' }}
                                </td>
                                <td class="cell">
                                    {{ !empty($client->tele_client) ? $client->tele_client : 'Non disponible' }}
                                </td>
                                <td class="cell">
                                    {{ !empty($client->email_client) ? $client->email_client : 'Non disponible' }}
                                </td>
                                <td class="cell">{{ $client->ville_client }}</td>
                                <td class="cell">
                                    @forelse ($client->categorieClients as $assoc)
                                        @if ($assoc->categorie)
                                            {{ $assoc->categorie->nom_categorie }}
                                        @endif
                                    @empty
                                        Non catégorisé
                                    @endforelse
                                </td>

                                <td class="cell">
                                    {{ !empty($client->utilisateur->name) ? $client->utilisateur->name : 'Personne' }}
                                </td>

                                @if (auth()->user()->role == 'super-admin')
                                    <td class="button-container">
                                        <div class="d-flex align-items-center gap-2"
                                            style="display: inline; border-radius: 1cap; border-style: inherit; color: transparent;">
                                            <a href="#" class="btn btn-outline-primary border-btn me-4"
                                                data-bs-toggle="modal" data-bs-target="#update_client"
                                                data-id="{{ $client->id }}"
                                                data-society="{{ $client->nomSociete_client }}"
                                                data-GSM1="{{ $client->GSM1_client }}"
                                                data-GSM2="{{ $client->GSM2_client }}"
                                                data-name="{{ $client->nom_client }}"
                                                data-tele="{{ $client->tele_client }}"
                                                data-email="{{ $client->email_client }}"
                                                data-ville="{{ $client->ville_client }}"
                                                data-category="{{ $client->categories->first()?->id ?? '' }}">
                                                Modifier
                                            </a>




                                            <button type="button" class="btn btn-outline-success border-btn me-4"
                                                data-bs-toggle="modal" data-bs-target="#remark-{{ $client->id }}">
                                                Remarque
                                            </button>



                                            <button type="button"
                                                class="btn btn-outline-info detailButton border-btn me-4"
                                                data-bs-toggle="modal"
                                                data-bs-target="#ModalClientDetails-{{ $client->id }}"
                                                data-name="{{ $client->nom_client }}"
                                                data-email="{{ $client->email_client }}"
                                                data-tele="{{ $client->tele_client }}"
                                                data-ville="{{ $client->ville_client }}"
                                                data-society-name="{{ !empty($client->nomSociete_client) ? $client->nomSociete_client : 'Particulier' }}"
                                                data-GSM1="{{ !empty($client->GSM1_client) ? $client->GSM1_client : 'Non disponible' }}"
                                                data-GSM2="{{ !empty($client->GSM2_client) ? $client->GSM2_client : 'Non disponible' }}"
                                                data-remark="{{ $client->remark }}"
                                                data-user="{{ !empty($client->utilisateur->name) ? $client->utilisateur->name : 'Personne' }}">

                                                Details
                                            </button>


                                            <form action="{{ route('client.destroy', $client->id) }}" method="POST"
                                                style="display: inline border-radius: 1cap; border-style: inherit; color: transparent;"
                                                id="delete-form-{{ $client->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-outline-danger border-btn me-4"
                                                    onclick="confirmDelete({{ $client->id }})">
                                                    Supprimer
                                                </button>
                                            </form>

                                            <form class="user-form"
                                                action="{{ route('user.select.client', $client->id) }}" method="POST">
                                                @csrf
                                                @method('POST')
                                                <select class="form-select userSelect" aria-label="Default select example"
                                                    data-client-id="{{ $client->id }}" style="margin-right:100px"
                                                    name="user_id">
                                                    <option value="">Contacté Par</option>
                                                    @foreach ($utilisateurs as $user)
                                                        <option value="{{ $user->id }}"
                                                            {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                            {{ $user->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </form>

                                            <form class="client-form" action="{{ route('client.select', $client->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('POST')
                                                <select name="status" id="" class="form-select status-select">
                                                    <option value="">Selectionner la table</option>
                                                    @foreach ($select as $item)
                                                        <option value="{{ $item }}">{{ $item }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </form>
                                        </div>
                                    </td>
                                @elseif (auth()->user()->role == 'admin')
                                    <td>
                                        <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#update_client" data-id="{{ $client->id }}"
                                            data-society="{{ $client->nomSociete_client }}"
                                            data-GSM1="{{ $client->GSM1_client }}"
                                            data-GSM2="{{ $client->GSM2_client }}" data-name="{{ $client->nom_client }}"
                                            data-tele="{{ $client->tele_client }}"
                                            data-email="{{ $client->email_client }}"
                                            data-ville="{{ $client->ville_client }}"
                                            data-category="{{ $client->categories->first()?->id ?? '' }}">
                                            Modifier
                                        </a>


                                        <form class="user-form" action="{{ route('user.select.client', $client->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('POST')
                                            <select class="form-select userSelect" aria-label="Default select example"
                                                data-client-id="{{ $client->id }}" style="margin-right:100px"
                                                name="user_id">
                                                <option value="">Contacté Par</option>
                                                @foreach ($utilisateurs as $user)
                                                    <option value="{{ $user->id }}"
                                                        {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                        {{ $user->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </form>

                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#remark-{{ $client->id }}">
                                            Remarque
                                        </button>



                                        <button type="button" class="btn btn-info detailButton" data-bs-toggle="modal"
                                            data-bs-target="#ModalClientDetails-{{ $client->id }}"
                                            data-name="{{ $client->nom_client }}"
                                            data-email="{{ $client->email_client }}"
                                            data-tele="{{ $client->tele_client }}"
                                            data-ville="{{ $client->ville_client }}"
                                            data-society-name="{{ !empty($client->nomSociete_client) ? $client->nomSociete_client : 'Particulier' }}"
                                            data-GSM1="{{ !empty($client->GSM1_client) ? $client->GSM1_client : 'Non disponible' }}"
                                            data-GSM2="{{ !empty($client->GSM2_client) ? $client->GSM2_client : 'Non disponible' }}"
                                            data-remark="{{ $client->remark }}"
                                            data-user="{{ !empty($client->utilisateur->name) ? $client->utilisateur->name : 'Personne' }}">

                                            Details
                                        </button>

                                        <form class="client-form" action="{{ route('client.select', $client->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('POST')
                                            <select name="status" id="" class="form-select status-select">
                                                <option value="">Selectionner la table</option>
                                                @foreach ($select as $item)
                                                    <option value="{{ $item }}">{{ $item }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </form>
                                    </td>
                                @elseif (auth()->user()->role == 'utilisateur')
                                    <td>
                                        <form class="user-form" action="{{ route('user.select.client', $client->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('POST')
                                            <select class="form-select userSelect" aria-label="Default select example"
                                                data-client-id="{{ $client->id }}" style="margin-right:100px"
                                                name="user_id">
                                                <option value="">Contacté Par</option>
                                                @foreach ($utilisateurs as $user)
                                                    <option value="{{ $user->id }}"
                                                        {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                        {{ $user->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </form>

                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#remark-{{ $client->id }}">
                                            Remarque
                                        </button>



                                        <button type="button" class="btn btn-info detailButton" data-bs-toggle="modal"
                                            data-bs-target="#ModalClientDetails-{{ $client->id }}"
                                            data-name="{{ $client->nom_client }}"
                                            data-email="{{ $client->email_client }}"
                                            data-tele="{{ $client->tele_client }}"
                                            data-ville="{{ $client->ville_client }}"
                                            data-society-name="{{ !empty($client->nomSociete_client) ? $client->nomSociete_client : 'Particulier' }}"
                                            data-GSM1="{{ !empty($client->GSM1_client) ? $client->GSM1_client : 'Non disponible' }}"
                                            data-GSM2="{{ !empty($client->GSM2_client) ? $client->GSM2_client : 'Non disponible' }}"
                                            data-remark="{{ $client->remark }}"
                                            data-user="{{ !empty($client->utilisateur->name) ? $client->utilisateur->name : 'Personne' }}">

                                            Details
                                        </button>
                                    </td>
                                @endif
                                <form action="{{ route('remark.client', $client->id) }}" method="POST">
                                    @csrf
                                    <div class="modal fade" id="remark-{{ $client->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">

                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="form-group">
                                                        <label for="remarque">Remarque</label>
                                                        <textarea name="remark" id="remarque" class="form-control" rows="4">{{ old('remark', $client->remark) }}</textarea>
                                                        @error('remark')
                                                            <div class="alert alert-danger">
                                                                {{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Ajouter la
                                                        remarque</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>


                            </tr>
                            <div class="modal fade" id="ModalClientDetails-{{ $client->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="show-info-client show-society">
                                                <label class="label-detail-client">Nom de la
                                                    société</label>
                                                <h6 class="info-client showSocietyClient"
                                                    id="showSocietyDetail-{{ $client->id }}">
                                                </h6>
                                            </div>
                                            <div class="show-info-client show-GSM1">
                                                <label class="label-detail-client">GSM1 de la
                                                    société</label>
                                                <h6 class="info-client showGSM1Client"
                                                    id="showGSM1Detail-{{ $client->id }}">
                                                </h6>
                                            </div>
                                            <div class="show-info-client show-GSM2">
                                                <label class="label-detail-client">GSM2 de la
                                                    société</label>
                                                <h6 class="info-client showGSM2Client"
                                                    id="showGSM2Detail-{{ $client->id }}">
                                                </h6>
                                            </div>
                                            <div class="show-info-client show-name">
                                                <label class="label-detail-client">Personne à
                                                    contacter</label>
                                                <h6 class="info-client showNameClient"
                                                    id="showNameDetail-{{ $client->id }}">
                                                </h6>
                                            </div>
                                            <div class="show-info-client show-contact">
                                                <label class="label-detail-client">Contact du GSM</label>
                                                <h6 class="info-client showContactClient"
                                                    id="showContactDetail-{{ $client->id }}">
                                                </h6>
                                            </div>
                                            <div class="show-info-client show-email">
                                                <label class="label-detail-client">Email</label>
                                                <h6 class="info-client showEmailClient"
                                                    id="showEmailDetail-{{ $client->id }}">
                                                </h6>
                                            </div>

                                        
                                            <div class="show-info-client show-ville">
                                                <label class="label-detail-client">Ville</label>
                                                <h6 class="info-client showVilleClient"
                                                    id="showVilleDetail-{{ $client->id }}">
                                                </h6>
                                            </div>

                                            <div class="show-info-client show-category" style="margin-top:10px">
                                                <label class="label-detail-client">Les
                                                    catégories</label>
                                                <select class="form-select form-select-sm info-client showCategoryClient"
                                                    aria-label=".form-select-sm example"
                                                    style="width: 200px; height: 30px"
                                                    id="categories-{{ $client->id }}">
                                                    <option value="" selected>Voir
                                                        la(les)
                                                        catégories</option>
                                                    @foreach ($client->allCategories as $categorie)
                                                        <option value="{{ $categorie->id }}">
                                                            {{ $categorie->nom_categorie }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="show-info-client show-product"
                                                style="margin-bottom: 40px; margin-top:10px">
                                                <label class="form-label label-detail-client">Sous-Catégorie</label>
                                                <select class="form-select form-select-sm info-client showProductClient"
                                                    aria-label=".form-select-sm example"
                                                    id="products-{{ $client->id }}"
                                                    style="width: 200px; height: 30px">
                                                    <option value="" selected>Voir les
                                                        produits associés</option>

                                                </select>
                                            </div>
                                            <div class="show-info-client show-user">
                                                <label class="label-detail-client">Contacté Par</label>
                                                <h6 class="info-client showUserClient"
                                                    id="showUserDetail-{{ $client->id }}">
                                                </h6>
                                            </div>
                                            <div class="show-info-client show-remark">
                                                <label class="label-detail-client">Remarque</label>
                                                <p class="info-client showRemarkClient"
                                                    id="showRemarkDetail-{{ $client->id }}" style="font-size: 12px">
                                                </p>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Fermer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
    </div>

    <!--//modifier-client-->
    @if (isset($client))
        <div class="modal fade" id="update_client" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('client.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="updateClientId">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modifier le client</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <label class="form-label"><strong class="det">Nom de la société</strong></label>
                                <input type="text" class="form-control" name="newNomSociete_client"
                                    placeholder="Entrer le nom de la société..." id="updateClientSociety"
                                    value="{{ old('newNomSociete_client', $client->nomSociete_client) }}" />
                                @if ($errors->has('newNomSociete_client'))
                                    <span class="text-danger">
                                        {{ $errors->first('newNomSociete_client') }}</span>
                                @endif

                            </div>
                            <div>
                                <label class="form-label"><strong class="det">GSM1 de la société</strong></label>
                                <input type="tel" class="form-control" name="newGSM1_client"
                                    placeholder="Entrer GSM1..." id="updateClientGSM1"
                                    value="{{ old('newGSM1_client', $client->GSM1_client) }}" />
                                @if ($errors->has('newGSM1_client'))
                                    <span class="text-danger">
                                        {{ $errors->first('newGSM1_client') }}</span>
                                @endif

                            </div>
                            <div>
                                <label class="form-label"><strong class="det">GSM2 de la société</strong></label>
                                <input type="tel" class="form-control" name="newGSM2_client"
                                    placeholder="Entrer GSM2..." id="updateClientGSM2"
                                    value="{{ old('newGSM2_client', $client->GSM2_client) }}" />
                                @if ($errors->has('newGSM2_client'))
                                    <span class="text-danger">
                                        {{ $errors->first('newGSM2_client') }}</span>
                                @endif

                            </div>
                            <div>
                                <label class="form-label"><strong class="det">Personne à contacter</strong></label>
                                <input id="updateClientName" type="text" class="form-control" name="newNom_client"
                                    placeholder="Entrer le client..."
                                    value="{{ old('newNom_client', $client->nom_client) }}" />
                                @if ($errors->has('newNom_client'))
                                    <span class="text-danger">
                                        {{ $errors->first('newNom_client') }}</span>
                                @endif

                            </div>
                            <div>
                                <label class="form-label"><strong class="det">Numéro De Téléphone</strong></label>
                                <input id="updateClientContact" type="tel" class="form-control"
                                    name="newTele_client" placeholder="Entrer le contact..."
                                    value="{{ old('newTele_client', $client->tele_client) }}" />
                                @if ($errors->has('newTele_client'))
                                    <span class="text-danger">
                                        {{ $errors->first('newTele_client') }}</span>
                                @endif

                            </div>
                            <div>
                                <label class="form-label"><strong class="det">Email</strong></label>
                                <input id="updateClientEmail" type="email" class="form-control" name="newEmail_client"
                                    placeholder="Entrer l'émail..."
                                    value="{{ old('newEmail_client', $client->email_client) }}" />
                                @if ($errors->has('newEmail_client'))
                                    <span class="text-danger">
                                        {{ $errors->first('newEmail_client') }}</span>
                                @endif

                            </div>

                            <div>
                                <label class="form-label"><strong class="det">Ville</strong></label>
                                <input id="updateClientVille" type="text" class="form-control" name="newVille_client"
                                    placeholder="Entrer la ville..."
                                    value="{{ old('newVille_client', $client->ville_client) }}" />
                                @if ($errors->has('newVille_client'))
                                    <span class="text-danger">
                                        {{ $errors->first('newVille_client') }}</span>
                                @endif

                            </div>

                            <div>
                                <label class="form-label"><strong class="det">Catégorie</strong></label>
                                <select id="updateClientCategory" class="form-select form-select-sm"
                                    aria-label=".form-select-sm example" name="newCategorie_id" style="height: 39px">
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}">

                                            {{ $cat->nom_categorie }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('newCategorie_id'))
                                    <span class="text-danger">
                                        {{ $errors->first('newCategorie_id') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary" data-bs-dismiss="modal" value="Modifier">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
    <div class="d-flex justify-content-between align-items-center">
        @if ($clients->total() >= 5)
            <form id="pagination-form" action="{{ route('clients.pagination') }}" method="GET"
                class="d-inline-flex">
                @csrf
                <select name="per_page" id="perPage" class="form-select form-select-sm"
                    onchange="document.getElementById('pagination-form').submit();">
                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                    <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                    <option value="30" {{ request('per_page') == 30 ? 'selected' : '' }}>30</option>
                    <option value="40" {{ request('per_page') == 40 ? 'selected' : '' }}>40</option>
                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                    <option value="60" {{ request('per_page') == 60 ? 'selected' : '' }}>60</option>
                </select>
            </form>
        @endif
        <div>
            {{ $clients->links('vendor.pagination.bootstrap-4') }}

        </div>
    </div>
@endsection
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const select = document.getElementById('pagination-select');
            const form = document.getElementById('pagination-form');
            const perPageInput = document.getElementById('per-page-input');

            select.addEventListener('change', function() {
                perPageInput.value = this.value;
                form.submit();
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const updateProspectModal = document.getElementById('update_client');
            updateProspectModal.addEventListener('show.bs.modal', event => {
                const button = event.relatedTarget;

                const clientId = button.getAttribute('data-id');
                const clientName = button.getAttribute('data-name');
                const clientEmail = button.getAttribute('data-email');
                const clientContact = button.getAttribute('data-tele');
                const clientVille = button.getAttribute('data-ville');
                const clientSociety = button.getAttribute('data-society');
                const clientGSM1 = button.getAttribute('data-GSM1');
                const clientGSM2 = button.getAttribute('data-GSM2');
                const clientCategory = button.getAttribute('data-category')

                document.getElementById('updateClientId').value = clientId;
                document.getElementById('updateClientName').value = clientName;
                document.getElementById('updateClientEmail').value = clientEmail;
                document.getElementById('updateClientContact').value = clientContact;
                document.getElementById('updateClientVille').value = clientVille;
                document.getElementById('updateClientSociety').value = clientSociety;
                document.getElementById('updateClientGSM1').value = clientGSM1;
                document.getElementById('updateClientGSM2').value = clientGSM2;
                document.getElementById('updateClientCategory').value = clientCategory;


            });
        });
    </script>
    <script>
        document.querySelectorAll(`.detailButton`).forEach(button => {

            button.addEventListener('click', function() {
                const clientId = this.getAttribute('data-bs-target').split('-').pop();
                const clientName = this.getAttribute('data-name') || 'Non disponible'
                const clientEmail = this.getAttribute('data-email') || 'Non disponible'
                const clientContact = this.getAttribute('data-tele') || 'Non disponible'
                const clientVille = this.getAttribute('data-ville')
                const clientSociety = this.getAttribute('data-society-name')
                const clientGSM1 = this.getAttribute('data-GSM1')
                const clientGSM2 = this.getAttribute('data-GSM2')
                const clientRemark = this.getAttribute('data-remark')
                const clientUser = this.getAttribute('data-user')

                document.querySelector(`#showNameDetail-${clientId}`).innerText = clientName
                document.querySelector(`#showGSM1Detail-${clientId}`).innerText = clientGSM1
                document.querySelector(`#showGSM2Detail-${clientId}`).innerText = clientGSM2
                document.querySelector(`#showEmailDetail-${clientId}`).innerText = clientEmail
                document.querySelector(`#showContactDetail-${clientId}`).innerText = clientContact
                document.querySelector(`#showVilleDetail-${clientId}`).innerText = clientVille
                document.querySelector(`#showSocietyDetail-${clientId}`).innerText = clientSociety
                document.querySelector(`#showRemarkDetail-${clientId}`).innerText = clientRemark
                document.querySelector(`#showUserDetail-${clientId}`).innerText = clientUser
            })
        });

        document.addEventListener('DOMContentLoaded', function() {
            const categories = @json($categories);

            document.querySelectorAll('.showCategoryClient').forEach(
                selectCategory => {
                    const clientId = selectCategory.id.split('-').pop();
                    const products = document.getElementById(`products-${clientId}`);

                    if (products) {
                        selectCategory.addEventListener('change', function() {
                            const selectedCategoryId = this.value;
                            products.innerHTML = '';
                            if (selectedCategoryId) {
                                const selectedCategory = categories.find(category => {
                                    return category.id == selectedCategoryId;
                                });

                                if (selectedCategory && selectedCategory.sous_categories.length > 0) {
                                    selectedCategory.sous_categories.forEach(sous_category => {
                                        const option = document.createElement('option');
                                        option.value = sous_category.id;
                                        option.textContent = sous_category.nom_produit;
                                        option.selected = true;
                                        option.disabled = true;

                                        products.appendChild(option);
                                    })
                                } else {
                                    const emptyOption = document.createElement('option');
                                    emptyOption.textContent = 'Aucun produit trouvé';
                                    emptyOption.disabled = true;
                                    products.appendChild(emptyOption);
                                }
                            }
                        })
                    }
                }
            )
        })
    </script>
    <script>
        function confirmDelete(clientId) {
            Swal.fire({
                title: 'Supprimer le client !',
                text: "êtes-vous sûr que vous voulez supprimer ce client ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                cancelButtonText: 'Annuler',
                confirmButtonText: 'Oui, Supprimer-le !'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + clientId).submit();
                }
            });
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selects = document.querySelectorAll('.status-select');
            selects.forEach(select => {
                select.addEventListener('change', function() {
                    const form = this.closest('.client-form');
                    if (form) {
                        form.submit();
                    }
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selects = document.querySelectorAll('.userSelect');
            selects.forEach(select => {
                select.addEventListener('change', function() {
                    const form = this.closest(
                        '.user-form');
                    if (form) {
                        form.submit();
                    }
                });
            });
        });
    </script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const searchInput = document.querySelector('input[name="search"]');

            searchInput.addEventListener('keydown', function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault();
                }
            });

            searchInput.addEventListener('input', function() {
                const searchQuery = searchInput.value;

                if (searchQuery.length > 0) {
                    fetch(`/search-clients?search=${searchQuery}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(`HTTP error! status: ${response.status}`);
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log(data);

                            const {
                                clients,
                                selectOptions
                            } = data;

                            const tbody = document.querySelector('tbody');
                            tbody.innerHTML = '';

                            clients.forEach(client => {


                                const categories = client.categories || [];

                                let categoriesList = 'Non catégorisé';

                                categories.forEach(category => {
                                    categoriesList =
                                        `${category.nom_categorie }`;
                                });



                                const row = document.createElement('tr');
                                const role = "{{ auth()->user()->role }}"
                                row.innerHTML =

                                    `
                          


                        ${role === "super-admin" ? `
                                                          <td>${client.nomSociete_client || 'Particulier'}</td>
                                                            <td>${client.GSM1_client || 'Non disponible'}</td>
                                                            <td>${client.GSM2_client || 'Non disponible'}</td>
                                                            <td>${client.nom_client || 'Non disponible'}</td>
                                                            <td>${client.tele_client || 'Non disponible'}</td>
                                                            <td>${client.email_client || 'Non disponible'}</td>
                                                            <td>${client.ville_client}</td>
                                                            <td>${categoriesList}</td>
                                                             <td>${client.utilisateur.name || 'Personne'}</td>
                                                        <td>
                                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                                data-bs-target="#update_client"
                                                                data-id="${client.id}"
                                                                data-name="${client.nom_client}"
                                                                data-email="${client.email_client}"
                                                                data-tele="${client.tele_client}"
                                                                data-ville="${client.ville_client}"
                                                                data-society="${client.nomSociete_client}"
                                                                data-GSM1=" ${client.GSM1_client }"
                                                                data-GSM2="${client.GSM2_client }"
                                                                data-category="${(client.categories && client.categories.length > 0) ? client.categories[0].id : ''}">Modifier
                                                            </button>
                                                        
                                                            <button type="button" class="btn btn-info detailButtonQuery"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#QueryClientsDetails"
                                                                data-name="${client.nom_client}"
                                                                data-email="${client.email_client}"
                                                                data-contact="${client.tele_client}"
                                                                data-ville="${client.ville_client}"
                                                                data-remark="${client.remark}"
                                                                data-user="${client.utilisateur.name}"
                                                                data-society-name="${client.nomSociete_client}"
                                                                data-GSM1="${client.GSM1_client}"
                                                                data-GSM2="${client.GSM2_client}"
                                                                data-categories="${encodeURIComponent(JSON.stringify(client.categories))}"
                                                            >
                                                            Détails
                                                            </button>
                                                       
                                                           
                                                                <form
                                                                    action="/client/destroy/${client.id}"
                                                                    method="POST" style="display: inline;"
                                                                    id="delete-form-${client.id }">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button" class="btn btn-outline-danger border-btn me-4"
                                                                        onclick="confirmDelete(${client.id })">Supprimer</button>
                                                                </form>
                                                            
                                                        
                                                                        <form class="client-form" action="/client/select/${client.id}" method="POST">
                                                                        @csrf
                                                                            <select class="form-select status-select" name="status">
                                                                                <option value="" selected>Selectionner la table</option>
                                                                                    ${selectOptions.map(option => `
                                                                    <option value="${option}">${option}</option>
                                                                    `).join('')}
                                                                            </select>
                                                                        </form>
                                                        </td>


                                                        `:''}
                        ${role === "admin" ? `
                                                       <td>${client.nomSociete_client || 'Particulier'}</td>
                                                            <td>${client.GSM1_client || 'Non disponible'}</td>
                                                            <td>${client.GSM2_client || 'Non disponible'}</td>
                                                            <td>${client.nom_client || 'Non disponible'}</td>
                                                            <td>${client.tele_client || 'Non disponible'}</td>
                                                            <td>${client.email_client || 'Non disponible'}</td>
                                                            <td>${client.ville_client}</td>
                                                            <td>${categoriesList}</td>
                                                             <td>${client.utilisateur.name || 'Personne'}</td>
                                                        <td>
                                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                                data-bs-target="#update_client"
                                                                data-id="${client.id}"
                                                                data-name="${client.nom_client}"
                                                                data-email="${client.email_client}"
                                                                data-tele="${client.tele_client}"
                                                                data-ville="${client.ville_client}"
                                                                data-society="${client.nomSociete_client}"
                                                                data-GSM1=" ${client.GSM1_client }"
                                                                data-GSM2="${client.GSM2_client }"
                                                                data-category="${(client.categories && client.categories.length > 0) ? client.categories[0].id : ''}">Modifier
                                                            </button>
                                                        
                                                            <button type="button" class="btn btn-info detailButtonQuery"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#QueryClientsDetails"
                                                                data-name="${client.nom_client}"
                                                                data-email="${client.email_client}"
                                                                data-contact="${client.tele_client}"
                                                                data-ville="${client.ville_client}"
                                                                data-remark="${client.remark}"
                                                                data-user="${client.utilisateur.name}"
                                                                data-society-name="${client.nomSociete_client}"
                                                                data-GSM1="${client.GSM1_client}"
                                                                data-GSM2="${client.GSM2_client}"
                                                                data-categories="${encodeURIComponent(JSON.stringify(client.categories))}"
                                                            >
                                                            Détails
                                                            </button>
                                                       
                                                                        <form class="client-form" action="/client/select/${client.id}" method="POST">
                                                                        @csrf
                                                                            <select class="form-select status-select" name="status">
                                                                                <option value="" selected>Selectionner la table</option>
                                                                                    ${selectOptions.map(option => `
                                                    <option value="${option}">${option}</option>
                                                    `).join('')}
                                                                            </select>
                                                                        </form>
                                                        </td>


                                                        `:''}${role === "utilisateur" ? `
                                                        <td>${client.nomSociete_client || 'Particulier'}</td>
                                                            <td>${client.GSM1_client || 'Non disponible'}</td>
                                                            <td>${client.GSM2_client || 'Non disponible'}</td>
                                                            <td>${client.nom_client || 'Non disponible'}</td>
                                                            <td>${client.tele_client || 'Non disponible'}</td>
                                                             <td>${client.email_client || 'Non disponible'}</td>
                                                            <td>${client.ville_client}</td>
                                                            <td>${categoriesList}</td>
                                                             <td>${client.utilisateur.name || 'Personne'}</td>

                                                          <td>
                                                            <button type="button" class="btn btn-info detailButtonQuery"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#QueryClientsDetails"
                                                                data-name="${client.nom_client}"
                                                                data-email="${client.email_client}"
                                                                data-contact="${client.tele_client}"
                                                                data-ville="${client.ville_client}"
                                                                data-remark="${client.remark}"
                                                                data-user="${client.utilisateur.name}"
                                                                data-society-name="${client.nomSociete_client}"
                                                                data-GSM1="${client.GSM1_client}"
                                                                data-GSM2="${client.GSM2_client}"
                                                                data-categories="${encodeURIComponent(JSON.stringify(client.categories))}"
                                                            >
                                                            Détails
                                                            </button>
                                                        </td>
                                                        
                                                        ` : ""}

                    `

                                tbody.appendChild(row);
                                // Gestion du changement de statut pour les clients
                                document.querySelectorAll('.status-select').forEach(
                                    selectElement => {
                                        selectElement.addEventListener('change',
                                            function() {
                                                const form = this.closest(
                                                    '.client-form');
                                                if (form) {
                                                    form
                                                        .submit(); // Soumet le formulaire associé
                                                }
                                            });
                                    });

                                // Gestion des détails des clients
                                document.querySelectorAll('.detailButtonQuery').forEach(
                                    button => {
                                        button.addEventListener('click', function() {
                                            // Récupération des données du client
                                            const clientName = this.getAttribute(
                                                'data-name'); || 'Non disponible'
                                            const clientEmail = this.getAttribute(
                                                    'data-email') ||
                                                'Non disponible';
                                            const clientContact = this.getAttribute(
                                                'data-contact'); ||
                                            'Non disponible';
                                            const clientSociety = this.getAttribute(
                                                'data-society') || 'Particulier';
                                            const clientGSM1 = this.getAttribute(
                                                'data-GSM1') || 'Non disponible';
                                            const clientGSM2 = this.getAttribute(
                                                'data-GSM2') || 'Non disponible';
                                            const clientVille = this.getAttribute(
                                                'data-ville');
                                            const clientRemark = this.getAttribute(
                                                'data-remark');
                                            const clientUser = this.getAttribute(
                                                'data-user') || 'Personne';

                                            // Mise à jour des éléments HTML
                                            const updateTextContent = (selector,
                                                text) => {
                                                const element = document
                                                    .querySelector(selector);
                                                if (element) {
                                                    element.innerText =
                                                        text; // Affiche 'N/A' si le texte est vide
                                                }
                                            };

                                            updateTextContent('#showNameClient',
                                                clientName);
                                            updateTextContent('#showEmailClient',
                                                clientEmail);
                                            updateTextContent('#showContactClient',
                                                clientContact);
                                            updateTextContent('#showSocietyClient',
                                                clientSociety);
                                            updateTextContent('#showGSM1Client',
                                                clientGSM1);
                                            updateTextContent('#showGSM2Client',
                                                clientGSM2);
                                            updateTextContent('#showVilleClient',
                                                clientVille);
                                            updateTextContent('#showRemarkClient',
                                                clientRemark);
                                            updateTextContent('#showUserClient',
                                                clientUser);

                                            // Gestion des catégories
                                            const categories = JSON.parse(
                                                decodeURIComponent(this
                                                    .getAttribute(
                                                        'data-categories')));
                                            console.log("Données des catégories :",
                                                categories);

                                            if (categories && Array.isArray(
                                                    categories)) {
                                                let categoriesHTML =
                                                    '<option value="" selected>Selectionner la catégorie</option>';
                                                categories.forEach(category => {
                                                    categoriesHTML +=
                                                        `<option value="${category.id}">${category.nom_categorie}</option>`;
                                                });

                                                const categoriesSelect = document
                                                    .querySelector(
                                                        '#categoriesQuery-1');
                                                if (categoriesSelect) {
                                                    categoriesSelect.innerHTML =
                                                        categoriesHTML;

                                                    // Écouteur pour le changement de catégorie
                                                    categoriesSelect
                                                        .addEventListener('change',
                                                            function() {
                                                                const
                                                                    selectedCategoryId =
                                                                    this.value;
                                                                const
                                                                    selectedCategory =
                                                                    categories.find(
                                                                        category =>
                                                                        category
                                                                        .id ==
                                                                        selectedCategoryId
                                                                    );

                                                                console.log(
                                                                    "Catégorie sélectionnée :",
                                                                    selectedCategory
                                                                );

                                                                let productsHTML =
                                                                    '<option value="" selected>Voir les produits</option>';
                                                                if (selectedCategory &&
                                                                    selectedCategory
                                                                    .sous_categories
                                                                ) {
                                                                    selectedCategory
                                                                        .sous_categories
                                                                        .forEach(
                                                                            product => {
                                                                                productsHTML
                                                                                    +=
                                                                                    `<option value="${product.id}" disabled>${product.nom_produit}</option>`;
                                                                            });
                                                                } else {
                                                                    console.log(
                                                                        "Aucune sous-catégorie trouvée pour cette catégorie."
                                                                    );
                                                                }

                                                                const
                                                                    productsSelect =
                                                                    document
                                                                    .querySelector(
                                                                        '#productsQuery-1'
                                                                    );
                                                                if (
                                                                    productsSelect
                                                                ) {
                                                                    productsSelect
                                                                        .innerHTML =
                                                                        productsHTML;
                                                                } else {
                                                                    console.log(
                                                                        "Le sélecteur de produits #productsQuery-1 n'existe pas."
                                                                    );
                                                                }
                                                            });
                                                } else {
                                                    console.log(
                                                        "Le sélecteur de catégories #categoriesQuery-1 n'existe pas."
                                                    );
                                                }
                                            } else {
                                                console.log(
                                                    "Les données des catégories ne sont pas valides ou sont vides."
                                                );
                                            }
                                        });
                                    });





                            });
                        })
                        .catch(error => {
                            console.error('Error fetching Clients:', error);
                        });
                } else {
                    location.reload();
                }
            });
        });
    </script>
@endsection
@section('content2')
    <div class="modal fade" id="QueryClientsDetails" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="show-info-client show-society">
                        <label class="label-detail-client">Nom de la société</label>
                        <h6 class="info-client" id="showSocietyClient">
                        </h6>
                    </div>
                    <div class="show-info-client show-society">
                        <label class="label-detail-client">GSM1 de la société</label>
                        <h6 class="info-client" id="showGSM1Client">
                        </h6>
                    </div>
                    <div class="show-info-client show-society">
                        <label class="label-detail-client">GSM2 de la société</label>
                        <h6 class="info-client" id="showGSM2Client">
                        </h6>
                    </div>
                    <div class="show-info-client show-name">
                        <label class="label-detail-client">Personne à contacter</label>
                        <h6 class="info-client" id="showNameClient"></h6>
                    </div>
                    <div class="show-info-client show-contact">
                        <label class="label-detail-client">Numero De Telephone</label>
                        <h6 class="info-client" id="showContactClient"></h6>
                    </div>
                    <div class="show-info-client show-email">
                        <label class="label-detail-client">Email</label>
                        <h6 class="info-client" id="showEmailClient">
                        </h6>
                    </div>



                    <div class="show-info-client show-ville">
                        <label class="label-detail-client">Ville</label>
                        <h6 class="info-client" id="showVilleClient">
                        </h6>
                    </div>
                    <div class="show-info-client show-category" style="margin-top:10px">
                        <label class="label-detail-client">Les catégories</label>
                        <select class="form-select form-select-sm info-client showCategoryClient"
                            aria-label=".form-select-sm example" style="width: 200px; height: 30px"
                            id="categoriesQuery-1">
                            <option value="" selected>Voir la(les) catégories</option>

                        </select>
                    </div>

                    <div class="show-info-client show-product" style="margin-bottom: 40px; margin-top:10px">
                        <label class="form-label label-detail-client">Sous-Catégorie</label>
                        <select class="form-select form-select-sm info-client showProductClient"
                            aria-label=".form-select-sm example" id="productsQuery-1" style="width: 200px; height: 30px">

                        </select>
                    </div>
                    <div class="show-info-client show-user">
                        <label class="label-detail-client">Contacté Par</label>
                        <h6 class="info-client" id="showUserClient">
                        </h6>
                    </div>
                    <div class="show-info-client show-remark">
                        <label class="label-detail-client">Remarque</label>
                        <p class="info-client" id="showRemarkClient" style="font-size: 12px">
                        </p>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content2')
    <div class="modal fade" id="QueryClientsDetails" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="show-info-client show-society">
                        <label class="label-detail-client">Nom de la société</label>
                        <h6 class="info-client" id="showSocietyClient">
                        </h6>
                    </div>
                    <div class="show-info-client show-society">
                        <label class="label-detail-client">GSM1 de la société</label>
                        <h6 class="info-client" id="showGSM1Client">
                        </h6>
                    </div>
                    <div class="show-info-client show-society">
                        <label class="label-detail-client">GSM2 de la société</label>
                        <h6 class="info-client" id="showGSM2Client">
                        </h6>
                    </div>
                    <div class="show-info-client show-name">
                        <label class="label-detail-client">Personne à contacter</label>
                        <h6 class="info-client" id="showNameClient"></h6>
                    </div>
                    <div class="show-info-client show-contact">
                        <label class="label-detail-client">Numero De Telephone</label>
                        <h6 class="info-client" id="showContactClient"></h6>
                    </div>
                    <div class="show-info-client show-email">
                        <label class="label-detail-client">Email</label>
                        <h6 class="info-client" id="showEmailClient">
                        </h6>
                    </div>


                    <div class="show-info-client show-ville">
                        <label class="label-detail-client">Ville</label>
                        <h6 class="info-client" id="showVilleClient">
                        </h6>
                    </div>
                    <div class="show-info-client show-category" style="margin-top:10px">
                        <label class="label-detail-client">Les catégories</label>
                        <select class="form-select form-select-sm info-client showCategoryClient"
                            aria-label=".form-select-sm example" style="width: 200px; height: 30px"
                            id="categoriesQuery-1">
                            <option value="" selected>Voir la(les) catégories</option>

                        </select>
                    </div>

                    <div class="show-info-client show-product" style="margin-bottom: 40px; margin-top:10px">
                        <label class="form-label label-detail-client">Sous-Catégorie</label>
                        <select class="form-select form-select-sm info-client showProductClient"
                            aria-label=".form-select-sm example" id="productsQuery-1" style="width: 200px; height: 30px">

                        </select>
                    </div>
                    <div class="show-info-client show-user">
                        <label class="label-detail-client">Contacté Par</label>
                        <h6 class="info-client" id="showUserClient">
                        </h6>
                    </div>
                    <div class="show-info-client show-remark">
                        <label class="label-detail-client">Remarque</label>
                        <p class="info-client" id="showRemarkClient" style="font-size: 12px">
                        </p>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
@endsection
