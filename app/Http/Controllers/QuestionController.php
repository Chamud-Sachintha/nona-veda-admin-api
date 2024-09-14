<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    private $AppHelper;
    private $QuestionModel;

    public function __construct()
    {
        $this->AppHelper = new AppHelper();
        $this->QuestionModel = new Question();
    }

    public function addNewQuestion(Request $request) {

        $question_name = (is_null($request->questionName) || empty($request->questionName)) ? "" : $request->questionName;
        $category = (is_null($request->category) || empty($request->category)) ? "" : $request->category;
        $answers = (is_null($request->answersObj) || empty($request->answersObj)) ? "" : $request->answersObj;

        if ($question_name == "") {

        } else if ($category == "") {

        } else if ($answers == "") {

        } else {

        }
    }

    public function getAllQuestions() {
        
    }
}
