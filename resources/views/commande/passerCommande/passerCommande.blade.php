
@extends('base')

@section('css')
    <link rel="stylesheet" href="{{ asset("css/sideBar/sideBar-videoGame-detail.css") }}">
    <link rel="stylesheet" href="{{ asset("css/commande/commande.css") }}">
    {{-- <link rel="stylesheet" href="{{ asset("css/content/content-home.css") }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset("css/client/detail-account.css") }}"> --}}

@endsection




@section('header') 
    @include('layout.header-videoGame-detail')
@endsection




@section('content')

@include('layout.menu')

<div class="container_order margin_top_content">

    <h1 class="order_title">Passer ma commande</h1>


    <div class="container_order_content">

        <div class="container_form_order">
            <form action="{{route("createCommande")}}" method="post" class="">

                @csrf

                <h3 class="order_form_title">Mode de livraison</h3>

                <div class="order_container_all_radio">

                    <div class="order_input_box_radio">
                        {{-- <input type="radio" id="adr" name="typeDelivery" value="adr"
                        checked> --}}
                        <input type="radio" id="adr" name="typeDelivery" value="adr" {{ old("typeDelivery")=="adr" ? "checked" : "" }}>

                        <label for="adr"> <span class="order_type_icon"> <i class="fas fa-home"></i> </span> Domicile </label>
                    </div>
                    
                    <div class="order_input_box_radio">
                        <input type="radio" id="rel" name="typeDelivery" value="rel" {{ old("typeDelivery")=="rel" ? "checked" : "" }}>
                        <label for="rel"> <span class="order_type_icon"> <i class="fas fa-map-marked-alt"></i> </span> Relais </label>
                    </div>

                    
                    <div class="order_input_box_radio">
                        <input type="radio" id="mag" name="typeDelivery" value="mag" {{ old("typeDelivery")=="mag" ? "checked" : "" }}>
                        <label for="mag"> <span class="order_type_icon"> <i class="fas fa-store-alt"></i> </span> Magasin </label>
                    </div>

                </div>



                <div class="order_container_all_select">

                    <div class="order_input_box_select order_input_box_select_home" id="adr">
                        <label for="adresse-select">Adresse :</label>
                    
                        <select name="adresse" id="adresse-select">
                            <option value="">-- Adresse --</option>
                            @foreach ($adresseList as $adresse)
                            <option value="{{ $adresse->id() }}" {{ old("adr_id")==$adresse->id() ? "selected" : "" }}>{{ $adresse->nom() }} ({{ $adresse->ville() }})</option>
                            @endforeach
                        </select>
                    </div>
                    
    
                    <div class="order_input_box_select order_input_box_select_relay" id="rel">
                        <label for="relai-select">Relais :</label>
                        <select name="relai" id="relai-select">
                            <option value="">-- Relais --</option>
                            @foreach ($relayList as $relay)   
                            <option value="{{ $relay->id() }}" {{ old("rel_id")== $relay->id() ? "selected" : "" }}>{{ $relay->nom() }} ({{ $relay->ville() }})</option>
                            @endforeach
                        </select>
                    </div>
                    
                    
                    <div class="order_input_box_select order_input_box_select_shop" id="mag">
                        <label for="relai-select">Magasin :</label>
                        <select name="magasin" id="relai-select">
                            <option value="">-- Magasin --</option>
                            @foreach ($magasinList as $magasin)                               
                            <option value="{{ $magasin->id() }}" {{ old("mag_id")== $magasin->id() ? "selected" : "" }}>{{ $magasin->nom() }} ({{ $magasin->ville() }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>
        
           
                <ul class="error error_form_order">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
              
        
              
        
                <div class="container_btn_order">
                    <button type="submit" class="btn_submit_order">Payer</button>
                </div>

            </form>

        </div>


    </div>

   

</div>


@endsection







@section('js')
    <script src="{{ asset("js/sideBar-toggle/sideBar-videoGame-detail.js") }}"></script>
    <script src="{{ asset("js/commande/typeDeliverySelected.js") }}"></script>
    {{-- <script src="{{ asset("js/content/content-videoGame-detail.js") }}"></script> --}}


@endsection

