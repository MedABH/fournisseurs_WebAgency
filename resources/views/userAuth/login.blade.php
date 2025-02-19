<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('CSS/login.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>Connexion</title>
</head>

<body>

    <div class="formLogin">
        <header class="header">Se connecter</header>
        <form action="{{ route('login') }}" method="POST" class="form">
            @csrf
            <div class="input-group">

                @if ($errors->any())
                    <div class="error-container">
                        <ul class="message-container">
                            @foreach ($errors->all() as $error)
                                <li class="error-message">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="password-wrapper">
                    <input type="text" placeholder="Entrer votre émail" name="email" class="input-text"
                        value="{{ old('email') }}" />
                </div>

                <div class="password-wrapper">
                    <input type="password" placeholder="Entrer votre mot de passe" name="password" class="input-text"
                        value="{{ old('password') }}" />
                    <button type="button" id="togglePassword" style="background: none; border: none; cursor: pointer;">
                        <i class="fas fa-eye" id="eyeIcon"></i>  <!-- Default Eye icon -->
                    </button>
                </div>
                
            </div>
            <div class="forget-password-group"></div>
            <input type="submit" value="Se connecter" class="input-submit" />
        </form>
    </div>

    <!-- Include the JavaScript -->
    <script src="{{ asset('js/login.js') }}"></script>

</body>

</html>
