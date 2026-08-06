<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $table = 'agenda';

    protected $fillable = [
    'judul_rapat',
    'tanggal',
    'jam_mulai',
    'jam_selesai',
    'tempat',
    'pimpinan_rapat',
    'keterangan',
    'status',
    'file_surat'
    ];
}