<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemilik extends Model
{
    protected $table = 'pemilik';
    protected $primaryKey = 'idpemilik';
    protected $fillable = ['iduser', 'alamat', 'no_wa'];

 
    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'id');
    }

   
    public function pets()
    {
        return $this->hasMany(Pet::class, 'idpemilik', 'idpemilik');
    }
}