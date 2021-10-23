@extends('base')

@section('css')
    <link rel="stylesheet" href="{{ asset("css/sideBar/sideBar-home.css") }}">
    <link rel="stylesheet" href="{{ asset("css/content/content-home.css") }}">
    <link rel="stylesheet" href="{{ asset("css/auth/register.css") }}">
@endsection

@section('content')
<div class="container_title_create_account margin_top_content">
    <div class="container_title_create_account margin_top_content">
        <h1 class="title_create_account">Votre compte</h1>
    </div>
    <x-validation-message/>
    <div class="container_subTitle">
        <h2 class="subTitle_contact_info">Vos coordonnées</h2>
    </div>
    <div class="container_form_create_account">
        <form method="post" action= "/profile" class="form_create_account">
            @csrf
            <x-input-error name="civilité"/>
            <div class="input_box">
                <label for="civilité" class="label_field" >Civilité *</label>
                
                <div class="input_field input_field_civility">
                    <input type="radio" name="civilité" value="M"
                    @if($compte->civilite()=='M') checked  @endif>
                    <label for="M">M</label>

                    <input type="radio" name="civilité" value="Mlle"
                    @if($compte->civilite()=='Mlle') checked @endif>
                    <label for="Mlle">Mlle</label>
                    
                    <input type="radio" name="civilité" value="Mme"
                    @if($compte->civilite()=='Mme') checked @endif>
                    <label for="Mme">Mme</label>
                </div>
            </div>
            
            <x-input-error name="email"/>
            <div class="input_box">
                <label for="email" class="label_field label_real_field">Email *</label>
                <input type="text" name="email" value="{{$compte->mail()}}" class="input_field input_real_field"/>
            </div>
            
            <x-input-error name="nom"/>
            <div class="input_box">
                <label for="nom" class="label_field" >Nom *</label>
                <input type="text" name="nom" value="{{$compte->nom()}}" class="input_field input_real_field"/>
            </div>
            
            <x-input-error name="prenom"/>
            <div class="input_box">
                <label for="prenom" class="label_field" >Prenom *</label>
                <input type="text" name="prenom" value="{{$compte->prenom()}}" class="input_field input_real_field"/>
            </div>
            
            <x-input-error name="pseudo"/>
            <div class="input_box">
                <label for="pseudo" class="label_field" >Pseudonyme *</label>
                <input type="text" name="pseudo" value="{{$compte->pseudo() }}" class="input_field input_real_field"/>
            </div>
            
            <x-input-error name="portable"/>
            <div class="input_box">
                <label for="portable" class="label_field" >Portable *</label>
                <input type="text" name="portable" value="{{$compte->telPortable()}}" class="input_field input_real_field"/>
            </div>
            
            <x-input-error name="fixe"/>
            <div class="input_box">
                <label for="fixe" class="label_field" >Fixe *</label>
                <input type="text" name="fixe" value="{{$compte->telFixe()}}" class="input_field input_real_field"/>
            </div>
            
            <input type="hidden" name="cli_id" value="{{$compte->id()}}">

            <input type="submit" value="Modifier mon compte" class="btn_submit"/>
        </form>
        <a href="{{route("password")}}">
            Changer de mot de passe
        </a>
    </div>
</div>
@endsection

@section('js')
    <script src="{{ asset("js/sideBar-toggle/sideBar-home.js") }}"></script>
@endsection