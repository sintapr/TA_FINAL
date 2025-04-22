<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    protected $table = 'tahun_ajaran';
    protected $primaryKey = 'id_ta';
    public $incrementing = false;
    public $timestamps = false;


    protected $fillable = ['id_ta', 'semester', 'tahun'];

    public function kondisiSiswa()
{
    return $this->hasMany(KondisiSiswa::class, 'id_ta', 'id_ta');
}

}
