
@extends('base')

@section('css')
    <link rel="stylesheet" href="{{ asset("css/sideBar/sideBar-home.css") }}">
    <link rel="stylesheet" href="{{ asset("css/content/content-home.css") }}">
    <link rel="stylesheet" href="{{ asset("css/client/detail-account.css") }}">

@endsection





@section('content')

<div class="margin_top_content">

    <h1>Choisir une adresse de livraison</h1>

    <form action="{{route("createCommande")}}" method="POST">
        @csrf
        <div>
            <label for="adr">Domicile : </label>
            <input type="radio" id="adr" name="typeDelivery" value="adr" {{ old("typeDelivery")=="adr" ? "checked" : "" }}>
        </div>
        
        <div>
            <label for="rel">Relais :</label>
            <input type="radio" id="rel" name="typeDelivery" value="rel" {{ old("typeDelivery")=="rel" ? "checked" : "" }}>
        </div>
        
        <div>
            <label for="mag">Magasin :</label>
            <input type="radio" id="mag" name="typeDelivery" value="mag" {{ old("typeDelivery")=="mag" ? "checked" : "" }}>
        </div>
        <p>
            <label for="adresse-select">choisissez une adresse :</label>
            
            <select name="adr_id" id="adresse-select">
                <option value="">--Please choose an option--</option>
                @foreach ($adresseList as $adresse)
                <option value="{{ $adresse->id() }}" {{ old("adr_id")==$adresse->id() ? "selected" : "" }}>{{ $adresse->nom() }} ({{ $adresse->ville() }})</option>
                @endforeach
            </select>

            <a href="{{route('newAdresse')}}" class="btn_submit">Ajouter une adresse à votre compte</a>

        </p>
        
        <p>
            <label for="relai-select">Choose an adresse :</label>
            <select name="rel_id" id="relai-select">
                <option value="">--Please choose an option--</option>
                @foreach ($relayList as $relay)
                <option value="{{ $relay->id() }}" {{ old("rel_id")== $relay->id() ? "selected" : "" }}>{{ $relay->nom() }} ({{ $relay->ville() }})</option>
                @endforeach
            </select>
        </p>
        <p>
            <label for="relai-select">Choose an adresse :</label>
            <select name="mag_id" id="relai-select">
                <option value="">--Please choose an option--</option>
                @foreach ($magasinList as $magasin)
                
                <option value="{{ $magasin->id() }}" {{ old("mag_id")== $magasin->id() ? "selected" : "" }}>{{ $magasin->nom() }} ({{ $magasin->ville() }})</option>
                @endforeach
            </select>
        </p>
            
            <ul class="error">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>


        <button type="submit">Commander</button>
    </form>
</div>


@endsection

