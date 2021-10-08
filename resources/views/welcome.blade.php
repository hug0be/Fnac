<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Fnac</title>

        <!-- Styles -->
        

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
    <h1>🐣</h1>

    @foreach ($videoGames as $videoGame)
        @foreach ($videoGame->rayons as $rayon)
            <p>{{ $rayon->ray_nom }}</p>
        @endforeach
    
    @endforeach

    </body>
</html>
