<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class PopulateSymptomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $url = config('constants.api.api_url') . '/' . config('constants.api.routes.symptoms') . '?token=' . config('constants.api.auth_token') . '&format=json&language=en-gb';
        $response = Http::get($url);
        $symptoms = $response->json();

        foreach ($symptoms as $symptom) {
            DB::table('symptoms')->insert([
                'name' => $symptom['Name'],
                'web_id' => $symptom['ID']
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('symptoms')->truncate();
    }
}
