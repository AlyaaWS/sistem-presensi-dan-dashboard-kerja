<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
     protected $table = 'boards';
     protected $primaryKey = 'id_board';
     public $timestamps = false;

     protected $fillable = [
         'title',
         'archived',
         'id_workspace',
     ];

     public function workspace()
     {
         return $this->belongsTo(Workspace::class, 'id_workspace');
     }
}
