
@extends('base')




@section('css')
    <link rel="stylesheet" href="{{ asset("css/sideBar/sideBar-videoGame-detail.css") }}">
    <link rel="stylesheet" href="{{ asset("css/serviceComm/avisAbusif.css") }}">
@endsection



@section('header') 
    @include('layout.header-videoGame-detail')
@endsection



@section('content')

    <div class="container_all_avis_abusif margin_top_content">

  

            <h1 class="avis_abusif_title_serv_comm">Service COMM</h1>

            <div class="container_all_avis_abusif_content">
                
                <h1 class="avis_abusif_title">Avis Abusif</h1>


                <div class="container_all_avis_abusif_content_form">
    
                    @foreach ($avisAbusifs as $avisAbusif)
    
                        <div class="container_avisAbusif_avis_form">
    
                            @include('jeuVideo.avis.displayOne', ['aNotice' => $avisAbusif->avis])
                        
                            <form action="{{ route("delete_avis")}}" method="POST">
                                @csrf
                                <input type="hidden" name='id_avis' value="{{$avisAbusif->avi_id}}">
                                <button type="submit" class="avisAbusif_btn_del">Supprimer</button>
                            </form>
    
                        </div>
            
                    @endforeach
    
                </div>


            </div>
         
            



    </div>
    
@endsection



@include('layout.menu')








@section('js')
    <script src="{{ asset("js/sideBar-toggle/sideBar-videoGame-detail.js") }}"></script>
@endsection