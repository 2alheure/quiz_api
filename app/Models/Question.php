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
    protected $hidden = [
        'language_id',
        'category_id',
        'question_type_id',
        'created_at',
        'updated_at',
        'deleted_at',
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

    public function sessions() {
        return $this->belongsToMany(Token::class, 'session', 'question_id', 'token_id');
    }
}
