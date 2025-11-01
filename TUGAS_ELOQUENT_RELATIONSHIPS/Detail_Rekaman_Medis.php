<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detail_Rekaman_Medis extends Model
{
    protected $table = 'detail_rekam_medis';
    protected $primaryKey = 'iddetail_rekam_medis';
    protected $fillable = ['detail', 'idrekam_medis', 'idkode_tindakan_terapi'];
    public $timestamps = false;

    public function rekamMedis()
    {
        return $this->belongsTo(Rekam_Medis::class, 'idrekam_medis', 'idrekam_medis');
    }

   
    public function kodeTindakanTerapi()
    {
        return $this->belongsTo(Kode_Tindakan_Terapi::class, 'idkode_tindakan_terapi', 'idkode_tindakan_terapi');
    }
}