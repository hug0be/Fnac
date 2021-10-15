@extends('base')

{{-- 
@section('css')
    <link rel="stylesheet" href="{{ asset("css/header/header.css") }}">
@endsection --}}

@section('css')
    <link rel="stylesheet" href="{{ asset("css/sideBar/sideBar-home.css") }}">
    <link rel="stylesheet" href="{{ asset("css/content/content-home.css") }}">

@endsection

@section('content')<div class="container_detail_game ">
    <div class="margin_top_content">
        {{ $errors }}
        <form method="post" action="register">
            @csrf
            <label for="cli_civilite">Civilite</label>
            <input type="radio" name="cli_civilite" value="M"
                @if(old('cli_civilite')=='M') checked @endif>
            <label for="M">M</label>
            <input type="radio" name="cli_civilite" value="Mlle"
                @if(old('cli_civilite')=='Mlle') checked @endif>
            <label for="Mlle">Mlle</label>
            <input type="radio" name="cli_civilite" value="Mme"
                @if(old('cli_civilite')=='Mme') checked @endif>
            <label for="Mme">Mme</label>
            <label for="cli_mel">Email</label>
            <input type="text" name="cli_mel" value="{{ old('cli_mel') }}"/>
            <label for="cli_motpasse">Mot de passe</label>
            <input type="password" name="cli_motpasse"/>
            <label for="cli_motpasse_confirmation">Confirmation du mot de passe</label>
            <input type="password" name="cli_motpasse_confirmation"/>
            <label for="cli_nom">Nom :</label>
            <input type="text" name="cli_nom" value="{{ old('cli_nom') }}"/>
            <label for="cli_prenom">Prenom :</label>
            <input type="text" name="cli_prenom" value="{{ old('cli_prenom') }}"/>
            <label for="cli_pseudo">Pseudonyme :</label>
            <input type="text" name="cli_pseudo" value="{{ old('cli_pseudo') }}"/>
            <label for="cli_telportable">Portable :</label>
            <input type="text" name="cli_telportable" value="{{ old('cli_telportable') }}"/>
            <label for="cli_telfixe">Fixe :</label>
            <input type="text" name="cli_telfixe" value="{{ old('cli_telfixe') }}"/>
            <input type="submit" value="Créer un compte"/>
        </form>
    </div>
@endsection



@section('js')
    <script src="{{ asset("js/sideBar-toggle/sideBar-home.js") }}"></script>
@endsection