<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Petition;

use Illuminate\Support\Facades\Auth;

class PetitionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $petitions = Petition::where('user_id', Auth::User()->id)->get();
        return view('petition/index', ['petitions' => $petitions]);
    }


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
        $petition->user_id = Auth::User()->id;
        $petition->save();

        return redirect('/home');
    }
}
