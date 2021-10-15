 
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

    

        <form action="{{ route('image.upload.post') }}" method="POST" enctype="multipart/form-data" class="form_add_img">

            @csrf
            <input  type="hidden" value="{{$videoGame->jeu_id}}" name="jeu_id">


                <div class="btn_add_image">

                    <input type="file" name="image" class="btn_choose_file ">
                    <label for="image" class="lab_add_img"> Ajoute mon pote !</label>

                </div>
                    



                    <button type="submit" class="btn btn-success">Ajouter photos </button>


    

        </form>

    