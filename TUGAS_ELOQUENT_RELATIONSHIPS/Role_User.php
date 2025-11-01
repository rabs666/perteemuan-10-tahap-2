<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role_User extends Model
{
    protected $table = 'role_user';
    protected $primaryKey = 'idrole_user';
    protected $fillable = ['status', 'iduser', 'idrole'];

    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'id');
    }

        public function role()
    {
        return $this->belongsTo(Role::class, 'idrole', 'idrole');
    }
}


