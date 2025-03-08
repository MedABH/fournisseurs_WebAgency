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
                             @if ($tiersChange > 0)
                                 <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-up"
                                     fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                     <path fill-rule="evenodd"
                                         d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z" />
                                 </svg> +{{ $tiersChange }}
                             @elseif ($tiersChange < 0)
                                 <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-down"
                                     fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                     <path fill-rule="evenodd"
                                         d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z" />
                                 </svg> {{ $tiersChange }}
                             @else
                                 <span>No Change</span>
                             @endif
                         </div>
                     </div>


                     <a class="app-card-link-mask" href="prospectsSection"></a>
                 </div><!--//app-card-->
             </div><!--//col-->

             <div class="col-6 col-lg-3">
                 <div class="app-card app-card-stat shadow-sm h-100">
                     <div class="app-card-body p-3 p-lg-4">
                         <h4 class="stats-type mb-1">Les Clients</h4>
                         <div class="stats-figure">{{ $sumClients }}</div>
                         <div class="stats-meta text-success">
                             @if ($clientsChange > 0)
                                 <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-up"
                                     fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                     <path fill-rule="evenodd"
                                         d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z" />
                                 </svg> +{{ $clientsChange }}
                             @elseif ($clientsChange < 0)
                                 <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-down"
                                     fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                     <path fill-rule="evenodd"
                                         d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z" />
                                 </svg> {{ $clientsChange }}
                             @else
                                 <span>No Change</span>
                             @endif
                         </div>
                     </div>

                     <a class="app-card-link-mask" href="clientsSection"></a>
                 </div><!--//app-card-->
             </div><!--//col-->
             <div class="col-6 col-lg-3">
                 <div class="app-card app-card-stat shadow-sm h-100">
                     <div class="app-card-body p-3 p-lg-4">
                         <h4 class="stats-type mb-1">Les Fournisseurs</h4>
                         <div class="stats-figure">{{ $sumSuppliers }}</div>
                         <div class="stats-meta text-success">
                             @if ($suppliersChange > 0)
                                 <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-up"
                                     fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                     <path fill-rule="evenodd"
                                         d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z" />
                                 </svg> +{{ $suppliersChange }}
                             @elseif ($suppliersChange < 0)
                                 <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-down"
                                     fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                     <path fill-rule="evenodd"
                                         d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z" />
                                 </svg> {{ $suppliersChange }}
                             @else
                                 <span>No Change</span>
                             @endif
                         </div>
                     </div><!--//app-card-body-->

                     <a class="app-card-link-mask" href="suppliersSection"></a>
                 </div><!--//app-card-->
             </div><!--//col-->
             <div class="col-6 col-lg-3">
                 <div class="app-card app-card-stat shadow-sm h-100">
                     <div class="app-card-body p-3 p-lg-4">
                         <h4 class="stats-type mb-1">Fournisseurs et Clients</h4>
                         <div class="stats-figure">{{ $sumFournClients }}</div>
                         <div class="stats-meta text-success">
                             @if ($fournClientsChange > 0)
                                 <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-up"
                                     fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                     <path fill-rule="evenodd"
                                         d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z" />
                                 </svg> +{{ $fournClientsChange }}
                             @elseif ($fournClientsChange < 0)
                                 <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-down"
                                     fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                     <path fill-rule="evenodd"
                                         d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z" />
                                 </svg> {{ $fournClientsChange }}
                             @else
                                 <span>No Change</span>
                             @endif
                         </div>
                     </div><!--//app-card-body-->

                     <a class="app-card-link-mask" href="suppliersAndClientsSection"></a>
                 </div><!--//app-card-->
             </div><!--//col-->
         </div><!--//row-->



         <!-- lfoog mgad f style -->


         <div class="row g-4 mb-4">
             <!-- Graphique Linéaire -->
             <div class="col-12 col-lg-6">
                 <div class="app-card app-card-chart h-100 shadow-sm">
                     <div class="app-card-header p-3">
                         <div class="row justify-content-between align-items-center">
                             <div class="col-auto">
                                 <h4 class="app-card-title">Graphique Linéaire</h4>
                             </div><!--//col-->
                             <div class="col-auto">
                                 <div class="card-header-action">
                                     <a href="">Plus</a>
                                 </div><!--//card-header-actions-->
                             </div><!--//col-->
                         </div><!--//row-->
                     </div><!--//app-card-header-->
                     <div class="app-card-body p-3 p-lg-4">
                         <div class="mb-3 d-flex">
                             <!-- Unique ID for Graphique Linéaire Dropdown -->
                             <select class="form-select form-select-sm ms-auto d-inline-flex w-auto line-chart-select"
                                 id="lineChartSelect">
                                 <option value="1" selected>Cette semaine</option>
                                 <option value="2">Aujourd'hui</option>
                                 <option value="3">Ce mois-ci</option>
                                 <option value="4">Cette année</option>
                             </select>
                         </div>
                         <div class="chart-container">
                             <canvas id="canvas-linechart"></canvas>
                         </div>
                     </div><!--//app-card-body-->
                 </div><!--//app-card-->
             </div><!--//col-->

             <!-- Graphique à Barres -->
             <div class="col-12 col-lg-6">
                 <div class="app-card app-card-chart h-100 shadow-sm">
                     <div class="app-card-header p-3">
                         <div class="row justify-content-between align-items-center">
                             <div class="col-auto">
                                 <h4 class="app-card-title">Graphique à Barres</h4>
                             </div><!--//col-->
                             <div class="col-auto">
                                 <div class="card-header-action">
                                     <a href="">Plus</a>
                                 </div><!--//card-header-actions-->
                             </div><!--//col-->
                         </div><!--//row-->
                     </div><!--//app-card-header-->
                     <div class="app-card-body p-3 p-lg-4">
                         <div class="mb-3 d-flex">
                             <!-- Unique ID for Graphique à Barres Dropdown -->
                             <select class="form-select form-select-sm ms-auto d-inline-flex w-auto bar-chart-select"
                                 id="barChartSelect">
                                 <option value="1" selected>Cette semaine</option>
                                 <option value="2">Aujourd'hui</option>
                                 <option value="3">Ce mois-ci</option>
                                 <option value="4">Cette année</option>
                             </select>
                         </div>
                         <div class="chart-container">
                             <canvas id="canvas-barchart"></canvas>
                         </div>
                     </div><!--//app-card-body-->
                 </div><!--//app-card-->
             </div><!--//col-->
         </div><!--//row-->




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

             <div class="col-12 col-lg-6">
                 <div class="app-card app-card-stats-table h-100 shadow-sm">
                     <div class="app-card-header p-3">
                         <div class="row justify-content-between align-items-center">
                             <div class="col-auto">
                                 <h4 class="app-card-title">Utilisateurs récemment connectés</h4>
                             </div><!--//col-->
                             <div class="col-auto">
                                 <div class="card-header-action">
                                     <a href="historiqueJournauxSection">Plus</a>
                                 </div><!--//card-header-actions-->
                             </div><!--//col-->
                         </div><!--//row-->
                     </div><!--//app-card-header-->
                     <div class="app-card-body p-3 p-lg-4">
                         <div class="table-responsive">
                             <table class="table table-borderless mb-0">
                                 <thead>
                                     <tr>
                                         <th class="meta">Nom</th>
                                         <th class="meta stat-cell">Role</th>
                                         <th class="meta stat-cell">Historique de Connexion</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     @foreach ($historiques as $historique)
                                         <tr>
                                             <td>{{ $historique->user->name }}</td>
                                             <td class="stat-cell">{{ $historique->user->role }}</td>
                                             <td class="stat-cell">
                                                 {{ \Carbon\Carbon::parse($historique->login_at)->timezone('Africa/Casablanca')->format('d/m/Y H:i') }}
                                             </td>
                                         </tr>
                                     @endforeach
                                 </tbody>
                             </table>
                         </div><!--//table-responsive-->
                     </div><!--//app-card-body-->
                 </div><!--//app-card-->
             </div><!--//col-->

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

     <!-- Charts JS -->
     <script src="{{ asset('assets/plugins/chart.js/chart.min.js') }}"></script>
     <!-- <script src="{{ asset('assets/js/index-charts.js') }}"></script> -->
     <script src="{{ asset('assets/js/chartsJS/Bar_Chart.js') }}"></script>
     <script src="{{ asset('assets/js/chartsJS/Line_Chart.js') }}"></script>
 @endsection
