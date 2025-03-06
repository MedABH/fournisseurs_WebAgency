 @extends('myApp.admin.adminLayout.adminPage')
 @section('title')
     Dashboard
 @endsection


 @section('content')
     <div class="page-inner">
         <h1 class="app-page-title">Aperçu</h1>
         <div class="row g-4 mb-4">
             <div class="col-6 col-lg-3">
                 <div class="app-card app-card-stat shadow-sm h-100">
                     <div class="app-card-body p-3 p-lg-4">
                         <h4 class="stats-type mb-1">Les Tiers</h4>
                         <div class="stats-figure">{{ $sumTiers }}</div>
                         <div class="stats-meta text-success">
                             <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-up"
                                 fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                 <path fill-rule="evenodd"
                                     d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z" />
                             </svg> +1
                         </div>
                     </div><!--//app-card-body-->
                     <a class="app-card-link-mask" href="PartiesPrenantesSection"></a>
                 </div><!--//app-card-->
             </div><!--//col-->

             <div class="col-6 col-lg-3">
                 <div class="app-card app-card-stat shadow-sm h-100">
                     <div class="app-card-body p-3 p-lg-4">
                         <h4 class="stats-type mb-1">Les Clients</h4>
                         <div class="stats-figure">{{ $sumClients }}</div>
                         <div class="stats-meta text-success">
                             <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-down"
                                 fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                 <path fill-rule="evenodd"
                                     d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z" />
                             </svg> -2
                         </div>
                     </div><!--//app-card-body-->
                     <a class="app-card-link-mask" href="PartiesPrenantesSection"></a>
                 </div><!--//app-card-->
             </div><!--//col-->
             <div class="col-6 col-lg-3">
                 <div class="app-card app-card-stat shadow-sm h-100">
                     <div class="app-card-body p-3 p-lg-4">
                         <h4 class="stats-type mb-1">Les Fournisseurs</h4>
                         <div class="stats-figure">{{ $sumSuppliers }}</div>
                         <div class="stats-meta text-success">
                             <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-down"
                                 fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                 <path fill-rule="evenodd"
                                     d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z" />
                             </svg> -2
                         </div>
                     </div><!--//app-card-body-->
                     <a class="app-card-link-mask" href="PartiesPrenantesSection"></a>
                 </div><!--//app-card-->
             </div><!--//col-->
             <div class="col-6 col-lg-3">
                 <div class="app-card app-card-stat shadow-sm h-100">
                     <div class="app-card-body p-3 p-lg-4">
                         <h4 class="stats-type mb-1">Fournisseurs et Clients</h4>
                         <div class="stats-figure">{{ $sumFournClients }}</div>
                         <div class="stats-meta text-success">
                             <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-down"
                                 fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                 <path fill-rule="evenodd"
                                     d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z" />
                             </svg> -2
                         </div>
                     </div><!--//app-card-body-->
                     <a class="app-card-link-mask" href="PartiesPrenantesSection.html"></a>
                 </div><!--//app-card-->
             </div><!--//col-->
         </div><!--//row-->



         <!-- lfoog mgad f style -->


         <div>


             <div class="col-md-12">
                 <div class="card">
                     <div class="card-body" style="position: relative; height: 30vh; width: 100%;">
                         <canvas id="myChart"></canvas>
                     </div>
                 </div>
             </div>


         </div>







         <!-- les tableaus lte7t -->

         <div class="row g-4 mb-4">
            <div class="col-12 col-lg-6">
                <div class="app-card app-card-progress-list h-100 shadow-sm">
                    <div class="app-card-header p-3">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-auto">
                                <h4 class="app-card-title">Nombre de fournisseurs par catégorie</h4>
                            </div><!--//col-->
                            <div class="col-auto">
                                <div class="card-header-action">
                                    <a href="PartiesPrenantesSection">Plus</a>
                                </div><!--//card-header-actions-->
                            </div><!--//col-->
                        </div><!--//row-->
                    </div><!--//app-card-header-->
                    <div class="app-card-body p-3 p-lg-4">
                        <div class="table-responsive">
                            <table class="table table-borderless mb-0">
                                <thead>
                                    <tr>
                                        <th class="meta">Catégorie</th>
                                        <th class="meta stat-cell">Nombre de fournisseurs</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($suppliersNumberByCategory as $categorie)
                                    <tr>
                                        <td>{{ $categorie->nom_categorie }}</td>
                                        <td class="stat-cell">{{ $categorie->fournisseurs_count }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div><!--//table-responsive-->
                    </div><!--//app-card-body-->
                </div><!--//app-card-->
            </div><!--//col-->

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
