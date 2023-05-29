<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Process extends Model
{
    use HasFactory, SoftDeletes;

    // Statuses
    const IN_WORK = 'in_work';
    const ACCEPTING_APPLICATIONS = 'accepting_applications';
    const CLOSED = 'closed';
    const FINISHED = 'finished';

    const STATUSES = [
        self::IN_WORK,
        self::ACCEPTING_APPLICATIONS,
        self::CLOSED,
        self::FINISHED
    ];

    public function department() {
        return $this->belongsTo(Department::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function fields() {
        return $this->hasMany(ProcessField::class);
    }

    public function applications() {
        return $this->hasMany(Application::class);
    }

    public function getStatusNameAttribute() {
        return static::getStatus($this->status);
    }

    public static function getStatus($status) {
        switch($status) {
            case self::IN_WORK:
                return 'În lucru';
            case self::ACCEPTING_APPLICATIONS:
                return 'Acceptă aplicații';
            case self::CLOSED:
                return 'Aplicațiile sunt închise';
            case self::FINISHED:
                return 'Finalizat';
        }
        return '';
    }

    public function generateHash() {
        $this->hash = Str::upper(Str::random(10));
        $this->save();
    }
}
