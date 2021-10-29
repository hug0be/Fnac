
@extends('base')

@section('css')
    <link rel="stylesheet" href="{{ asset("css/sideBar/sideBar-home.css") }}">
    <link rel="stylesheet" href="{{ asset("css/content/content-home.css") }}">
    <link rel="stylesheet" href="{{ asset("css/client/detail-account.css") }}">

@endsection





@section('content')

<div class="margin_top_content">

    <h1>Choisir une adresse de livraison</h1>

    <form action="" method="post">
        <div>
            <label for="adr">Domicile : </label>
            <input type="radio" id="adr" name="typeDelivery" value="adr"
                    checked>
        </div>
        
        <div>
            <label for="rel">Relais :</label>
            <input type="radio" id="rel" name="typeDelivery" value="rel">
        </div>
        
        <div>
            <label for="mag">Magasin :</label>
            <input type="radio" id="mag" name="typeDelivery" value="mag">
        </div>

        <label for="adresse-select">Choose an adresse :</label>
        
        <select name="adresse" id="adresse-select">
            <option value="">--Please choose an option--</option>
            @foreach ($adresseList as $adresse)
            
            <option value="{{ $adresse->id() }}">{{ $adresse->nom() }} ({{ $adresse->ville() }})</option>
            @endforeach
        </select>
        
        
        <label for="relai-select">Choose an adresse :</label>
        <select name="relai" id="relai-select">
            <option value="">--Please choose an option--</option>
            @foreach ($relayList as $relay)
                
            <option value="{{ $relay->id() }}">{{ $relay->nom() }} ({{ $relay->ville() }})</option>
            @endforeach
        </select>

        <label for="relai-select">Choose an adresse :</label>
        <select name="magasin" id="relai-select">
            <option value="">--Please choose an option--</option>
            @foreach ($magasinList as $magasin)
                
            <option value="{{ $magasin->id() }}">{{ $magasin->nom() }} ({{ $magasin->ville() }})</option>
            @endforeach
        </select>


        <button type="submit">Commander</button>
    </form>
</div>


@endsection

