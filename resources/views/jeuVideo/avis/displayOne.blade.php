

<div class="container_detail_game_content_notice_card">
    <p class="notice_card_name">  {{ $aNotice->client->firstnameUcFirst() }} {{ $aNotice->client->surnameFirstLetter() }}. </p>
    <p class="notice_card_date">Avis posté le {{ $aNotice->avi_date->translatedFormat('l jS F Y à H\hi') }}</p>
    <p class="notice_card_title"> {{ $aNotice->avi_titre }} </p>
    <p class="notice_card_descr"> {{ $aNotice->avi_detail }} </p>
</div>