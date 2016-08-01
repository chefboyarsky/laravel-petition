<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Petition;
use App\Mediafile;

use Illuminate\Support\Facades\Auth;
use Storage;
use Illuminate\Http\Request;

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
     * Lists all the user's partitions, as a control panel
     */
    public function index()
    {
        $petitions = Petition::where('user_id', Auth::User()->id)->get();
        return view('petition/index', ['petitions' => $petitions]);
    }

    public function signatures($id)
    {
        $petition = Petition::findOrFail($id);
        return view('petition/signatures', ['petition' => $petition]);
    }

    /**
     * Create a petition.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $petition = new Petition;
        $mediafiles = $petition->mediafiles;
        return view('petition/create', ['petition' => $petition, 'mediafiles' => $mediafiles]);
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
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function storeMediaFile($id, Request $request)
    {
        $file = \Illuminate\Support\Facades\Request::file('filefield');
        $extension = $file->getClientOriginalExtension();
        $imageName = $id . '_' . $file->getClientOriginalName();
        \Illuminate\Support\Facades\Request::file('filefield')->move(
            base_path() . '/public/mediafiles/', $imageName
        );
        
        $entry = new Mediafile();
        $entry->mime = $file->getClientMimeType();
        $entry->original_filename = $file->getClientOriginalName();
        $entry->filename = $imageName;
        $entry->petition_id = $id;
        $entry->save();
        
        return redirect('/petition/' . $id . '/mediafiles');
    }
    

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
     *
     */
    public function editMediaFiles($id)
    {
        $petition = Petition::findOrFail($id);
        return view('mediafile/create', ['id' => $id, 'mediafiles' => $petition->mediafiles ]);
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
        //TODO: could clean up unneeded image files as optimization
        $petition->delete();

        return redirect('/home');
    }


    /**
     *
     */
    public function destroyMediafile($id)
    {
        $mediafile = Mediafile::findOrFail($id);
        $petitionId = $mediafile->petition->id;
        //TODO: could delete image file if you don't need it around anymore
        $mediafile->delete();

        return redirect('/petition/' . $petitionId . '/mediafiles');
    }

    /**
     *
     */
    private function validateRequest(Request $request){
        $this->validate($request, [
            'title'   => 'bail|required|max:255',
            'summary' => 'required|max:700',
            'body'    => 'required',
            'thanks_message' => 'max:1000',
            'thanks_email' => 'max:2000',
            'thanks_sms' => 'max:200'
        ]);
    }
}
