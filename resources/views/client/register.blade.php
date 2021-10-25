@extends('base')

@section('css')
    <link rel="stylesheet" href="{{ asset("css/sideBar/sideBar-home.css") }}">
    <link rel="stylesheet" href="{{ asset("css/content/content-home.css") }}">
    <link rel="stylesheet" href="{{ asset("css/auth/register.css") }}">

@endsection

@section('content')

    <div class="container_title_create_account margin_top_content">
        <h1 class="title_create_account">Créer votre compte</h1>
    </div>

    <div class="container_main_subTitle_form">

        <div class="container_subTitle">
            <h2 class="subTitle_contact_info">Vos coordonnées</h2>
        </div>

        <div class="container_form_create_account">
            <form method="post" action="register" class="form_create_account">
                @csrf
                <x-input-error name="civilite"/>
                <div class="input_box">
                    <label for="civilite" class="label_field" >Civilité *</label>
                    <div class="input_field input_field_civility">
                        <input type="radio" name="civilite" value="M"
                            @if(old('civilite')=='M') checked @endif>
                        <label for="M">M</label>

                        <input type="radio" name="civilite" value="Mlle"
                            @if(old('civilite')=='Mlle') checked @endif>
                        <label for="Mlle">Mlle</label>

                        <input type="radio" name="civilite" value="Mme"
                            @if(old('civilite')=='Mme') checked @endif>
                        <label for="Mme">Mme</label>
                    </div>
                </div>
                <x-input-error name="mail"/>
                <div class="input_box">
                    <label for="mail" class="label_field label_real_field">Email *</label>
                    <input type="text" name="mail" value="{{ old('mail') }}" class="input_field input_real_field"/>
                </div>

                <x-input-error name="nom"/>
                <div class="input_box">
                    <label for="nom" class="label_field" >Nom *</label>
                    <input type="text" name="nom" value="{{ old('nom') }}" class="input_field input_real_field"/>
                </div>
                
                <x-input-error name="prenom"/>
                <div class="input_box">
                    <label for="prenom" class="label_field" >Prénom *</label>
                    <input type="text" name="prenom" value="{{ old('prenom') }}" class="input_field input_real_field"/>
                </div>

                <x-input-error name="pseudo"/>
                <div class="input_box">
                    <label for="pseudo" class="label_field" >Pseudonyme *</label>
                    <input type="text" name="pseudo" value="{{ old('pseudo') }}" class="input_field input_real_field"/>
                </div>
                
                <x-input-error name="portable"/>
                <div class="input_box">
                    <label for="portable" class="label_field" >Portable *</label>
                    <input type="text" name="portable" value="{{ old('portable') }}" class="input_field input_real_field"/>
                </div>
                
                <x-input-error name="fixe"/>
                <div class="input_box">
                    <label for="fixe" class="label_field" >Fixe *</label>
                    <input type="text" name="fixe" value="{{ old('fixe') }}" class="input_field input_real_field"/>
                </div>

                <x-input-error name="mdp"/>
                <div class="input_box">
                    <label for="mdp" class="label_field" >Mot de passe *</label>
                    <input type="password" name="mdp" class="input_field input_real_field"/>
                </div>
                
                <x-input-error name="mdp_confirmation"/>
                <div class="input_box">
                    <label for="mdp_confirmation" class="label_field" >Confirmation *</label>
                    <input type="password" name="mdp_confirmation" class="input_field input_real_field"/>
                </div>
                
                <input type="submit" value="Créer mon compte" class="btn_submit"/>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset("js/sideBar-toggle/sideBar-home.js") }}"></script>
@endsection