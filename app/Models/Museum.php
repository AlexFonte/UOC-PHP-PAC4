<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Museum extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'name',
        'city',
        'schedule',
        'visitguided',
        'price',
        'urlImg',
    ];

    public function topics()
    {
        return $this->belongsToMany(Topic::class);
    }
}
