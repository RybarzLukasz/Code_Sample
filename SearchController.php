<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kurs;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->get('search');
        $kursy = DB::table('kurs')
                    ->Where('title','like','%'.$search.'%' )
                    ->orWhere('subtitle','like','%'.$search.'%' )
                    ->orWhere('level','like','%'.$search.'%' )
                    ->orWhere('creator','like','%'.$search.'%' )
                    ->orWhere('category','like','%'.$search.'%' )->paginate();      
                    
        return view('welcome', ['kursy' => $kursy]);
    }

    public function filtr(Request $request)
    {
        $search = $request->get('filtr');

        $search1 = $request->get('filtr1');

        if(empty($search1))
        {
        $kursy = DB::table('kurs')
                    ->Where('level','like','%'.$search.'%' )->paginate();
                    return view('welcome', ['kursy' => $kursy]);

        }
        if($search1=='desc')
        {
            $kursy = DB::table('kurs')
                    ->orderBy('price', 'desc')->paginate();
                    return view('welcome', ['kursy' => $kursy]);

        }

        if($search1=='asc')
        {
            $kursy = DB::table('kurs')
                    ->orderBy('price', 'asc')->paginate();
                    return view('welcome', ['kursy' => $kursy]);

        }
        }

}
