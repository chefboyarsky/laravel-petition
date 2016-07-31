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

    /**
     *
     */
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
        $petition = new Petition;
        return view('petition/create', ['petition' => $petition]);
    }


    /**
     * Save a petition.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateRequest($request);

        $petition = new Petition;
        $input = $request->all();
        $petition->fill($input);
        $petition->user_id = Auth::User()->id;
        $petition->save();

        return redirect('/home');
    }


    /**
     *
     */
    public function edit($id)
    {
        $petition = Petition::where('id', $id)->get()->first();

        return view('petition/edit', ['petition' => $petition]);
    }


    /**
     *
     */
    public function update($id, Request $request)
    {
        $petition = Petition::findOrFail($id);
        $this->validateRequest($request);

        $input = $request->all();
        $petition->fill($input)->save();

        return redirect('/home');
    }


    /**
     * Toggle the 'published' state of this petition.
     */
    public function publish($id)
    {
        $petition = Petition::findOrFail($id);

        $petition->published = !$petition->published;
        $petition->save();

       return redirect('/home');
    }


    /**
     *
     */
    public function destroy($id)
    {
        $petition = Petition::findOrFail($id);
        $petition->delete();

        return redirect('/home');
    }


    /**
     *
     */
    private function validateRequest(Request $request){
        $this->validate($request, [
            'title'   => 'bail|required|max:255',
            'summary' => 'required|max:700',
            'body'    => 'required'
        ]);
    }
}
