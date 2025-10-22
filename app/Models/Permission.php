<?php

namespace App\Models;

// app/Models/Permission.php

use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    protected $fillable = [
        'name',
        'guard_name',
        'module',
        'description',
    ];
}
