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

}
