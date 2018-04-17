<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Publication;
use App\User;

use Redirect;


class PublicationController extends Controller
{
    public function create(Request $request){
        if (session('user') === null){
            return redirect('/');
        }

        if($request->has('publication')){
            $publication = new Publication ([
                'text' => $request->publication,
                'user_id' => session('user')->id,
                'date' => date('Y-m-d h:i:s', time())
            ]);
            $publication->save();

            return redirect('/profile');
        }
        return redirect('/profile')->with('publicatefail', true);
    }
    
    public function delete(Request $request)
    {
        if (session('user') === null)
        {
            return redirect('/');
        }

        if ($request->has('publication_id'))
        {
            $pub = Publication::find($request->publication_id);

            if ($pub !== null)
            {
                $pub->delete();
            }
        }
        
        return back();
    }


    /*public function list(Request $request){
        if (session('user') === null){
            return redirect('/');
        }

        $publications = Publication::where('user_id', session('user')->id)->orderBy('created_at', 'desc')->simplePaginate(5);
        /*session(['publications' => $publications]);

        if($request->ajax()) {
            return view('publication.publications', ['publications' => session('publications')])->render();  
        }

        return view('publication.publications');
    }*/
}
