@extends('myApp.admin.adminLayout.adminPage')
@section('title')
Les catégories
@endsection
@section('search-bar')
    <form action="{{ route('search.categories') }}" method="GET">
        <div class="input-group-prepend input-group">
            <button type="button" class="btn btn-search pe-1">
                <i class="fa fa-search search-icon" id="fa-search"></i>
            </button>

            <input type="text" placeholder="Search ..." class="form-control" name="search" />

        </div>

    </form>
@endsection
@section('errorContent')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var modalType = document.getElementById('modals').getAttribute('data-error');

            if (modalType === 'update') {
                var updateModal = new bootstrap.Modal(document.getElementById('updateCategoryModal'));
                updateModal.show();
            } else if (modalType === 'default') {
                var addModal = new bootstrap.Modal(document.getElementById('ModalAddCategory'));
                addModal.show();
            }
        });
    </script>
@endsection
@section('content')
    <div>
        <div id="modals" style="display:none;" data-error="{{ session('modalType') }}"></div>
        <!-- Modal -->
        <form action="/addCategory" method="POST">
            @csrf
            <div class="modal fade" id="ModalAddCategory" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ajouter une catégorie</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="form-label">Nom de la catégorie</label>
                                <input type="text" class="form-control" name="nom_categorie"
                                    placeholder="Entrer la catégorie" value="{{ old('nom_categorie') }}" />
                                @error('nom_categorie', 'default')
                                    <span class="text-danger">{{ $message }}</span> <br>
                                @enderror




                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary" data-bs-dismiss="modal" value="Ajouter">
                        </div>
                    </div>
                </div>
            </div>

        </form>


        <div class="page-inner">
            @if (auth()->user()->role == 'super-admin')
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalAddCategory">
                    Ajouter la catégorie
                </button>
                <a href="{{ route('categories.pdf') }}" class="btn btn-primary" style="margin-left: 986px">
                    <i class="fas fa-file-pdf"></i>
                </a>
            @elseif (auth()->user()->role == 'admin')
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalAddCategory">
                    Ajouter la catégorie
                </button>
                <a href="{{ route('categories.pdf') }}" class="btn btn-primary" style="margin-left: 986px">
                    <i class="fas fa-file-pdf"></i>
                </a>
            @endif


            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Les catégories</h4>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>

                                            <th>Nom de la catégorie</th>
                                           

                                            
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($categories as $categorie)
                                            <tr>
                                                <td>{{ $categorie->nom_categorie }}</td>

                                                @if (auth()->user()->role == 'super-admin')
                                                    <td>
                                                        <a class="btn btn-primary" data-bs-toggle="modal"
                                                            data-bs-target="#updateCategoryModal"
                                                            data-id={{ $categorie->id }}
                                                            data-name={{ $categorie->nom_categorie }}>
                                                            Modifier</a>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-info detailButton"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#ModalCategoryDetail-{{ $categorie->id }}"
                                                            data-name="{{ $categorie->nom_categorie }}">
                                                            Details
                                                        </button>
                                                    </td>
                                                    <td>
                                                        <a href="#">
                                                            <form action="{{ route('category.destroy', $categorie->id) }}"
                                                                method="POST" style="display: inline;"
                                                                id="delete-form-{{ $categorie->id }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" class="btn btn-danger"
                                                                    onclick="confirmDelete({{ $categorie->id }})">Supprimer</button>
                                                            </form>

                                                        </a>
                                                    </td>
                                                @elseif (auth()->user()->role == 'admin')
                                                    <td>
                                                        <a class="btn btn-primary" data-bs-toggle="modal"
                                                            data-bs-target="#updateCategoryModal"
                                                            data-id={{ $categorie->id }}
                                                            data-name={{ $categorie->nom_categorie }}>
                                                            Modifier</a>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-info detailButton"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#ModalCategoryDetail-{{ $categorie->id }}"
                                                            data-name="{{ $categorie->nom_categorie }}">
                                                            Details
                                                        </button>
                                                    </td>
                                                @elseif (auth()->user()->role == 'utilisateur')
                                                <td>
                                                    <button type="button" class="btn btn-info detailButton"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#ModalCategoryDetail-{{ $categorie->id }}"
                                                        data-name="{{ $categorie->nom_categorie }}">
                                                        Details
                                                    </button>
                                                </td>
                                                @endif


                                                <div class="modal fade" id="ModalCategoryDetail-{{ $categorie->id }}"
                                                    tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">


                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="show-info-category show-category">
                                                                    <label class="label-detail-category">Catégorie</label>
                                                                    <h6 class="info-category showCategory"
                                                                        id="showCategory-{{ $categorie->id }}">
                                                                    </h6>
                                                                </div>

                                                                <div class="show-info-category show-product">
                                                                    <label class="label-detail-category">Les
                                                                        produits</label>
                                                                    <select
                                                                        class="form-select form-select-sm info-category showProductCategory"
                                                                        aria-label=".form-select-sm example"
                                                                        style="width: 200px; height: 30px">
                                                                        <option selected>Voir les produits associés
                                                                        </option>
                                                                        @foreach ($categorie->sousCategories as $product)
                                                                            <option disabled>
                                                                                {{ $product->nom_produit }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>


                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-info"
                                                                    data-bs-dismiss="modal">Fermer</button>

                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>


                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="updateCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="/updateCategory" method="POST">
                            @csrf
                            <input type="hidden" name="id" id="updateCategorieId">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modifier la catégorie</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <div>
                                        <label class="form-label">Nom de la catégorie</label>
                                        <input type="text" class="form-control" id="updateCategoryName"
                                            name="newNom_categorie" placeholder="Entrer la catégorie" />
                                        @if ($errors->has('newNom_categorie'))
                                            <span class="text-danger">
                                                {{ $errors->first('newNom_categorie') }}</span>
                                        @endif

                                    </div>





                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-primary" data-bs-dismiss="modal" value="Ajouter">
                            </div>
                        </form>
                    </div>

                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                @if ($categories->total() >= 10)
                   <form id="pagination-form" action="{{ route('categories.pagination') }}" method="GET"
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
            {{ $categories->links('vendor.pagination.bootstrap-4') }}

           </div>
        </div>
    @endsection
    @section('content2')
        <div class="modal fade" id="QueryModalCategoryDetail" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="show-info-category show-category">
                            <label class="label-detail-category">Catégorie</label>
                            <h6 class="info-category" id="showCategory">
                            </h6>
                        </div>

                        <div class="show-info-category show-product-category">
                            <label class="label-detail-category">Les produits</label>
                            <select class="form-select form-select-sm info-category" aria-label=".form-select-sm example"
                                id="showProductsCategory" style="width: 200px; height: 30px">
                                <option selected>Voir les produits associés</option>

                            </select>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-bs-dismiss="modal">Fermer</button>

                    </div>
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
                    const updateCategoryModal = document.getElementById('updateCategoryModal');
                    updateCategoryModal.addEventListener('show.bs.modal', event => {
                        const button = event.relatedTarget;
                        const categorieId = button.getAttribute('data-id');
                        const categorieName = button.getAttribute('data-name');
                        const categorieFournisseurId = button.getAttribute('data-fournisseur_id');

                        document.getElementById('updateCategorieId').value = categorieId;
                        document.getElementById('updateCategoryName').value = categorieName;
                        document.getElementById('updateCategorySupplierId').value = categorieFournisseurId;
                    })

                })
            </script>
            <script>
                function confirmDelete(categoryId) {
                    Swal.fire({
                        title: 'Supprimer la catégorie !',
                        text: "êtes-vous sûr que vous voulez supprimer cette catégorie ?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        cancelButtonText: 'Annuler',
                        confirmButtonText: 'Oui, Supprimer !'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('delete-form-' + categoryId).submit();
                        }
                    });
                }
            </script>
            <script>
                document.querySelectorAll('.detailButton').forEach(button => {
                    button.addEventListener('click', function() {

                        const categoryId = this.getAttribute('data-bs-target').split('-').pop();
                        const categoryName = this.getAttribute('data-name')
                        const supplierName = this.getAttribute('data-supplier')

                        document.querySelector(`#showCategory-${categoryId}`).innerText = categoryName
                        document.querySelector(`#showSupplier-${categoryId}`).innerText = supplierName
                    })

                });
            </script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const searchInput = document.querySelector('input[name="search"]');

                    searchInput.addEventListener('keydown', function(event) {
                        if (event.key === 'Enter') {
                            event.preventDefault();
                        }
                    });

                    const tbody = document.querySelector('tbody');

                    searchInput.addEventListener('input', function() {
                        const inputValue = searchInput.value;

                        if (inputValue.length > 0) {
                            fetch(`/search-categories?search=${inputValue}`)
                                .then(response => response.json())
                                .then(data => {
                                    console.log(data);
                                    tbody.innerHTML = '';


                                    data.forEach(category => {
                                        console.log(category)

                                        let products = 'Pas de produit associé';

                                        if (category.sous_categories && category.sous_categories
                                            .length > 0) {
                                            products = category.sous_categories.map(product => product
                                                .nom_produit).join(', ');
                                        }


                                        const row = document.createElement('tr');
                                        const role = "{{ auth()->user()->role }}"
                                        row.innerHTML = `

                                                <td>${category.nom_categorie}</td>
                                                 ${role === "super-admin" ? `
                                                 <td>
                                                <a class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#updateCategoryModal"
                                                    data-id="${category.id}"
                                                     data-name="${category.nom_categorie}"
                                                   >Modifier
                                                </a>
                                                </td>
                                                <td>
                                                <button type="button" class="btn btn-info "
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#QueryModalCategoryDetail"
                                                        data-name="${category.nom_categorie}"
                                                        data-product="${products}">
                                                        Details
                                                </button>
                                                </td>
                                                <td>
                                                <form action="/category/destroy/${category.id}"
                                                    method="POST" style="display: inline;"
                                                    id="delete-form-${category.id}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger"
                                                        onclick="confirmDelete(${category.id})">Supprimer</button>
                                                </form>
                                                </td>


                                                ` : ""
                                                     }
                                                    ${role == 'admin' ?
                                                    `
                                                <td>
                                                <a class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#updateCategoryModal"
                                                    data-id="${category.id}"
                                                     data-name="${category.nom_categorie}"
                                                   >Modifier
                                                </a>
                                                </td>
                                                <td>
                                                <button type="button" class="btn btn-info "
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#QueryModalCategoryDetail"
                                                        data-name="${category.nom_categorie}"
                                                        data-product="${products}">
                                                        Details
                                                </button>
                                                </td>


                                               ` : ""

                                                    }  ${role == 'utilisateur' ?  `
                                                      <td>
                                                <button type="button" class="btn btn-info "
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#QueryModalCategoryDetail"
                                                        data-name="${category.nom_categorie}"
                                                        data-product="${products}">
                                                        Details
                                                </button>
                                                </td>

                                                      
                                                    ` : ""}
                                            `

                                        ;
                                        tbody.appendChild(row);
                                    });

                                    document.querySelectorAll('button[data-bs-toggle="modal"]').forEach(
                                        button => {
                                            button.addEventListener('click', function() {

                                                const categoryName = this.getAttribute('data-name');

                                                const products = this.getAttribute('data-product');

                                                document.getElementById(
                                                        `showCategory`).innerText =
                                                    categoryName;

                                                const productsList = document.getElementById(
                                                    `showProductsCategory`)


                                                // productsList.innerHTML = '';

                                                products.split(', ').forEach(product => {
                                                    const option = document.createElement(
                                                        'option');
                                                    option.textContent = product;
                                                    option.disabled = true;
                                                    productsList.appendChild(option);
                                                });
                                            })
                                        })

                                })
                                .catch(error => {
                                    console.error('Error fetching categories:', error);
                                });
                        } else {

                            location.reload();
                        }
                    });
                });
            </script>
        @endsection
