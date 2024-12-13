<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Street;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        return Street::searchByText($request->q);
    }
}