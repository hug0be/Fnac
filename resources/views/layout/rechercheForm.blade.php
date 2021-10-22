
        <div class="container_search">
            <form action="{{route("rechercheJeu")}}" method="post">
                @csrf
                <input type="text" name="barreRecherche" id="" placeholder="Rechercher un produit" class="header_search_input">
                <button class="btn_search" type="submit">
                    <img src="{{ asset('/img/icon/icon-search.svg')}}" alt="" class="header_search_img">
                </button>
            </form>
        </div>