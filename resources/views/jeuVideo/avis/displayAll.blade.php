<div class="container_detail_game_content_notice ">

    <h4 class="container_detail_game_content_notice_title">
        Avis Client
    </h4>

    <div class="container_detail_game_content_all_notice_card">

        @foreach ($videoGame->avis as $aNotice)
            @include('jeuVideo.avis.displayOne')
        @endforeach

    </div>                
   
</div>