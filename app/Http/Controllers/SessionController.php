<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller {
    public function addToSession(Request $request) {
        if($request->key == "comparateur") {
            if($request->session('comparateur')->has($request->value)) {
                return back()->withErrors('comparateur', 'Ce jeu est déjà dans le comparateur');
            } else {
                $request->session()->push('comparateur', $request->value);
            }
        }
        //$request->session()->forget('comparateur');
        //$request->session()->all()
        return back();    
    }
}
