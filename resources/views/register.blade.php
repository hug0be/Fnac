@extends('base')

{{-- 
@section('css')
    <link rel="stylesheet" href="{{ asset("css/header/header.css") }}">
@endsection --}}

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

            <div class="container_errors">
                {{-- {{ $errors }} --}}
            </div>
            
            <form method="post" action="register" class="form_create_account">
               
                <div class="input_box">
                    @csrf
                    <label for="cli_civilite" class="label_field" >Civilité *</label>

                    <div class="input_field input_field_civility">
                        <input type="radio" name="cli_civilite" value="M"
                            @if(old('cli_civilite')=='M') checked @endif>
                        <label for="M">M</label>

                        <input type="radio" name="cli_civilite" value="Mlle"
                            @if(old('cli_civilite')=='Mlle') checked @endif>
                        <label for="Mlle">Mlle</label>

                        <input type="radio" name="cli_civilite" value="Mme"
                            @if(old('cli_civilite')=='Mme') checked @endif>
                        <label for="Mme">Mme</label>
                    </div>
                </div>
                
                <div class="input_box">
                    <label for="cli_mel" class="label_field label_real_field">Email *</label>
                    <input type="text" name="cli_mel" value="{{ old('cli_mel') }}" class="input_field input_real_field"/>
                
                </div>

                <div class="input_box">
                    <label for="cli_nom" class="label_field" >Nom *</label>
                    <input type="text" name="cli_nom" value="{{ old('cli_nom') }}" class="input_field input_real_field"/>
                </div>
                
                <div class="input_box">
                    <label for="cli_prenom" class="label_field" >Prenom *</label>
                    <input type="text" name="cli_prenom" value="{{ old('cli_prenom') }}" class="input_field input_real_field"/>
                </div>

                <div class="input_box">
                    <label for="cli_pseudo" class="label_field" >Pseudonyme *</label>
                    <input type="text" name="cli_pseudo" value="{{ old('cli_pseudo') }}" class="input_field input_real_field"/>
                </div>
                
                <div class="input_box">
                    <label for="cli_telportable" class="label_field" >Portable *</label>
                    <input type="text" name="cli_telportable" value="{{ old('cli_telportable') }}" class="input_field input_real_field"/>
                </div>
                
                <div class="input_box">
                    <label for="cli_telfixe" class="label_field" >Fixe *</label>
                    <input type="text" name="cli_telfixe" value="{{ old('cli_telfixe') }}" class="input_field input_real_field"/>
                </div>

                <div class="input_box">
                    <label for="cli_motpasse" class="label_field" >Mot de passe *</label>
                    <input type="password" name="cli_motpasse" class="input_field input_real_field"/>
                </div>
                
                <div class="input_box">
                    <label for="cli_motpasse_confirmation" class="label_field" >Confirmation *</label>
                    <input type="password" name="cli_motpasse_confirmation" class="input_field input_real_field"/>
                </div>
                
                <input type="submit" value="Créer mon compte" class="btn_submit"/>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset("js/sideBar-toggle/sideBar-home.js") }}"></script>
@endsection