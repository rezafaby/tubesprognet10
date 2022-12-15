<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomponenGroupDetail extends Model
{
    use HasFactory;
    protected $table='m_iks_gkomponen_detail';

    protected $fillable = [
        'gkomponen_id',
        'gkomponen_detail'
    ];

    public function KomponenGroups(){
        return $this->belongsTo(KomponenGroups::class,'gkomponen_id','id');
    }

}
