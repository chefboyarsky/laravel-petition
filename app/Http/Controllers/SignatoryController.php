<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Petition;
use App\Signature;
use Mail;

class SignatoryController extends Controller
{
    /**
     * Lists all the published petitions, even to users who aren't logged in
     */
    public function listPetitions()
    {
        $petitions = Petition::where('published', 1)->get();
        return view('signatory/list', ['petitions' => $petitions]);
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createSignature($id)
    {
        $petition = Petition::findOrFail($id);
        $signature = new Signature;
        return view('signatory/create', ['signature' => $signature, 'petition' => $petition]);
    }


    /**
     * @param $id
     * @param Request $request
     */
    public function storeSignature($id, Request $request)
    {
        $this->validate($request, [
            'name'   => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone'    => 'required|regex:/[01]?[0-9]{9}/'
        ]);

        $petition = Petition::findOrFail($id);

        if(!$petition->published)
        {
            return redirect('/'); //If somehow we got here for an unpublished petition, just return the user to petitions
        }

        $signature = new Signature;
        $input = $request->all();
        $signature->fill($input);
        $signature->petition_id = $id;
        $signature->save();

        //TODO: Default thanks message should be in a translation file someplace
        $thanks_message = $petition->thanks_message=='' ? 'Thanks for signing!' : $petition->thanks_message;

        Mail::send('email.thanks', ['signature' => $signature, 'petition' => $petition], function ($m) use ($signature) {
            $m->from('noreply@effect.com', 'Effect');

            $m->to($signature->email, $signature->name)->subject('Thanks for Signing');
        });

        return view('signatory/thanks', ['thanks_message' => $thanks_message]);
    }
}
