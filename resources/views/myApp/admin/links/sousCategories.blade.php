@extends('myApp.admin.adminLayout.adminPage')
@section('title')
    Les sous-catégories
@endsection

@section('errorContent')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var modalType = document.getElementById('update_add_modals').getAttribute('data-error')

            if (modalType === 'default') {
                var addModal = new bootstrap.Modal(document.getElementById('ModalAddProduct'))
                addModal.show();
            } else if (modalType === 'update') {
                var updateModal = new bootstrap.Modal(document.getElementById('updateProductModal'))
                updateModal.show();
            }
        })
    </script>
@endsection
@section('content')
    <div>
        <div id="update_add_modals" style="display: none" data-error="{{ session('modalType') }}">

        </div>
        <form action="/addSousCategory" method="POST">
            @csrf
            <div class="modal fade" id="ModalAddProduct" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ajouter un produit</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="form-label">Nom de la sous-catégorie</label>
                                <input type="text" class="form-control" name="nom_produit"
                                    placeholder="Entrer la sous-catégorie" value="{{ old('nom_produit') }}" />
                                @error('nom_produit', 'default')
                                    <span class="text-danger">{{ $message }}</span> <br>
                                @enderror


                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Entrer une description"
                                        name="texte">{{ old('texte') }}</textarea>
                                    @error('texte', 'default')
                                        <span class="text-danger">{{ $message }}</span> <br>
                                    @enderror
                                </div>


                                <label style="margin-left: 5px; font-size:40px; font-weight:bold; color:rgb(122, 118, 118)">
                                    Catégorie</label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    name="categorie_id" style="height: 39px">
                                    <option value="">Selectionner la catégorie</option>
                                    @foreach ($categories as $categorie)
                                        <option value="{{ $categorie->id }}"
                                            {{ old('categorie_id') == $categorie->id ? 'selected' : '' }}>
                                            {{ $categorie->nom_categorie }}</option>
                                    @endforeach
                                </select>
                                @error('categorie_id', 'default')
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

        <!---->


        <div class="page-inner">
            @if (auth()->user()->role == 'super-admin')
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalAddProduct">
                    Ajouter les sous-catégories
                </button>

                <a href="{{ route('sousCategories.pdf') }}" class="btn btn-primary" style="margin-left: 935px">
                    <i class="fas fa-file-pdf"></i>
                </a>
            @elseif (auth()->user()->role == 'admin')
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalAddProduct">
                    Ajouter les sous-catégories
                </button>

                <a href="{{ route('sousCategories.pdf') }}" class="btn btn-primary" style="margin-left: 935px">
                    <i class="fas fa-file-pdf"></i>
                </a>
            @endif


            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Les sous-catégories</h4>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nom du produit</th>

                                            <th>Catégorie</th>
                                            

                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($getSousCategories as $sousCategorie)
                                            <tr>
                                                <td>{{ $sousCategorie->nom_produit }}</td>

                                                <td>{{ $sousCategorie->categorie->nom_categorie }}</td>
                                                @if (auth()->user()->role == 'super-admin')
                                                    <td>
                                                        <a class="btn btn-primary" data-bs-toggle="modal"
                                                            data-bs-target="#updateProductModal"
                                                            data-id={{ $sousCategorie->id }}
                                                            data-name={{ $sousCategorie->nom_produit }}
                                                            data-texte={{ $sousCategorie->texte }}
                                                            data-categorie_id={{ $sousCategorie->categorie_id }}>Modifier</a>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-info detailButton"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#ModalProductDetail-{{ $sousCategorie->id }}"
                                                            data-name="{{ $sousCategorie->nom_produit }}"
                                                            data-category="{{ $sousCategorie->categorie->nom_categorie }}"
                                                            data-texte = "{{ $sousCategorie->texte }}">
                                                            Details
                                                        </button>
                                                    </td>
                                                    <td>
                                                        <a>
                                                            <form
                                                                action="{{ route('product.destroy', $sousCategorie->id) }}"
                                                                method="POST" style="display: inline;"
                                                                id="delete-form-{{ $sousCategorie->id }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" class="btn btn-danger"
                                                                    onclick="confirmDelete({{ $sousCategorie->id }})">Supprimer</button>
                                                            </form>
                                                        </a>
                                                    </td>
                                                @elseif (auth()->user()->role == 'admin')
                                                    <td>
                                                        <a class="btn btn-primary" data-bs-toggle="modal"
                                                            data-bs-target="#updateProductModal"
                                                            data-id={{ $sousCategorie->id }}
                                                            data-name={{ $sousCategorie->nom_produit }}
                                                            data-texte={{ $sousCategorie->texte }}
                                                            data-categorie_id={{ $sousCategorie->categorie_id }}>Modifier</a>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-info detailButton"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#ModalProductDetail-{{ $sousCategorie->id }}"
                                                            data-name="{{ $sousCategorie->nom_produit }}"
                                                            data-category="{{ $sousCategorie->categorie->nom_categorie }}"
                                                            data-texte = "{{ $sousCategorie->texte }}">
                                                            Details
                                                        </button>
                                                    </td>
                                                @elseif (auth()->user()->role == 'utilisateur')
                                                <td>
                                                    <button type="button" class="btn btn-info detailButton"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#ModalProductDetail-{{ $sousCategorie->id }}"
                                                        data-name="{{ $sousCategorie->nom_produit }}"
                                                        data-category="{{ $sousCategorie->categorie->nom_categorie }}"
                                                        data-texte = "{{ $sousCategorie->texte }}">
                                                        Details
                                                    </button>
                                                </td>
                                                @endif

                                                <div class="modal fade" id="ModalProductDetail-{{ $sousCategorie->id }}"
                                                    tabindex="-1" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">

                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="show-info-product ">
                                                                    <label class="label-detail-product">Produit</label>
                                                                    <h6 class="info-product showProduct"
                                                                        id="showProduct-{{ $sousCategorie->id }}">
                                                                    </h6>
                                                                </div>
                                                                <div class="show-info-product ">
                                                                    <label class="label-detail-product">Description</label>
                                                                    <h6 class="info-text showTextProduct"
                                                                        id="showText-{{ $sousCategorie->id }}">
                                                                    </h6>
                                                                </div>
                                                                <div class="show-info-product ">
                                                                    <label class="label-detail-product">Catégorie</label>
                                                                    <h6 class="info-product showCategoryProduct"
                                                                        id="showCategory-{{ $sousCategorie->id }}">
                                                                    </h6>
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



            <div class="modal fade" id="updateProductModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="/updateProduct" method="POST">
                            @csrf
                            <input type="hidden" name="id" id="updateProductId">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modifier le produit</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label class="form-label">Nom de la sous-catégorie</label>
                                    <input type="text" class="form-control" name="newNom_produit"
                                        id="updateProductName" placeholder="Entrer la sous-catégorie"
                                        value="{{ old('newNom_produit') }}" />
                                    @if ($errors->has('newNom_produit'))
                                        <span class="text-danger">{{ $errors->first('newNom_produit') }}</span>
                                    @endif

                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control" id="updateProductText" placeholder="Entrer une description" name="newTexte">{{ old('newTexte', htmlspecialchars($sousCategorie->texte)) }} </textarea>
                                        @if ($errors->has('newTexte'))
                                            <span class="text-danger">{{ $errors->first('newTexte') }}</span>
                                        @endif
                                    </div>


                                    <label
                                        style="margin-left: 5px; font-size:40px; font-weight:bold; color:rgb(122, 118, 118)">Catégorie</label>
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                        name="newCategorie_id" id="updateProductCategoryId" style="height: 39px">
                                        <option value="">Selectionner la catégorie</option>
                                        @foreach ($categories as $categorie)
                                            <option value="{{ $categorie->id }}"
                                                {{ old('newCategorie_id') == $categorie->id ? 'selected' : '' }}>
                                                {{ $categorie->nom_categorie }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('newCategorie_id'))
                                        <span class="text-danger">{{ $errors->first('newCategorie_id') }}</span> <br>
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
            <div class="d-flex justify-content-between align-items-center">
                @if ($getSousCategories->total() >= 10)
                   <form id="pagination-form" action="{{ route('sousCategories.pagination') }}" method="GET"
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
            {{ $getSousCategories->links('vendor.pagination.bootstrap-4') }}

           </div>
        </div>
    @endsection
    @section('content2')
        <div class="modal fade" id="QueryModalProductDetail" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="show-info-product ">
                            <label class="label-detail-product">Produit</label>
                            <h6 class="info-product" id="showProduct">
                            </h6>
                        </div>
                        <div class="show-info-product ">
                            <label class="label-detail-product">Description</label>
                            <h6 class="info-product" id="showTextProduct">
                            </h6>
                        </div>
                        <div class="show-info-product ">
                            <label class="label-detail-product">Catégorie</label>
                            <h6 class="info-product" id="showCategoryProduct">
                            </h6>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-bs-dismiss="modal">Fermer</button>
                    </div>
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
            document.addEventListener(("DOMContentLoaded"), function() {
                const updateProductModal = document.getElementById('updateProductModal');
                updateProductModal.addEventListener('show.bs.modal', event => {
                    const button = event.relatedTarget;
                    const productId = button.getAttribute('data-id');
                    const productName = button.getAttribute('data-name');
                    const productTexte = button.getAttribute('data-texte');
                    const productCategorieId = button.getAttribute('data-categorie_id')

                    document.getElementById('updateProductId').value = productId;
                    document.getElementById('updateProductName').value = productName;
                    document.getElementById('updateProductText').value = productTexte;
                    document.getElementById('updateProductCategoryId').value = productCategorieId;
                })

            })
        </script>

        <script>
            function confirmDelete(productId) {
                Swal.fire({
                    title: 'Supprimer ce produit !',
                    text: "êtes-vous sûr que vous voulez supprimer ce produit ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    cancelButtonText: 'Annuler',
                    confirmButtonText: 'Oui, Supprimer-le !'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + productId).submit();
                    }
                });
            }
        </script>

        <script>
            document.querySelectorAll('.detailButton').forEach(button => {
                button.addEventListener('click', function() {

                    const productId = this.getAttribute('data-bs-target').split('-').pop();
                    const productName = this.getAttribute('data-name')
                    const categoryName = this.getAttribute('data-category')
                    const productText = this.getAttribute('data-texte')

                    document.querySelector(`#showProduct-${productId}`).innerText = productName
                    document.querySelector(`#showText-${productId}`).innerText = productText
                    document.querySelector(`#showCategory-${productId}`).innerText = categoryName
                })

            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const searchInput = document.getElementById('search')

                searchInput.addEventListener('keydown', function(event) {
                    if (event.key === 'Enter') {
                        event.preventDefault();
                    }
                });

                const tbody = document.querySelector('tbody')

                searchInput.addEventListener('input', function() {
                    const inputValue = searchInput.value

                    if (inputValue.length > 0) {
                        fetch(`/search-products?search=${inputValue}`)
                            .then(response => response.json())
                            .then(data => {

                                console.log(data)
                                tbody.innerHTML = ''




                                data.forEach(product => {

                                    const row = document.createElement('tr')
                                    const role = "{{ auth()->user()->role }}"

                                    row.innerHTML = `

                                                    <td>${product.nom_produit }</td>

                                                    <td>${product.categorie.nom_categorie }</td>
                                                    ${role === "super-admin" ? `
                                                                                    <td>
                                                                                        <a class="btn btn-primary" data-bs-toggle="modal"
                                                                                            data-bs-target="#updateProductModal"
                                                                                            data-id=${product.id }
                                                                                            data-name=${product.nom_produit }
                                                                                            data-texte=${product.texte }
                                                                                            data-categorie_id=${product.categorie_id }>Modifier</a>
                                                                                    </td>
                                                                                     <td>
                                                                                        <!-- Button trigger modal -->
                                                                                        <button type="button" class="btn btn-info detailButton"
                                                                                            data-bs-toggle="modal"
                                                                                            data-bs-target="#QueryModalProductDetail"
                                                                                            data-name="${product.nom_produit }"
                                                                                            data-category="${product.categorie.nom_categorie }"
                                                                                            data-texte="${product.texte }"
                                                                                            data-supplier="${product.categorie.fournisseurs.nom_fournisseur }"
                                                                                            >
                                                                                            Details
                                                                                        </button>
                                                                                    </td>
                                                                                    <td>
                                                                                        <a>
                                                                                            <form
                                                                                                action="/product/destroy/${product.id}"
                                                                                                method="POST" style="display: inline;"
                                                                                                id="delete-form-${product.id }">
                                                                                                @csrf
                                                                                                @method('DELETE')
                                                                                                <button type="button" class="btn btn-danger"
                                                                                                    onclick="confirmDelete(${product.id })">Supprimer</button>
                                                                                            </form>
                                                                                        </a>
                                                                                    </td>

                                                                                    ` : ""
                                                     }
                                                    ${role == 'admin' ?
                                                    `
                                                                                    <td>
                                                                                        <a class="btn btn-primary" data-bs-toggle="modal"
                                                                                            data-bs-target="#updateProductModal"
                                                                                            data-id=${product.id }
                                                                                            data-name=${product.nom_produit }
                                                                                            data-texte=${product.texte }
                                                                                            data-categorie_id=${product.categorie_id }>Modifier</a>
                                                                                    </td>
                                                                                     <td>
                                                                                        <!-- Button trigger modal -->
                                                                                        <button type="button" class="btn btn-info detailButton"
                                                                                            data-bs-toggle="modal"
                                                                                            data-bs-target="#QueryModalProductDetail"
                                                                                            data-name="${product.nom_produit }"
                                                                                            data-category="${product.categorie.nom_categorie }"
                                                                                            data-supplier="${product.categorie.fournisseurs.nom_fournisseur }"
                                                                                            data-texte="${product.texte }">
                                                                                            Details
                                                                                        </button>
                                                                                    </td>


                                                                                    ` : ""

                                                    }${role == 'utilisateur' ? `

                                                     <td>
                                                                                        
                                                                                        <button type="button" class="btn btn-info detailButton"
                                                                                            data-bs-toggle="modal"
                                                                                            data-bs-target="#QueryModalProductDetail"
                                                                                            data-name="${product.nom_produit }"
                                                                                            data-category="${product.categorie.nom_categorie }"
                                                                                            data-supplier="${product.categorie.fournisseurs.nom_fournisseur }"
                                                                                            data-texte="${product.texte }">
                                                                                            Details
                                                                                        </button>
                                                                                    </td>
                                                    
                                                    
                                                    
                                                    `: ""}



                                            `
                                    tbody.appendChild(row)


                                })

                                document.querySelectorAll('.detailButton').forEach(button => {
                                    button.addEventListener('click', function() {

                                        const productName = this.getAttribute('data-name')
                                        const productText = this.getAttribute('data-texte')
                                        const productCategory = this.getAttribute(
                                            'data-category')

                                        document.getElementById('showProduct').innerText =
                                            productName
                                        document.getElementById('showTextProduct')
                                            .innerText = productText
                                        document.getElementById('showCategoryProduct')
                                            .innerText = productCategory

                                    })
                                })
                            }).catch(error => {
                                console.error('error fetching products : ', error);

                            })

                    } else {
                        location.reload()
                    };

                })


            })
        </script>
    @endsection
