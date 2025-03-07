@extends('myApp.admin.adminLayout.adminPage')
@section('search-bar')
    <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
            <h1 class="app-page-title mb-0">Les Fournisseurs</h1>
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
                            <a class="btn app-btn-secondary" href="{{ route('prospects.pdf') }}">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download me-1"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                    <path fill-rule="evenodd"
                                        d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                                </svg>

                            </a>
                        @elseif (auth()->user()->role == 'admin')
                            <a href="{{ route('prospects.pdf') }}" class="btn btn-primary" style="margin-left:996px">
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

            if (modalType === 'update') {
                var updateModal = new bootstrap.Modal(document.getElementById('updateSupplierModal'));
                updateModal.show();
            } else if (modalType === 'default') {
                var addModal = new bootstrap.Modal(document.getElementById('ModalAddSupplier'));
                addModal.show();
            } else if (modalType === 'remark') {
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
        <a href="/suppliersSection" class="flex-sm-fill text-sm-center nav-link active">Les Fournisseurs</a>
        <a href="/suppliersAndClientsSection" class="flex-sm-fill text-sm-center nav-link">Fournisseurs et Clients</a>
    </nav>
@endsection
@section('content')
<div id="modals" style="display:none;" data-error="{{ session('modalType') }}"></div>


<form action="/addSupplier" method="POST">
    @csrf
    <div class="modal fade" id="ModalAddSupplier" tabindex="-1" aria-labelledby="ModalAddSupplierLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter un fournisseur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label class="form-label"><strong class="det">Nom de la société</strong></label>
                    <input type="text" class="form-control" name="nomSociete_fournisseur"
                        placeholder="Entrer le nom de la société..." value="{{ old('nomSociete_fournisseur') }}" />
                    @error('nomSociete_fournisseur', 'default')
                    <span class="text-danger">{{ $message }}</span> 
                    @enderror
                    <label class="form-label"><strong class="det">GSM1 de la société</strong></label>
                    <input type="text" class="form-control" name="GSM1_fournisseur" placeholder="Entrer le GSM1..."
                        value="{{ old('GSM1_fournisseur') }}" />
                    @error('GSM1_fournisseur', 'default')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <label class="form-label"><strong class="det">GSM2 de la société</strong></label>
                    <input type="text" class="form-control" name="GSM2_fournisseur" placeholder="Entrer le GSM2..."
                        value="{{ old('GSM2_fournisseur') }}" />
                    @error('GSM2_fournisseur', 'default')
                    <span class="text-danger">{{ $message }}</span> 
                    @enderror

                    <label class="form-label"><strong class="det">Personne à contacter</strong></label>
                    <input type="text" class="form-control" name="nom_fournisseur" placeholder="Entrer le fournisseur..."
                        value="{{ old('nom_fournisseur') }}" />
                    @error('nom_fournisseur', 'default')
                    <span class="text-danger">{{ $message }}</span> 
                    @enderror
                    <label class="form-label"><strong class="det">Numero De Telephone</strong></label>
                    <input type="text" class="form-control" name="tele_fournisseur" placeholder="Entrer le contact..."
                        value="{{ old('tele_fournisseur') }}" />
                    @error('tele_fournisseur', 'default')
                    <span class="text-danger">{{ $message }}</span> 
                    @enderror
                    <label class="form-label"><strong class="det">Email</strong></label>
                    <input type="email" class="form-control" name="email_fournisseur" placeholder="Entrer l'émail..."
                        value="{{ old('email_fournisseur') }}" />
                    @error('email_fournisseur', 'default')
                    <span class="text-danger">{{ $message }}</span> 
                    @enderror
                    <label class="form-label"><strong class="det">Ville</strong></label>
                    <input type="text" class="form-control" name="ville_fournisseur" placeholder="Entrer la ville..."
                        value="{{ old('ville_fournisseur') }}" />
                    @error('ville_fournisseur', 'default')
                    <span class="text-danger">{{ $message }}</span> 
                    @enderror
                    <label class="form-label"><strong class="det">Catégorie</strong></label>
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
                    <span class="text-danger">{{ $message }}</span> 
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
                            <th class="cell">Numero De Telephone</th>
                            <th class="cell">Email</th>
                            <th class="cell">Ville</th>
                            <th class="cell">Catégorie</th>
                            <th class="cell">Contacté Par</th>
                            <th class="cell text-end">
                                @if (auth()->user()->role == 'super-admin')
                                <button type="button" class="btn app-btn-secondary" data-bs-toggle="modal"
                                    data-bs-target="#ModalAddSupplier">
                                    Ajouter
                                </button>
                                @elseif (auth()->user()->role == 'admin')
                                <button type="button" class="btn app-btn-secondary" data-bs-toggle="modal"
                                    data-bs-target="#ModalAddSupplier">
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
                        @foreach ($fournisseurs as $fournisseur)
                        <tr>
                            <td class="cell">{{ !empty($fournisseur->nomSociete_fournisseur) ? $fournisseur->nomSociete_fournisseur : 'Particulier' }}
                            </td>
                            <td class="cell">{{ !empty($fournisseur->GSM1_fournisseur) ? $fournisseur->GSM1_fournisseur : 'Non disponible' }}
                            </td>
                            <td class="cell">{{ !empty($fournisseur->GSM2_fournisseur) ? $fournisseur->GSM2_fournisseur : 'Non disponible' }}
                            </td>
                            <td class="cell">{{ !empty($fournisseur->nom_fournisseur) ? $fournisseur->nom_fournisseur : 'Non disponible' }}</td>
                            <td class="cell">{{!empty($fournisseur->tele_fournisseur) ? $fournisseur->tele_fournisseur : 'Non disponible' }}</td>
                            <td class="cell">{{ !empty($fournisseur->email_fournisseur) ? $fournisseur->email_fournisseur : 'Non disponible' }}</td>
                            <td class="cell">{{ $fournisseur->ville_fournisseur }}</td>

                            <td class="cell">
                                @forelse ($fournisseur->categorieFournisseur as $assoc)
                                @if ($assoc->categorie)
                                {{ $assoc->categorie->nom_categorie }}
                                @endif
                                @empty
                                Non catégorisé
                                @endforelse
                            </td>

                            <td class="cell">
                                {{ !empty($fournisseur->utilisateur->name) ? $fournisseur->utilisateur->name : 'Personne' }}
                            </td>

                            @if (auth()->user()->role == 'super-admin')
                        
                            <td class="button-container">
                                <div class="d-flex align-items-center gap-2"
                                    style="display: inline; border-radius: 1cap; border-style: inherit; color: transparent;">
                                    <button type="button" class="btn btn-outline-primary border-btn me-4" data-bs-toggle="modal"
                                        data-bs-target="#updateSupplierModal"
                                        data-id="{{ $fournisseur->id }}"
                                        data-name="{{ $fournisseur->nom_fournisseur }}"
                                        data-email="{{ $fournisseur->email_fournisseur }}"
                                        data-tele="{{ $fournisseur->tele_fournisseur }}"
                                        data-ville="{{ $fournisseur->ville_fournisseur }}"
                                        data-society="{{ $fournisseur->nomSociete_fournisseur }}"
                                        data-GSM1="{{ $fournisseur->GSM1_fournisseur }}"
                                        data-GSM2="{{ $fournisseur->GSM2_fournisseur }}"
                                        data-category="{{ $fournisseur->categories->first()?->id ?? '' }}">
                                        Modifier
                                    </button>


                                    <button type="button" class="btn btn-outline-success border-btn me-4" data-bs-toggle="modal" data-bs-target="#remark-{{ $fournisseur->id }}">
                                        Remarque
                                    </button>


                                    <button type="button" class="btn btn-outline-info detailButton border-btn me-4"
                                        data-bs-toggle="modal"
                                        data-bs-target="#ModalSupplierDetails-{{ $fournisseur->id }}"
                                        data-name="{{ $fournisseur->nom_fournisseur }}"
                                        data-email="{{ $fournisseur->email_fournisseur }}"
                                        data-tele="{{ $fournisseur->tele_fournisseur }}"
                                        data-ville="{{ $fournisseur->ville_fournisseur }}"
                                        data-society-name="{{ !empty($fournisseur->nomSociete_fournisseur) ? $fournisseur->nomSociete_fournisseur : 'Particulier' }}"
                                        data-GSM1="{{ !empty($fournisseur->GSM1_fournisseur) ? $fournisseur->GSM1_fournisseur : 'Non disponible' }}"
                                        data-GSM2="{{ !empty($fournisseur->GSM2_fournisseur) ? $fournisseur->GSM2_fournisseur : 'Non disponible' }}"
                                        data-remark="{{ $fournisseur->remark }}"
                                        data-user="{{ !empty($fournisseur->utilisateur->name) ? $fournisseur->utilisateur->name : 'Personne' }}">

                                        Details
                                    </button>

                                  
                                        <form action="{{ route('supplier.destroy', $fournisseur->id) }}"
                                            method="post" id="delete-form-{{ $fournisseur->id }}"
                                            style="display: inline; border-radius: 1cap; border-style: inherit; color: transparent;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-outline-danger border-btn me-4"
                                                onclick="confirmDelete({{ $fournisseur->id }})">Supprimer</button>
                                        </form>
                                    

                                    <form class="user-form"
                                        action="{{ route('user.select', $fournisseur->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('POST')
                                        <select class="form-select userSelect"
                                            aria-label="Default select example"
                                            data-fournisseur-id="{{ $fournisseur->id }}"
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

                                    <form class="supplier-form"
                                        action="{{ route('supplier.select', $fournisseur->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('POST')
                                        <select class="form-select status-select"
                                            aria-label="Default select example" name="status"
                                            id="">
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
                            
                            <td class="button-container">
                                <div class="d-flex align-items-center gap-2"
                                    style="display: inline; border-radius: 1cap; border-style: inherit; color: transparent;">
                                    <button type="button" class="btn btn-outline-primary border-btn me-4" data-bs-toggle="modal"
                                        data-bs-target="#updateSupplierModal"
                                        data-id="{{ $fournisseur->id }}"
                                        data-name="{{ $fournisseur->nom_fournisseur }}"
                                        data-email="{{ $fournisseur->email_fournisseur }}"
                                        data-tele="{{ $fournisseur->tele_fournisseur }}"
                                        data-ville="{{ $fournisseur->ville_fournisseur }}"
                                        data-society="{{ $fournisseur->nomSociete_fournisseur }}"
                                        data-GSM1="{{ $fournisseur->GSM1_fournisseur }}"
                                        data-GSM2="{{ $fournisseur->GSM2_fournisseur }}"
                                        data-category="{{ $fournisseur->categories->first()?->id ?? '' }}">
                                        Modifier
                                    </button>



                                    <button type="button" class="btn btn-outline-success border-btn me-4" data-bs-toggle="modal" data-bs-target="#remark-{{ $fournisseur->id }}">
                                        Remarque
                                    </button>


                                    <button type="button" class="btn btn-outline-info detailButton border-btn me-4"
                                        data-bs-toggle="modal"
                                        data-bs-target="#ModalSupplierDetails-{{ $fournisseur->id }}"
                                        data-name="{{ $fournisseur->nom_fournisseur }}"
                                        data-email="{{ $fournisseur->email_fournisseur }}"
                                        data-tele="{{ $fournisseur->tele_fournisseur }}"
                                        data-ville="{{ $fournisseur->ville_fournisseur }}"
                                        data-society-name="{{ !empty($fournisseur->nomSociete_fournisseur) ? $fournisseur->nomSociete_fournisseur : 'Particulier' }}"
                                        data-GSM1="{{ !empty($fournisseur->GSM1_fournisseur) ? $fournisseur->GSM1_fournisseur : 'Non disponible' }}"
                                        data-GSM2="{{ !empty($fournisseur->GSM2_fournisseur) ? $fournisseur->GSM2_fournisseur : 'Non disponible' }}"
                                        data-remark="{{ $fournisseur->remark }}"
                                        data-user="{{ !empty($fournisseur->utilisateur->name) ? $fournisseur->utilisateur->name : 'Personne' }}">

                                        Details
                                    </button>

                                    <form class="user-form"
                                        action="{{ route('user.select', $fournisseur->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('POST')
                                        <select class="form-select userSelect"
                                            aria-label="Default select example"
                                            data-fournisseur-id="{{ $fournisseur->id }}"
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

                                    <form class="supplier-form"
                                        action="{{ route('supplier.select', $fournisseur->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('POST')
                                        <select class="form-select status-select"
                                            aria-label="Default select example" name="status"
                                            id="">
                                            <option value="">Selectionner la table</option>
                                            @foreach ($select as $item)
                                            <option value="{{ $item }}">{{ $item }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </form>
                                </div>
                            </td>
                            @elseif (auth()->user()->role == 'utilisateur')
                            
                            <td class="button-container">
                                <div class="d-flex align-items-center gap-2"
                                    style="display: inline; border-radius: 1cap; border-style: inherit; color: transparent;">
                                    <form class="user-form"
                                        action="{{ route('user.select', $fournisseur->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('POST')
                                        <select class="form-select userSelect"
                                            aria-label="Default select example"
                                            data-fournisseur-id="{{ $fournisseur->id }}"
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

                                    <button type="button" class="btn btn-outline-success border-btn me-4" data-bs-toggle="modal" data-bs-target="#remark-{{ $fournisseur->id }}">
                                        Remarque
                                    </button>


                                    <button type="button" class="btn btn-outline-info detailButton border-btn me-4"
                                        data-bs-toggle="modal"
                                        data-bs-target="#ModalSupplierDetails-{{ $fournisseur->id }}"
                                        data-name="{{ $fournisseur->nom_fournisseur }}"
                                        data-email="{{ $fournisseur->email_fournisseur }}"
                                        data-tele="{{ $fournisseur->tele_fournisseur }}"
                                        data-ville="{{ $fournisseur->ville_fournisseur }}"
                                        data-society-name="{{ !empty($fournisseur->nomSociete_fournisseur) ? $fournisseur->nomSociete_fournisseur : 'Particulier' }}"
                                        data-GSM1="{{ !empty($fournisseur->GSM1_fournisseur) ? $fournisseur->GSM1_fournisseur : 'Non disponible' }}"
                                        data-GSM2="{{ !empty($fournisseur->GSM2_fournisseur) ? $fournisseur->GSM2_fournisseur : 'Non disponible' }}"
                                        data-remark="{{ $fournisseur->remark }}"
                                        data-user="{{ !empty($fournisseur->utilisateur->name) ? $fournisseur->utilisateur->name : 'Personne' }}">

                                        Details
                                    </button>
                                </div>
                            </td>

                            @endif

                            <form action="{{ route('remark', ['id' => $fournisseur->id]) }}" method="POST">
                                @csrf
                                <div class="modal fade" id="remark-{{ $fournisseur->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Remarque</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <textarea name="remark" id="remarque" class="form-control col-12" rows="6">{{ old('remark', $fournisseur->remark) }}</textarea>
                                                    @error('remark')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success">Ajouter la remarque</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>





                            <div class="modal fade" id="ModalSupplierDetails-{{ $fournisseur->id }}"
                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="" id="ModalSupplierDetails">Details du fournisseur</h5>
                                            <button type="button" class="btn-close"
                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="show-info-fournisseur show-society">
                                                <label class="label-detail-fournisseur"><strong class="det">Nom de la
                                                        société</strong></label>
                                                <p class="info-fournisseur showSocietyfournisseur"
                                                    id="showSocietyDetail-{{ $fournisseur->id }}">
                                                </p>
                                            </div>

                                            <div class="show-info-fournisseur show-GSM1">
                                                <label class="label-detail-fournisseur"><strong class="det">GSM1 de la
                                                        société</strong></label>
                                                <p class="info-fournisseur showGSM1fournisseur"
                                                    id="showGSM1Detail-{{ $fournisseur->id }}">
                                                </p>
                                            </div>
                                            <div class="show-info-fournisseur show-GSM2">
                                                <label class="label-detail-fournisseur"><strong class="det">GSM2 de la
                                                        société</strong></label>
                                                <p class="info-fournisseur showGSM2fournisseur"
                                                    id="showGSM2Detail-{{ $fournisseur->id }}">
                                                </p>
                                            </div>

                                            <div class="show-info-fournisseur show-name">
                                                <label class="label-detail-fournisseur"><strong class="det">Personne à
                                                        contacter</strong></label>
                                                <p class="info-fournisseur showNamefournisseur"
                                                    id="showNameDetail-{{ $fournisseur->id }}">
                                                </p>
                                            </div>
                                            <div class="show-info-fournisseur show-contact">
                                                <label class="label-detail-fournisseur"><strong class="det">Numero de telephone</strong></label>
                                                <p class="info-fournisseur showContactfournisseur"
                                                    id="showContactDetail-{{ $fournisseur->id }}">
                                                </p>
                                            </div>
                                            <div class="show-info-fournisseur show-email">
                                                <label class="label-detail-fournisseur"><strong class="det">Email</strong></label>
                                                <p class="info-fournisseur showEmailfournisseur"
                                                    id="showEmailDetail-{{ $fournisseur->id }}">
                                                </p>
                                            </div>


                                            <div class="show-info-fournisseur show-ville">
                                                <label class="label-detail-fournisseur"><strong class="det">Ville</strong></label>
                                                <p class="info-fournisseur showVillefournisseur"
                                                    id="showVilleDetail-{{ $fournisseur->id }}">
                                                </p>
                                            </div>

                                            <div class="show-info-fournisseur show-category" style="margin-top:10px">
                                                <label class="label-detail-fournisseur"><strong class="det">Les
                                                        catégories</strong></label>
                                                <select
                                                    class="form-select form-select-sm info-fournisseur showCategoryfournisseur"
                                                    aria-label=".form-select-sm example"
                                                    style="width: 200px; height: 30px"
                                                    id="categories-{{ $fournisseur->id }}">
                                                    <option value="" selected>Voir
                                                        la(les)
                                                        catégories</option>
                                                    @foreach ($fournisseur->allCategories as $categorie)
                                                    <option value="{{ $categorie->id }}">
                                                        {{ $categorie->nom_categorie }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="show-info-fournisseur show-product"
                                                style="margin-bottom: 40px; margin-top:10px">
                                                <label class="form-label label-detail-fournisseur"><strong class="det">Sous-Catégorie</strong></label>
                                                <select
                                                    class="form-select form-select-sm info-fournisseur showProductfournisseur"
                                                    aria-label=".form-select-sm example"
                                                    id="products-{{ $fournisseur->id }}"
                                                    style="width: 200px; height: 30px">
                                                    <option value="" selected>Voir les
                                                        produits associés</option>

                                                </select>
                                            </div>
                                            <div class="show-info-fournisseur show-user">
                                                <label class="label-detail-fournisseur"><strong class="det">Contacté Par</strong></label>
                                                <p class="info-fournisseur showUserfournisseur"
                                                    id="showUserDetail-{{ $fournisseur->id }}">
                                                </p>
                                            </div>
                                            <div class="show-info-fournisseur show-remark">
                                                <label class="label-detail-fournisseur"><strong class="det">Remarque</strong></label>
                                                <p class="info-fournisseur showRemarkfournisseur"
                                                    id="showRemarkDetail-{{ $fournisseur->id }}"
                                                    style="font-size: 12px">
                                                </p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @if (isset($fournisseur))
                <div class="modal fade" id="updateSupplierModal" tabindex="-1"
                    aria-labelledby="updateSupplierModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="/updateSupplier" method="POST">
                                @csrf
                                <input type="hidden" name="id" id="updateSupplierId">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        Modifier le fournisseur</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label"><strong class="det">Nom de la société</strong></label>
                                            <input type="text" class="form-control" name="newNomSociete_fournisseur"
                                                placeholder="Entrer le nom de la société..." id="updatefournisseurSociety"
                                                value="{{ old('newNomSociete_fournisseur', $fournisseur->nomSociete_fournisseur) }}">
                                            @if ($errors->has('newNomSociete_fournisseur'))
                                            <span class="text-danger">
                                                {{ $errors->first('newNomSociete_fournisseur') }}</span>
                                            @endif
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label"><strong class="det">GSM1 de la société</strong></label>
                                            <input type="tel" class="form-control" name="newGSM1_fournisseur" placeholder="Entrer le GSM1..."
                                                id="updatefournisseurGSM1" value="{{ old('newGSM1_fournisseur', $fournisseur->GSM1_fournisseur) }}">
                                            @if ($errors->has('newGSM1_fournisseur'))
                                            <span class="text-danger">
                                                {{ $errors->first('newGSM1_fournisseur') }}</span>
                                            @endif
                                        </div>


                                        <div class="mb-3">
                                            <label class="form-label"><strong class="det">GSM2 de la société</strong></label>
                                            <input type="tel" class="form-control" name="newGSM2_fournisseur" placeholder="Entrer GSM2..."
                                                id="updatefournisseurGSM2" value="{{ old('newGSM2_fournisseur', $fournisseur->GSM2_fournisseur) }}">
                                            @if ($errors->has('newGSM2_fournisseur'))
                                            <span class="text-danger">
                                                {{ $errors->first('newGSM2_fournisseur') }}</span>
                                            @endif
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label"><strong class="det">Personne à contacter</strong></label>
                                            <input type="text" class="form-control" id="updatefournisseurName" name="newNom_fournisseur"
                                                placeholder="Entrer le fournisseur..." value="{{ old('newNom_fournisseur', $fournisseur->nom_fournisseur) }}">
                                            @if ($errors->has('newNom_fournisseur'))
                                            <span class="text-danger">
                                                {{ $errors->first('newNom_fournisseur') }}</span>
                                            @endif
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label"><strong class="det">Numéro de téléphone</strong></label>
                                            <input type="tel" class="form-control" id="updatefournisseurContact" name="newTele_fournisseur"
                                                placeholder="Entrer le contact..."
                                                value="{{ old('newTele_fournisseur', $fournisseur->tele_fournisseur) }}">
                                            @if ($errors->has('newTele_fournisseur'))
                                            <span class="text-danger">
                                                {{ $errors->first('newTele_fournisseur') }}</span>
                                            @endif
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label"><strong class="det">Email</strong></label>
                                            <input id="updatefournisseurEmail" type="email" class="form-control" name="newEmail_fournisseur"
                                                placeholder="Entrer l'émail..." value="{{ old('newEmail_fournisseur', $fournisseur->email_fournisseur) }}">
                                            @if ($errors->has('newEmail_fournisseur'))
                                            <span class="text-danger">
                                                {{ $errors->first('newEmail_fournisseur') }}</span>
                                            @endif
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label"><strong class="det">Ville</strong></label>
                                            <input id="updatefournisseurVille" type="text" class="form-control" name="newVille_fournisseur"
                                                placeholder="Entrer la ville..."
                                                value="{{ old('newVille_fournisseur', $fournisseur->ville_fournisseur) }}">

                                            @if ($errors->has('newVille_fournisseur'))
                                            <span class="text-danger">
                                                {{ $errors->first('newVille_fournisseur') }}</span>
                                            @endif
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label"><strong class="det">Catégorie</strong></label>
                                            <select class="form-select" id="updatefournisseurCategory" aria-label=".form-select-sm example"
                                                name="newCategorie_id" style="color: #a6a6a6;">
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

                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary">Modifier</button>
                                        </div>
                                    </form>
                                </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
</div>
<div class="d-flex justify-content-between align-items-center">
    @if ($fournisseurs->total() >= 10)
    <form id="pagination-form" action="{{ route('fournisseurs.pagination') }}" method="GET"
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
        {{ $fournisseurs->links('vendor.pagination.bootstrap-4') }}

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
            const updateSupplierModal = document.getElementById('updateSupplierModal');
            updateSupplierModal.addEventListener('show.bs.modal', event => {
                const button = event.relatedTarget;

                const supplierId = button.getAttribute('data-id');
                const supplierName = button.getAttribute('data-name');
                const supplierEmail = button.getAttribute('data-email');
                const supplierContact = button.getAttribute('data-tele');
                const supplierAdress = button.getAttribute('data-adress');
                const supplierVille = button.getAttribute('data-ville');
                const supplierSociety = button.getAttribute('data-society');
                const supplierGSM1 = button.getAttribute('data-GSM1');
                const supplierGSM2 = button.getAttribute('data-GSM2');
                const supplierCategory = button.getAttribute('data-category');


                document.getElementById('updateSupplierId').value = supplierId;
                document.getElementById('updateSupplierName').value = supplierName;
                document.getElementById('updateSupplierEmail').value = supplierEmail;
                document.getElementById('updateSupplierContact').value = supplierContact;
                document.getElementById('updateSupplierAdress').value = supplierAdress;
                document.getElementById('updateSupplierVille').value = supplierVille;
                document.getElementById('updateSupplierSociety').value = supplierSociety;
                document.getElementById('updateSupplierGSM1').value = supplierGSM1;
                document.getElementById('updateSupplierGSM2').value = supplierGSM2;
                document.getElementById('updateSupplierCategorie').value = supplierCategory;

            });
        });
    </script>

    <script>
        document.querySelectorAll(`.detailButton`).forEach(button => {

            button.addEventListener('click', function() {
                const supplierId = this.getAttribute('data-bs-target').split('-').pop();
                const supplierName = this.getAttribute('data-name') || 'Non disponible'
                const supplierEmail = this.getAttribute('data-email') || 'Non disponible'
                const supplierContact = this.getAttribute('data-tele') || 'Non disponible'
                const supplierAdress = this.getAttribute('data-adress') || 'Non disponible'
                const supplierVille = this.getAttribute('data-ville')
                const supplierSociety = this.getAttribute('data-society-name')
                const supplierGSM1 = this.getAttribute('data-GSM1')
                const supplierGSM2 = this.getAttribute('data-GSM2')
                const supplierRemark = button.getAttribute('data-remark');
                const supplierUser = button.getAttribute('data-user');

                document.querySelector(`#showNameDetail-${supplierId}`).innerText = supplierName
                document.querySelector(`#showEmailDetail-${supplierId}`).innerText = supplierEmail
                document.querySelector(`#showContactDetail-${supplierId}`).innerText = supplierContact
                document.querySelector(`#showVilleDetail-${supplierId}`).innerText = supplierVille
                document.querySelector(`#showSocietyDetail-${supplierId}`).innerText = supplierSociety
                document.querySelector(`#showGSM1Detail-${supplierId}`).innerText = supplierGSM1
                document.querySelector(`#showGSM2Detail-${supplierId}`).innerText = supplierGSM2
                document.querySelector(`#showRemarkDetail-${supplierId}`).innerText = supplierRemark
                document.querySelector(`#showUserDetail-${supplierId}`).innerText = supplierUser
            })
        });

        document.addEventListener('DOMContentLoaded', function() {

            const categories = @json($categories);
            // console.log(categories);

            document.querySelectorAll('.showCategorySupplier').forEach(

                selectCategory => {
                    const supplierId = selectCategory.id.split('-').pop();
                    const products = document.getElementById(`products-${supplierId}`)
                    selectCategory.addEventListener('change', function() {

                        const selectedCategoryId = this.value
                        products.innerHTML = ''

                        if (selectedCategoryId) {
                            const selectedCategory = categories.find(category => {
                                return category.id == selectedCategoryId
                            })
                            // console.log(selectedCategory);

                            if (selectedCategory && selectedCategory.sous_categories.length > 0) {

                                // console.log(selectedCategory.sous_categories);
                                selectedCategory.sous_categories.forEach(sous_category => {
                                    const option = document.createElement('option')
                                    option.value = sous_category.id
                                    option.textContent = sous_category.nom_produit
                                    option.selected = true;
                                    option.disabled = true;

                                    products.appendChild(option)

                                })
                            } else {
                                const emptyOption = document.createElement('option');
                                emptyOption.textContent = 'Aucun produit trouvé';
                                emptyOption.disabled = true;
                                sousCategories.appendChild(emptyOption);
                            }

                        }



                    })
                }



            )






        })
    </script>

    <script>
        function confirmDelete(supplierId) {
            Swal.fire({
                title: 'Supprimer le fournisseur !',
                text: "êtes-vous sûr que vous voulez supprimer ce fournisseur ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                cancelButtonText: 'Annuler',
                confirmButtonText: 'Oui, Supprimer-le !'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + supplierId).submit();
                }
            });
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selects = document.querySelectorAll('.status-select'); // Sélectionne tous les selects
            selects.forEach(select => {
                select.addEventListener('change', function() {
                    const form = this.closest(
                        '.supplier-form'); // Trouve le formulaire correspondant
                    if (form) {
                        form.submit();
                    }
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selects = document.querySelectorAll('.userSelect'); // Sélectionne tous les selects
            selects.forEach(select => {
                select.addEventListener('change', function() {
                    const form = this.closest(
                        '.user-form'); // Trouve le formulaire correspondant
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
                fetch(`/search-suppliers?search=${searchQuery}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log(data);

                        const {
                            suppliers,
                            selectOptions
                        } = data;

                        const tbody = document.querySelector('tbody');
                        tbody.innerHTML = '';

                        suppliers.forEach(supplier => {


                            const categories = supplier.categories || [];

                            let categoriesList = 'Non catégorisé';

                            categories.forEach(category => {
                                categoriesList =
                                    `${category.nom_categorie }`;
                            });



                            const row = document.createElement('tr');
                            const role = "{{ auth()->user()->role }}"
                            row.innerHTML =

                                `
                                  
                                    ${role === "super-admin" ?
                                    `
                                                                           <td>${supplier.nomSociete_fournisseur || 'Particulier'}</td>
                                                                            <td>${supplier.GSM1_fournisseur || 'Non disponible'}</td>
                                                                            <td>${supplier.GSM2_fournisseur || 'Non disponible'}</td>
                                                                            <td>${supplier.nom_fournisseur || 'Non disponible'}</td>
                                                                            <td>${supplier.tele_fournisseur || 'Non disponible'}</td>
                                                                            <td>${supplier.email_fournisseur || 'Non disponible'}</td>
                                                                            <td>${supplier.ville_fournisseur}</td>
                                                                        
                                                                            <td>${categoriesList}</td>
                                                                            <td>${supplier.utilisateur.name || 'Personne'}</td>
                                                                           
                                                                    
                                                                                <button type="button" class="btn btn-outline-primary border-btn me-4" data-bs-toggle="modal"
                                                                                    data-bs-target="#updateSupplierModal"
                                                                                    data-id="${supplier.id}"
                                                                                    data-name="${supplier.nom_fournisseur}"
                                                                                    data-email="${supplier.email_fournisseur}"
                                                                                    data-tele="${supplier.tele_fournisseur}"
                                                                                    data-ville="${supplier.ville_fournisseur}"
                                                                                    data-society="${supplier.nomSociete_fournisseur}"
                                                                                    data-GSM1="${supplier.GSM1_fournisseur }"
                                                                                    data-GSM2="${supplier.GSM2_fournisseur }"
                                                                                    data-category="${supplier.category_id}">Modifier
                                                                                </button>
                                                                               
                                                                                    <button type="button" class="btn btn-outline-info detailButtonQuery border-btn me-4"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#QueryModalSupplierDetails"
                                                                                    data-name="${supplier.nom_fournisseur}"
                                                                                    data-email="${supplier.email_fournisseur}"
                                                                                    data-contact="${supplier.tele_fournisseur}"
                                                                                    data-ville="${supplier.ville_fournisseur}"
                                                                                    data-remark="${supplier.remark}"
                                                                                    data-user="${supplier.utilisateur.name}"
                                                                                    data-society-name="${supplier.nomSociete_fournisseur}"
                                                                                    data-GSM1="${supplier.GSM1_fournisseur}"
                                                                                    data-GSM2="${supplier.GSM2_fournisseur}"
                                                                                    data-categories="${encodeURIComponent(JSON.stringify(supplier.categories))}"
                                                                                     >
                                                                                    Détails
                                                                                    </button>

                                                                                        <form
                                                                                            action="/supplier/destroy/${supplier.id}"
                                                                                            method="POST" style="display: inline;"
                                                                                            id="delete-form-${supplier.id }">
                                                                                            @csrf
                                                                                            @method('DELETE')
                                                                                            <button type="button" class="btn btn-outline-danger border-btn me-4"
                                                                                                onclick="confirmDelete(${supplier.id })">Supprimer</button>
                                                                                        </form>
                                                                                    
                                                                                <form class="supplier-form" action="/supplier/select/${supplier.id}" method="POST">
                                                                                    @csrf
                                                                                    <select class="form-select status-select" name="status">
                                                                                        <option value="" selected>Selectionner la table</option>
                                                                                        ${selectOptions.map(option => `
                                                                                        <option value="${option}">${option}</option>
                                                                                        `).join('')}
                                                                                    </select>
                                                                                </form>
                                                                                 </td>

                                                                                 ` : ""}

                                    ${role === "admin" ?
                                    `
                                                                            <td>${supplier.nomSociete_fournisseur || 'Particulier'}</td>
                                                                            <td>${supplier.GSM1_fournisseur || 'Non disponible'}</td>
                                                                            <td>${supplier.GSM2_fournisseur || 'Non disponible'}</td>
                                                                             <td>${supplier.nom_fournisseur || 'Non disponible'}</td>
                                                                            <td>${supplier.tele_fournisseur || 'Non disponible'}</td>
                                                                           <td>${supplier.email_fournisseur || 'Non disponible'}</td>
                                                                            <td>${supplier.ville_fournisseur}</td>
                                                                        
                                                                            <td>${categoriesList}</td>
                                                                            <td>${supplier.utilisateur.name || 'Personne'}</td>
                                                                           
                                                                    
                                                                                <button type="button" class="btn btn-outline-primary border-btn me-4" data-bs-toggle="modal"
                                                                                    data-bs-target="#updateSupplierModal"
                                                                                    data-id="${supplier.id}"
                                                                                    data-name="${supplier.nom_fournisseur}"
                                                                                    data-email="${supplier.email_fournisseur}"
                                                                                    data-tele="${supplier.tele_fournisseur}"
                                                                                    data-ville="${supplier.ville_fournisseur}"
                                                                                    data-society="${supplier.nomSociete_fournisseur}"
                                                                                    data-GSM1="${supplier.GSM1_fournisseur }"
                                                                                    data-GSM2="${supplier.GSM2_fournisseur }"
                                                                                    data-category="${supplier.category_id}">Modifier
                                                                                </button>
                                                                             
                                                                                    <button type="button" class="btn btn-outline-info detailButtonQuery border-btn me-4"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#QueryModalSupplierDetails"
                                                                                    data-name="${supplier.nom_fournisseur}"
                                                                                    data-email="${supplier.email_fournisseur}"
                                                                                    data-contact="${supplier.tele_fournisseur}"
                                                                                    data-ville="${supplier.ville_fournisseur}"
                                                                                    data-remark="${supplier.remark}"
                                                                                    data-user="${supplier.utilisateur.name}"
                                                                                    data-society-name="${supplier.nomSociete_fournisseur}"
                                                                                    data-GSM1="${supplier.GSM1_fournisseur}"
                                                                                    data-GSM2="${supplier.GSM2_fournisseur}"
                                                                                    data-categories="${encodeURIComponent(JSON.stringify(supplier.categories))}"
                                                                                     >
                                                                                    Détails
                                                                                    </button>
                                                                            
                                                                                    <form class="supplier-form" action="/supplier/select/${supplier.id}" method="POST">
                                                                                        @csrf
                                                                                        <select class="form-select status-select" name="status">
                                                                                            <option value="" selected>Selectionner la table</option>
                                                                                            ${selectOptions.map(option => `
                                                                                                <option value="${option}">${option}</option>
                                                                                                `).join('')}
                                                                                                                                    </select>
                                                                                    </form>
                                                                                </td>
                                                                    ` : ""}${role === "utilisateur" ? ` 
                                                                    <td>${supplier.nomSociete_fournisseur || 'Particulier'}</td>
                                                                            <td>${supplier.GSM1_fournisseur || 'Non disponible'}</td>
                                                                            <td>${supplier.GSM2_fournisseur || 'Non disponible'}</td>
                                                                            <td>${supplier.nom_fournisseur || 'Non disponible'}</td>
                                                                            <td>${supplier.tele_fournisseur || 'Non disponible'}</td>
                                                                           <td>${supplier.email_fournisseur || 'Non disponible'}</td>
                                                                            <td>${supplier.ville_fournisseur}</td>
                                                                            <td>${categoriesList}</td>
                                                                            <td>${supplier.utilisateur.name || 'Personne'}</td>
                                                                           
                                                                    <td>
                                                                                    <button type="button" class="btn btn-outline-info detailButtonQuery border-btn me-4"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#QueryModalSupplierDetails"
                                                                                    data-name="${supplier.nom_fournisseur}"
                                                                                    data-email="${supplier.email_fournisseur}"
                                                                                    data-contact="${supplier.tele_fournisseur}"
                                                                                    data-ville="${supplier.ville_fournisseur}"
                                                                                    data-remark="${supplier.remark}"
                                                                                    data-user="${supplier.utilisateur.name}"
                                                                                    data-society-name="${supplier.nomSociete_fournisseur}"
                                                                                    data-GSM1="${supplier.GSM1_fournisseur}"
                                                                                    data-GSM2="${supplier.GSM2_fournisseur}"
                                                                                    data-categories="${encodeURIComponent(JSON.stringify(supplier.categories))}"
                                                                                     >
                                                                                    Détails
                                                                                    </button>
                                                                                </td>
                                                                    
                                                                    `:""}
                                                                    `;

                            tbody.appendChild(row);

                            const selectElement = row.querySelector('.status-select');
                            if (selectElement) { // Vérifiez que l'élément existe
                                selectElement.addEventListener('change', function() {
                                    const form = this.closest('.supplier-form');
                                    if (form) {
                                        form.submit(); // Exécute la logique seulement si l'élément existe
                                    }
                                });
                            }

                            //     }
                            // });

                            // Ajouter un événement de détail pour chaque bouton "Détails"
                            const detailButtons = document.querySelectorAll('.detailButtonQuery');

                            if (detailButtons.length > 0) { // Assurez-vous qu'il y a au moins un bouton
                                detailButtons.forEach(button => {
                                    button.addEventListener('click', function() {
                                        // Récupération des données du fournisseur
                                        const supplierName = this.getAttribute('data-name'); || 'Non disponible'
                                        const supplierEmail = this.getAttribute('data-email') || 'Non disponible';
                                        const supplierContact = this.getAttribute('data-contact'); || 'Non disponible'
                                        const supplierAdress = this.getAttribute('data-adress') || 'Non disponible';
                                        const supplierSociety = this.getAttribute('data-society-name') || 'Particulier';
                                        const supplierGSM1 = this.getAttribute('data-GSM1') || 'Non disponible';
                                        const supplierGSM2 = this.getAttribute('data-GSM2') || 'Non disponible';
                                        const supplierVille = this.getAttribute('data-ville');
                                        const supplierRemark = this.getAttribute('data-remark');
                                        const supplierUser = this.getAttribute('data-user') || 'Personne';

                                        // Mise à jour des éléments HTML
                                        const updateTextContent = (selector, text) => {
                                            const element = document.querySelector(selector);
                                            if (element) {
                                                element.innerText = text;
                                            }
                                        };

                                        updateTextContent('#showNameSupplier', supplierName);
                                        updateTextContent('#showEmailSupplier', supplierEmail);
                                        updateTextContent('#showContactSupplier', supplierContact);
                                        updateTextContent('#showAdressSupplier', supplierAdress);
                                        updateTextContent('#showSocietySupplier', supplierSociety);
                                        updateTextContent('#showGSM1Supplier', supplierGSM1);
                                        updateTextContent('#showGSM2Supplier', supplierGSM2);
                                        updateTextContent('#showVilleSupplier', supplierVille);
                                        updateTextContent('#showUserSupplier', supplierUser);
                                        updateTextContent('#showRemarkSupplier', supplierRemark);

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

                                                    let productsHTML = '<option value="" selected>Voir les sous catégories associées</option>';
                                                    if (selectedCategory && selectedCategory.sous_categories) {
                                                        console.log("Sous-catégories de cette catégorie :", selectedCategory.sous_categories);
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
                            }


                        });
                    })
                    .catch(error => {
                        console.error('Error fetching suppliers:', error);
                    });
            } else {
                location.reload();
            }
        });
    });
</script>
@endsection
@section('content2')
    <div class="modal fade" id="QueryModalSupplierDetails" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="show-info-supplier show-society">
                        <label class="label-detail-supplier">Nom de la société</label>
                        <h6 class="info-supplier" id="showSocietySupplier">
                        </h6>
                    </div>

                    <div class="show-info-supplier show-society">
                        <label class="label-detail-supplier">GSM1 de la société</label>
                        <h6 class="info-supplier" id="showGSM1Supplier">
                        </h6>
                    </div>

                    <div class="show-info-supplier show-society">
                        <label class="label-detail-supplier">GSM2 de la société</label>
                        <h6 class="info-supplier" id="showGSM2Supplier">
                        </h6>
                    </div>

                    <div class="show-info-supplier show-name">
                        <label class="label-detail-supplier">Personne à contacter</label>
                        <h6 class="info-supplier" id="showNameSupplier"></h6>
                    </div>
                    <div class="show-info-supplier show-contact">
                        <label class="label-detail-supplier">Numero de telephone</label>
                        <h6 class="info-supplier" id="showContactSupplier"></h6>
                    </div>
                    <div class="show-info-supplier show-email">
                        <label class="label-detail-supplier">Email</label>
                        <h6 class="info-supplier" id="showEmailSupplier">
                        </h6>
                    </div>



                    <div class="show-info-supplier show-ville">
                        <label class="label-detail-supplier">Ville</label>
                        <h6 class="info-supplier" id="showVilleSupplier">
                        </h6>
                    </div>
                    <div class="show-info-supplier show-category" style="margin-top:10px">
                        <label class="label-detail-supplier">Les catégories</label>
                        <select class="form-select form-select-sm info-supplier showCategorySupplier"
                            aria-label=".form-select-sm example" style="width: 200px; height: 30px"
                            id="categoriesQuery-1">
                            <option value="" selected>Voir la(les) catégories</option>

                        </select>
                    </div>

                    <div class="show-info-supplier show-product" style="margin-bottom: 40px; margin-top:10px">
                        <label class="form-label label-detail-supplier">Sous-Catégorie</label>
                        <select class="form-select form-select-sm info-supplier showProductSupplier"
                            aria-label=".form-select-sm example" id="productsQuery-1" style="width: 200px; height: 30px">

                        </select>
                    </div>
                    <div class="show-info-supplier show-user">
                        <label class="label-detail-supplier">Contacté Par</label>
                        <h6 class="info-supplier" id="showUserSupplier">
                        </h6>
                    </div>
                    <div class="show-info-supplier show-remark">
                        <label class="label-detail-supplier">Remarque</label>
                        <p class="info-supplier" id="showRemarkSupplier" style="font-size: 12px">
                        </p>
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-bs-dismiss="modal">Fermer</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
