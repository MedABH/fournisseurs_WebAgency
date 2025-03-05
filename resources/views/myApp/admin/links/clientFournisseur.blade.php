@extends('myApp.admin.adminLayout.adminPage')
@section('search-bar')
    <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
            <h1 class="app-page-title mb-0">Les Clients et Fournisseurs</h1>
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
                            <a href="{{ route('clients.pdf') }}" class="btn btn-primary" style="margin-left:996px">
                                <i class="fas fa-file-pdf"></i>
                            </a>

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

@section('errorContent')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var modalType = document.getElementById('modals').getAttribute('data-error');

            if (modalType === 'default') {
                var addModal = new bootstrap.Modal(document.getElementById('add_fournisseurClient'));
                addModal.show();
            } else if (modalType === 'update') {
                var updateModal = new bootstrap.Modal(document.getElementById('update_fournisseurClient'));
                updateModal.show();
            }else if (modalType === 'remark') {
                var remark = new bootstrap.Modal(document.getElementById('remark'));
                remark.show();
            }
        });
    </script>
@endsection
@section('parties-prenantes')
<nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
    <a href="/prospectsSection" class="flex-sm-fill text-sm-center nav-link">Les Tiers</a>
    <a href="/clientsSection" class="flex-sm-fill text-sm-center nav-link">Les Clients</a>
    <a href="/suppliersSection" class="flex-sm-fill text-sm-center nav-link">Les Fournisseurs</a>
    <a href="/suppliersAndClientsSection" class="flex-sm-fill text-sm-center nav-link active">Fournisseurs et Clients</a>
