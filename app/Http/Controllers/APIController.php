<?php

namespace App\Http\Controllers;

use App\Anime;
use Illuminate\Http\Request;

class APIController extends Controller
{
    //
    public function index(Request $request){
    	$animelist = Anime::where('title','LIKE','%'.$request['query'].'%')->get();
        $response = Array();
        $response['success']=true;
        $response['results'] = [];
        $response['results'][] = ['name'=>$request['query'],'value'=>$request['query']];
        foreach ($animelist as $anime) {
            $response['results'][] = ['name'=>$anime->title,'value'=>$anime->title];
        }
        return \Response::json($response);
    }
}
