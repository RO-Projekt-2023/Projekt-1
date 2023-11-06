<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    public function index()
    {
        $items = Item::all(); // Pridobite vse elemente (prilagodite glede na vaš model)
        return view('archive', compact('items'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $results = Item::where('naziv', 'LIKE', "%$query%")->get(); // Prilagodite glede na vaš model in polje za iskanje
        return view('archive', compact('results'));
    }

}
