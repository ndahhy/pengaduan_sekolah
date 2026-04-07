<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aspirasi extends Model
{
    protected $fillable = [
        'user_id','kategori_id','judul','isi','lokasi','ket','status','tanggal'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function feedback()
    {
        return $this->hasOne(Feedback::class);
    }
}