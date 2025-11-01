<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rekam_Medis extends Model
{
    protected $table = 'rekam_medis';
    protected $primaryKey = 'idrekam_medis';
    protected $fillable = ['created_at', 'anamnesa', 'temuan_klinis', 'diagnosa', 'idpet', 'dokter_pemeriksa'];


    public function pet()
    {
        return $this->belongsTo(Pet::class, 'idpet', 'idpet');
    }

    public function detailRekamMedis()
    {
        return $this->hasMany(Detail_Rekaman_Medis::class, 'idrekam_medis', 'idrekam_medis');
    }

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