<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiKomIKS extends Model
{
    use HasFactory;
    protected $table='t_komponen_iks';

    protected $fillable = [
        'iks_provider_id',
        'iks_gkomponen_id',
        'group',
    ];

    public function TransaksiIKSPro(){
        return $this->belongsTo(TransaksiIKSPro::class,'iks_provider_id','id');
    }
    public function TransaksiKomIKSDetail(){
        return $this->hasMany(TransaksiKomIKSDetail::class,'komponen_iks_id','id');
    }
}
