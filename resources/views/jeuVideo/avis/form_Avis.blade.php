
<div class="container_detail_game_content_notice_add">

    <h4 class="container_detail_game_content_notice_title">
        Ajouter un Avis
    </h4>

    <div class="container_form_notice">
        <form action="{{ route("add_avis")}}" method="POST">
            @csrf

            <div class="form_notice_input_box form_notice_input_box_note">
                <label for="">Note générale </label>

                <div class="form_notice_note_stars">
                    <i class="fas fa-star notice_icon_form_note" data-valueNote="1"></i>
                    <i class="fas fa-star notice_icon_form_note" data-valueNote="2"></i>
                    <i class="fas fa-star notice_icon_form_note" data-valueNote="3"></i>
                    <i class="fas fa-star notice_icon_form_note" data-valueNote="4"></i>
                    <i class="fas fa-star notice_icon_form_note" data-valueNote="5"></i>
                </div>

                <input type="number" name="avi_note" min="1" max="5" class="form_notice_input_note_hidden" value='{{ old("avi_note") }}'>
            </div>

            <div class="form_notice_input_box form_notice_input_box_normal form_notice_input_box_title">
                <label for="">Titre de l'avis</label>
                <input type="text" name="avi_titre" value='{{ old("avi_titre") }}'>
            </div>

            <div class="form_notice_input_box form_notice_input_box_normal form_notice_input_box_detail">
                <label for="">Votre avis</label>
                <textarea name="avi_detail">{{ old("avi_detail") }}</textarea>
            </div>


            <input type="hidden" name='jeu_id' value="{{$videoGame->jeu_id}}">
        
        
            <ul class="error">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        
            <button type="submit" class="form_notice_submit">Envoyer</button>
        </form>
    </div>

    
    
</div>

