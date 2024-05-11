<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Preaching extends Model
{
    use HasFactory,HasUuids;
    protected $fillable=['title','audio_url','preacher_name','church_id','is_online'];

    public  function  church():BelongsTo
    {
        return  $this->belongsTo(Church::class,'church_id');
    }
}
