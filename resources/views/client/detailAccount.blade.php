@extends('base')

{{-- 
@section('css')
    <link rel="stylesheet" href="{{ asset("css/header/header.css") }}">
@endsection --}}

@section('css')
    <link rel="stylesheet" href="{{ asset("css/sideBar/sideBar-home.css") }}">
    <link rel="stylesheet" href="{{ asset("css/content/content-home.css") }}">
    <link rel="stylesheet" href="{{ asset("css/client/detail-account.css") }}">

@endsection




@section('content')

    <div class="container_account_info margin_top_content">

        {{-- {{ $detailsAccount }} --}}

        <div class="container_all_account_info_content">

            <div class="info_box">
                <p class="type_info">Civilité : </p>
                <p class="content_info"> {{ $detailsAccount->cli_civilite }} </p>
            </div>

            <div class="info_box">
                <p class="type_info">Email : </p>
                <p class="content_info"> {{ $detailsAccount->cli_mel }} </p>
            </div>

            <div class="info_box">
                <p class="type_info">Nom : </p>
                <p class="content_info"> {{ $detailsAccount->cli_nom }} </p>
            </div>

            <div class="info_box">
                <p class="type_info">Prénom : </p>
                <p class="content_info"> {{ $detailsAccount->cli_prenom }} </p>
            </div>

            <div class="info_box">
                <p class="type_info">Pseudo : </p>
                <p class="content_info"> {{ $detailsAccount->cli_pseudo }} </p>
            </div>

            <div class="info_box">
                <p class="type_info">Portable : </p>
                <p class="content_info"> {{ $detailsAccount->cli_telportable }} </p>
            </div>

            <div class="info_box">
                <p class="type_info">Fixe : </p>
                <p class="content_info"> {{ $detailsAccount->cli_telfixe }} </p>
            </div>


        </div>

        {{-- <form action="" class="form_edit_account">

            <input type="submit" value="Modifier" class="btn_edit_account">

        </form> --}}

        <a href="{{route("profile")}}" class="btn_edit_account">
            Modifier
        </a>

    </div>




@endsection

@section('js')
    <script src="{{ asset("js/sideBar-toggle/sideBar-home.js") }}"></script>
@endsection