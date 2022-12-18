<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IKS extends Model
{
    use HasFactory;
    protected $table='m_iks';

    protected $fillable = [
        'kode',
        'nama',
        'penjamin_id',
        'tipe_id',
        'masa_berlaku_awal',
        'masa_berlaku_akhir',
    ];

    public function Penjamin(){
        return $this->belongsTo(Penjamin::class,'penjamin_id','id');
    }
    
    public function TipeIks(){
        return $this->belongsTo(TipeIks::class,'tipe_id','id');
    }
}
