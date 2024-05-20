<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function getCreatedAtAttribute($value)
    {
        // return Carbon::parse($value)->format('d-m-Y');
        return date('d-m-Y', strtotime($value));
    }

    public function projects(){
        return $this->hasMany(Project::class);
    }
}
