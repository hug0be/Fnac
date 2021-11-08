@extends('base')

@section('css')
    <link rel="stylesheet" href="{{ asset("css/sideBar/sideBar-home.css") }}">
    <link rel="stylesheet" href="{{ asset("css/content/content-home.css") }}">
    <link rel="stylesheet" href="{{ asset("css/auth/register.css") }}">
@endsection

@section('content')
<div class="container_title_create_account margin_top_content">
    <div class="container_title_create_account margin_top_content">
        <h1 class="title_create_account">Modifier votre mot de passe</h1>
    </div>
    <x-validation-message/>
    <div>
        <form method="post" action= "/password">
            @csrf
            <x-input-error name="current_password"/>
            <div class="input_box">
                <label for="current_password" class="label_field" >Mot de passe actuel</label>
                <input type="password" name="current_password" class="input_field input_real_field"/>
            </div>

            <x-input-error name="new_password"/>
            <div class="input_box">
                <label for="new_password" class="label_field" >Nouveau mot de passe</label>
                <input type="password" name="new_password" class="input_field input_real_field"/>
            </div>
            
            <x-input-error name="new_password_confirmation"/>
            <div class="input_box">
                <label for="new_password_confirmation" class="label_field" >Confirmer le mot de passe</label>
                <input type="password" name="new_password_confirmation" class="input_field input_real_field"/>
            </div>

            <input type="submit" value="Modifier" class="btn_submit"/>
        </form>
    </div>
</div>
@endsection

@section('js')
    <script src="{{ asset("js/sideBar-toggle/sideBar-home.js") }}"></script>
@endsection