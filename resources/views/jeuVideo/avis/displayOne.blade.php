

<div class="container_detail_game_content_notice_card">
    <p class="notice_card_name">  {{ $aNotice->client->firstnameUcFirst() }} {{ $aNotice->client->surnameFirstLetter() }}. </p>
    <p class="notice_card_date">Avis posté le {{ $aNotice->avi_date->translatedFormat('l jS F Y à H\hi') }}</p>
    <p class="notice_card_title"> {{ $aNotice->avi_titre }} </p>
    <p class="notice_card_descr"> {{ $aNotice->avi_detail }} </p>

    <p class="container_notice_useful">
        <p class="notice_useful_txt">Cet avis vous a été utile ?</p>

        <div class="container_notice_useful_answer">
            <form action="{{ route("add_avisUtile")}}" method="POST">
                @csrf
                <input type="hidden" name='avisId' value="{{$aNotice->id()}}">
                <input type="submit" value="Oui{{$aNotice->nbUtiles()}}" class="notice_useful_answer notice_useful_answer_yes">
            </form>
            
            <form action="{{ route("add_avisInutile")}}" method="POST">
                @csrf
                <input type="hidden" name='avisId' value="{{$aNotice->id()}}">
                <input type="submit" value="Non{{$aNotice->nbPasUtile()}}" class="notice_useful_answer notice_useful_answer_no">
            </form>
        </div>
    </p>
</div>