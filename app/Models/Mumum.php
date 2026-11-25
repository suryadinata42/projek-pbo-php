<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mumum extends Model
{
    protected $table = 'data_100rb';
    protected $fillable = ['nik', 'nama', 'jenis_kelamain', 'tanggal_lahir', 'usia', 'alamat', 'no_hp', 'email'];
}
