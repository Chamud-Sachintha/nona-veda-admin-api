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

    public function find_by_id($questionId) {
        $map['id'] = $questionId;

        return $this->where($map)->first();
    }

    public function update_by_id($info, $id) {
        $map['id'] = $id;
        $map1['question_name'] = $info['questionName'];
        $map1['category'] = $info['categoryType'];
        $map1['answers'] = $info['answersList'];

        return $this->where($map)->update($map1);
    }
}
