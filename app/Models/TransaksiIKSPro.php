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
        'nama_iks',
        'tanggal_awal',
        'tanggal_akhir',
        'iks_file',
    ];

    public function Iks(){
        return $this->belongsTo(IKS::class,'iks_id','id');
    }
}
