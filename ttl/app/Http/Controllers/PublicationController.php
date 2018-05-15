<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Publication;
use App\User;

use Redirect;


class PublicationController extends Controller
{
    public function create(Request $request){
        if (session('user') === null)
        {
            return redirect('/');
        }

        if ($request->has('publication') && $request->has('publication_group'))
        {
            if (empty($request->publication))
            {
                return back()->with('create_publication_fail', true);
            }

            if ($request->publication_group == 'all_groups')
            {
                $groups = session('user')->group_user()->get();

                foreach ($groups as $group)
                {
                    $publication = new Publication([
                        'text' => $request->publication,
                        'user_id' => session('user')->id,
                        'date' => date('Y-m-d h:i:s', time())
                    ]);
                    DB::beginTransaction();
                    try{
                        $publication->save();
                        $publication->group_id = $group->id;
                        $publication->save();
                        DB::commit();
                    } catch(\Exception $e){
                        DB::rollback();
                        return back()->with('create_publication_fail', true);
                    }
                }
            }
            else
            {
                $group_publication_id = 0;

                if ($request->publication_group != 'own_publication')
                {
                    $group_publication_id = $request->publication_group;
                }
                $publication = new Publication([
                    'text' => $request->publication,
                    'user_id' => session('user')->id,
                    'date' => date('Y-m-d h:i:s', time())
                ]);
                DB::beginTransaction();
                try{
                    $publication->save();
                    $publication->group_id = $group_publication_id;
                    $publication->save();
                    DB::commit();
                } catch(\Exception $e){
                    DB::rollback();
                    return back()->with('create_publication_fail', true);
                }
            }

            return back();
        }
        return back()->with('unexpected_error', true);
    }
    
    public function delete(Request $request){
        if (session('user') === null)
        {
            return redirect('/');
        }

        if ($request->has('publication_id'))
        {
            $pub = Publication::find($request->publication_id);

            if ($pub !== null)
            {
                DB::beginTransaction();
                try{
                    $pub->delete();
                    DB::commit();
                } catch(\Exception $e){
                    DB::rollback();
                    return back();
                }
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

    public function listPublications(Request $request){
        $publications = Publication::where('id', '>=', '0');

        if ($request->has('order-form') || $request->has('find-form'))
        {
            session([   'publications_field' => null, 
                        'publications_direction' => null,
                        'publications_min_date' => null,
                        'publications_max_date' => null,
                        'publications_pub_contains' => null,
                        'publications_date_field' => null]);
        }
        else if (session('publications_field') === null || (session('publications_field') == 'created_at' && session('publications_direction') == 'desc'))
        {
            session([   'publications_field' => 'created_at',
                        'publications_direction' => 'desc']);
        }

        if (session('publications_field') !== null)
        {
            $publications = $publications->orderBy(session('publications_field'), session('publications_direction'));
        }
        else if ($request->has('field') && $request->has('direction'))
        {
            $publications = $publications->orderBy($request->field, $request->direction);

            session([   'publications_field' => $request->field,
                        'publications_direction' => $request->direction]);
        }

        if (session('publications_pub_contains') !== null)
        {
            $publications = $publications->where('text', 'like', '%' . session('publications_pub_contains') . '%');
        }
        else if ($request->has('pub_contains') && !empty($request->pub_contains))
        {
            $publications = $publications->where('text', 'like', '%' . $request->pub_contains . '%');
            
            session(['publications_pub_contains' => $request->pub_contains]);
        }

        if (session('publications_min_date') !== null)
        {
            $publications = $publications->whereBetween(session('publications_date_field'), array(session('publications_min_date'), session('publications_max_date')));
        }
        else if ($request->has('min_date') && $request->has('max_date') && $request->has('date_field') && !empty($request->min_date) && !empty($request->max_date) && strtotime($request->min_date) <= strtotime($request->max_date))
        {
            $min_date = "$request->min_date 00:00:00";
            $max_date = "$request->max_date 23:59:59";

            $publications = $publications->whereBetween($request->date_field, array($min_date, $max_date));

            session([   'publications_min_date' => $min_date,
                        'publications_max_date' => $max_date,
                        'publications_date_field' => $request->date_field]);
        }

        $publications = $publications->simplePaginate(5);

        if ($request->ajax())
        {
            return view('lists.pag.publications', ['publications' => $publications])->render();
        }

        return view('lists.list-publications', ['publications' => $publications]);
    }
}
