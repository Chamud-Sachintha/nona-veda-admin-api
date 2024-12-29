<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'result',
        'create_time'
    ];

    public function find_all() {
        return $this->all();
    }
}
