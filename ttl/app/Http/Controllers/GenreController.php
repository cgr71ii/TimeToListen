<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Genre;

class GenreController extends Controller
{

    public function listGenres(Request $request)
    {
        $genres = Genre::where('id', '>=', '0');

        if ($request->has('order-form'))
        {
            session([   'genre_field' => null, 
                        'genre_direction' => null]);
        }

        if (session('genre_field') !== null)
        {
            $genres = $genres->orderBy(session('genre_field'), session('genre_direction'));
        }
        else if ($request->has('field') && $request->has('direction'))
        {
            session([   'genre_field' => $request->field,
                        'genre_direction' => $request->direction]);

            $genres = $genres->orderBy($request->field, $request->direction);
        }

        $genres = $genres->simplePaginate(5);

        if ($request->ajax())
        {
            return view('lists.pag.genres', ['genres' => $genres])->render();
        }

        return view('lists.list-genres', ['genres' => $genres]);
    }

    public function update(Request $request)
    {
        if (session('user') === null)
        {
            return redirect('/');
        }

        if ($request->has('genre_id') && $request->has('name') && !empty($request->name))
        {
            $genre = Genre::find($request->genre_id);

            $genre->name = $request->name;

            $genre->save();
        }

        return back();
    }

    public function remove(Request $request)
    {
        if (session('user') === null)
        {
            return redirect('/');
        }

        if ($request->has('genre_id'))
        {
            $genre = Genre::find($request->genre_id);
            
            $genre->delete();
        }

        return back();
    }

}
