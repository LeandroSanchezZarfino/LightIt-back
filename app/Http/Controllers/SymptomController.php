<?php

namespace App\Http\Controllers;

use App\Models\Symptom;
use Illuminate\Http\Request;

class SymptomController extends Controller
{

    public function get(Request $request)
    {
        $input = $request->input('name');
        $symptoms = Symptom::where('name', 'LIKE', '%' . $input . '%')->get();

        return response()->json($symptoms);
    }
}
