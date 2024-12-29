<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'email',
        'birthday',
        'gender',
        'create_time'
    ];

    public function find_by_id($id) {
        $map['id'] = $id;
        return $this->where($map)->first();
    }
}
