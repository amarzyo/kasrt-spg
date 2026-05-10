<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tarikan extends Model
{
    use HasFactory;
    protected $table = 'tarikans';
    protected $fillable = [
        'member_id',
        'nominal'
    ];

    /*
    |--------------------------------------------------------------------------
    | Relasi ke Member
    |--------------------------------------------------------------------------
    */
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
