<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Petition;

class PetitionController extends Controller
{

    /**
     * Create a petition.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('petition/create');
    }

    /**
     * Save a petition.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'   => 'bail|required|unique:petitions|max:255',
            'summary' => 'required|max:700',
            'body'    => 'required'
        ]);

        $petition = new Petition;
        $petition->title   = $request->title;
        $petition->summary = $request->summary;
        $petition->body    = $request->body;

        $petition->save();

        return redirect('/home');
    }
}
