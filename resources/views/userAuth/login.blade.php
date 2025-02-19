<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('CSS/login.css')}}">
    <title>Connexion</title>
</head>
<body>

    <div class="formLogin">
        <header class="header">Se connecter</header>
        <form action="{{route('login')}}" method="POST" class="form">
        @csrf
        <div class="input-group">

            @if ($errors->any())
               <div class="error-container">
                <ul class="message-container">
                    @foreach ($errors->all() as $error)
                       <li class="error-message">{{$error}}</li>

                    @endforeach
                </ul>
               </div>

            @endif



          <input type="text" placeholder="Entrer votre émail" name="email" class="input-text"
          value="{{old('email')}}"/>
          {{-- @error('email')
             <span style="color: red; font-size: 14px;">{{$message}}</span>
          @enderror --}}

          <input type="password" placeholder="Entrer votre mot de passe" name="password" class="input-text"
          value="{{old('password')}}"/>
          {{-- @error('password')
             <span style="color: red; font-size: 14px;">{{$message}}</span>

          @enderror --}}
        </div>
        <div class="forget-password-group">

        </div>
          <input type="submit" value="Se connecter" class="input-submit"/>
        </form>
    </div>

</body>
</html>
