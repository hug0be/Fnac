@section('css')
    <link rel="stylesheet" href="{{ asset("css/content/content-home.css") }}">
@endsection

<header class="header">
    <div class="header_container_toggle_aisle">
        <div class="toggle_btn">
            <span></span>
        </div>

        <p class="toggle_txt" >Rayons </p>
    </div>

    <a href="{{ route('home') }}" class="link_container_logo_header">
        <div class="header_container_logo header_border_right">
            <img src="{{ asset('/img/logo/logo-fnac.svg')}}" alt="" class="logo_img">
        </div>
    </a>

    <div class="header_container_aisle_search header_border_right">

        <div class="container_aisle">

            <div class="aisle_content">
                <p> {{ $currentRay->ray_nom ?? 'Rayons' }} </p> <i class="fas fa-chevron-down header_aisle_chevron_down"></i>
            </div>

            <div class="header_aisle_dropdown">
                @foreach ($rayons as $rayon)
                    <a href="{{route("searchByRayon", ['idRayon' => $rayon->ray_id]);}}" class="header_aisle_dropdown_item" >{{ $rayon->ray_nom}}</a>
                @endforeach
            </div>

        </div>
        @include('layout.rechercheForm')
    </div>


    <!-- Login and register buttons -->
    <div class="container_header_account">
        @auth
        <div class="header_container_aisle_search header_border_right">
            <div class="settings_container">
                <div class="aisle_container" style="font-size:20px; padding:10px">
                    <i class="fas fa-cog"></i><i class="fas fa-chevron-down header_aisle_chevron_down"></i>
                </div>
                <div class="settings_dropdown">
                    <a href="{{route("profile");}}" class="settings_dropdown_item">
                        <i class="fas fa-user"></i><span class="settings_text">Mon profil</span>
                    </a>
                    <a href="{{ route("panier") }}" class="settings_dropdown_item">
                        <i class="fas fa-shopping-bag"></i><span class="settings_text">Mon panier</span>
                    </a>
                    <a href="{{ route('myCommandes') }}" class="settings_dropdown_item">
                        <span class="settings_text">Mes commandes</span>
                    </a>
                    <a href="{{route("logout");}}" class="settings_dropdown_item">
                        <i class="fas fa-sign-out-alt"></i><span class="settings_text">Se déconnecter</span>
                    </a>
                </div>
            </div>
        </div> 
        @endauth
        @guest
        <a href="{{ route("panier") }}" class="header_link_account">Panier</a>
            <a href="{{route("login")}}" class="header_link_login header_link">
                <span class="login_txt log_txt">Se connecter</span> 
                <span class="login_icon log_icon"> <i class="fas fa-sign-in-alt"></i> </span> 
            </a>
        @endguest
    </div>
</header>
@section('js')
    <script src="{{ asset("js/sideBar-toggle/sideBar-home.js") }}"></script>
@endsection