@extends('myApp.admin.adminLayout.adminPage')
@section('title')
    Profile
@endsection
@section('script')
<script>
    document.addEventListener("DOMContentLoaded", function() {
    var modalType = document.getElementById('modals').getAttribute('data-error');

    if (modalType === 'updatePassword') {
        var updateModal = new bootstrap.Modal(document.getElementById('editPassword'));
        updateModal.show();
    }
});

</script>

@endsection
@section('info-edit-user')
  

    <div id="modals" style="display: none" data-error="{{ session('modalType') }}"></div>
    <div class="container-form-update">
        <form action="{{route('update.user.auth')}}" method="POST" class="row g-3 needs-validation form-profile" novalidate
        >
       @csrf
       <div class="row">
        <div class="col-md-4 profile" >
            <i class="fas fa-user fa-auth" id="icon-user"></i>
            <h4 style="margin-top:15px">Salut, {{$user->name}}</h4>

        </div>

       </div>
       <div class="row profile" style="margin-top: 10px">

           <div class="col-md-3">


               <label class="form-label" style="font-size: 70px;
                font-weight: bold;">Nom</label>
               <input type="text" class="form-control" id="updateUserName" name="newName" placeholder="Entrer le nom..."
                   value="{{ old('newName', $user->name) }}"
                   style="font-size: 17px">

               @if ($errors->has('newName'))
                   <span class="text-danger">
                       {{ $errors->first('newName') }}</span>
               @endif



           </div>
           <div class="col-md-6" >
               <label class="form-label"v
               style="font-size: 50px;
                font-weight: bold;">Email</label>
               <input type="email" class="form-control" id="updateUserEmail" name="newEmail"
                   placeholder="Entrer l'email..." value="{{ old('newEmail', $user->email) }}"
                   style="font-size: 17px">

               @if ($errors->has('newEmail'))
                   <span class="text-danger">
                       {{ $errors->first('newEmail') }}</span>
               @endif
           </div>

       </div>


       <div class="row profile" style="margin-top: 10px">
           <div class="col-md-3">
               <label  class="form-label">Contact</label>
               <input type="text" class="form-control" id="updateUserContact" name="newContact"
                   placeholder="Entrer le contact..." value="{{ old('newContact', $user->contact) }}"
                   style="font-size: 17px">

               @if ($errors->has('newContact'))
                   <span class="text-danger">
                       {{ $errors->first('newContact') }}</span>
               @endif
           </div>
           <div class="col-md-3">
               <label class="form-label">Adresse</label>
               <input type="text" class="form-control" id="updateUserAdresse" name="newAdresse"
                   placeholder="Entrer l'adresse..." value="{{ old('newAdresse', $user->adresse) }}"
                   style="font-size: 17px">

               @if ($errors->has('newAdresse'))
                   <span class="text-danger">
                       {{ $errors->first('newAdresse') }}</span>
               @endif
           </div>
           <div class="col-md-3">
               <label  class="form-label">Rôle</label>
               <input type="text" class="form-control" id="updateUserAdresse" name="newRole"
                   placeholder="Entrer l'adresse..." value="{{ old('newRole', $user->role) }}"
                   style="font-size: 17px">


               @if ($errors->has('newRole'))
                   <span class="text-danger">
                       {{ $errors->first('newRole') }}</span>
               @endif

           </div>

       </div>

       <div class="col-12">
           <a href="#" data-bs-toggle="modal" data-bs-target="#editPassword">
            Voulez-vous changer le mot de passe ?</a>
       </div>
       <div class="col-12" style="margin-top: 26px">
           <button class="btn btn-primary" type="submit">Mettre à jour</button>
       </div>
   </form>
    </div>

    <div class="modal fade" id="editPassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

            <div class="modal-body" id="modal-body">
                <form action="{{route('change.password')}}" method="POST">
                @csrf
                    <div>
                        <h3 style="display: flex; justify-content:center; align-items:center">Changer le mot de passe</h3 >
                    </div>
                    <div class="">
                        <label class="form-label">Entrer l'ancien mot de passe</label>
                        <input type="password" class="form-control " name="password"
                        placeholder="Entrer le mot de passe...">
                        @error('password', 'updatePassword')
                            <span class="text-danger">{{ $message }}</span> <br>
                        @enderror
                      </div>

                      <div class="">
                        <label class="form-label">Entrer le nouveau mot de passe</label>
                        <input type="password" class="form-control " name="newPassword"
                        placeholder="Entrer le mot de passe...">
                        @error('newPassword', 'updatePassword')
                            <span class="text-danger">{{ $message }}</span> <br>
                        @enderror
                      </div>

                      <div class="" style="padding-bottom: 33px">
                        <label class="form-label">Confirmer le nouveau mot de passe</label>
                        <input type="password" class="form-control " name="newPassword_confirmation"
                        placeholder="Confirmer le mot de passe...">
                        @error('newPassword_confirmation', 'updatePassword')
                            <span class="text-danger">{{ $message }}</span> <br>
                        @enderror
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                      </div>

                </form>

            </div>

          </div>
        </div>
      </div>
@endsection

