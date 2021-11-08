<div class="container_detail_game_content_notice ">

    <h4 class="container_detail_game_content_notice_title">
        Avis Client
    </h4>
    <a href="{{route('detailVideoGameAvisNeg', ['idGame'=> $videoGame->id()])}}">Afficher les avis les plus négatifs</a>

    <div class="container_detail_game_content_all_notice_card">
        @foreach ($videoGame->avisList as $aNotice)
            @include('jeuVideo.avis.displayOne')
        @endforeach
    </div> 
    
  
</div>

@auth
    @if($boughtThisGame)
        @include('jeuVideo.avis.form_Avis')
    @endif
@endauth