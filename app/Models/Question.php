<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model {
    use HasFactory;

    protected $table = 'question';
    protected $casts = [
        'source' => 'object'
    ];

    public function responses() {
        return $this->hasMany(Response::class);
    }

    public function language() {
        return $this->belongsTo(Language::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function type() {
        return $this->belongsTo(QuestionType::class, 'question_type_id');
    }
}
