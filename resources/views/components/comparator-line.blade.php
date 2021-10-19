<tr>
    @foreach($statsJeu as $stat=>$value)
        @if($stat=="Note moyenne")
        <td>{{ $value ? round($value,2) : "Pas de notes" }}</td>
        @elseif($stat=="Date de parution")
        <td>{{$value->translatedFormat('d/m/Y')}}</td>
        @elseif($stat=="Nom")
        <td><a href="/videoGameDetail/{{$idJeu}}">{{$value}}</a>
        @else
        <td>{{$value}}</td>
        @endif
    @endforeach
</tr>