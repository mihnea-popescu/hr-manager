<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProcessField extends Model
{
    use HasFactory, SoftDeletes;

    // Types
    const TEXT = 'text';
    const LONGTEXT = 'longtext';
    const NUMBER = 'number';
    const DATE = 'date';

    const TYPES = [
        self::TEXT,
        self::LONGTEXT,
        self::NUMBER,
        self::DATE
    ];

    public function process() {
        return $this->belongsTo(Process::class);
    }
}
