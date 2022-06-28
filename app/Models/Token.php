<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model {
    use HasFactory;

    public $timestamps = false;

    protected $table = 'token';
    protected $fillable = ['token', 'expiration'];
    protected $casts = [
        'expiration' => 'datetime',
    ];
    protected $hidden = ['id'];

    public function __construct() {
        parent::__construct();
        $this->token = hash('sha256', random_bytes(32));
        $this->expiration = new \DateTime('+2 hours');
    }
}
