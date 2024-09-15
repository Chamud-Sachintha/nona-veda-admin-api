<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_name',
        'category',
        'answers',
        'create_time'
    ];

    public function add_log($info) {
        $map['question_name'] = $info['questionName'];
        $map['category'] = $info['categoryType'];
        $map['answers'] = $info['answersList'];
        $map['create_time'] = $info['createTime'];

        return $this->create($map);
    }

    public function find_all() {
        return $this->all();
    }
}
