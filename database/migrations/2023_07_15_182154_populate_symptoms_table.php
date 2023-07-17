<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class PopulateSymptomsTable extends Migration
{
    protected $apiClient;

    public function __construct()
    {
        $this->apiClient = new \App\Services\ApiClient();
    }
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $symptoms = $this->apiClient->getSymptoms();

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
