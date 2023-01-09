<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiKomIKSDetail extends Model
{
    use HasFactory;
    protected $table='t_komponen_iks_d';

    protected $fillable = [
        'komponen_iks_id',
        'komponen_iks_detail',
    ];

    public function TransaksiKomIKS(){
        return $this->belongsTo(TransaksiKomIKS::class,'komponen_iks_id','id');
    }
}
