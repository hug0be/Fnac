@extends('base')
{{-- THEOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO c'est utile ça ?
    @section('css')
        <link rel="stylesheet" href="{{ asset("css/sideBar/sideBar-home.css") }}">
        <link rel="stylesheet" href="{{ asset("css/content/content-home.css") }}">
    @endsection 
--}}

@section('content')
    <div class="margin_top_content">COMPARATEUR

        {{ var_dump($session) }}
        {{-- <table>
        <thead>
            <tr>
                <th colspan="2">The table header</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>The table body</td>
                <td>with two columns</td>
            </tr>
        </tbody>
        </table> --}}
    </div>
@endsection