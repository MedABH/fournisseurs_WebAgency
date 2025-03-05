@extends('myApp.admin.adminLayout.adminPage')
@section('search-bar')
    <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
            <h1 class="app-page-title mb-0">Les Categories</h1>
        </div>
        <div class="col-auto">
            <div class="page-utilities">
                <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                    <div class="col-auto">
                        @if (auth()->user()->role == 'super-admin')
                            <a class="btn app-btn-secondary" href="{{ route('categories.pdf') }}">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download me-1"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                    <path fill-rule="evenodd"
                                        d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                                </svg>

                            </a>
                        @elseif (auth()->user()->role == 'admin')
                            <a href="{{ route('categories.pdf') }}" class="btn btn-primary" style="margin-left:996px">
                                <i class="fas fa-file-pdf"></i>
                            </a>

                            <a class="btn app-btn-secondary" href="{{ route('categories.pdf') }}">
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
    <a href="#" class="flex-sm-fill text-sm-center nav-link active">Les Categories</a>
    <a href="/productsSection" class="flex-sm-fill text-sm-center nav-link">Les Sous-Categories</a>
</nav>
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
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ajouter une catégorie</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="form-label"><strong class="det">Nom de la catégorie</strong></label>
                                <input type="text" class="form-control" name="nom_categorie"
                                    placeholder="Entrer la catégorie" value="{{ old('nom_categorie') }}" />
                                @error('nom_categorie', 'default')
                                    <span class="text-danger">{{ $message }}</span> <br>
                                @enderror

                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-success" data-bs-dismiss="modal" value="Ajouter">
                        </div>
                    </div>
                </div>
            </div>
        </form>


        <div class="page-inner">


            <div class="tab-content" id="orders-table-tab-content">
                    <div class="app-card app-card-orders-table shadow-sm mb-5">
                        <div class="app-card-body">
                            <div class="table-responsive">
                                <table class="table app-table-hover mb-0 text-left">
                                    <thead>
                                        <tr>
                                            <th class="cell">Nom de la catégorie</th>
                                            <th class="cell text-end">
                                                @if (auth()->user()->role == 'super-admin')
                                                <button type="button" class="btn app-btn-secondary" data-bs-toggle="modal"
                                                    data-bs-target="#ModalAddCategory">
                                                    Ajouter
                                                </button>
                                                @elseif (auth()->user()->role == 'admin')
                                                <button type="button" class="btn app-btn-secondary" data-bs-toggle="modal"
                                                    data-bs-target="#ModalAddCategory">
                                                    Ajouter
                                                </button>
                                                @endif
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($categories as $categorie)
                                            <tr>
                                                <td class="cell">{{ $categorie->nom_categorie }}</td>

                                                @if (auth()->user()->role == 'super-admin')
                                                <td>
                                                    <button type="button" class="btn btn-outline-primary border-btn me-5" data-bs-toggle="modal" data-bs-target="#updateCategoryModal" data-id={{ $categorie->id }} data-name={{ $categorie->nom_categorie }}>
                                                        Modifier</button>
                                        
                                                    <button type="button" class="btn btn-outline-info border-btn me-5 detailButton" data-bs-toggle="modal"
                                                        data-bs-target="#ModalCategoryDetail-{{ $categorie->id }}" data-name="{{ $categorie->nom_categorie }}">
                                                        Details
                                                    </button>
                                        
                                                    
                                                        <form action="{{ route('category.destroy', $categorie->id) }}" method="POST" style="display: inline; border-radius: 1cap; border-style: inherit; color: transparent;"
                                                            id="delete-form-{{ $categorie->id }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-outline-danger border-btn"
                                                                onclick="confirmDelete({{ $categorie->id }})">Supprimer</button>
                                                        </form>
                                        
                                                    
                                                </td>
                                                @elseif (auth()->user()->role == 'admin')
                                                    <td>
                                                        <button type="button" class="btn btn-outline-primary border-btn me-5" data-bs-toggle="modal"
                                                            data-bs-target="#updateCategoryModal"
                                                            data-id={{ $categorie->id }}
                                                            data-name={{ $categorie->nom_categorie }}>
                                                            Modifier</button>
                                                   
                                                        <button type="button" class="btn btn-outline-info border-btn me-5 detailButton"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#ModalCategoryDetail-{{ $categorie->id }}"
                                                            data-name="{{ $categorie->nom_categorie }}">
                                                            Details
                                                        </button>
                                                    
                                                        @elseif (auth()->user()->role == 'utilisateur')
                                                        
                                                            <button type="button" class="btn btn-outline-info border-btn me-5 detailButton"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#ModalCategoryDetail-{{ $categorie->id }}"
                                                                data-name="{{ $categorie->nom_categorie }}">
                                                                Details
                                                            </button>
                                                </td>
                                                @endif


                                                <div class="modal fade" id="ModalCategoryDetail-{{ $categorie->id }}" tabindex="-1"
                                                    aria-labelledby="detailsCategoryLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="detailsCategoryLabel">Catégorie</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                
                                                            <div class="modal-body">
                                                                <div class="mb-3 show-info-category show-category">
                                                                    <strong class="det">Catégorie :</strong><span id="showCategory-{{ $categorie->id }}">
                                                                        PLOMBERIE - DROGUERIE (GROS)</span>
                                                                </div>
                                                                <div class="d-flex align-items-center mb-3 show-info-category show-product">
                                                                    <label class="form-label info-category showProductCategory"><strong class="det">Les
                                                                            produits :</strong></label>
                                                                    <select id="productSelect" class="form-select" style="color: #5d6778;">
                                                                        <option>Voir les produits associés</option>
                                                                        @foreach ($categorie->sousCategories as $product)
                                                                        <option disabled>
                                                                            {{ $product->nom_produit }}
                                                                        </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
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
                <div class="modal-dialog modal-dialog-centered">
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
                                        <label class="det">Nom de la catégorie</label>
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
            <div class="modal-dialog modal-dialog-centered">
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
                                                        <button type="button" class="btn btn-outline-primary border-btn me-5" data-bs-toggle="modal"
                                                            data-bs-target="#updateCategoryModal"
                                                            data-id="${category.id}"
                                                            data-name="${category.nom_categorie}"
                                                        >Modifier
                                                        </button>
                                                        
                                                        <button type="button" class="btn btn-outline-info border-btn me-5 "
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#QueryModalCategoryDetail"
                                                                data-name="${category.nom_categorie}"
                                                                data-product="${products}">
                                                                Details
                                                        </button>
                                                        
                                                        <form action="/category/destroy/${category.id}"
                                                            method="POST" style="display: inline;"
                                                            id="delete-form-${category.id}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-outline-danger border-btn"
                                                                onclick="confirmDelete(${category.id})">Supprimer</button>
                                                        </form>
                                                </td>


                                                ` : ""
                                                     }
                                                    ${role == 'admin' ?
                                                    `
                                                <td>
                                                        <button type="button" class="btn btn-outline-primary border-btn me-5" data-bs-toggle="modal"
                                                            data-bs-target="#updateCategoryModal"
                                                            data-id="${category.id}"
                                                            data-name="${category.nom_categorie}"
                                                        >Modifier
                                                        </button>
                                                        
                                                        <button type="button" class="btn btn-outline-info border-btn me-5 "
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
                                                            <button type="button" class="btn btn-outline-info border-btn me-5 "
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
