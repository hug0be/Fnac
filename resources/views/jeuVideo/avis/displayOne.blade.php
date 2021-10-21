

<div class="container_detail_game_content_notice_card">

    <div class="notice_card_name_note">  
        <p class="notice_card_name"> {{ $aNotice->client->firstnameUcFirst() }} {{ $aNotice->client->surnameFirstLetter() }}. </p>  
        <p class="notice_card_note"> 
            <span class="notice_value_note">{{ $aNotice->avi_note }}</span>   

            <i class="fas fa-star notice_icon_note"></i>
            <i class="fas fa-star notice_icon_note"></i>
            <i class="fas fa-star notice_icon_note"></i>
            <i class="fas fa-star notice_icon_note"></i>
            <i class="fas fa-star notice_icon_note"></i>
        </p>
    </div>

    <p class="notice_card_date">Avis posté le {{ $aNotice->avi_date->translatedFormat('l jS F Y à H\hi') }}</p>
    <p class="notice_card_title"> {{ $aNotice->avi_titre }} </p>
    <p class="notice_card_descr"> {{ $aNotice->avi_detail }} </p>



    <div class="container_notice_useful">

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


    </div>

    <div class="notice_card_signal">
        <form action="">
            <input type="submit" value="Signaler" class="notice_card_signal_submit">
        </form>
    </div>

</div>