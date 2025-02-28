@extends('myApp.admin.adminLayout.adminPage')
@section('title')
    Les tiers
@endsection

@section('errorContent')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var modalType = document.getElementById('modals').getAttribute('data-error');

            if (modalType === 'default') {
                var addModal = new bootstrap.Modal(document.getElementById('add_prospect'));
                addModal.show();
            } else if (modalType === 'update') {
                var updateModal = new bootstrap.Modal(document.getElementById('update_prospect'));
                updateModal.show();
            }else if (modalType === 'remark') {
                var remark = new bootstrap.Modal(document.getElementById('remark'));
                remark.show();
            }
        });
    </script>
@endsection

@section('content')
    <div id="modals" style="display:none;" data-error="{{ session('modalType') }}"></div>
    <form action="{{ route('prospect.add') }}" method="POST">
        @csrf
        <div class="modal fade" id="add_prospect" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ajouter un tiers</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label class="form-label">Nom de la société</label>
                        <input type="text" class="form-control" name="nomSociete_prospect"
                            placeholder="Entrer le nom de la société..." value="{{ old('nomSociete_prospect') }}" />
                        @error('nomSociete_prospect', 'default')
                            <span class="text-danger">{{ $message }}</span> <br>
                        @enderror
                       
                       

                        <label class="form-label">Personne à contacter</label>
                        <input type="text" class="form-control" name="nom_prospect" placeholder="Entrer le prospect..."
                            value="{{ old('nom_prospect') }}" />
                        @error('nom_prospect', 'default')
                            <span class="text-danger">{{ $message }}</span> <br>
                        @enderror
                        <label class="form-label">Numero de telephone</label>
                        <input type="text" class="form-control" name="tele_prospect" placeholder="Entrer le contact..."
                            value="{{ old('tele_prospect') }}" />
                        @error('tele_prospect', 'default')
                            <span class="text-danger">{{ $message }}</span> <br>
                        @enderror
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email_prospect" placeholder="Entrer l'émail..."
                            value="{{ old('email_prospect') }}" />
                        @error('email_prospect', 'default')
                            <span class="text-danger">{{ $message }}</span> <br>
                        @enderror
                        
                        <label class="form-label">Ville</label>
                        <input type="text" class="form-control" name="ville_prospect" placeholder="Entrer la ville..."
                            value="{{ old('ville_prospect') }}" />
                        @error('ville_prospect', 'default')
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
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_prospect">
                Ajouter un tiers
            </button>
            <a href="{{ route('prospects.pdf') }}" class="btn btn-primary" style="margin-left: 989px">
                <i class="fas fa-file-pdf"></i>
            </a>
        @elseif (auth()->user()->role == 'admin')
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_prospect">
                Ajouter un tiers
            </button>
            <a href="{{ route('prospects.pdf') }}" class="btn btn-primary" style="margin-left: 989px">
                <i class="fas fa-file-pdf"></i>
            </a>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Les tiers</h4>
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
                                    @foreach ($prospects as $prospect)
                                        <tr>
                                            <td>{{ !empty($prospect->nomSociete_prospect) ? $prospect->nomSociete_prospect : 'Particulier' }}
                                            </td>
                                            <td>{{!empty($prospect->nom_prospect) ? $prospect->nom_prospect : 'Non disponible' }}</td>
                                            <td>{{ !empty($prospect->tele_prospect) ? $prospect->tele_prospect : 'Non disponible'  }}</td>
                                            <td>{{ !empty($prospect->email_prospect) ? $prospect->email_prospect : 'Non disponible' }}</td>
                                            <td>{{ $prospect->ville_prospect }}</td>
                                            <td>
                                                @forelse ($prospect->categorieProspects as $assoc)
                                                    @if ($assoc->categorie)
                                                        {{ $assoc->categorie->nom_categorie }}
                                                    @endif
                                                @empty
                                                    Non catégorisé
                                                @endforelse
                                            </td>
                                            <td>
                                                {{ !empty($prospect->utilisateur->name) ? $prospect->utilisateur->name : 'Personne' }}
                                            </td>

                                            @if (auth()->user()->role == 'super-admin')
                                                <td>
                                                    <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#update_prospect" data-id="{{ $prospect->id }}"
                                                        data-society="{{ $prospect->nomSociete_prospect }}"
                                                        data-name="{{ $prospect->nom_prospect }}"
                                                        data-tele="{{ $prospect->tele_prospect }}"
                                                        data-email="{{ $prospect->email_prospect }}"
                                                        data-ville="{{ $prospect->ville_prospect }}"
                                                        data-category="{{ $prospect->categories->first()?->id ?? '' }}">
                                                        Modifier
                                                    </a>

                                                </td>
                                                <td>
                                                    <form class="user-form"
                                                        action="{{ route('user.select.prospect', $prospect->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('POST')
                                                        <select class="form-select userSelect"
                                                            aria-label="Default select example"
                                                            data-prospect-id="{{ $prospect->id }}"
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
                                                        data-bs-target="#remark-{{ $prospect->id }}">
                                                        Remarque
                                                    </button>
                                                    


                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-info detailButton"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#ModalProspectDetails-{{ $prospect->id }}"
                                                        data-name="{{ $prospect->nom_prospect }}"
                                                        data-email="{{ $prospect->email_prospect }}"
                                                        data-tele="{{ $prospect->tele_prospect }}"
                                                        data-ville="{{ $prospect->ville_prospect }}"
                                                        data-society-name="{{ !empty($prospect->nomSociete_prospect) ? $prospect->nomSociete_prospect : 'Particulier' }}"
                                                        data-remark="{{ $prospect->remark }}"
                                                        data-user="{{ !empty($prospect->utilisateur->name) ? $prospect->utilisateur->name : 'Personne' }}"

                                                        >

                                                        Details
                                                    </button>
                                                </td>



                                                <td>
                                                    <a>
                                                        <form action="{{ route('prospect.destroy', $prospect->id) }}"
                                                            method="POST" style="display: inline"
                                                            id="delete-form-{{ $prospect->id }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-danger"
                                                                onclick="confirmDelete({{ $prospect->id }})">
                                                                Supprimer
                                                            </button>
                                                        </form>
                                                    </a>
                                                </td>
                                                <td>
                                                    <form class="prospect-form"
                                                        action="{{ route('prospect.select', $prospect->id) }}"
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
                                                        data-bs-target="#update_prospect" data-id="{{ $prospect->id }}"
                                                        data-society="{{ $prospect->nomSociete_prospect }}"
                                                        data-name="{{ $prospect->nom_prospect }}"
                                                        data-tele="{{ $prospect->tele_prospect }}"
                                                        data-email="{{ $prospect->email_prospect }}"
                                                        data-ville="{{ $prospect->ville_prospect }}"
                                                        data-category="{{ $prospect->categories->first()?->id ?? '' }}">
                                                        Modifier
                                                    </a>

                                                </td>
                                                <td>
                                                    <form class="user-form"
                                                        action="{{ route('user.select.prospect', $prospect->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('POST')
                                                        <select class="form-select userSelect"
                                                            aria-label="Default select example"
                                                            data-prospect-id="{{ $prospect->id }}"
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
                                                        data-bs-target="#remark-{{ $prospect->id }}">
                                                        Remarque
                                                    </button>
                                                    


                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-info detailButton"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#ModalProspectDetails-{{ $prospect->id }}"
                                                        data-name="{{ $prospect->nom_prospect }}"
                                                        data-email="{{ $prospect->email_prospect }}"
                                                        data-tele="{{ $prospect->tele_prospect }}"
                                                        data-ville="{{ $prospect->ville_prospect }}"
                                                        data-society-name="{{ !empty($prospect->nomSociete_prospect) ? $prospect->nomSociete_prospect : 'Particulier' }}"
                                                        data-remark="{{ $prospect->remark }}"
                                                        data-user="{{ !empty($prospect->utilisateur->name) ? $prospect->utilisateur->name : 'Personne' }}"

                                                        >

                                                        Details
                                                    </button>
                                                </td>
                                                <td>
                                                    <form class="prospect-form"
                                                        action="{{ route('prospect.select', $prospect->id) }}"
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
                                                        action="{{ route('user.select.prospect', $prospect->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('POST')
                                                        <select class="form-select userSelect"
                                                            aria-label="Default select example"
                                                            data-prospect-id="{{ $prospect->id }}"
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
                                                        data-bs-target="#remark-{{ $prospect->id }}">
                                                        Remarque
                                                    </button>
                                                    


                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-info detailButton"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#ModalProspectDetails-{{ $prospect->id }}"
                                                        data-name="{{ $prospect->nom_prospect }}"
                                                        data-email="{{ $prospect->email_prospect }}"
                                                        data-tele="{{ $prospect->tele_prospect }}"
                                                        data-ville="{{ $prospect->ville_prospect }}"
                                                        data-society-name="{{ !empty($prospect->nomSociete_prospect) ? $prospect->nomSociete_prospect : 'Particulier' }}"
                                                        data-remark="{{ $prospect->remark }}"
                                                        data-user="{{ !empty($prospect->utilisateur->name) ? $prospect->utilisateur->name : 'Personne' }}"

                                                        >

                                                        Details
                                                    </button>
                                                </td>

                                            @endif
                                            <form action="{{ route('remark.prospect', $prospect->id) }}"
                                                method="POST">
                                                @csrf
                                                <div class="modal fade" id="remark-{{ $prospect->id }}" tabindex="-1"
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
                                                                    <textarea name="remark" id="remarque" class="form-control" rows="4">{{ old('remark', $prospect->remark) }}</textarea>
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

                                        <div class="modal fade" id="ModalProspectDetails-{{ $prospect->id }}"
                                            tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="show-info-prospect show-society">
                                                            <label class="label-detail-prospect">Nom de la
                                                                société</label>
                                                            <h6 class="info-prospect showSocietyProspect"
                                                                id="showSocietyDetail-{{ $prospect->id }}">
                                                            </h6>
                                                        </div>
                                                     
                                                       
                                                        <div class="show-info-prospect show-name">
                                                            <label class="label-detail-prospect">Personne à
                                                                contacter</label>
                                                            <h6 class="info-prospect showNameProspect"
                                                                id="showNameDetail-{{ $prospect->id }}">
                                                            </h6>
                                                        </div>
                                                        <div class="show-info-prospect show-contact">
                                                            <label class="label-detail-prospect">Numero de telephone</label>
                                                            <h6 class="info-prospect showContactProspect"
                                                                id="showContactDetail-{{ $prospect->id }}">
                                                            </h6>
                                                        </div>
                                                        <div class="show-info-prospect show-email">
                                                            <label class="label-detail-prospect">Email</label>
                                                            <h6 class="info-prospect showEmailProspect"
                                                                id="showEmailDetail-{{ $prospect->id }}">
                                                            </h6>
                                                        </div>

                                                        
                                                        <div class="show-info-prospect show-ville">
                                                            <label class="label-detail-prospect">Ville</label>
                                                            <h6 class="info-prospect showVilleProspect"
                                                                id="showVilleDetail-{{ $prospect->id }}">
                                                            </h6>
                                                        </div>

                                                        <div class="show-info-prospect show-category"
                                                            style="margin-top:10px">
                                                            <label class="label-detail-prospect">Les
                                                                catégories</label>
                                                            <select
                                                                class="form-select form-select-sm info-prospect showCategoryProspect"
                                                                aria-label=".form-select-sm example"
                                                                style="width: 200px; height: 30px"
                                                                id="categories-{{ $prospect->id }}">
                                                                <option value="" selected>Voir
                                                                    la(les)
                                                                    catégories</option>
                                                                @foreach ($prospect->allCategories as $categorie)
                                                                    <option value="{{ $categorie->id }}">
                                                                        {{ $categorie->nom_categorie }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="show-info-prospect show-product"
                                                            style="margin-bottom: 40px; margin-top:10px">
                                                            <label class="form-label label-detail-prospect">Sous-Catégorie</label>
                                                            <select
                                                                class="form-select form-select-sm info-prospect showProductProspect"
                                                                aria-label=".form-select-sm example"
                                                                id="products-{{ $prospect->id }}"
                                                                style="width: 200px; height: 30px">
                                                                <option value="" selected>Voir les
                                                                    produits associés</option>

                                                            </select>
                                                        </div>
                                                        <div class="show-info-prospect show-user">
                                                            <label class="label-detail-prospect">Contacté Par</label>
                                                            <h6 class="info-prospect showUserProspect"
                                                                id="showUserDetail-{{ $prospect->id }}">
                                                            </h6>
                                                        </div>
                                                        <div class="show-info-prospect show-remark">
                                                            <label class="label-detail-prospect">Remarque</label>
                                                            <p class="info-prospect showRemarkProspect"
                                                                id="showRemarkDetail-{{ $prospect->id }}" style="font-size:12px">
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

        @if (isset($prospect))
            <div class="modal fade" id="update_prospect" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('prospect.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" id="updateProspectId">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modifier le tiers</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div>
                                    <label class="form-label">Nom de la
                                        société</label>
                                    <input type="text" class="form-control" name="newNomSociete_prospect"
                                        placeholder="Entrer le nom de la société..." id="updateProspectSociety"
                                        value="{{ old('newNomSociete_prospect', $prospect->nomSociete_prospect) }}" />
                                    @if ($errors->has('newNomSociete_prospect'))
                                        <span class="text-danger">
                                            {{ $errors->first('newNomSociete_prospect') }}</span>
                                    @endif

                                </div>
                              
                               
                                <div>
                                    <label class="form-label">Personne à contacter</label>
                                    <input id="updateProspectName" type="text" class="form-control"
                                        name="newNom_prospect" placeholder="Entrer le prospect..."
                                        value="{{ old('newNom_prospect', $prospect->nom_prospect) }}" />
                                    @if ($errors->has('newNom_prospect'))
                                        <span class="text-danger">
                                            {{ $errors->first('newNom_prospect') }}</span>
                                    @endif

                                </div>
                                <div>
                                    <label class="form-label">Numero de telephone</label>
                                    <input id="updateProspectContact" type="text" class="form-control"
                                        name="newTele_prospect" placeholder="Entrer le contact..."
                                        value="{{ old('newTele_prospect', $prospect->tele_prospect) }}" />
                                    @if ($errors->has('newTele_prospect'))
                                        <span class="text-danger">
                                            {{ $errors->first('newTele_prospect') }}</span>
                                    @endif

                                </div>
                                <div>
                                    <label class="form-label">Email</label>
                                    <input id="updateProspectEmail" type="email" class="form-control"
                                        name="newEmail_prospect" placeholder="Entrer l'émail..."
                                        value="{{ old('newEmail_prospect', $prospect->email_prospect) }}" />
                                    @if ($errors->has('newEmail_prospect'))
                                        <span class="text-danger">
                                            {{ $errors->first('newEmail_prospect') }}</span>
                                    @endif

                                </div>

                         
                                <div>
                                    <label class="form-label">Ville</label>
                                    <input id="updateProspectVille" type="text" class="form-control"
                                        name="newVille_prospect" placeholder="Entrer la ville..."
                                        value="{{ old('newVille_prospect', $prospect->ville_prospect) }}" />
                                    @if ($errors->has('newVille_prospect'))
                                        <span class="text-danger">
                                            {{ $errors->first('newVille_prospect') }}</span>
                                    @endif

                                </div>

                                <div>
                                    <label class="form-label">Catégorie</label>
                                    <select id="updateProspectCategory" class="form-select form-select-sm"
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
            @if ($prospects->total() >= 10)
                <form id="pagination-form" action="{{ route('prospects.pagination') }}" method="GET"
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
                {{ $prospects->links('vendor.pagination.bootstrap-4') }}

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
                const updateProspectModal = document.getElementById('update_prospect');
                updateProspectModal.addEventListener('show.bs.modal', event => {
                    const button = event.relatedTarget;

                    const prospectId = button.getAttribute('data-id');
                    const prospectName = button.getAttribute('data-name');
                    const prospectEmail = button.getAttribute('data-email');
                    const prospectContact = button.getAttribute('data-tele');
                    const prospectAdress = button.getAttribute('data-adress');
                    const prospectVille = button.getAttribute('data-ville');
                    const prospectSociety = button.getAttribute('data-society');
                    const prospectGSM1 = button.getAttribute('data-GSM1');
                    const prospectGSM2 = button.getAttribute('data-GSM2');
                    const prospectCategory = button.getAttribute('data-category')

                    document.getElementById('updateProspectId').value = prospectId;
                    document.getElementById('updateProspectName').value = prospectName;
                    document.getElementById('updateProspectEmail').value = prospectEmail;
                    document.getElementById('updateProspectContact').value = prospectContact;
                    document.getElementById('updateProspectAdress').value = prospectAdress;
                    document.getElementById('updateProspectVille').value = prospectVille;
                    document.getElementById('updateProspectSociety').value = prospectSociety;
                    document.getElementById('updateProspectGSM1').value = prospectGSM1;
                    document.getElementById('updateProspectGSM2').value = prospectGSM2;
                    document.getElementById('updateProspectCategory').value = prospectCategory;


                });
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const selects = document.querySelectorAll('.status-select');
                selects.forEach(select => {
                    select.addEventListener('change', function() {
                        const form = this.closest('.prospect-form');
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
            function confirmDelete(prospectId) {
                Swal.fire({
                    title: 'Supprimer le prospect !',
                    text: "êtes-vous sûr que vous voulez supprimer ce prospect ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    cancelButtonText: 'Annuler',
                    confirmButtonText: 'Oui, Supprimer-le !'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + prospectId).submit();
                    }
                });
            }
        </script>

        <script>
            document.querySelectorAll(`.detailButton`).forEach(button => {

                button.addEventListener('click', function() {
                    const prospectId = this.getAttribute('data-bs-target').split('-').pop();
                    const prospectName = this.getAttribute('data-name')|| 'Non disponible'
                    const prospectEmail = this.getAttribute('data-email')|| 'Non disponible'
                    const prospectContact = this.getAttribute('data-tele')|| 'Non disponible'
                    const prospectAdress = this.getAttribute('data-adress') || 'Non disponible'
                    const prospectVille = this.getAttribute('data-ville')
                    const prospectSociety = this.getAttribute('data-society-name')
                    const prospectGSM1 = this.getAttribute('data-GSM1')
                    const prospectGSM2 = this.getAttribute('data-GSM2')
                    const prospectRemark = this.getAttribute('data-remark')
                    const prospectUser = this.getAttribute('data-user')

                    document.querySelector(`#showNameDetail-${prospectId}`).innerText = prospectName
                    document.querySelector(`#showEmailDetail-${prospectId}`).innerText = prospectEmail
                    document.querySelector(`#showContactDetail-${prospectId}`).innerText = prospectContact
                    document.querySelector(`#showVilleDetail-${prospectId}`).innerText = prospectVille
                    document.querySelector(`#showSocietyDetail-${prospectId}`).innerText = prospectSociety
                    document.querySelector(`#showRemarkDetail-${prospectId}`).innerText = prospectRemark
                    document.querySelector(`#showUserDetail-${prospectId}`).innerText = prospectUser
                })
            });

            document.addEventListener('DOMContentLoaded', function() {

                const categories = @json($categories);
                // console.log(categories);

                document.querySelectorAll('.showCategoryProspect').forEach(selectCategory => {
                    const prospectId = selectCategory.id.split('-').pop();
                    const products = document.getElementById(`products-${prospectId}`);


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
                                    });
                                } else {
                                    const emptyOption = document.createElement('option');
                                    emptyOption.textContent = 'Aucun produit trouvé';
                                    emptyOption.disabled = true;
                                    products.appendChild(emptyOption);
                                }
                            }
                        });
                    }
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
                        fetch(`/search-prospects?search=${searchQuery}`)
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error(`HTTP error! status: ${response.status}`);
                                }
                                return response.json();
                            })
                            .then(data => {
                                console.log(data);
                                const {
                                    prospects,
                                    selectOptions
                                } = data;

                                const tbody = document.querySelector('tbody');
                                tbody.innerHTML = '';

                                prospects.forEach(prospect => {

                                    const categories = prospect.categories || [];

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
                                                          <td>${prospect.nomSociete_prospect || 'Particulier'}</td>
                                                        <td>${prospect.nom_prospect || 'Non disponible'}</td>
                                                        <td>${prospect.tele_prospect || 'Non disponible'}</td>
                                                        <td>${prospect.email_prospect || 'Non disponible'}</td>
                                                        <td>${prospect.ville_prospect}</td>
                                                        <td>${categoriesList}</td>
                                                         <td>${prospect.utilisateur.name || 'Personne'}</td>
                                                        <td>
                                                            <a class="btn btn-primary" data-bs-toggle="modal"
                                                                data-bs-target="#update_prospect"
                                                                data-id="${prospect.id}"
                                                                data-name="${prospect.nom_prospect}"
                                                                data-email="${prospect.email_prospect}"
                                                                data-tele="${prospect.tele_prospect}"
                                                                data-ville="${prospect.ville_prospect}"
                                                                data-society="${prospect.nomSociete_prospect}"
                                                                data-category="${(prospect.categories && prospect.categories.length > 0) ? prospect.categories[0].id : ''}">Modifier
                                                            </a>
                                                        </td>
                                                         <td>
                                                            <button type="button" class="btn btn-info detailButtonQuery"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#QueryProspectDetails"
                                                                data-name="${prospect.nom_prospect}"
                                                                data-email="${prospect.email_prospect}"
                                                                data-contact="${prospect.tele_prospect}"
                                                                data-ville="${prospect.ville_prospect}"
                                                                data-society-name="${prospect.nomSociete_prospect}"
                                                                data-remark="${prospect.remark}"
                                                                data-user="${prospect.utilisateur.name}"
                                                                data-categories="${encodeURIComponent(JSON.stringify(prospect.categories))}"
                                                            >
                                                            Détails
                                                            </button>
                                                        </td>
                                                        <td>
                                                            <a>
                                                                <form
                                                                    action="/prospect/destroy/${prospect.id}"
                                                                    method="POST" style="display: inline;"
                                                                    id="delete-form-${prospect.id }">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button" class="btn btn-danger"
                                                                        onclick="confirmDelete(${prospect.id })">Supprimer</button>
                                                                </form>
                                                            </a>
                                                        </td>
                                                           <td>
                                                                <form class="prospect-form" action="/prospect/select/${prospect.id}" method="POST">
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

                                                         <td>${prospect.nomSociete_prospect || 'Particulier'}</td>
                                                       <td>${prospect.nom_prospect || 'Non disponible'}</td>
                                                        <td>${prospect.tele_prospect || 'Non disponible'}</td>
                                                       <td>${prospect.email_prospect || 'Non disponible'}</td>
                                                        <td>${prospect.ville_prospect}</td>
                                                        <td>${categoriesList}</td>
                                                         <td>${prospect.utilisateur.name || 'Personne'}</td>
                                                        <td>
                                                            <a class="btn btn-primary" data-bs-toggle="modal"
                                                                data-bs-target="#update_prospect"
                                                                data-id="${prospect.id}"
                                                                data-name="${prospect.nom_prospect}"
                                                                data-email="${prospect.email_prospect}"
                                                                data-tele="${prospect.tele_prospect}"
                                                                data-ville="${prospect.ville_prospect}"
                                                                data-society="${prospect.nomSociete_prospect}"
                                                                data-category="${(prospect.categories && prospect.categories.length > 0) ? prospect.categories[0].id : ''}">Modifier
                                                            </a>
                                                        </td>
  <td>
                                                            <button type="button" class="btn btn-info detailButtonQuery"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#QueryProspectDetails"
                                                                data-name="${prospect.nom_prospect}"
                                                                data-email="${prospect.email_prospect}"
                                                                data-contact="${prospect.tele_prospect}"
                                                                data-ville="${prospect.ville_prospect}"
                                                                data-society-name="${prospect.nomSociete_prospect}"
                                                                data-remark="${prospect.remark}"
                                                                data-user="${prospect.utilisateur.name}"
                                                                data-categories="${encodeURIComponent(JSON.stringify(prospect.categories))}"
                                                            >
                                                            Détails
                                                            </button>
                                                        </td>

                                                           <td>
                                                                <form class="prospect-form" action="/prospect/select/${prospect.id}" method="POST">
                                                                    @csrf
                                                                    <select class="form-select status-select" name="status">
                                                                        <option value="" selected>Selectionner la table</option>
                                                                        ${selectOptions.map(option => `
                                                <option value="${option}">${option}</option>
                                            `).join('')}
                                                                    </select>
                                                                </form>
                                                            </td>
                                                        ` : '' } ${role === "utilisateur" ? `
                                                         <td>${prospect.nomSociete_prospect || 'Particulier'}</td>
                                                         <td>${prospect.nom_prospect || 'Non disponible'}</td>
                                                        <td>${prospect.tele_prospect || 'Non disponible'}</td>
                                                        <td>${prospect.email_prospect || 'Non disponible'}</td>
                                                        <td>${prospect.ville_prospect}</td>
                                                        <td>${categoriesList}</td>
                                                         <td>${prospect.utilisateur.name || 'Personne'}</td>
                                                        <td>
                                                            <button type="button" class="btn btn-info detailButtonQuery"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#QueryProspectDetails"
                                                                data-name="${prospect.nom_prospect}"
                                                                data-email="${prospect.email_prospect}"
                                                                data-contact="${prospect.tele_prospect}"
                                                                data-ville="${prospect.ville_prospect}"
                                                                data-society-name="${prospect.nomSociete_prospect}"
                                                                data-remark="${prospect.remark}"
                                                                data-user="${prospect.utilisateur.name}"
                                                                data-categories="${encodeURIComponent(JSON.stringify(prospect.categories))}"
                                                            >
                                                            Détails
                                                            </button>
                                                        </td>
                                                        
                                                        
                                                        ` : ""}

                                `

                                    tbody.appendChild(row);

                                    const selectElement = row.querySelector('.status-select');
if (selectElement) { // Vérifiez que l'élément existe
    selectElement.addEventListener('change', function() {
        const form = this.closest('.prospect-form');
        if (form) {
            form.submit(); // Exécute la logique seulement si l'élément existe
        }
    });
}
                             // Ajouter un événement de détail pour chaque bouton "Détails"
const detailButtonsProspect = document.querySelectorAll('.detailButtonQuery');

if (detailButtonsProspect.length > 0) { // Assurez-vous qu'il y a au moins un bouton
    detailButtonsProspect.forEach(button => {
        button.addEventListener('click', function() {
            // Récupération des données du prospect
            const prospectName = this.getAttribute('data-name') || 'Non disponible';
            const prospectEmail = this.getAttribute('data-email')|| 'Non disponible';
            const prospectContact = this.getAttribute('data-contact') || 'Non disponible';
            const prospectAdress = this.getAttribute('data-adress')|| 'Non disponible';
            const prospectSociety = this.getAttribute('data-society') || 'Particulier';
            const prospectGSM1 = this.getAttribute('data-GSM1') || 'Non disponible';
            const prospectGSM2 = this.getAttribute('data-GSM2') || 'Non disponible';
            const prospectVille = this.getAttribute('data-ville');
            const prospectRemark = this.getAttribute('data-remark');
            const prospectUser = this.getAttribute('data-user')  || 'Personne';

            // Mise à jour des éléments HTML
            const updateTextContent = (selector, text) => {
                const element = document.querySelector(selector);
                if (element) {
                    element.innerText = text ; // Défaut : 'N/A' si la donnée est vide
                }
            };

            updateTextContent('#showNameProspect', prospectName);
            updateTextContent('#showEmailProspect', prospectEmail);
            updateTextContent('#showContactProspect', prospectContact);
            updateTextContent('#showAdressProspect', prospectAdress);
            updateTextContent('#showSocietyProspect', prospectSociety);
            updateTextContent('#showGSM1Prospect', prospectGSM1);
            updateTextContent('#showGSM2Prospect', prospectGSM2);
            updateTextContent('#showVilleProspect', prospectVille);
            updateTextContent('#showRemarkProspect', prospectRemark);
            updateTextContent('#showUserProspect', prospectUser)  ;

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
        <div class="modal fade" id="QueryProspectDetails" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="show-info-prospect show-society">
                            <label class="label-detail-prospect">Nom de la société</label>
                            <h6 class="info-prospect" id="showSocietyProspect">
                            </h6>
                        </div>
                       
                       
                        <div class="show-info-prospect show-name">
                            <label class="label-detail-prospect">Personne à contacter</label>
                            <h6 class="info-prospect" id="showNameProspect"></h6>
                        </div>
                        <div class="show-info-prospect show-contact">
                            <label class="label-detail-prospect">Numero de telephone</label>
                            <h6 class="info-prospect" id="showContactProspect"></h6>
                        </div>
                        <div class="show-info-prospect show-email">
                            <label class="label-detail-prospect">Email</label>
                            <h6 class="info-prospect" id="showEmailProspect">
                            </h6>
                        </div>

                      

                        <div class="show-info-prospect show-ville">
                            <label class="label-detail-prospect">Ville</label>
                            <h6 class="info-prospect" id="showVilleProspect">
                            </h6>
                        </div>
                        <div class="show-info-prospect show-category" style="margin-top:10px">
                            <label class="label-detail-prospect">Les catégories</label>
                            <select class="form-select form-select-sm info-prospect showCategoryProspect"
                                aria-label=".form-select-sm example" style="width: 200px; height: 30px"
                                id="categoriesQuery-1">
                                <option value="" selected>Voir la(les) catégories</option>

                            </select>
                        </div>

                        <div class="show-info-prospect show-product" style="margin-bottom: 40px; margin-top:10px">
                            <label class="form-label label-detail-prospect">Sous-Catégorie</label>
                            <select class="form-select form-select-sm info-prospect showProductProspect"
                                aria-label=".form-select-sm example" id="productsQuery-1"
                                style="width: 200px; height: 30px">

                            </select>
                        </div>
                        <div class="show-info-prospect show-user">
                            <label class="label-detail-prospect">Contacté Par</label>
                            <h6 class="info-prospect" id="showUserProspect">
                            </h6>
                        </div>
                        <div class="show-info-prospect show-remark">
                            <label class="label-detail-prospect">Remarque</label>
                            <p class="info-prospect" id="showRemarkProspect" style="font-size: 12px">
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
