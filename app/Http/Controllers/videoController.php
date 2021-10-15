<?php

namespace App\Http\Controllers;

use App\Models\Video;

use Illuminate\Http\Request;

class videoController extends Controller
{
      /**
     * Show the home page of the Fnac webSite
     *
     *
     * @return \Illuminate\View\View
     */
    public function videoUpload()
    {

        return view('videoUpload');

    }

    public function videoUploadPost(Request $request)
    {
        /*
        $request->validate([

            'video' => 'required|video|mimes:mp4|max:2048',

        ]);
        */
    

        $videoName = time().'.'.$request->video->extension();

        /* Store $videoName name in DATABASE from HERE */
        $video=Video::create(['jeu_id'=>$request->jeu_id, 'vid_url'=>$videoName]);
        $video->save();

        $request->video->move(public_path('Videos'), $videoName);

        return back()

            ->with('success','You have successfully upload video.')

            ->with('video',$videoName); 
        }

}
