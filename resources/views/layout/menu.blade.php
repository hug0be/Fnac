<div class="menu_nav_sidebar">
    <div class="menu_nav_sidebar_content">
        
        <div class="menu_nav_sidebar_container_aisle">
            @auth
            <h4 class="menu_nav_sidebar_title menu_nav_sidebar_title_favoris">
                <a href="{{ route('favoritesGames') }}">
                    JEUX FAVORIS
                </a>
<<<<<<< HEAD
            </h4>    
            <h4 class="menu_nav_sidebar_title menu_nav_sidebar_title_favoris">
                <a href="{{ route('myCommandes') }}">
                    MES COMMANDES
                </a>
            </h4> 
=======
            </h4>
>>>>>>> mes_commandes
            @endauth
            <h4 class="menu_nav_sidebar_title">
                
                <a href="{{ route('home') }}">
                    TOUS LES RAYONS
                </a>
            </h4>        
            @foreach ($rayons as $rayon)
                <div class="menu_nav_sidebar_container_link">
                    <a href="{{route("searchByRayon", ['idRayon' => $rayon->ray_id]);}}" class="link_menu_nav_sidebar" >{{ $rayon->ray_nom}}</a>
                </div>
            @endforeach
        </div>

        <div class="menu_nav_sidebar_container_console">
            <h4 class="menu_nav_sidebar_title">
                <a href="{{ route('home') }}">
                    TOUTES LES CONSOLES
                </a>
            </h4>
    
            
                @foreach ($consoles as $console)
                    <div class="menu_nav_sidebar_container_link">
                        <a href="{{route("searchByConsole", ['idConsole' => $console->con_id]);}}" class="link_menu_nav_sidebar" >{{ $console->con_nom}}</a>
                    </div>
                @endforeach
        </div>
    </div>
</div>