<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiIKSPro extends Model
{
    use HasFactory;
    protected $table='t_iks_provider';

    protected $fillable = [
        'iks_id',
        'nomor_iks',
        'tanggal_awal',
        'tanggal_akhir',
        'iks_file'
    ];

    public function IKS(){
        return $this->belongsTo(IKS::class,'iks_id','id');
    }

    public function TransaksiKomIKS(){
        return $this->hasMany(TransaksiKomIKS::class,'iks_provider_id','id');
    }

    public function Transaksikomiksdetail(){
        return $this->hasMany(TransaksiKomIKSDetail::class,'komponen_iks_id','id');
    }
}
