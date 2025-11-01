<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Data_User extends Model
{
    protected $table = 'data_user';
    protected $primaryKey = 'iddata_user';
    protected $fillable = ['nama_depan', 'nama_belakang', 'alamat', 'no_telepon', 'tanggal_lahir', 'jenis_kelamin', 'iduser'];
}
