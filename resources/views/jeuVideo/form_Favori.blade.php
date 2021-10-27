<div class="favori">
    @auth
        <h1>
            <form action="{{ route("toggle_favori")}}" method="POST">
                @csrf
                <input type="hidden" name='jeuId' value="{{$videoGame->id()}}">
                <button type="submit" class="">{{
                    Auth::user()->haveThisGameInfavorite($videoGame->id()) ?
                    "Enlever"
                    : "Ajouter"
                }} favori</button>
            </form>
            
        </h1>    
    @endauth
</div>