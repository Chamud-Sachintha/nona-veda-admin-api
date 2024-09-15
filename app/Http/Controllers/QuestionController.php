<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use App\Models\Question;
use Exception;
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

        $question_name = (is_null($request->quistionName) || empty($request->quistionName)) ? "" : $request->quistionName;
        $category = (is_null($request->quiestionCategoryType) || empty($request->quiestionCategoryType)) ? "" : $request->quiestionCategoryType;
        $answers = (is_null($request->questionAnswer) || empty($request->questionAnswer)) ? "" : $request->questionAnswer;

        if ($question_name == "") {
            return $this->AppHelper->responseMessageHandle(0, "Question Name is required.");
        } else if ($category == "") {
            return $this->AppHelper->responseMessageHandle(0, "Categoiry is required.");
        } else if ($answers == "") {
            return $this->AppHelper->responseMessageHandle(0 ,"Answers is required.");
        } else {
            try {
                $questionInfo = array();

                $questionInfo['questionName'] = $question_name;
                $questionInfo['categoryType'] = $category;
                $questionInfo['answersList'] = $answers;
                $questionInfo['createTime'] = $this->AppHelper->day_time();

                $res = $this->QuestionModel->add_log($questionInfo);

                if ($res) {
                    return $this->AppHelper->responseMessageHandle(1, "Operation Successfully");
                } else {
                    return $this->AppHelper->responseMessageHandle(0, "Error Occured.");
                }
            } catch (Exception $e) {
                return $this->AppHelper->responseMessageHandle(0, "Error Occured. " . $e->getMessage());
            }
        }
    }

    public function getAllQuestions() {

        $question_list = $this->QuestionModel->find_all();

        $formated_list = array();
        foreach ($question_list as $key => $value) {
            $formated_list[$key]['id'] = $value['id'];
            $formated_list[$key]['quistionName'] = $value['question_name'];
            $formated_list[$key]['quiestionCategoryType'] = $value['category'];
            $formated_list[$key]['questionAnswer'] = $value['answers'];
            $formated_list[$key]['createTime'] = $value['create_time'];
        }

        return $this->AppHelper->responseEntityHandle(1, "Operation Successfully", $formated_list);
    }
}
