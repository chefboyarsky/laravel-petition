<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Petition;

class SignatoryController extends Controller
{
    /**
     * Lists all the published petitions, even to users who aren't logged in
     */
    public function list()
    {
        $petitions = Petition::where('published', 1)->get();
        return view('signatory/list', ['petitions' => $petitions]);
    }
}
