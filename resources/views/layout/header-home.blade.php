


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

        <div class="container_search">
            <input type="text" name="" id="" placeholder="Rechercher un produit" class="header_search_input">
            <div class="btn_search">
                <img src="{{ asset('/img/icon/icon-search.svg')}}" alt="" class="header_search_img">
            </div>
        </div>
    </div>
</header>


