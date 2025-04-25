<?php

namespace App\Http\Controllers;

use App\Models\EdcMachine;

class MapController extends Controller
{
    public function index()
    {
        $edcMachines = EdcMachine::all();

        return view('maps', compact('edcMachines'));
    }
}