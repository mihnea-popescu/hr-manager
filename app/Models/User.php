<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'dob',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relationships

    public function departments() {
        return $this->belongsToMany(Department::class)->using(DepartmentUser::class);
    }

    public function departmentUsers() {
        return $this->hasMany(DepartmentUser::class);
    }

    public function processes() {
        return $this->hasMany(Process::class);
    }

    public function getProfilePicture() {
        $jd = new \Jdenticon\Identicon([
            'size' => 500,
            'value' => $this->id
        ]);

        return $jd->getImageDataUri();
    }

    public function hasAccessToDepartment($type) {
        if($this->is_admin) {
            return true;
        }

        if($this->departments()->where('departments.type', $type)->count()) {
            return true;
        }

        return false;
    }
}
