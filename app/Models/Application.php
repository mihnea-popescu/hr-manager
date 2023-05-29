<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    // Statuses
    const PENDING = 'pending';
    const REFUSED = 'refused';
    const ACCEPTED_FOR_INTERVIEW = 'accepted_for_interview';
    const ACCEPTED = 'accepted';

    const STATUSES = [
        self::PENDING,
        self::REFUSED,
        self::ACCEPTED_FOR_INTERVIEW,
        self::ACCEPTED
    ];

    public function process() {
        return $this->belongsTo(Process::class);
    }

    public function fields() {
        return $this->hasMany(ApplicationField::class);
    }
}
