<?php

namespace App\Services;

use App\Models\Symptom;
use Illuminate\Support\Facades\Http;

class ApiClient
{

    private function authenticate()
    {
        $baseUrl =  config('constants.api.credentials.api_auth_url');
        $loginUrl = $baseUrl . '/' . config('constants.api.routes.login');

        $username = config('constants.api.credentials.username');
        $password = config('constants.api.credentials.password');

        $computedHash = base64_encode(hash_hmac('md5', $loginUrl, $password, true));

        $response = Http::withHeaders([
            'Authorization' => "Bearer $username:$computedHash"
        ])->post($loginUrl);

        return $response->json()['Token'];
    }

    public function getSymptoms()
    {
        $token = $this->authenticate();
        $params = [
            'token' => $token,
            'format' => 'json',
            'language' => 'en-gb'
        ];
        $url = config('constants.api.credentials.api_health_url') . '/' . config('constants.api.routes.symptoms');
        $response = Http::get($url, $params);
        return $response->json();
    }

    public function getDiagnose($birthDay, $gender, $symptomsIds)
    {
        $token = $this->authenticate();
        $year = substr($birthDay, 0, 4);

        $symptoms = Symptom::whereIn('id', $symptomsIds)->get();
        $symptomsWebIds = $symptoms->map(function ($symptom) {
            return $symptom->web_id;
        })->toArray();

        $params = [
            "year_of_birth" => $year,
            'symptoms' => '[' . implode(', ', $symptomsWebIds) . ']',
            'format' => 'json',
            'language' => 'en-gb',
            "gender" => $gender,
            'token' => $token
        ];

        $queryParams = http_build_query($params);

        $url = config('constants.api.credentials.api_health_url') . '/' . config('constants.api.routes.diagnosis');
        $url = $url . "?" . $queryParams;
        $response = Http::get($url);
        return $response->json();
    }
}
