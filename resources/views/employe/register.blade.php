@extends('base')

@section('css')
    <link rel="stylesheet" href="{{ asset("css/sideBar/sideBar-home.css") }}">
    <link rel="stylesheet" href="{{ asset("css/content/content-home.css") }}">
    <link rel="stylesheet" href="{{ asset("css/auth/register.css") }}">

@endsection

@section('content')

    <div class="container_title_create_account margin_top_content">
        <h1 class="title_create_account">Créer un compte employé</h1>
    </div>

    <div class="container_main_subTitle_form">

        <div class="container_subTitle">
            <h2 class="subTitle_contact_info">Vos coordonnées</h2>
        </div>

        <div class="container_form_create_account">
            <form method="post" action="/employe/register"" class="form_create_account">
                @csrf
                <x-input-error name="mail"/>
                <div class="input_box">
                    <label for="mail" class="label_field label_real_field">Email *</label>
                    <input type="text" name="mail" value="{{ old('mail') }}" class="input_field input_real_field"/>
                </div>

                <x-input-error name="mdp"/>
                <div class="input_box">
                    <label for="mdp" class="label_field">Mot de passe *</label>
                    <input type="password" name="mdp" class="input_field input_real_field"/>
                </div>
                
                <x-input-error name="mdp_confirmation"/>
                <div class="input_box">
                    <label for="mdp_confirmation" class="label_field">Confirmation *</label>
                    <input type="password" name="mdp_confirmation" class="input_field input_real_field"/>
                </div>
                
                <x-input-error name="role"/>
                <div class="input_box">
                    <label for="role" class="label_field">Role</label>
                    <select name="role">
                        <option value=""></option>
                        @foreach ($roles as $role)
                            <option name="role" value="{{$role->id()}}">{{$role->nom()}}</option>    
                        @endforeach
                    </select>
                </div>
                
                <input type="submit" value="Créer mon compte" class="btn_submit"/>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset("js/sideBar-toggle/sideBar-home.js") }}"></script>
@endsection