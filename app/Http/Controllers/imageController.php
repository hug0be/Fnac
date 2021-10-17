<?php

namespace App\Http\Controllers;

use App\Models\Photo;

use Illuminate\Http\Request;

class imageController extends Controller
{
      /**
     * Show the home page of the Fnac webSite
     *
     *
     * @return \Illuminate\View\View
     */
    public function imageUpload()
    {

        return view('imageUpload');

    }

    public function imageUploadPost(Request $request)
    {

        $request->validate([

            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',

        ]);

    

        $imageName = time().'.'.$request->image->extension();

        /* Store $imageName name in DATABASE from HERE */
        $photo=Photo::create(['jeu_id'=>$request->jeu_id, 'pho_url'=>$imageName]);
        $photo->save();

        $request->image->move(public_path('Photos'), $imageName);

        return back()

            ->with('success','You have successfully upload image.')

            ->with('image',$imageName); 
        }

}
