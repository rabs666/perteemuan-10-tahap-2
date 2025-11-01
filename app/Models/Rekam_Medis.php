<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rekam_Medis extends Model
{
    protected $table = 'rekam_medis';
    protected $primaryKey = 'idrekam_medis';
    protected $fillable = ['created_at', 'anamnesa', 'temuan_klinis', 'diagnosa', 'idpet', 'dokter_pemeriksa'];

    // Relationship: Many to One (inverse) - RekamMedis belongs to Pet
    public function pet()
    {
        return $this->belongsTo(Pet::class, 'idpet', 'idpet');
    }

    // Relationship: One to Many - RekamMedis has many DetailRekamMedis
    public function detailRekamMedis()
    {
        return $this->hasMany(Detail_Rekaman_Medis::class, 'idrekam_medis', 'idrekam_medis');
    }

    // Relationship: Many to Many - RekamMedis has many KodeTindakanTerapi through DetailRekamMedis
    public function kodeTindakanTerapi()
    {
        return $this->belongsToMany(
            Kode_Tindakan_Terapi::class,
            'detail_rekam_medis',
            'idrekam_medis',
            'idkode_tindakan_terapi',
            'idrekam_medis',
            'idkode_tindakan_terapi'
        )->withPivot('detail');
    }
}