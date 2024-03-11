<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $table = 'permissions';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public $timestamps = false;

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
