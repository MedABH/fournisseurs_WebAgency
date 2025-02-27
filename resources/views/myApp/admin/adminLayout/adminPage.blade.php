<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <script src="assets/js/plugin/webfont/webfont.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('CSS/chart.css')}}"/>
    <link rel="stylesheet" href="{{asset('CSS/searchBar.css')}}"/>
    <link rel="stylesheet" href="{{asset('CSS/utilisateurs.css')}}"/>
    <link rel="stylesheet" href="{{asset('CSS/fournisseurs.css')}}"/>
    <link rel="stylesheet" href="{{asset('CSS/categories.css')}}"/>
    <link rel="stylesheet" href="{{asset('CSS/sousCategories.css')}}"/>
    <link rel="stylesheet" href="{{asset('CSS/profileAuth.css')}}"/>
    <link rel="stylesheet" href="{{asset('CSS/prospects.css')}}"/>
    <link rel="stylesheet" href="{{asset('CSS/clients.css')}}"/>
    <link rel="stylesheet" href="{{asset('CSS/fournisseurClients.css')}}"/>
    <link rel="stylesheet" href="{{asset('CSS/templatemo-style.css')}}" />

    <!--Ce que j'ai ajouté-->
    <link rel="stylesheet" href="{{asset('assets/css/portal.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/templatemo-style.css')}}" />
    <script src="assets/js/app.js"></script>
    <script src="assets/plugins/fontawesome/js/all.min.js"></script>
    <script src="assets/plugins/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    
    

    <title>@yield('title')</title>
</head>
<body>
  <div>
    @include('myApp.admin.adminLayout.NavSideBar')
    @yield('search-bar')
    @yield('content')
    @yield('errorContent')
    @yield('script')
    @yield('content2')
    @yield('info-edit-user')



  </div>
</body>
</html>