</nav>
@endsection
@section('content')
    <div id="modals" style="display:none;" data-error="{{ session('modalType') }}"></div>
    <form action="{{ route('fournisseurClient.add') }}" method="POST">
        @csrf
        <div class="modal fade" id="add_fournisseurClient" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ajouter un client & fournisseur</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label class="form-label">Nom de la société</label>
                        <input type="text" class="form-control" name="nomSociete_fournisseurClient"
                            placeholder="Entrer le nom de la société..."
                            value="{{ old('nomSociete_fournisseurClient') }}" />
                        @error('nomSociete_fournisseurClient', 'default')
                            <span class="text-danger">{{ $message }}</span> <br>
                        @enderror
                        <label class="form-label">Personne à contacter</label>
                        <input type="text" class="form-control" name="nom_fournisseurClient"
                            placeholder="Entrer le fournisseurClient..." value="{{ old('nom_fournisseurClient') }}" />
                        @error('nom_fournisseurClient', 'default')
                            <span class="text-danger">{{ $message }}</span> <br>
                        @enderror
                        <label class="form-label">Numero de telephone</label>
                        <input type="text" class="form-control" name="tele_fournisseurClient"
                            placeholder="Entrer le contact..." value="{{ old('tele_fournisseurClient') }}" />
                        @error('tele_fournisseurClient', 'default')
                            <span class="text-danger">{{ $message }}</span> <br>
                        @enderror
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email_fournisseurClient"
                            placeholder="Entrer l'émail..." value="{{ old('email_fournisseurClient') }}" />
                        @error('email_fournisseurClient', 'default')
                            <span class="text-danger">{{ $message }}</span> <br>
                        @enderror
                     
                        <label class="form-label">Ville</label>
                        <input type="text" class="form-control" name="ville_fournisseurClient"
                            placeholder="Entrer la ville..." value="{{ old('ville_fournisseurClient') }}" />
                        @error('ville_fournisseurClient', 'default')
                            <span class="text-danger">{{ $message }}</span> <br>
                        @enderror
                        <label class="form-label">Catégorie</label>
                        <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="categorie_id"
                            style="height: 39px">
                            <option value="">Selectionner la catégorie</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('categorie_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->nom_categorie }}
                                </option>
                            @endforeach
                        </select>
                        @error('categorie_id', 'default')
                            <span class="text-danger">{{ $message }}</span> <br>
                        @enderror

                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Ajouter" data-bs-dismiss="modal">
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="page-inner">
        @if (auth()->user()->role == 'super-admin')
            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                data-bs-target="#add_fournisseurClient">
                Ajouter un client & fournisseur
            </button>
            <a href="{{ route('fournisseurClients.pdf') }}" class="btn btn-primary" style="margin-left:915px">
                <i class="fas fa-file-pdf"></i>
            </a>
        @elseif (auth()->user()->role == 'admin')
            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                data-bs-target="#add_fournisseurClient">
                Ajouter un client & fournisseur
            </button>
            <a href="{{ route('fournisseurClients.pdf') }}" class="btn btn-primary" style="margin-left:915px">
                <i class="fas fa-file-pdf"></i>
            </a>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Les clients & fournisseurs</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Nom de la société</th>
                                        <th>Personne à contacter</th>
                                        <th>Numero de telephone</th>
                                        <th>Email</th>
                                        <th>Ville</th>
                                        <th>Catégorie</th>
                                        <th>Contacté Par</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $utilisateurs = \App\Models\User::get();
                                @endphp
                                    @foreach ($fournisseurClients as $fc)
                                        <tr>
                                            <td>{{ !empty($fc->nomSociete_fournisseurClient) ? $fc->nomSociete_fournisseurClient : 'Particulier' }}
                                            </td>
                                            <td>{{  !empty($fc->nom_fournisseurClient) ? $fc->nom_fournisseurClient : 'Non disponible' }}</td>
                                            <td>{{ !empty($fc->tele_fournisseurClient) ? $fc->tele_fournisseurClient : 'Non disponible'}}</td>
                                            <td>{{ !empty($fc->email_fournisseurClient) ? $fc->email_fournisseurClient : 'Non disponible'}}</td>
                                            <td>{{ $fc->ville_fournisseurClient }}</td>
                                            <td>
                                                @forelse ($fc->categorieClientFournisseurs as $assoc)
                                                    @if ($assoc->categorie)
                                                        {{ $assoc->categorie->nom_categorie }}
                                                    @endif
                                                @empty
                                                    Non catégorisé
                                                @endforelse
                                            </td>
                                            <td>
                                                {{ !empty($fc->utilisateur->name) ? $fc->utilisateur->name : 'Personne' }}
                                            </td>


                                            @if (auth()->user()->role == 'super-admin')
                                                <td>
                                                    <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#update_fournisseurClient"
                                                        data-id="{{ $fc->id }}"
                                                        data-society="{{ $fc->nomSociete_fournisseurClient }}"
                                                        data-name="{{ $fc->nom_fournisseurClient }}"
                                                        data-tele="{{ $fc->tele_fournisseurClient }}"
                                                        data-email="{{ $fc->email_fournisseurClient }}"
                                                        data-ville="{{ $fc->ville_fournisseurClient }}"
                                                        data-category="{{ $fc->categories->first()?->id ?? '' }}">
                                                        Modifier
                                                    </a>

                                                </td>
                                                <td>
                                                    <form class="user-form"
                                                        action="{{ route('user.select.fc', $fc->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('POST')
                                                        <select class="form-select userSelect"
                                                            aria-label="Default select example"
                                                            data-fc-id="{{ $fc->id }}"
                                                            style="margin-right:100px" name="user_id">
                                                            <option value="">Contacté Par</option>
                                                            @foreach ($utilisateurs as $user)
                                                                <option value="{{ $user->id }}"
                                                                    {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                                    {{ $user->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </form>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#remark-{{ $fc->id }}">
                                                        Remarque
                                                    </button>
                                                    


                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-info detailButton"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#ModalFCDetails-{{ $fc->id }}"
                                                        data-name="{{ $fc->nom_fournisseurClient }}"
                                                        data-email="{{ $fc->email_fournisseurClient }}"
                                                        data-tele="{{ $fc->tele_fournisseurClient }}"
                                                        data-ville="{{ $fc->ville_fournisseurClient }}"
                                                        data-society-name="{{ !empty($fc->nomSociete_fournisseurClient) ? $fc->nomSociete_fournisseurClient : 'Particulier' }}"
                                                        data-remark="{{ $fc->remark }}"
                                                        data-user="{{ !empty($fc->utilisateur->name) ? $fc->utilisateur->name : 'Personne' }}"
                                                        >

                                                        Details
                                                    </button>
                                                </td>




                                                <td>
                                                    <a>
                                                        <form action="{{ route('fournisseurClient.destroy', $fc->id) }}"
                                                            method="POST" style="display: inline"
                                                            id="delete-form-{{ $fc->id }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-danger"
                                                                onclick="confirmDelete({{ $fc->id }})">
                                                                Supprimer
                                                            </button>
                                                        </form>
                                                    </a>
                                                </td>
                                                <td>
                                                    <form class="fc-form"
                                                        action="{{ route('fournisseurClient.select', $fc->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('POST')
                                                        <select name="status" id=""
                                                            class="form-select status-select">
                                                            <option value="" selected>Selectionner la table</option>
                                                            @foreach ($select as $item)
                                                                <option value="{{ $item }}">{{ $item }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </form>

                                                </td>
                                            @elseif (auth()->user()->role == 'admin')
                                                <td>
                                                    <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#update_fournisseurClient"
                                                        data-id="{{ $fc->id }}"
                                                        data-society="{{ $fc->nomSociete_fournisseurClient }}"
                                                        data-name="{{ $fc->nom_fournisseurClient }}"
                                                        data-tele="{{ $fc->tele_fournisseurClient }}"
                                                        data-email="{{ $fc->email_fournisseurClient }}"
                                                        data-ville="{{ $fc->ville_fournisseurClient }}"
                                                        data-category="{{ $fc->categories->first()?->id ?? '' }}">
                                                        Modifier
                                                    </a>

                                                </td>
                                                <td>
                                                    <form class="user-form"
                                                        action="{{ route('user.select.fc', $fc->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('POST')
                                                        <select class="form-select userSelect"
                                                            aria-label="Default select example"
                                                            data-fc-id="{{ $fc->id }}"
                                                            style="margin-right:100px" name="user_id">
                                                            <option value="">Contacté Par</option>
                                                            @foreach ($utilisateurs as $user)
                                                                <option value="{{ $user->id }}"
                                                                    {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                                    {{ $user->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </form>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#remark-{{ $fc->id }}">
                                                        Remarque
                                                    </button>
                                                    


                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-info detailButton"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#ModalFCDetails-{{ $fc->id }}"
                                                        data-name="{{ $fc->nom_fournisseurClient }}"
                                                        data-email="{{ $fc->email_fournisseurClient }}"
                                                        data-tele="{{ $fc->tele_fournisseurClient }}"
                                                        data-ville="{{ $fc->ville_fournisseurClient }}"
                                                        data-society-name="{{ !empty($fc->nomSociete_fournisseurClient) ? $fc->nomSociete_fournisseurClient : 'Particulier' }}"
                                                        data-remark="{{ $fc->remark }}"
                                                        data-user="{{ !empty($fc->utilisateur->name) ? $fc->utilisateur->name : 'Personne' }}"
                                                        >

                                                        Details
                                                    </button>
                                                </td>

                                                <td>
                                                    <form class="fc-form"
                                                        action="{{ route('fournisseurClient.select', $fc->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('POST')
                                                        <select name="status" id=""
                                                            class="form-select status-select">
                                                            <option value="" selected>Selectionner la table</option>
                                                            @foreach ($select as $item)
                                                                <option value="{{ $item }}">{{ $item }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </form>


                                                </td>
                                                @elseif (auth()->user()->role == 'utilisateur')
                                                <td>
                                                    <form class="user-form"
                                                        action="{{ route('user.select.fc', $fc->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('POST')
                                                        <select class="form-select userSelect"
                                                            aria-label="Default select example"
                                                            data-fc-id="{{ $fc->id }}"
                                                            style="margin-right:100px" name="user_id">
                                                            <option value="">Contacté Par</option>
                                                            @foreach ($utilisateurs as $user)
                                                                <option value="{{ $user->id }}"
                                                                    {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                                    {{ $user->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </form>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#remark-{{ $fc->id }}">
                                                        Remarque
                                                    </button>
                                                    


                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-info detailButton"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#ModalFCDetails-{{ $fc->id }}"
                                                        data-name="{{ $fc->nom_fournisseurClient }}"
                                                        data-email="{{ $fc->email_fournisseurClient }}"
                                                        data-tele="{{ $fc->tele_fournisseurClient }}"
                                                        data-ville="{{ $fc->ville_fournisseurClient }}"
                                                        data-society-name="{{ !empty($fc->nomSociete_fournisseurClient) ? $fc->nomSociete_fournisseurClient : 'Particulier' }}"
                                                        data-remark="{{ $fc->remark }}"
                                                        data-user="{{ !empty($fc->utilisateur->name) ? $fc->utilisateur->name : 'Personne' }}"
                                                        >

                                                        Details
                                                    </button>
                                                </td>

                                            @endif
                                            <form action="{{ route('remark.fc', $fc->id) }}"
                                                method="POST">
                                                @csrf
                                                <div class="modal fade" id="remark-{{ $fc->id }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">

                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <div class="form-group">
                                                                    <label for="remarque">Remarque</label>
                                                                    <textarea name="remark" id="remarque" class="form-control" rows="4">{{ old('remark', $fc->remark) }}</textarea>
                                                                    @error('remark')
                                                                        <div class="alert alert-danger">
                                                                            {{ $message }}</div>
                                                                    @enderror
                                                                </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit"
                                                                    class="btn btn-primary">Ajouter la
                                                                    remarque</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>


                                        </tr>
                                        <div class="modal fade" id="ModalFCDetails-{{ $fc->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="show-info-fournisseurClient show-society">
                                                            <label class="label-detail-fournisseurClient">Nom de la
                                                                société</label>
                                                            <h6 class="info-fournisseurClient showSocietyfc"
                                                                id="showSocietyDetail-{{ $fc->id }}">
                                                            </h6>
                                                        </div>
                                                     
                                                      
                                                        <div class="show-info-fournisseurClient show-name">
                                                            <label class="label-detail-fournisseurClient">Personne à
                                                                contacter</label>
                                                            <h6 class="info-fournisseurClient showNamefc"
                                                                id="showNameDetail-{{ $fc->id }}">
                                                            </h6>
                                                        </div>
                                                        <div class="show-info-fournisseurClient show-contact">
                                                            <label class="label-detail-fournisseurClient">Numero de telephone</label>
                                                            <h6 class="info-fournisseurClient showContactfc"
                                                                id="showContactDetail-{{ $fc->id }}">
                                                            </h6>
                                                        </div>
                                                        <div class="show-info-fournisseurClient show-email">
                                                            <label class="label-detail-fournisseurClient">Email</label>
                                                            <h6 class="info-fournisseurClient showEmailfc"
                                                                id="showEmailDetail-{{ $fc->id }}">
                                                            </h6>
                                                        </div>

                                                       
                                                        <div class="show-info-fournisseurClient show-ville">
                                                            <label class="label-detail-fournisseurClient">Ville</label>
                                                            <h6 class="info-fournisseurClient showVillefc"
                                                                id="showVilleDetail-{{ $fc->id }}">
                                                            </h6>
                                                        </div>

                                                        <div class="show-info-fournisseurClient show-category"
                                                            style="margin-top:10px">
                                                            <label class="label-detail-fournisseurClient">Les
                                                                catégories</label>
                                                            <select
                                                                class="form-select form-select-sm info-fournisseurClient showCategoryfc"
                                                                aria-label=".form-select-sm example"
                                                                style="width: 200px; height: 30px"
                                                                id="categories-{{ $fc->id }}">
                                                                <option value="" selected>Voir
                                                                    la(les)
                                                                    catégories</option>
                                                                @foreach ($fc->allCategories as $categorie)
                                                                    <option value="{{ $categorie->id }}">
                                                                        {{ $categorie->nom_categorie }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="show-info-fournisseurClient show-product"
                                                            style="margin-bottom: 40px; margin-top:10px">
                                                            <label
                                                                class="form-label label-detail-fournisseurClient">Sous-Catégorie</label>
                                                            <select
                                                                class="form-select form-select-sm info-fournisseurClient showProductfc"
                                                                aria-label=".form-select-sm example"
                                                                id="products-{{ $fc->id }}"
                                                                style="width: 200px; height: 30px">
                                                                <option value="" selected>Voir les
                                                                    produits associés</option>

                                                            </select>
                                                        </div>
                                                        <div class="show-info-fournisseurClient show-user">
                                                            <label class="label-detail-fournisseurClient">Contacté Par</label>
                                                            <h6 class="info-fournisseurClient showUserfc"
                                                                id="showUserDetail-{{ $fc->id }}">
                                                            </h6>
                                                        </div>

                                                        <div class="show-info-fournisseurClient show-remark">
                                                            <label class="label-detail-fournisseurClient">Remarque</label>
                                                            <p class="info-fournisseurClient showRemarkfc"
                                                                id="showRemarkDetail-{{ $fc->id }}" style="font-size: 12px">
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
        @if (isset($fc))
            <div class="modal fade" id="update_fournisseurClient" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('fournisseurClient.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" id="updateFCId">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modifier le client & fournisseur</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div>
                                    <label class="form-label">Nom de la
                                        société</label>
                                    <input type="text" class="form-control" name="newNomSociete_fournisseurClient"
                                        placeholder="Entrer le nom de la société..." id="updateFCSociety"
                                        value="{{ old('newNomSociete_fournisseurClient', $fc->nomSociete_fournisseurClient) }}" />
                                    @if ($errors->has('newNomSociete_fournisseurClient'))
                                        <span class="text-danger">
                                            {{ $errors->first('newNomSociete_fournisseurClient') }}</span>
                                    @endif

                                </div>
                              
                              
                                <div>
                                    <label class="form-label">Personne à contacter</label>
                                    <input id="updateFCName" type="text" class="form-control"
                                        name="newNom_fournisseurClient" placeholder="Entrer le client & fournisseur..."
                                        value="{{ old('newNom_fournisseurClient', $fc->nom_fournisseurClient) }}" />
                                    @if ($errors->has('newNom_fournisseurClient'))
                                        <span class="text-danger">
                                            {{ $errors->first('newNom_fournisseurClient') }}</span>
                                    @endif

                                </div>
                                <div>
                                    <label class="form-label">Numero de telephone</label>
                                    <input id="updateFCContact" type="text" class="form-control"
                                        name="newTele_fournisseurClient" placeholder="Entrer le contact..."
                                        value="{{ old('newTele_fournisseurClient', $fc->tele_fournisseurClient) }}" />
                                    @if ($errors->has('newTele_fournisseurClient'))
                                        <span class="text-danger">
                                            {{ $errors->first('newTele_fournisseurClient') }}</span>
                                    @endif

                                </div>
                                <div>
                                    <label class="form-label">Email</label>
                                    <input id="updateFCEmail" type="email" class="form-control"
                                        name="newEmail_fournisseurClient" placeholder="Entrer l'émail..."
                                        value="{{ old('newEmail_fournisseurClient', $fc->email_fournisseurClient) }}" />
                                    @if ($errors->has('newEmail_fournisseurClient'))
                                        <span class="text-danger">
                                            {{ $errors->first('newEmail_fournisseurClient') }}</span>
                                    @endif

                                </div>

                            
                                <div>
                                    <label class="form-label">Ville</label>
                                    <input id="updateFCVille" type="text" class="form-control"
                                        name="newVille_fournisseurClient" placeholder="Entrer la ville..."
                                        value="{{ old('newVille_fournisseurClient', $fc->ville_fournisseurClient) }}" />
                                    @if ($errors->has('newVille_fournisseurClient'))
                                        <span class="text-danger">
                                            {{ $errors->first('newVille_fournisseurClient') }}</span>
                                    @endif

                                </div>

                                <div>
                                    <label class="form-label">Catégorie</label>
                                    <select id="updateFCCategory" class="form-select form-select-sm"
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
                                <input type="submit" class="btn btn-primary" data-bs-dismiss="modal" value="Ajouter">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
        <div class="d-flex justify-content-between align-items-center">
            @if ($fournisseurClients->total() >= 10)
                <form id="pagination-form" action="{{ route('fournisseurClients.pagination') }}" method="GET"
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
                {{ $fournisseurClients->links('vendor.pagination.bootstrap-4') }}

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
                const updateFCModal = document.getElementById('update_fournisseurClient');
                updateFCModal.addEventListener('show.bs.modal', event => {
                    const button = event.relatedTarget;

                    const fcId = button.getAttribute('data-id');
                    const fcName = button.getAttribute('data-name');
                    const fcEmail = button.getAttribute('data-email');
                    const fcContact = button.getAttribute('data-tele');
                    const fcAdress = button.getAttribute('data-adress');
                    const fcVille = button.getAttribute('data-ville');
                    const fcSociety = button.getAttribute('data-society');
                    const fcGSM1 = button.getAttribute('data-GSM1');
                    const fcGSM2 = button.getAttribute('data-GSM2');
                    const fcCategory = button.getAttribute('data-category')

                    document.getElementById('updateFCId').value = fcId;
                    document.getElementById('updateFCName').value = fcName;
                    document.getElementById('updateFCEmail').value = fcEmail;
                    document.getElementById('updateFCContact').value = fcContact;
                    document.getElementById('updateFCAdress').value = fcAdress;
                    document.getElementById('updateFCVille').value = fcVille;
                    document.getElementById('updateFCSociety').value = fcSociety;
                    document.getElementById('updateFCGSM1').value = fcGSM1;
                    document.getElementById('updateFCGSM2').value = fcGSM2;
                    document.getElementById('updateFCCategory').value = fcCategory;

                });
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const selects = document.querySelectorAll('.status-select');
                selects.forEach(select => {
                    select.addEventListener('change', function() {
                        const form = this.closest('.fc-form');
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
            function confirmDelete(clientFournisseurId) {
                Swal.fire({
                    title: 'Supprimer le client&fournisseur !',
                    text: "êtes-vous sûr que vous voulez supprimer ce client&fournisseur ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    cancelButtonText: 'Annuler',
                    confirmButtonText: 'Oui, Supprimer-le !'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + clientFournisseurId).submit();
                    }
                });
            }
        </script>
        <script>
            document.querySelectorAll(`.detailButton`).forEach(button => {

                button.addEventListener('click', function() {
                    const fcId = this.getAttribute('data-bs-target').split('-').pop();
                    const fcName = this.getAttribute('data-name')|| 'Non disponible'
                    const fcEmail = this.getAttribute('data-email') || 'Non disponible'
                    const fcContact = this.getAttribute('data-tele')|| 'Non disponible'
                    const fcAdress = this.getAttribute('data-adress') || 'Non disponible'
                    const fcVille = this.getAttribute('data-ville')
                    const fcSociety = this.getAttribute('data-society-name')
                    const fcGSM1 = this.getAttribute('data-GSM1')
                    const fcGSM2 = this.getAttribute('data-GSM2')
                    const fcRemark = this.getAttribute('data-remark')
                    const fcUser = this.getAttribute('data-user')

                    document.querySelector(`#showNameDetail-${fcId}`).innerText = fcName
                    document.querySelector(`#showEmailDetail-${fcId}`).innerText = fcEmail
                    document.querySelector(`#showContactDetail-${fcId}`).innerText = fcContact
                    document.querySelector(`#showVilleDetail-${fcId}`).innerText = fcVille
                    document.querySelector(`#showSocietyDetail-${fcId}`).innerText = fcSociety
                    document.querySelector(`#showRemarkDetail-${fcId}`).innerText = fcRemark
                    document.querySelector(`#showUserDetail-${fcId}`).innerText = fcUser
                })
            });

            document.addEventListener('DOMContentLoaded', function() {
                const categories = @json($categories);

                document.querySelectorAll('.showCategoryfc').forEach(selectCategory => {
                    const fcId = selectCategory.id.split('-').pop();
                    const products = document.getElementById(`products-${fcId}`);

                    if (products) {
                        selectCategory.addEventListener('change', function() {
                            const selectedCategoryId = this.value;
                            products.innerHTML = '';

                            if (selectedCategoryId) {
                                const selectedCategory = categories.find(category => {
                                    return category.id == selectedCategoryId
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
                })
            })
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
                        fetch(`/search-fournisseurClients?search=${searchQuery}`)
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error(`HTTP error! status: ${response.status}`);
                                }
                                return response.json();
                            })
                            .then(data => {
                                console.log(data);
                                const {
                                    fcs,
                                    selectOptions
                                } = data;

                                const tbody = document.querySelector('tbody');
                                tbody.innerHTML = '';

                                fcs.forEach(fc => {


                                    const categories = fc.categories || [];

                                    let categoriesList = 'Non catégorisé';

                                    categories.forEach(category => {
                                        categoriesList =
                                            `${category.nom_categorie }<br>`;
                                    });



                                    const row = document.createElement('tr');
                                    const role = "{{ auth()->user()->role }}"
                                    row.innerHTML =
                                        `
                                   

                                ${role === "super-admin" ? `
                                        <td>${fc.nomSociete_fournisseurClient || 'Particulier'}</td>
                                            <td>${fc.nom_fournisseurClient || 'Non disponible'}</td>
                                            <td>${fc.tele_fournisseurClient || 'Non disponible'}</td>
                                            <td>${fc.email_fournisseurClient || 'Non disponible'}</td>
                                            <td>${fc.ville_fournisseurClient}</td>
                                            <td>${categoriesList}</td>
                                             <td>${fc.utilisateur.name || 'Personne'}</td>
                                        <td>
                                            <a class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#update_fournisseurClient"
                                                data-id="${fc.id}"
                                                data-name="${fc.nom_fournisseurClient}"
                                                data-email="${fc.email_fournisseurClient}"
                                                data-tele="${fc.tele_fournisseurClient}"
                                                data-ville="${fc.ville_fournisseurClient}"
                                                data-society="${fc.nomSociete_fournisseurClient}"
                                                data-category="${(fc.categories && fc.categories.length > 0) ? fc.categories[0].id : ''}">Modifier
                                            </a>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-info detailButtonQuery"
                                                data-bs-toggle="modal"
                                                data-bs-target="#QueryFournisseurClientsDetails"
                                                data-name="${fc.nom_fournisseurClient}"
                                                data-email="${fc.email_fournisseurClient}"
                                                data-contact="${fc.tele_fournisseurClient}"
                                                data-ville="${fc.ville_fournisseurClient}"
                                                data-remark="${fc.remark}"
                                                data-user="${fc.utilisateur.name}"
                                                data-society-name="${fc.nomSociete_fournisseurClient}"
                                                data-categories="${encodeURIComponent(JSON.stringify(fc.categories))}"
                                            >
                                            Détails
                                            </button>
                                        </td>
                                        <td>
                                            <a>
                                                <form
                                                    action="/fournisseurClient/destroy/${fc.id}"
                                                    method="POST" style="display: inline;"
                                                    id="delete-form-${fc.id }">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger"
                                                        onclick="confirmDelete(${fc.id })">Supprimer</button>
                                                </form>
                                            </a>
                                        </td>
                                        <td>
                                            <form class="fc-form" action="/fournisseurClient/select/${fc.id}" method="POST">
                                            @csrf
                                                <select class="form-select status-select" name="status">
                                                    <option value="" selected>Selectionner la table</option>
                                                            ${selectOptions.map(option => `
                                                <option value="${option}">${option}</option>
                                                `).join('')}
                                                </select>
                                            </form>
                                        </td>

                                        ` : ''}

                                ${role === "admin" ? `
                                        <td>${fc.nomSociete_fournisseurClient || 'Particulier'}</td>
                                              <td>${fc.nom_fournisseurClient || 'Non disponible'}</td>
                                            <td>${fc.tele_fournisseurClient || 'Non disponible'}</td>
                                              <td>${fc.email_fournisseurClient || 'Non disponible'}</td>
                                            <td>${fc.ville_fournisseurClient}</td>
                                            <td>${categoriesList}</td>
                                             <td>${fc.utilisateur.name || 'Personne'}</td>
                                        <td>
                                            <a class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#update_fournisseurClient"
                                                data-id="${fc.id}"
                                                data-name="${fc.nom_fournisseurClient}"
                                                data-email="${fc.email_fournisseurClient}"
                                                data-tele="${fc.tele_fournisseurClient}"
                                                data-ville="${fc.ville_fournisseurClient}"
                                                data-society="${fc.nomSociete_fournisseurClient}"
                                                data-category="${(fc.categories && fc.categories.length > 0) ? fc.categories[0].id : ''}">Modifier
                                            </a>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-info detailButtonQuery"
                                                data-bs-toggle="modal"
                                                data-bs-target="#QueryFournisseurClientsDetails"
                                                data-name="${fc.nom_fournisseurClient}"
                                                data-email="${fc.email_fournisseurClient}"
                                                data-contact="${fc.tele_fournisseurClient}"
                                                data-ville="${fc.ville_fournisseurClient}"
                                                data-remark="${fc.remark}"
                                                data-user="${fc.utilisateur.name}"
                                                data-society-name="${fc.nomSociete_fournisseurClient}"
                                                data-categories="${encodeURIComponent(JSON.stringify(fc.categories))}"
                                            >
                                            Détails
                                            </button>
                                        </td>

                                        <td>
                                            <form class="fc-form" action="/fournisseurClient/select/${fc.id}" method="POST">
                                            @csrf
                                                <select class="form-select status-select" name="status">
                                                    <option value="" selected>Selectionner la table</option>
                                                            ${selectOptions.map(option => `
                                                <option value="${option}">${option}</option>
                                                `).join('')}
                                                </select>
                                            </form>
                                        </td>



                                        `:''} ${role === "utilisateur" ? `
                                         <td>${fc.nomSociete_fournisseurClient || 'Particulier'}</td>
                                                <td>${fc.nom_fournisseurClient || 'Non disponible'}</td>
                                            <td>${fc.tele_fournisseurClient || 'Non disponible'}</td>
                                            <td>${fc.email_fournisseurClient || 'Non disponible'}</td>
                                            <td>${fc.ville_fournisseurClient}</td>
                                            <td>${categoriesList}</td>
                                             <td>${fc.utilisateur.name || 'Personne'}</td>

                                         <td>
                                            <button type="button" class="btn btn-info detailButtonQuery"
                                                data-bs-toggle="modal"
                                                data-bs-target="#QueryFournisseurClientsDetails"
                                                data-name="${fc.nom_fournisseurClient}"
                                                data-email="${fc.email_fournisseurClient}"
                                                data-contact="${fc.tele_fournisseurClient}"
                                                data-ville="${fc.ville_fournisseurClient}"
                                                data-remark="${fc.remark}"
                                                data-user="${fc.utilisateur.name}"
                                                data-society-name="${fc.nomSociete_fournisseurClient}"
                                                data-categories="${encodeURIComponent(JSON.stringify(fc.categories))}"
                                            >
                                            Détails
                                            </button>
                                        </td>
                                        
                                        ` : ""}

                            `

                                    tbody.appendChild(row);
                                    document.querySelectorAll('.status-select').forEach(selectElement => {
    selectElement.addEventListener('change', function() {
        const form = this.closest('.fc-form');
        if (form) {
            form.submit();
        }
    });
});

// Gestion des détails des éléments
document.querySelectorAll('.detailButtonQuery').forEach(button => {
    button.addEventListener('click', function() {
        // Récupération des données
        const fcName = this.getAttribute('data-name');|| 'Non disponible'
        const fcEmail = this.getAttribute('data-email') || 'Non disponible';
        const fcContact = this.getAttribute('data-contact');|| 'Non disponible'
        const fcAdress = this.getAttribute('data-adress') || 'Non disponible';
        const fcSociety = this.getAttribute('data-society') || 'Particulier'; // Par défaut "Particulier"
        const fcGSM1 = this.getAttribute('data-GSM1') || 'Non disponible'; // Par défaut "Non"
        const fcGSM2 = this.getAttribute('data-GSM2') || 'Non disponible'; // Par défaut "Non"
        const fcVille = this.getAttribute('data-ville');
        const fcRemark = this.getAttribute('data-remark');
        const fcUser = this.getAttribute('data-user');

        // Mise à jour des éléments HTML
        const updateTextContent = (selector, text) => {
            const element = document.querySelector(selector);
            if (element) {
                element.innerText = text ;
            }
        };

        updateTextContent('#showNamefc', fcName);
        updateTextContent('#showEmailfc', fcEmail);
        updateTextContent('#showContactfc', fcContact);
        updateTextContent('#showAdressfc', fcAdress);
        updateTextContent('#showSocietyfc', fcSociety);
        updateTextContent('#showGSM1fc', fcGSM1);
        updateTextContent('#showGSM2fc', fcGSM2);
        updateTextContent('#showVillefc', fcVille);
        updateTextContent('#showRemarkfc', fcRemark);
        updateTextContent('#showUserfc', fcUser);

        // Gestion des catégories
        const categories = JSON.parse(decodeURIComponent(this.getAttribute('data-categories')));
        console.log("Données des catégories :", categories);

        if (categories && Array.isArray(categories)) {
            let categoriesHTML = '<option value="" selected>Selectionner la catégorie</option>';
            categories.forEach(category => {
                categoriesHTML += `<option value="${category.id}">${category.nom_categorie}</option>`;
            });

            const categoriesSelect = document.querySelector('#categoriesQuery-1');
            if (categoriesSelect) {
                categoriesSelect.innerHTML = categoriesHTML;

                // Écouteur pour le changement de catégorie
                categoriesSelect.addEventListener('change', function() {
                    const selectedCategoryId = this.value;
                    const selectedCategory = categories.find(category => category.id == selectedCategoryId);

                    console.log("Catégorie sélectionnée :", selectedCategory);

                    let productsHTML = '<option value="" selected>Voir les produits</option>';
                    if (selectedCategory && selectedCategory.sous_categories) {
                        selectedCategory.sous_categories.forEach(product => {
                            productsHTML += `<option value="${product.id}" disabled>${product.nom_produit}</option>`;
                        });
                    } else {
                        console.log("Aucune sous-catégorie trouvée pour cette catégorie.");
                    }

                    const productsSelect = document.querySelector('#productsQuery-1');
                    if (productsSelect) {
                        productsSelect.innerHTML = productsHTML;
                    } else {
                        console.log("Le sélecteur de produits #productsQuery-1 n'existe pas.");
                    }
                });
            } else {
                console.log("Le sélecteur de catégories #categoriesQuery-1 n'existe pas.");
            }
        } else {
            console.log("Les données des catégories ne sont pas valides ou sont vides.");
        }
    });
});

                                });
                            })
                            .catch(error => {
                                console.error('Error fetching prospects:', error);
                            });
                    } else {
                        location.reload();
                    }
                });
            });
        </script>
    @endsection
    @section('content2')
        <div class="modal fade" id="QueryFournisseurClientsDetails" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="show-info-fournisseurClient show-society">
                            <label class="label-detail-fournisseurClient">Nom de la société</label>
                            <h6 class="info-fournisseurClient" id="showSocietyfc">
                            </h6>
                        </div>
                      
                       
                        <div class="show-info-fournisseurClient show-name">
                            <label class="label-detail-fournisseurClient">Personne à contacter</label>
                            <h6 class="info-fournisseurClient" id="showNamefc"></h6>
                        </div>
                        <div class="show-info-fournisseurClient show-contact">
                            <label class="label-detail-fournisseurClient">Numero de telephone</label>
                            <h6 class="info-fournisseurClient" id="showContactfc"></h6>
                        </div>
                        <div class="show-info-fournisseurClient show-email">
                            <label class="label-detail-fournisseurClient">Email</label>
                            <h6 class="info-fournisseurClient" id="showEmailfc">
                            </h6>
                        </div>

                       

                        <div class="show-info-fournisseurClient show-ville">
                            <label class="label-detail-fournisseurClient">Ville</label>
                            <h6 class="info-fournisseurClient" id="showVillefc">
                            </h6>
                        </div>
                        <div class="show-info-fournisseurClient show-category" style="margin-top:10px">
                            <label class="label-detail-fournisseurClient">Les catégories</label>
                            <select class="form-select form-select-sm info-fournisseurClient showCategoryfc"
                                aria-label=".form-select-sm example" style="width: 200px; height: 30px"
                                id="categoriesQuery-1">
                                <option value="" selected>Voir la(les) catégories</option>

                            </select>
                        </div>

                        <div class="show-info-fournisseurClient show-product"
                            style="margin-bottom: 40px; margin-top:10px">
                            <label class="form-label label-detail-fournisseurClient">Sous-Catégorie</label>
                            <select class="form-select form-select-sm info-fournisseurClient showProductfc"
                                aria-label=".form-select-sm example" id="productsQuery-1"
                                style="width: 200px; height: 30px">

                            </select>
                        </div>
                        <div class="show-info-fournisseurClient show-user">
                            <label class="label-detail-fournisseurClient">Contacté Par</label>
                            <h6 class="info-fournisseurClient" id="showUserfc">
                            </h6>
                        </div>
                        
                        <div class="show-info-fournisseurClient show-remark">
                            <label class="label-detail-fournisseurClient">Remarque</label>
                            <p class="info-fournisseurClient" id="showRemarkfc" style="font-size: 12px">
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
