@extends('myApp.admin.adminLayout.adminPage')
@section('search-bar')
    <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
            <h1 class="app-page-title mb-0" style="color: #404242">PARTIES PRENANTES</h1>
        </div>
    </div><!--//row-->
@endsection

@section('parties-prenantes')
    <nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
        <a href="/prospectsSection" class="flex-sm-fill text-sm-center nav-link">Les Tiers</a>
        <a href="/clientsSection" class="flex-sm-fill text-sm-center nav-link">Les Clients</a>
        <a href="/suppliersSection" class="flex-sm-fill text-sm-center nav-link">Les Fournisseurs</a>
        <a href="/suppliersAndClientsSection" class="flex-sm-fill text-sm-center nav-link">Fournisseurs et Clients</a>
    </nav>
@endsection