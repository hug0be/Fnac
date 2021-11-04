<div class="container_header_account">
    @if(Auth::check() || Auth::guard('employe')->check())
        {{-- AUTHENTIFIE --}}
        <div class="header_container_aisle_search header_border_right">
            <div class="settings_container">
                <div class="aisle_container" style="font-size:20px; padding:10px">
                    <i class="fas fa-cog"></i><i class="fas fa-chevron-down header_aisle_chevron_down"></i>
                </div>
                <div class="settings_dropdown">
                    {{-- CLIENT --}}
                    @auth
                        <a href="{{ route("cli.profile") }}" class="settings_dropdown_item">
                            <i class="fas fa-user"></i><span class="settings_text">Mon profil</span>
                        </a>
                        <a href="{{ route("panier") }}" class="settings_dropdown_item">
                            <i class="fas fa-shopping-bag"></i><span class="settings_text">Mon panier</span>
                        </a>
                        <a href="{{ route('myCommandes') }}" class="settings_dropdown_item">
                            <i class="fas fa-truck"></i><span class="settings_text">Mes commandes</span>
                        </a>
                    @endauth

                    {{-- EMPLOYE --}}
                    @employe
                        <a href="{{ route("emp.profile") }}" class="settings_dropdown_item">
                            <i class="fas fa-user"></i><span class="settings_text">Mon profil</span>
                        </a>
                    @endemploye

                    {{-- ADMIN --}}
                    @admin
                        <a href="{{ route("admin") }}" class="settings_dropdown_item">
                            <i class="fas fa-users-cog"></i></i><span class="settings_text">Administration</span>
                        </a>
                    @endadmin

                    {{-- SERVICE COMM --}}
                    @role(['service comm'])
                        <a href="{{ route("avisAbusifs") }}" class="settings_dropdown_item">
                            <i class="fas fa-exclamation-triangle"></i><span class="settings_text">Avis signalés</span>
                        </a>
                    @endrole

                    {{-- SERVICE CLIENT --}}
                    @role(['service client'])
                        <a href="{{ route("commandeVeille") }}" class="settings_dropdown_item">
                            <i class="fas fa-business-time"></i><span class="settings_text">Commande de la veille</span>
                        </a>
                    @endrole
                    
                    <a href="{{route("logout");}}" class="settings_dropdown_item">
                        <i class="fas fa-sign-out-alt"></i><span class="settings_text">Se déconnecter</span>
                    </a>
                </div>
            </div>
        </div>
    @else
        {{-- VISITEUR --}}
        <a href="{{route("login")}}" class="header_link_login header_link">
            <span class="login_txt log_txt">Se connecter</span> 
            <span class="login_icon log_icon"><i class="fas fa-sign-in-alt"></i> </span> 
        </a>
    @endif
</div>