<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';
    protected $primaryKey = 'idrole';
    protected $fillable = ['nama_role'];
    public $timestamps = false; // Disable timestamps

    // Relationship: One to Many - Role has many RoleUser
    public function roleUsers()
    {
        return $this->hasMany(Role_User::class, 'idrole', 'idrole');
    }

    // Relationship: Many to Many - Role has many Users through RoleUser
    public function users()
    {
        return $this->hasManyThrough(User::class, Role_User::class, 'idrole', 'id', 'idrole', 'iduser');
    }
}
