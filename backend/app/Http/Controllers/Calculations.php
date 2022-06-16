<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Calculations extends Controller
{
    public function index()
	{
		return view('calculations');
	}

	public function store(Request $request) {
		if($request->input('weight') && $request->input('height')) {
			$calc = $request->input('weight') / pow($request->input('height') / 100, 2);
		}

		return view('calculations')->with('calc', $calc ?? null);
	}
}
