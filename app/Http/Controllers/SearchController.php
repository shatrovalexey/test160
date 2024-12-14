<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Street;

/**
* Поиск
*/
class SearchController extends Controller
{
    /**
    * Поиск по улице, городу и региону
    *
    * @param Request $request
    */
    public function search(Request $request)
    {
        return Street::searchByText($request->input('q'));
    }
}