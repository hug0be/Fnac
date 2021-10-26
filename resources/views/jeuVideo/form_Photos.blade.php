{{--  
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">

            <button type="button" class="close" data-dismiss="alert">×</button>

                <strong>{{ $message }}</strong>

        </div>

        <img src="{{asset('Photos/'.Session::get('image'))}}">

        @endif --}}

        <div class="alert alert-danger">
            @if ($errors->has('image'))
                L'image n'a pas été enregistré.
            @endif
        </div>

    
        <div class="container_form_add_img">
            <form action="{{ route('image.upload.post') }}" method="POST" enctype="multipart/form-data" class="form_add_img">

                @csrf
                <input  type="hidden" value="{{$videoGame->jeu_id}}" name="jeu_id">
    
    
                <div class="btn_add_image">
                    <input type="file" name="image"  id="upload_img" class="btn_choose_file ">
                    <label for="upload_img" class="lab_choose_file"> 
                        <img src="{{asset("img/icon/icon-add-image.png")}}" alt="" class="icon_choose_file">
                    </label>
                </div>
                    



                <button type="submit" class="btn_confirm_file">
                    <img src="{{asset("img/icon/icon-check.png")}}" alt="" class="icon_confirm_file">
                </button>
    
    
        
    
            </form>
        </div>

