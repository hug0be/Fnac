@extends('base')

{{-- 
@section('css')
    <link rel="stylesheet" href="{{ asset("css/header/header.css") }}">
@endsection --}}

@section('css')
    <link rel="stylesheet" href="{{ asset("css/sideBar/sideBar-home.css") }}">
    <link rel="stylesheet" href="{{ asset("css/content/content-home.css") }}">

@endsection

@section('content')

<div class="margin_top_content">
    {{ $errors }}
    <form method="post" actions="login">
        @csrf
        <label for="cli_mel">Email</label>
        <input type="text" name="cli_mel" value="{{old('cli_mel')}}"/>
        <label for="cli_mel">Mot de passe</label>
        <input type="password" name="cli_motpasse"/> 
        <input type="submit" value="login"/>
    </form>
</div>

@endsection



@section('js')
    <script src="{{ asset("js/sideBar-toggle/sideBar-home.js") }}"></script>
@endsection