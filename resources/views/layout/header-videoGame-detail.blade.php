



<header class="header">

    <div class="header_container_toggle_aisle_videoGame_detail">
        <div class="toggle_btn_videoGame_detail">
            <span></span>
        </div>

        <p class="toggle_txt_videoGame_detail" >Rayons</p>
    </div>



    

    <a href="{{ route('home') }}" class="link_container_logo_header">
        <div class="header_container_logo header_border_right">
            <img src="{{ asset('/img/logo/logo-fnac.svg')}}" alt="" class="logo_img">
        </div>
    </a>


    <div class="header_container_aisle_search header_border_right">

        <div class="container_aisle">

            <div class="aisle_content">
                <p>Rayons</p> <i class="fas fa-chevron-down header_aisle_chevron_down"></i>
            </div>

            <div class="header_aisle_dropdown">
                @foreach ($rayons as $rayon)
                    <a href="{{route("searchByRayon", ['idRayon' => $rayon->ray_id]);}}" class="header_aisle_dropdown_item" >{{ $rayon->ray_nom}}</a>
                @endforeach
            </div>

        </div>

        <div class="container_search">
            <input type="text" name="" id="" placeholder="Rechercher un produit" class="header_search_input">
            <div class="btn_search">
                <img src="{{ asset('/img/icon/icon-search.svg')}}" alt="" class="header_search_img">
            </div>
        </div>
    </div>

    <div class="container_header_account" >
        @auth
            <a href="{{ route("detailAccount") }}" class="header_link_account">
                <i class="fas fa-user"></i>
            </a>
            <a href="{{route("logout")}}" class="header_link_logout header_link">
                <span class="logout_txt log_txt">Se déconnecter</span> 
                <span class="logout_icon log_icon"> <i class="fas fa-sign-out-alt"></i> </span>
            </a>
        @endauth
        @guest
            <a href="{{route("login")}}" class="header_link_login header_link">
                <span class="login_txt log_txt">Se connecter</span> 
                <span class="login_icon log_icon"> <i class="fas fa-sign-in-alt"></i> </span> 
            </a>
        @endguest
    </div>
</header>   