<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EssenceController extends Controller
{
    public function show()
    {
        return view('essence', ['essence' => null]);
    }
}
