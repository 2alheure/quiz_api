<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model {
    use HasFactory;

    protected $table = 'response';
    protected $casts = [
        'is_correct' => 'boolean'
    ];
    protected $hidden = [
        'question_id',
    ];
}
