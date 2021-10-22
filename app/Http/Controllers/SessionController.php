<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller {
    public function addToSession(Request $request) {
        $request->validate([
            "key" => ['required'],
            "value" => ['required']
        ]);
        if($request->key === 'comparateur') {
            if(session()->has('comparateur') && in_array($request->value, session('comparateur'))) {
                //If game already in comparator, don't add it
                return 'Le jeu est déjà dans le comparateur';
            }
            //Else, adding it in the comparator
            $request->session()->push('comparateur', $request->value);
            return 'Jeu ajouté dans le comparateur !';
        }
    }
    public function deleteFromSession(Request $request) {
        $request->validate([
            "key" => ['required']
        ]);
        if($request->key === 'comparateur' && session()->has('comparateur')) {
            session()->forget('comparateur');
            return 'Comparateur vidé';
        }
        return 'Le comparateur est déjà vide';
    }
}
