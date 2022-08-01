<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nilai extends Model
{
    use HasFactory;
    protected $table = 'nilais';
    protected $fillable = ['nim','kode_matakuliah','nilai_angka','nilai_huruf'];
                        
    public function mahasiswa()
                        {
                            return $this->belongsTo(mahasiswa::class, 'id');
                        }
                        public function matakuliah()
                        {
                            return $this->belongsTo(matakuliah::class, 'id');
                        }
}
