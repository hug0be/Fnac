@extends('base')

{{-- 
@section('css')
    <link rel="stylesheet" href="{{ asset("css/header/header.css") }}">
@endsection --}}

@section('css')
    <link rel="stylesheet" href="{{ asset("css/sideBar/sideBar-home.css") }}">
    <link rel="stylesheet" href="{{ asset("css/content/content-home.css") }}">
    <link rel="stylesheet" href="{{ asset("css/auth/login.css") }}">

@endsection




@section('content')

<div class="container_main_login">
    {{-- {{ $errors }} --}}

    <div class="container_login_form">

        <h2 class="title_login">Se connecter</h2>

        <form method="post" actions="login" class="form_login">
            @csrf
    
            <div class="input_box">
                
                <input type="text" name="cli_mel" value="{{old('cli_mel')}}" class="input_login" required/>
                <label for="cli_mel">Email</label>
            </div>
    
    
            <div class="input_box">
                
                <input type="password" name="cli_motpasse" class="input_login" required/> 
                <label for="cli_mel">Mot de passe</label>
            </div>


            <div class="container_create_account">
                <a href="{{route("register")}}" class="link_create_account">Créer mon compte </a>
            </div>
    
         
            <input type="submit" value="Se connecter" class="btn_submit"/>
        </form>
    </div>
 
</div>








@endsection

@section('js')
    <script src="{{ asset("js/sideBar-toggle/sideBar-home.js") }}"></script>
@endsection