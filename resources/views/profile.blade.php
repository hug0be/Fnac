@extends('base')

@section('css')
    <link rel="stylesheet" href="{{ asset("css/sideBar/sideBar-home.css") }}">
    <link rel="stylesheet" href="{{ asset("css/content/content-home.css") }}">
    <link rel="stylesheet" href="{{ asset("css/auth/register.css") }}">
@endsection

@section('content')
<div class="container_title_create_account margin_top_content">
    <x-forms.profile :edit-mode="true" :data="$compte" title="Modifier"/>
</div>
@endsection

@section('js')
    <script src="{{ asset("js/sideBar-toggle/sideBar-home.js") }}"></script>
@endsection