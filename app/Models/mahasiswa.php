<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mahasiswa extends Model
{
    use HasFactory;
    protected $table = 'mahasiswas';
    protected $fillable = ['nama','nim','jurusan','jenis_kelamin','alamat'];
    public function nilai()
    {
        return $this->hasMany(Nilai::class);
    }
}
