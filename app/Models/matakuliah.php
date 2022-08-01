<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class matakuliah extends Model
{
    use HasFactory;
    protected $table = 'matakuliahs';
    protected $fillable = ['kode_matakuliah','nam_matakuliah','sks_teori','sks_pratikum'];
    public function nilai()
    {
        return $this->hasMany(Nilai::class);
    }
}
