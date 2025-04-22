<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $primaryKey = 'NIS';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'NIS',
        'NIK',
        'NISN',
        'nama_siswa',
        'tempat_lahir',
        'tgl_lahir',
        'nama_kelas',
        'foto',
    ];
    
    public function kondisiSiswa()
{
    return $this->hasMany(KondisiSiswa::class, 'NIS', 'NIS');
}

}
