<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $table = 'pet';
    protected $primaryKey = 'idpet';
    protected $fillable = ['nama', 'tanggal_lahir', 'warna_tanda', 'jenis_kelamin', 'idras_hewan', 'idpemilik'];

    // Relationship: Many to One (inverse) - Pet to RasHewan
    public function rasHewan()
    {
        return $this->belongsTo(RasHewan::class, 'idras_hewan', 'idras_hewan');
    }

    // Relationship: Many to One (inverse) - Pet to Pemilik
    public function pemilik()
    {
        return $this->belongsTo(Pemilik::class, 'idpemilik', 'idpemilik');
    }

    // Relationship: One to Many - Pet many RekamMedis
    public function rekamMedis()
    {
        return $this->hasMany(Rekam_Medis::class, 'idpet', 'idpet');
    }
}
