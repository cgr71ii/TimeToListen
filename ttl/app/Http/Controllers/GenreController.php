<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Genre;

class GenreController extends Controller
{

    public function listGenres(Request $request)
    {
        $genres = Genre::where('id', '>=', '0');

        if ($request->has('order-form') || session('genre_field') !== null)
        {
            session([   'genre_field' => null, 
                        'genre_direction' => null]);
        }
        else if (session('genre_field') === null || (session('genre_field') == 'created_at' && session('genre_direction') == 'desc'))
        {
            session([   'genre_field' => 'created_at',
                        'genre_direction' => 'desc']);
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
        if ($request->has('genre_id'))
        {
            $genre = Genre::find($request->genre_id);
            
            $genre->delete();
        }

        return back();
    }

}
