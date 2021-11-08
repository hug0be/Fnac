@extends('base')

@section('css')
    <link rel="stylesheet" href="{{ asset("css/sideBar/sideBar-home.css") }}">
    <link rel="stylesheet" href="{{ asset("css/content/content-home.css") }}">
    <link rel="stylesheet" href="{{ asset("css/auth/register.css") }}">
    <style>
        .role_checkbox {
            padding: 10px 20px 10px 20px;
        }
    </style>
@endsection

@section('content')
<div class="container_title_create_account margin_top_content">
    <div class="container_title_create_account margin_top_content">
        <h1>Administration</h1>
    </div>
    
    <x-validation-message/>
    
    {{-- Edition d'employés --}}
    <div class="container_main_subTitle_form">

        <div class="container_subTitle">
            <h2 class="subTitle_contact_info">Gérer les employés</h2>
        </div>
        <x-input-error name="mail"/>
        <x-input-error name="roles"/>
        @foreach ($employes as $emp)
        <div style="padding-left: 10%;">
            <div style="display: flex;  cursor: pointer;" class="dropdown_btn">
                <p style="width: 25%">{{$emp->mail()}}</p><i class="fas fa-chevron-down"></i>
            </div>
            <form style="padding-bottom: 10px" class="dropdown" action="{{route("admin.edit")}}" method="post">
                @csrf 
                <input type="hidden" name="id" value={{$emp->id()}}>
                
                {{-- Mail --}}
                <div class="input_box">
                    <label for="mail">Changer le mail</label>
                    <input type="text" name="mail" value="{{$emp->mail()}}" class="input_field input_real_field"/>
                </div>

                {{-- Roles --}}
                <div class="input_box">
                    <label for="roles[]">Rôles :</label>
                    @foreach ($roles as $role)
                    <div class="role_checkbox">
                        <label for="{{$role->nom()}}">{{$role->nom()}}</label>
                        <input name="roles[]" type="checkbox" value="{{$role->id()}}" id="{{$role->nom()}}" @if($emp->hasRole($role->nom())) checked @endif />
                    </div>
                    @endforeach
                </div>

                <div class="input_box">
                    <input class="btn_submit" type="submit" value="Modifier">
                </div>
            </form>
        </div>
        @endforeach
    </div>

    {{-- Addition d'employé --}}
    <div class="container_main_subTitle_form">
        <div class="container_subTitle">
            <h2 class="subTitle_contact_info">Créer un compte employé</h2>
        </div>

        <div class="container_form_create_account">
            <form method="post" action="{{route("admin.add")}}" class="form_create_account">
                @csrf
                <x-input-error name="add_mail"/>
                <div class="input_box">
                    <label for="add_mail" class="label_field label_real_field">Email *</label>
                    <input type="text" name="add_mail" value="{{ old('add_mail') }}" class="input_field input_real_field"/>
                </div>

                <x-input-error name="add_mdp"/>
                <div class="input_box">
                    <label for="add_mdp" class="label_field">Mot de passe *</label>
                    <input type="password" name="add_mdp" class="input_field input_real_field"/>
                </div>
                
                <x-input-error name="add_mdp_confirmation"/>
                <div class="input_box">
                    <label for="add_mdp_confirmation" class="label_field">Confirmation *</label>
                    <input type="password" name="add_mdp_confirmation" class="input_field input_real_field"/>
                </div>

                <x-input-error name="add_roles"/>
                <div class="input_box">
                    <label for="add_roles[]" class="label_field">Rôles :</label>
                    @foreach ($roles as $role)
                        <div class="role_checkbox">
                            <label for="{{$role->nom()}}">{{$role->nom()}}</label>
                            <input name="add_roles[]" type="checkbox" value="{{$role->id()}}" id="{{$role->nom()}}"/>
                        </div>
                    @endforeach
                </div>
                
                <input type="submit" value="Créer mon compte" class="btn_submit"/>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script src="{{ asset("js/sideBar-toggle/sideBar-home.js") }}"></script>
    <script src="{{ asset("js/dropdown.js") }}"></script>
@endsection