@extends('base')

@section('css')
    <link rel="stylesheet" href="{{ asset("css/sideBar/sideBar-home.css") }}">
    <link rel="stylesheet" href="{{ asset("css/content/content-home.css") }}">
    <link rel="stylesheet" href="{{ asset("css/auth/register.css") }}">
@endsection

@section('content')
<div class="container_title_create_account margin_top_content">
    <div class="container_title_create_account margin_top_content">
        <h1 class="title_create_account">Votre compte employé</h1>
    </div>
    <x-validation-message/>
    <div class="container_form_create_account">
        <form method="post" action="/profile" class="form_create_account">
            @csrf
            <input type="hidden" name="emp_id" value="{{$compte->id()}}">

            <x-input-error name="email"/>
            <div class="input_box">
                <label for="email" class="label_field label_real_field">Email *</label>
                <input type="text" name="email" value="{{$compte->mail()}}" class="input_field input_real_field"/>
            </div>

            <div class="input_box">
                <label for="email" class="label_field label_real_field">Vos rôles</label>
                @foreach($compte->roles as $role)
                <div class="etiquette">{{ $role->nom() }}</div>
                @endforeach
            </div>
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