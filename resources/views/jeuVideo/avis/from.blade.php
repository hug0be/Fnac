<form action="{{ route("add_avis")}}" method="POST">
    @csrf

    <input type="hidden" name='jeu_id' value="{{$videoGame->jeu_id}}">

    Titre: <input type="text" name="avi_titre" value='{{ old("avi_titre") }}'>
    Détail: <textarea name="avi_detail">{{ old("avi_detail") }}</textarea>

    Note : <input type="number" name="avi_note" min="1" max="5" value='{{ old("avi_note") }}'>

    <ul class="error">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>

    <button type="submit">Ajouter</button>
</form>