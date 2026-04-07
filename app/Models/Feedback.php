<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedbacks';
    protected $fillable = ['aspirasi_id','isi_feedback','tanggal'];

    public function aspirasi()
    {
        return $this->belongsTo(Aspirasi::class);
    }
}