<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Symptom extends Model
{
    use HasFactory;

    protected $table = 'symptoms';

    protected $fillable = ['name', 'web_id'];

    public function diagnoses()
    {
        return $this->belongsToMany(Diagnose::class, 'diagnose_symptom');
    }
}
