<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'nama_lengkap',
        'email',
        'password',
        'status',
        'id_role',
        'image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

        public function role()
    {
        return $this->belongsTo(Role::class, 'id_role');
    }

    public function presensis()
    {
        return $this->hasMany(Presensi::class, 'id_user');
    }

    public function workspaces()
    {
        return $this->belongsToMany(Workspace::class, 'workspace_user', 'id_user', 'id_workspace')
            ->withPivot('role_in_workspace', 'status')
            ->withTimestamps();
    }

}
