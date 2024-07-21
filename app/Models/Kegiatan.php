<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;
    /**
     * Get the user that owns the Kegiatan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function Instansi()
    {
        return $this->belongsTo(Instansi::class, 'instansi_id', 'id');
    }
}
