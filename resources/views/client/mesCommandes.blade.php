@extends('base')


@section('css')
    <link rel="stylesheet" href="{{ asset("css/sideBar/sideBar-videoGame-detail.css") }}">
    <link rel="stylesheet" href="{{ asset("css/serviceClient/commandeVeille.css") }}">

@endsection

@section('header')
    @include('layout.header-videoGame-detail')
@endsection

@section('content')

    @include('layout.menu')

    <div class="container_all_commande margin_top_content">
        
        <h1 class="">Mes commandes{{$textEnCours}} :</h1>
        
        @if ($textEnCours =="")
            <a href="/mes-commandes-en-cours" class="access_commands_link">Accéder aux commandes en cours</a>
        @else
            <a href="/mes-commandes" class="access_commands_link">Accéder à toutes vos commandes</a>
        @endif
        <div class="container_all_commande_content">
            <x-validation-message/>
            @include('commande.displayAll')
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset("js/sideBar-toggle/sideBar-videoGame-detail.js") }}"></script>
    <script src="{{ asset("js/content/content-videoGame-detail.js") }}"></script>
@endsection