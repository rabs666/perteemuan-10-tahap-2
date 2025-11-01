<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';
    protected $primaryKey = 'idrole';
    protected $fillable = ['nama_role'];

    public function roleUsers()
    {
        return $this->hasMany(Role_User::class, 'idrole', 'idrole');
    }

    public function users()
    {
        return $this->hasManyThrough(User::class, Role_User::class, 'idrole', 'id', 'idrole', 'iduser');
    }
}
