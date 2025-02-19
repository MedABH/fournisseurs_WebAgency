 @extends('myApp.admin.adminLayout.adminPage')
 @section('title')
 Dashboard
 @endsection


 @section('content')

             <div class="page-inner">
                 <div class="row">
                     <div class="col-sm-12 col-md-4 firstRowChart">
                         <div class="card card-stats card-info card-round x">
                             <div class="card-body ">
                                 <div class="row ">
                                     <div class="col-5">
                                         <div class="icon-big text-center">
                                             <i class="fas fa-users"></i>
                                         </div>
                                     </div>
                                     <div class="col-7 col-stats">
                                         <div class="numbers">
                                             <p class="card-category">Les utilisateurs</p>
                                             <h4 class="card-title">{{ $sumUsers }}</h4>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="col-sm-12 col-md-4 firstRowChart">
                         <div class="card card-stats card-success card-round">
                             <div class="card-body ">
                                 <div class="row ">
                                     <div class="col-5">
                                         <div class="icon-big text-center">
                                             <i class="fas fa-people-carry"></i>
                                         </div>
                                     </div>
                                     <div class="col-7 col-stats">
                                         <div class="numbers">
                                             <p class="card-category">Les fournisseurs</p>
                                             <h4 class="card-title">{{ $sumSuppliers }}</h4>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="col-sm-12 col-md-4 firstRowChart ">
                         <div class="card card-stats card-secondary card-round">
                             <div class="card-body ">
                                 <div class="row ">
                                     <div class="col-5">
                                         <div class="icon-big text-center">
                                             <i class="fas fa-list"></i>
                                         </div>
                                     </div>
                                     <div class="col-7 col-stats">
                                         <div class="numbers">
                                             <p class="card-category">Les catégories</p>
                                             <h4 class="card-title">{{ $sumCategories }}</h4>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>


                <div  >


                     <div class="col-md-12">
                         <div class="card">
                             <div class="card-body" style="position: relative; height: 30vh; width: 100%;">
                                 <canvas id="myChart"></canvas>
                             </div>
                         </div>
                     </div>




                </div>
                 <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"></h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive ">
                                    <table id="basic-datatables" class="display table table-striped table-hover">
                                        <h3>Le nombre de fournisseur par catégorie</h3>
                                        <thead>
                                            <tr>

                                                <th>Catégorie</th>
                                                <th>Nombre de fournisseur</th>




                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($suppliersNumberByCategory as $categorie)
                                               <tr>
                                                   <td>{{$categorie->nom_categorie}}</td>
                                                   <td>{{$categorie->fournisseurs_count}}</td>
                                               </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                </div>




                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"></h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="basic-datatables" class="display table table-striped table-hover">
                                        <h3>Les utilisateurs récemment inscris</h3>
                                        <thead>
                                            <tr>

                                                <th>Nom</th>
                                                <th rowspan="1"></th>


                                                </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($lastUsers as $user)
                                                <tr>
                                                    <td>{{ $user->name }}</td>
                                                    <td>
                                                        <button
                                                            style="border-style: none;
                                               background-color:transparent"
                                                            data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                            data-user-name="{{ $user->name }}"
                                                            data-user-email="{{ $user->email }}"
                                                            data-user-contact="{{ $user->contact }}"
                                                            data-user-adresse="{{ $user->adresse }}">
                                                            <i class="fas fa-info-circle" style="color: #31CE36;"></i>
                                                        </button>




                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
         </div>



     </div>





     <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog">
             <div class="modal-content">
                 <div class="modal-header">
                     <h1 class="modal-title" id="showName"></h1>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                 <div class="modal-body">

                     <div class="show-info show-email">
                         <label class="label">Email :</label>
                         <h6 id="showEmail" class="info"></h6>
                     </div>
                     <div class="show-info show-contact">
                         <label class="label">Contact :</label>
                         <h6 id="showContact" class="info"></h6>
                     </div>
                     <div class="show-info show-adress">
                         <label class="label">Adresse :</label>
                         <h6 id="showAdress" class="info"></h6>
                     </div>
                 </div>
                 <div class="modal-footer">
                     <button type="button" id="btn-info" data-bs-dismiss="modal">Close</button>
                 </div>
             </div>
         </div>
     </div>
 @endsection
 @section('script')
     <script>
         const categoryNames = @json($categoryNames);
         const subcategoryCounts = @json($subcategoryCounts);
         const cctx = document.getElementById('myChart');
         new Chart(cctx, {
             type: 'bar',
             data: {
                 labels: categoryNames,
                 datasets: [{
                     label: '# Le nombre des produits par catégorie',
                     data: subcategoryCounts,
                     borderWidth: 1,
                     backgroundColor: ["#48ABF7", "#6861CE"],
                 }]
             },
             options: {
                 responsive: true,
                 maintainAspectRatio: false,
                 scales: {
                     y: {
                         beginAtZero: true,
                         ticks: {
                             stepSize: 1
                         }
                     }
                 }
             }
         });
     </script>



     <script>
         document.querySelectorAll('button[data-bs-toggle="modal"]').forEach(button => {
             button.addEventListener('click', function() {
                 const userName = this.getAttribute('data-user-name');
                 const userEmail = this.getAttribute('data-user-email');
                 const userContact = this.getAttribute('data-user-contact');
                 const userAdress = this.getAttribute('data-user-adresse');

                 document.querySelector('#showName').innerText = userName;
                 document.querySelector('#showEmail').innerText = userEmail;
                 document.querySelector('#showContact').innerText = userContact;
                 document.querySelector('#showAdress').innerText = userAdress;


             });
         });
     </script>
 @endsection
