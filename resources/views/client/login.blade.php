@extends('base')

@section('css')
    <link rel="stylesheet" href="{{ asset("css/sideBar/sideBar-home.css") }}">
    <link rel="stylesheet" href="{{ asset("css/content/content-home.css") }}">
    <link rel="stylesheet" href="{{ asset("css/auth/login.css") }}">
    <link rel="stylesheet" href="{{ asset("css/auth/register.css") }}">

@endsection




@section('content')

<div class="container_main_login">
    <div class="container_login_form">
        <x-validation-message/>
        <h2 class="title_login">Se connecter</h2>
        <form method="post" actions="login" class="form_login">
            @csrf
            <x-input-error name="mail"/>
            <div class="input_box">
                <input type="text" name="mail" value="{{old('mail')}}" class="input_login" required/>
                <label for="mail">Email</label>
            </div>
            
            <x-input-error name="password"/>
            <div class="input_box">                
                <input type="password" name="password" class="input_login" required/> 
                <label for="password">Mot de passe</label>
            </div>

            <div class="input_box">
                <label for="remember_me">Se rappeler de moi</label>
                <input type="checkbox" name="remember_me">
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