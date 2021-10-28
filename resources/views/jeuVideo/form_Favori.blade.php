<div class="favori">
    @auth
        <h1>
            <form action="{{ route("toggle_favori")}}" method="POST" class="form_favori">
                @csrf
                <input type="hidden" name='jeuId' value="{{$videoGame->id()}}">
                <button type="submit">
                
                @if (Auth::user()->haveThisGameInfavorite($videoGame->id()))
                    <i class="fas fa-star favori_icon favori_icon_active"></i>
                @else
                    <i class="fas fa-star favori_icon favori_icon_disactive"></i>
                @endif
                
                </button>
            </form>
            
        </h1>    
    @endauth
</div>

{{-- 

{{
    Auth::user()->haveThisGameInfavorite($videoGame->id()) ?
    "Enlever"
    : "Ajouter"
}} favori --}}