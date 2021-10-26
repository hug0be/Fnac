{{--  
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">

            <button type="button" class="close" data-dismiss="alert">×</button>

                <strong>{{ $message }}</strong>

        </div>

            <video controls width="250">

                <source src="{{asset('Videos/'.Session::get('video'))}}"
                        type="video/mp4">
            
                Sorry, your browser doesn't support embedded videos.
            </video>

        @endif --}}

    

        <div class="alert alert-danger">
            @if ($errors->has('video'))
                La vidéo n'a pas été enregistré.
            @endif
        </div>

    
        <div class="container_form_add_vid">
            <form action="{{ route('video.upload.post') }}" method="POST" enctype="multipart/form-data" class="form_add_video">

                @csrf
                <input  type="hidden" value="{{$videoGame->jeu_id}}" name="jeu_id">

                    
                <div class="btn_add_image">

                    <input type="file" name="video"  id="upload_vid" class="btn_choose_file ">
                    <label for="upload_vid" class="lab_choose_file"> 
                        <img src="{{asset("img/icon/icon-add-video.png")}}" alt="" class="icon_choose_file">
                    </label>

                </div>
               

                <button type="submit" class="btn_confirm_file">
                    <img src="{{asset("img/icon/icon-check.png")}}" alt="" class="icon_confirm_file">
                </button>
        


            </form>
        </div>

    