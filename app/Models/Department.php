<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory, SoftDeletes;

    // Types
    const RECRUITMENT = 'recruitment';
    const PR = 'pr';
    const GROWTH = 'growth';
    const PERFORMANCE = 'performance';

    const TYPES = [
        self::RECRUITMENT,
        self::PR,
        self::GROWTH,
        self::PERFORMANCE
    ];

    // Relationships
    public function users() {
        return $this->belongsToMany(User::class)->using(DepartmentUser::class);
    }

    public function departmentUsers() {
        return $this->hasMany(DepartmentUser::class);
    }

    public function processes() {
        return $this->hasMany(Process::class);
    }
}
