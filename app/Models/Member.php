<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Member extends Model
{
    use HasFactory;
    protected $table = 'members';
    protected $fillable = [
        'nama',
        'whatsapp',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relasi Tarikan
    |--------------------------------------------------------------------------
    */
    public function tarikans()
    {
        return $this->hasMany(Tarikan::class);
    }
}
