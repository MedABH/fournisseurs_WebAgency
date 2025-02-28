   @extends('myApp.admin.adminLayout.adminPage')

   @section('title')
       Les utilisateurs
   @endsection

   
   @section('errorContent')
       <script>
           document.addEventListener("DOMContentLoaded", function() {
               var modalType = document.getElementById('modals').getAttribute('data-error');

               if (modalType === 'update') {
                   var updateModal = new bootstrap.Modal(document.getElementById('updateUserModal'));
                   updateModal.show();
               } else if (modalType === 'default') {
                   var addModal = new bootstrap.Modal(document.getElementById('ModalAddUser'));
                   addModal.show();
               }
           });
       </script>
   @endsection
   @section('content')
       <div id="modals" style="display:none;" data-error="{{ session('modalType') }}"></div>


       <div>
           <form action="/addUser" method="POST">
               @csrf
               <div class="modal fade" id="ModalAddUser" tabindex="-1" aria-labelledby="ModalAddUserLabel"
                   aria-hidden="true">
                   <div class="modal-dialog">
                       <div class="modal-content">
                           <div class="modal-header">
                               <h5 class="modal-title" id="exampleModalLabel">Ajouter un utilisateur</h5>
                               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                           </div>
                           <div class="modal-body">
                               <div class="form-group">
                                   <label class="form-label">Nom</label>
                                   <input type="text" class="form-control " name="name" placeholder="Entrer le nom..."
                                       value="{{ old('name') }}">
                                   @error('name', 'default')
                                       <span class="text-danger">{{ $message }}</span> <br>
                                   @enderror
                                   <label class="form-label">Email</label>
                                   <input type="email" class="form-control " name="email"
                                       placeholder="Entrer l'émail..." value="{{ old('email') }}" />
                                   @error('email', 'default')
                                       <span class="text-danger">{{ $message }}</span> <br>
                                   @enderror

                                   <label class="col-sm-1 col-form-label form-label">Mot de passe</label>
                                   <input type="password" class="form-control " name="password"
                                       placeholder="Entrer le mot de passe...">
                                   @error('password', 'default')
                                       <span class="text-danger">{{ $message }}</span> <br>
                                   @enderror

                                   <label class="col-sm-1 col-form-label form-label"> Confirmer le mot de passe</label>
                                   <input type="password" class="form-control " name="password_confirmation"
                                       placeholder="Confirmer votre mot de passe...">
                                   @error('password_confirmation', 'default')
                                       <span class="text-danger">{{ $message }}</span> <br>
                                   @enderror

                                   <label class="form-label">Adresse</label>
                                   <input type="text" class="form-control " name="adresse"
                                       placeholder="Entrer l'adresse..." value="{{ old('adresse') }}" />
                                   @error('adresse', 'default')
                                       <span class="text-danger">{{ $message }}</span> <br>
                                   @enderror
                                   <label class="form-label">Contact</label>
                                   <input type="text" class="form-control " name="contact"
                                       placeholder="Entrer le contact..." value="{{ old('contact') }}" />
                                   @error('contact', 'default')
                                       <span class="text-danger">{{ $message }}</span> <br>
                                   @enderror


                                   <label class="form-label">Role</label>
                                   <select id="" class="form-select form-select-sm"
                                       aria-label=".form-select-sm example" name="role" style="height: 39px">
                                       <option value="">Selectionner le rôle</option>
                                       <option value="super-admin" {{ old('role') == 'super-admin' ? 'selected' : '' }}>
                                           super-admin</option>
                                       <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>admin</option>
                                       <option value="utilisateur" {{ old('role') == 'utilisateur' ? 'selected' : '' }}>
                                           utilisateur</option>
                                   </select>
                                   @error('role', 'default')
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
               <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalAddUser">
                   Ajouter les utilisateurs
               </button>
               <a href="{{ route('users.pdf') }}" class="btn btn-primary" style="margin-left: 975px">
                   <i class="fas fa-file-pdf"></i>
               </a>

               <div class="row">
                   <div class="col-md-12">
                       <div class="card">
                           <div class="card-header">
                               <h4 class="card-title">Les utilisateurs</h4>
                           </div>
                           <div class="card-body">
                               <div class="table-responsive">
                                   <table id="basic-datatables" class="display table table-striped table-hover">
                                       <thead>
                                           <tr>
                                               <th>Nom complet</th>
                                               <th>Email</th>
                                               <th>Contact</th>
                                               <th>Adresse</th>
                                               <th>Rôle</th>
                                               <th rowspan="2"></th>
                                           </tr>
                                       </thead>


                                       <tbody>

                                           @foreach ($users as $user)
                                               <tr>
                                                   <td>{{ $user->name }}</td>
                                                   <td>{{ $user->email }}</td>
                                                   <td>{{ $user->contact }}</td>
                                                   <td>{{ $user->adresse }}</td>
                                                   <td>{{ $user->role }}</td>
                                                   <td>
                                                       <a class="btn btn-primary" data-bs-toggle="modal"
                                                           data-bs-target="#updateUserModal"
                                                           data-id="{{ $user->id }}" data-name="{{ $user->name }}"
                                                           data-email="{{ $user->email }}"
                                                           data-contact="{{ $user->contact }}"
                                                           data-adresse="{{ $user->adresse }}"
                                                           data-role="{{ $user->role }}">
                                                           Modifier
                                                       </a>
                                                   </td>
                                                   <div class="modal fade" id="updateUserModal" tabindex="-1"
                                                       aria-labelledby="updateUserModalLabel" aria-hidden="true">
                                                       <div class="modal-dialog">
                                                           <div class="modal-content">
                                                               <form action="/updateUser" method="POST">
                                                                   @csrf

                                                                   <div class="modal-header">
                                                                       <h5 class="modal-title" id="updateUserModalLabel">
                                                                           Modifier l'utilisateur</h5>
                                                                       <button type="button" class="btn-close"
                                                                           data-bs-dismiss="modal"
                                                                           aria-label="Close"></button>
                                                                   </div>
                                                                   <div class="modal-body">
                                                                       <div class="form-group">
                                                                           <input type="hidden" name="id"
                                                                               value="{{ $user->id }}"
                                                                               id="updateUserId">

                                                                           <div>
                                                                               <label class="form-label">Nom</label>
                                                                               <input type="text" class="form-control"
                                                                                   id="updateUserName" name="newName"
                                                                                   placeholder="Entrer le nom..."
                                                                                   value="{{ old('newName', $user->name) }}">

                                                                               @if ($errors->has('newName'))
                                                                                   <span class="text-danger">
                                                                                       {{ $errors->first('newName') }}</span>
                                                                               @endif


                                                                           </div>
                                                                           <div>
                                                                               <label class="form-label">Email</label>
                                                                               <input type="email" class="form-control"
                                                                                   id="updateUserEmail" name="newEmail"
                                                                                   placeholder="Entrer l'email..."
                                                                                   value="{{ old('newEmail', $user->email) }}">

                                                                               @if ($errors->has('newEmail'))
                                                                                   <span class="text-danger">
                                                                                       {{ $errors->first('newEmail') }}</span>
                                                                               @endif

                                                                           </div>
                                                                           <div>
                                                                               <label class="form-label">Adresse</label>
                                                                               <input type="text" class="form-control"
                                                                                   id="updateUserAdresse"
                                                                                   name="newAdresse"
                                                                                   placeholder="Entrer l'adresse..."
                                                                                   value="{{ old('newAdresse', $user->adresse) }}">

                                                                               @if ($errors->has('newAdresse'))
                                                                                   <span class="text-danger">
                                                                                       {{ $errors->first('newAdresse') }}</span>
                                                                               @endif

                                                                           </div>
                                                                           <div>
                                                                               <label class="form-label">Contact</label>
                                                                               <input type="text" class="form-control"
                                                                                   id="updateUserContact"
                                                                                   name="newContact"
                                                                                   placeholder="Entrer le contact..."
                                                                                   value="{{ old('newContact', $user->contact) }}">

                                                                               @if ($errors->has('newContact'))
                                                                                   <span class="text-danger">
                                                                                       {{ $errors->first('newContact') }}</span>
                                                                               @endif
                                                                           </div>
                                                                           <div>
                                                                               <label class="form-label">Role</label>
                                                                               <select id="updateUserRole"
                                                                                   class="form-select form-select-sm"
                                                                                   aria-label=".form-select-sm example"
                                                                                   name="newRole" style="height: 39px">

                                                                                   <option value="super-admin"
                                                                                       {{ old('newRole', $user->role) == 'super-admin' ? 'selected' : '' }}>
                                                                                       super-admin
                                                                                   </option>
                                                                                   <option value="admin"
                                                                                       {{ old('newRole', $user->role) == 'admin' ? 'selected' : '' }}>
                                                                                       admin
                                                                                   </option>
                                                                                   <option value="utilisateur"
                                                                                       {{ old('newRole', $user->role) == 'utilisateur' ? 'selected' : '' }}>
                                                                                       utilisateur
                                                                                   </option>
                                                                               </select>
                                                                               @if ($errors->has('newRole'))
                                                                                   <span class="text-danger">
                                                                                       {{ $errors->first('newRole') }}</span>
                                                                               @endif

                                                                           </div>
                                                                           <div class="">
                                                                               <label class="form-label">Entrer le mot de
                                                                                   passe</label>
                                                                               <input type="password" class="form-control"
                                                                                   name="newPassword"
                                                                                   placeholder="Entrer le mot de passe...">
                                                                               @if ($errors->has('newPassword'))
                                                                                   <span class="text-danger">
                                                                                       {{ $errors->first('newPassword') }}</span>
                                                                               @endif


                                                                           </div>

                                                                           <div class="">
                                                                               <label class="form-label">Confirmer le mot
                                                                                   de passe</label>
                                                                               <input type="password"
                                                                                   class="form-control "
                                                                                   name="newPassword_confirmation"
                                                                                   placeholder="Confirmer le mot de passe...">
                                                                               @if ($errors->has('newPassword_confirmation'))
                                                                                   <span class="text-danger">
                                                                                       {{ $errors->first('newPassword_confirmation') }}</span>
                                                                               @endif
                                                                           </div>






                                                                       </div>
                                                                   </div>
                                                                   <div class="modal-footer">
                                                                       <button type="submit"
                                                                           class="btn btn-primary">Ajouter</button>
                                                                   </div>

                                                               </form>
                                                           </div>
                                                       </div>


                                                   </div>

                                                   <td>
                                                       <a>
                                                           <form action="{{ route('user.destroy', $user->id) }}"
                                                               id="delete-form-{{ $user->id }}" method="POST"
                                                               style="display: inline;">
                                                               @csrf
                                                               @method('DELETE')
                                                               <button type="button" class="btn btn-danger"
                                                                   onclick="confirmDelete({{ $user->id }})">Supprimer</button>
                                                           </form>
                                                       </a>
                                                   </td>


                                               </tr>
                                           @endforeach

                                           <div class="modal fade" id="ModalUserDetail" tabindex="-1"
                                               aria-labelledby="exampleModalLabel" aria-hidden="true">
                                               <div class="modal-dialog">
                                                   <div class="modal-content">
                                                       <div class="modal-header">
                                                           <h5 class="modal-title" id="exampleModalLabel"></h5>
                                                           <button type="button" class="btn-close"
                                                               data-bs-dismiss="modal" aria-label="Close"></button>
                                                       </div>
                                                       <div class="modal-body">
                                                           <div class="show-info-user show-name-user">
                                                               <label class="label-detail-user">Nom</label>
                                                               <h6 class="info-user" id="showNameUser"></h6>
                                                           </div>
                                                           <div class="show-info-user show-email-user">
                                                               <label class="label-detail-user">Email</label>
                                                               <h6 class="info-user" id="showEmailUser"></h6>
                                                           </div>
                                                           <div class="show-info-user show-contact-user">
                                                               <label class="label-detail-user">Contact</label>
                                                               <h6 class="info-user" id="showContactUser"></h6>
                                                           </div>
                                                           <div class="show-info-user show-adress-user">
                                                               <label class="label-detail-user">Adresse</label>
                                                               <h6 class="info-user" id="showAdressUser"></h6>
                                                           </div>
                                                           <div class="show-info-user show-adress-role">
                                                               <label class="label-detail-user">Rôle</label>
                                                               <h6 class="info-user" id="showRoleUser"></h6>
                                                           </div>

                                                       </div>
                                                       <div class="modal-footer">
                                                           <button type="button" class="btn btn-info "
                                                               data-bs-dismiss="modal">Fermer</button>
                                                       </div>
                                                   </div>
                                               </div>
                                           </div>





                                       </tbody>
                                   </table>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>



                   <div class="d-flex justify-content-between align-items-center">
                    @if ($users->total() >= 10)
                       <form id="pagination-form" action="{{ route('users.pagination') }}" method="GET"
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
                {{ $users->links('vendor.pagination.bootstrap-4') }}

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
                   const updateUserModal = document.getElementById('updateUserModal');
                   updateUserModal.addEventListener('show.bs.modal', event => {
                       const button = event.relatedTarget;
                       const userId = button.getAttribute('data-id');
                       const userName = button.getAttribute('data-name');
                       const userEmail = button.getAttribute('data-email');
                       const userContact = button.getAttribute('data-contact');
                       const userAdresse = button.getAttribute('data-adresse');
                       const userRole = button.getAttribute('data-role');

                       document.getElementById('updateUserId').value = userId;
                       document.getElementById('updateUserName').value = userName;
                       document.getElementById('updateUserEmail').value = userEmail;
                       document.getElementById('updateUserContact').value = userContact;
                       document.getElementById('updateUserAdresse').value = userAdresse;
                       document.getElementById('updateUserRole').value = userRole;
                   });
               });
           </script>

           <script>
               function confirmDelete(userId) {
                   Swal.fire({
                       title: 'Supprimer l\'utilisateur !',
                       text: "êtes-vous sûr que vous voulez supprimer cet utilisateur ?",
                       icon: 'warning',
                       showCancelButton: true,
                       confirmButtonColor: '#d33',
                       cancelButtonColor: '#3085d6',
                       cancelButtonText: 'Annuler',
                       confirmButtonText: 'Oui, Supprimer-le !'
                   }).then((result) => {
                       if (result.isConfirmed) {
                           document.getElementById('delete-form-' + userId).submit();
                       }
                   });
               }
           </script>

           <script>
               document.querySelectorAll('button[data-bs-toggle="modal"]').forEach(button => {
                   button.addEventListener('click', function() {
                       const userName = this.getAttribute('data-user-name')
                       const userEmail = this.getAttribute('data-user-email')
                       const userContact = this.getAttribute('data-user-contact')
                       const userAdress = this.getAttribute('data-user-adresse')
                       const userProduct = this.getAttribute('data-user-product')
                       const userCategory = this.getAttribute('data-user-product-category')

                       document.querySelector('#showNameUser').innerText = userName
                       document.querySelector('#showEmailUser').innerText = userEmail
                       document.querySelector('#showContactUser').innerText = userContact
                       document.querySelector('#showAdressUser').innerText = userAdress
                       document.querySelector('#showProductUser').innerText = userProduct
                       document.querySelector('#showCategoryUser').innerText = userCategory
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

                   searchInput.addEventListener('input', function() {
                       const searchQuery = searchInput.value;

                       if (searchQuery.length > 0) {
                           fetch(`/search-users?search=${searchQuery}`)
                               .then(response => response.json())
                               .then(data => {
                                   console.log(data)
                                   const tbody = document.querySelector('tbody');
                                   tbody.innerHTML = '';

                                   data.forEach(user => {




                                       const row = document.createElement('tr');
                                       row.innerHTML = `
                                        <td>${user.name}</td>
                                        <td>${user.email}</td>
                                        <td>${user.contact}</td>
                                        <td>${user.adresse}</td>
                                        <td>${user.role}</td>
                                        <td>
                                                       <a class="btn btn-primary" data-bs-toggle="modal"
                                                           data-bs-target="#updateUserModal"
                                                           data-id="${user.id}"
                                                           data-name="${user.name}"
                                                           data-email="${user.email}"
                                                           data-contact="${user.contact}"
                                                           data-adresse="${user.adresse}"
                                                           data-role="${user.role}"
                                                           >
                                                           Modifier
                                                       </a>
                                        </td>

                                        <td>


                                        <form action="{{ route('user.destroy', $user->id) }}" id="delete-form-${user.id}" method="POST"
                                                               style="display: inline;">

                                            @method('DELETE')
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="button" class="btn btn-danger"
                                                    onclick="confirmDelete(${user.id})">Supprimer</button>
                                        </form>
                                        </td>
                                        `
                                       tbody.appendChild(row);
                                   });

                                   document.querySelectorAll('button[data-bs-toggle="modal"]').forEach(
                                       button => {
                                           button.addEventListener('click', function() {
                                               const userName = this.getAttribute(
                                                   'data-user-name');
                                               const userEmail = this.getAttribute(
                                                   'data-user-email');
                                               const userContact = this.getAttribute(
                                                   'data-user-contact');
                                               const userAdresse = this.getAttribute(
                                                   'data-user-adresse');
                                               const userRole = this.getAttribute(
                                                   'data-user-role');



                                               document.querySelector('#showNameUser').innerText =
                                                   userName;
                                               document.querySelector('#showEmailUser').innerText =
                                                   userEmail;
                                               document.querySelector('#showContactUser')
                                                   .innerText = userContact;
                                               document.querySelector('#showAdressUser')
                                                   .innerText = userAdresse;
                                               document.querySelector('#showRoleUser').innerText =
                                                   userRole;


                                           });
                                       });
                               })
                               .catch(error => {
                                   console.error('Error fetching users:', error);
                               });
                       } else {
                           location.reload();
                       }
                   });
               });
           </script>
       @endsection
