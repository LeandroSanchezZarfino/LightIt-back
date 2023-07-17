<?php

namespace App\Http\Controllers;

use App\Models\Diagnose;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class DiagnoseController extends Controller
{

    public function index(Request $request)
    {
        $page = $request->query('page', 1);
        
        $perPage = 10; 
    
        $diagnoses = $request->user()->diagnoses()
            ->with('symptoms')
            ->orderBy('id', 'desc')
            ->paginate($perPage, ['*'], 'page', $page);
    
        return response()->json($diagnoses);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'symptoms' => ['required', 'array', 'min:1'],
            'symptoms.*' => ['numeric'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $symptoms = $request->symptoms;
        $birthDay = $request->user()->birthday;
        $gender = $request->user()->gender;
        $apiClient = new \App\Services\ApiClient();
        $diagnoses = $apiClient->getDiagnose($birthDay, $gender, $symptoms);


        if (count($diagnoses) == 0) {
            return response()->json([
                'success' => false,
                'error' => 'No diagnoses found'
            ], 404);
        }

        $addedDiagnoses = [];
        foreach ($diagnoses as $diagnose) {
            $diagnoseIssue = (object) $diagnose["Issue"];

            $newDiagnose = Diagnose::create([
                'name' => $diagnoseIssue->Name,
                'web_id' => $diagnoseIssue->ID,
                'prof_name' => $diagnoseIssue->ProfName,
                'accuracy' => $diagnoseIssue->Accuracy,
                'user_id' => $request->user()->id,
            ]);

            $newDiagnose->symptoms()->sync($symptoms);
            $newDiagnose->load('symptoms');
            $addedDiagnoses[] = $newDiagnose;
        }

        return response()->json([
            'success' => true,
            'message' => count($diagnoses) . " diagnoses obtained",
            "data" => $addedDiagnoses
        ]);
    }

    public function validateUserDiagnosis(Request $request, $id)
    {
        $validator = Validator::make([
            'id' => $id,
            'correct' => $request->correct,
        ], [
            'id' => ['required', 'numeric'],
            'correct' => ['required', 'boolean'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $userId = $request->user()->id;

        $diagnosis = Diagnose::where('id', $id)
            ->where('user_id', $userId)
            ->first();

        if (!$diagnosis) {
            return response()->json([
                'success' => false,
                'error' => 'Diagnose not found'
            ], 404);
        }

        $diagnosis->correct = $request->correct ? "correct" : "incorrect";
        $diagnosis->save();

        return response()->json([
            'success' => true,
            'message' => 'Diagnose updated successfully'
        ]);
    }
}
