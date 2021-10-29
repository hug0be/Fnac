@extends('base')

@section('css')
    <link rel="stylesheet" href="{{ asset("css/sideBar/sideBar-home.css") }}">
    <link rel="stylesheet" href="{{ asset("css/content/content-home.css") }}">
@endsection




@section('content')
<div class="margin_top_content">
    <h1>Ajouter une adresse</h1>
    @include('client.adresse.form')
</div>
@endsection

@section('js')
    <script src="{{ asset("js/sideBar-toggle/sideBar-home.js") }}"></script>
@endsection