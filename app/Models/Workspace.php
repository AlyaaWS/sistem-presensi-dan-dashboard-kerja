<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workspace extends Model
{
    protected $table = 'workspaces';
    protected $primaryKey = 'id_workspace';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'archived',
        'id_user',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function boards()
    {
        return $this->hasMany(Board::class, 'id_workspace');
    }

    public function tasks()
    {
     return $this->hasMany(Task::class, 'id_board');
    }

    public function members()
    {
     return $this->belongsToMany(User::class, 'workspace_user', 'id_workspace', 'id_user')
              ->withPivot('role_in_workspace')
              ->withTimestamps();
    }



}
