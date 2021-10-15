 
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">

            <button type="button" class="close" data-dismiss="alert">×</button>

                <strong>{{ $message }}</strong>

        </div>

        <img src="{{asset('Photos/'.Session::get('image'))}}">

        @endif

    

        @if (count($errors) > 0)

            <div class="alert alert-danger">

                <strong>Désolé!</strong> L'image n'a pas été correctement ajouter 

                <ul>

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

    

        <form action="{{ route('image.upload.post') }}" method="POST" enctype="multipart/form-data">

            @csrf
            <input  type="hidden" value="{{$videoGame->jeu_id}}" name="jeu_id">
            <div class="row">
                
                <div class="col-md-6">

                    <input type="file" name="image" class="form-control">

                </div>

     

                <div class="col-md-6">

                    <button type="submit" class="btn btn-success">Ajouter photos </button>

                </div>

     

            </div>

        </form>

    