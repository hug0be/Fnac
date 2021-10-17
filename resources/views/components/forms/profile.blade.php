<div class="container_title_create_account margin_top_content">
    <h1 class="title_create_account">{{$title}} votre compte</h1>
</div>

<div class="container_main_subTitle_form">

    <div class="container_subTitle">
        <h2 class="subTitle_contact_info">Vos coordonnées</h2>
    </div>

    <div class="container_form_create_account">
        <form method="post" 
        action= @if($editMode) profile @else register @endif
        class="form_create_account">
           
            <div class="input_box">
                @csrf
                {{$errors->first('civilité')}}
                <label for="civilité" class="label_field" >Civilité *</label>
                
                <div class="input_field input_field_civility">
                    <input type="radio" name="civilité" value="M"
                    @if($data->civilite()=='M') or  
                        checked 
                        @endif>
                    <label for="M">M</label>

                    <input type="radio" name="civilité" value="Mlle"
                    @if($data->civilite()=='Mlle') checked @endif>
                    <label for="Mlle">Mlle</label>
                    
                    <input type="radio" name="civilité" value="Mme"
                    @if($data->civilite()=='Mme') checked @endif>
                    <label for="Mme">Mme</label>
                </div>
            </div>
            
            <div class="input_box">
                {{$errors->first('email')}}
                <label for="email" class="label_field label_real_field">Email *</label>
                <input type="text" name="email" value="{{$data->mail()}}" class="input_field input_real_field"/>
                
            </div>
            
            <div class="input_box">
                {{$errors->first('nom')}}
                <label for="nom" class="label_field" >Nom *</label>
                <input type="text" name="nom" value="{{$data->nom()}}" class="input_field input_real_field"/>
            </div>
            
            <div class="input_box">
                {{$errors->first('prenom')}}
                <label for="prenom" class="label_field" >Prenom *</label>
                <input type="text" name="prenom" value="{{$data->prenom()}}" class="input_field input_real_field"/>
            </div>
            
            <div class="input_box">
                {{$errors->first('pseudo')}}
                <label for="pseudo" class="label_field" >Pseudonyme *</label>
                <input type="text" name="pseudo" value="{{$data->pseudo() }}" class="input_field input_real_field"/>
            </div>
            
            <div class="input_box">
                {{$errors->first('portable')}}
                <label for="portable" class="label_field" >Portable *</label>
                <input type="text" name="portable" value="{{$data->telPortable()}}" class="input_field input_real_field"/>
            </div>
            
            <div class="input_box">
                {{$errors->first('fixe')}}
                <label for="fixe" class="label_field" >Fixe *</label>
                <input type="text" name="fixe" value="{{$data->telFixe()}}" class="input_field input_real_field"/>
            </div>
            
            @if($editMode)
                <input type="hidden" name="cli_id" value="{{$data->id_client()}}">
            @else
                <div class="input_box">
                    {{$errors->first('mdp')}}
                    <label for="mdp" class="label_field" >Mot de passe *</label>
                    <input type="password" name="mdp" class="input_field input_real_field"/>
                </div>
                
                <div class="input_box">
                    {{$errors->first('mdp_confirmation')}}
                    <label for="mdp_confirmation" class="label_field" >Confirmation *</label>
                    <input type="password" name="mdp_confirmation" class="input_field input_real_field"/>
                </div>
            @endif
            
            <input type="submit" value="{{$title}} mon compte" class="btn_submit"/>
        </form>
    </div>
</div>