@foreach ($avisAbusifs as $avisAbusif)
    @include('jeuVideo.avis.displayOne', ['aNotice' => $avisAbusif->avis])
    <form action="{{ route("delete_avis")}}" method="POST">
        @csrf
        <input type="hidden" name='id_avis' value="{{$avisAbusif->avi_id}}">
        <button type="submit">Supprimer</button>
    </form>
@endforeach
