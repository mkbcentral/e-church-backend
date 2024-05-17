<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Member extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'birthdate', 'phone', 'email', 'church_id'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'birthdate' => 'datetime',
        ];
    }

    /**
     * Get the church that owns the Member
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function church(): BelongsTo
    {
        return $this->belongsTo(User::class, 'church_id');
    }

    /**
     * Get all of the deposits for the Member
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function deposits(): HasMany
    {
        return $this->hasMany(Deposit::class);
    }

    public function getAge(): string
    {
        $age = "";
        $age = date('Y') - $this->birthdate->format('Y ');
        return $age <= 18 ? $age . " Mineur" : $age . " MAjeur";
    }
}
