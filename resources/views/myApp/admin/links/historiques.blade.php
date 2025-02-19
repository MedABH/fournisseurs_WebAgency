@extends('myApp.admin.adminLayout.adminPage')
@section('title')
    L'historique
@endsection
@section('content')
    <div class="page-inner">


        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">L'historique</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Nom</th>
                                        <th scope="col">role</th>
                                        <th scope="col">Historique de Connexion</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->role }}</td>
                                            <td>
                                                @if ($user->historiques->isEmpty())
                                                    <div>Aucun historique trouvé</div>
                                                @else
                                                    @foreach ($user->historiques as $historique)
                                                        <div>{{ \Carbon\Carbon::parse($historique->login_at)->timezone('Africa/Casablanca')->format('d/m/Y H:i') }}</div>
                                                    @endforeach
                                                @endif
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
@endsection
