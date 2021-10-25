<div class="game_line_container_add_cart button">
    <form action="{{route("addPanier")}}" method="POST">
        @csrf
        <input type="hidden" name="idJeu" value="{{$videoGame->id()}}">
        <button class="game_line_add_cart"> <i class="fas fa-shopping-bag"></i> Ajouter au panier </button>
    </form>
</div>