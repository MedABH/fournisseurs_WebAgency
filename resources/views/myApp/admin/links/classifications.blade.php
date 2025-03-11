@extends('myApp.admin.adminLayout.adminPage')
@section('search-bar')
    <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
            <h1 class="app-page-title mb-0">Les Classifications</h1>
        </div>
    </div><!--//row-->
@endsection

@section('parties-prenantes')
<nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
    <a href="/categoriesSection" class="flex-sm-fill text-sm-center nav-link">Les Categories</a>
    <a href="/productsSection" class="flex-sm-fill text-sm-center nav-link">Les Sous-Categories</a>
</nav>
@endsection