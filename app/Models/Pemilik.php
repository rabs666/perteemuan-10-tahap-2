<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemilik extends Model
{
    protected $table = 'pemilik';
    protected $primaryKey = 'idpemilik';
    protected $fillable = ['iduser', 'alamat', 'no_wa'];

    // Relationship: One to One (inverse) - Pemilik belongs to User
    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'id');
    }

    // Relationship: One to Many - Pemilik has many Pets
    public function pets()
    {
        return $this->hasMany(Pet::class, 'idpemilik', 'idpemilik');
    }
}