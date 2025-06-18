<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';
    protected $primaryKey = 'id_task';
    public $timestamps = false;

    protected $fillable = ['description', 'due_date', 'id_board', 'status_progress', 'color'];

    public function board()
    {
    return $this->belongsTo(Board::class, 'id_board');
    }

}