<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EdcMachine extends Model
{
    use HasFactory;

    protected $guarded = [];


    protected $attributes = [

        'status' => 'not exist',

    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
