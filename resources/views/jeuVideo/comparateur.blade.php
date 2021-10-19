@extends('base')

@section('css')
    <link rel="stylesheet" href="{{ asset("css/sideBar/sideBar-home.css") }}">
    <link rel="stylesheet" href="{{ asset("css/content/content-home.css") }}">
@endsection

@section('content')
    @include('layout.menu')
    <div>COMPARATEUR</div>
@endsection