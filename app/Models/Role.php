<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    public function users()
{
    return $this->belongsToMany(User::class);
}

public function permissions()
{
    return $this->belongsToMany(Permission::class);
}

}