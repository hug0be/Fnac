@extends('base')


@section('css')
    <link rel="stylesheet" href="{{ asset("css/sideBar/sideBar-videoGame-detail.css") }}">
    {{-- <link rel="stylesheet" href="{{ asset("css/content/content-videoGame-detail.css") }}"> --}}
    <link rel="stylesheet" href="{{ asset("css/panier/panier.css") }}">
@endsection


@section('header') 
    @include('layout.header-videoGame-detail')
@endsection



@include('layout.menu')


<div class="container_cart margin_top_content">

    <div class="container_cart_content">


        <div class="container_all_line_cart_payment">

            <div class="container_all_line_cart">

                <h1 class="cart_title">Mon panier  </h1>
    
                @foreach ($jeuInPanier as $aLignePanier)
    
                    
                
                    <div class="container_one_cart_line">
    
                        <div class="one_cart_line_container_img">
                            <img src="{{asset("Photos/".$aLignePanier['jeu']->photoList()->first()->url())}}" alt="" class="one_cart_line_img" >                                   
                        </div>
                        
                        <div class="container_name_qty_price">

                            <div class="container_name_qty">

                
                                <a href="{{ route("detailVideoGame", ['idGame' => $aLignePanier['jeu']->id() ]) }}" class="cart_link_name">{{ $aLignePanier['jeu']->jeu_nom }}</a>


                                <div class="container_qty_all">
                                    <div class="container_form_plus">
                                        <form action="{{ route("decrement_qte_panier")}}" method="POST">
                                            @csrf
                                            <input type="hidden" name='idJeu' value="{{$aLignePanier['jeu']->id()}}">
                                            <input type="submit" value="-" class="qty_form_input">
                                        </form> 
                                    </div>

                                    <div class="container_qty_value">
                                        <p class="qty_value">
                                            {{$aLignePanier['qte']}}
                                        </p>
                                    </div>

                                    

                                    <div class="container_form_minus">
                                        <form action="{{ route("addPanier")}}" method="POST">
                                            @csrf
                                            <input type="hidden" name='idJeu' value="{{$aLignePanier['jeu']->id()}}">
                                            <input type="submit" value="+" class="qty_form_input">
                                        </form>
                                    </div>
                                    
                                </div>
                                
                            </div>


                            <div class="container_price">

                                <div class="container_price_values">
                                    <div class="game_line_price_first_value">
                                        {{ $aLignePanier['jeu']->prixTTCeuro() }}
                                    </div>
                        
                        
                                    <div class="game_line_price_second_value">
                                        €{{ $aLignePanier['jeu']->prixTTCcentime() }}
                                        
                                    </div>
                                </div>
                                
                            </div>
           
                            
                        </div>

                        
    
                        
                    
                    </div>
    
                
                @endforeach
    
            </div>


            <div class="container_payment">
                <h2 class="payment_title">Nous acceptons</h2>

                <div class="payment_container_imgs">
                    <img src=" {{ asset('/img/icon/payment/payment-google.png')}} " alt="" class="payment_img">
                    <img src=" {{ asset('/img/icon/payment/payment-mastercard.png')}} " alt="" class="payment_img">
                    <img src=" {{ asset('/img/icon/payment/payment-meastro.png')}} " alt="" class="payment_img">
                    <img src=" {{ asset('/img/icon/payment/payment-paypal.png')}} " alt="" class="payment_img">
                    <img src=" {{ asset('/img/icon/payment/payment-visa.png')}} " alt="" class="payment_img">
                </div>
            </div>


        </div>

        
       



        <div class="container_total_group">
            <h2 class="total_title">Total</h2>

            <div class="container_subTotal container_total_group_line">
                <p class="subTotal_txt">Sous-total</p>
                <p class="subTotal_price"> {{$total}}€ </p>

            </div>

            <div class="container_delivery_price container_total_group_line">
                <p class="delivery_price_txt">Livraison</p>
                <p class="delivery_price_price"> 0.00€ </p>
            </div>


            <div class="container_total container_total_group_line">
                <p class="total_txt">Total (TVA incluse)</p>
                <p class="total_price"> {{$total}}€ </p>
            </div>

            <div class="container_btn_command">
                <a href="{{route("passerCommande")}}" class="btn_command">COMMANDER</a>
            </div>

        </div>



    </div>


    

</div>





@section('js')
    <script src="{{ asset("js/sideBar-toggle/sideBar-videoGame-detail.js") }}"></script>
    {{-- <script src="{{ asset("js/content/content-videoGame-detail.js") }}"></script> --}}


@endsection