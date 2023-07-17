<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnose extends Model
{
    use HasFactory;

    protected $table = 'diagnoses';

    protected $fillable = ['name', 'web_id', "prof_name", "accuracy",  "user_id"];

    protected $attributes = [
        'correct' => 'pending',
    ];

    public function symptoms()
    {
        return $this->belongsToMany(Symptom::class, 'diagnose_symptom');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
