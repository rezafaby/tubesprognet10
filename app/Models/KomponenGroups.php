<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomponenGroups extends Model
{
    use HasFactory;
    protected $table='m_iks_gkomponen';

    protected $fillable = [
        'group',
    ];
}
