<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use App\Models\ClientInfo;
use App\Models\ClientResponse;
use App\Models\Question;
use Exception;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    private $AppHelper;
    private $QuestionModel;
    private $ClientResponse;
    private $ClientInfo;

    public function __construct()
    {
        $this->AppHelper = new AppHelper();
        $this->QuestionModel = new Question();
        $this->ClientResponse = new ClientResponse();
        $this->ClientInfo = new ClientInfo();
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

    public function getQuestionInfoById(Request $request) {

        $questionId = (is_null($request->questionId) || empty($request->questionId)) ? "" : $request->questionId;

        if ($questionId == "") {
            return $this->AppHelper->responseMessageHandle(0, "Question ID is required.");
        } else {
            try {
                $question = $this->QuestionModel->find_by_id($questionId);

                $questionInfo = array();
                if ($question) {
                    $questionInfo['questionName'] = $question['question_name'];
                    $questionInfo['category'] = $question['category'];
                    $questionInfo['answersList'] = $question['answers'];

                    return $this->AppHelper->responseEntityHandle(1, "Operation Successfully", $questionInfo);
                } else {
                    return $this->AppHelper->responseMessageHandle(0, "Invalid Question Id");
                }
            } catch (Exception $e) {
                return $this->AppHelper->responseMessageHandle(0, "Error Occured " . $e->getMessage());
            }
        }
    }

    public function updateQuestionById(Request $request) {

        $questionId = (is_null($request->questionId) || empty($request->questionId)) ? "" : $request->questionId;
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

                $update_question = $this->QuestionModel->update_by_id($questionInfo, $questionId);

                if ($update_question) {
                    return $this->AppHelper->responseMessageHandle(1, "Operation Successfully");
                } else {
                    return $this->AppHelper->responseMessageHandle(0, "Error Occure");
                }
            } catch (Exception $e) {
                return $this->AppHelper->responseMessageHandle(0, "Error Occured " . $e->getMessage());
            }
        }
    }

    public function deleteQuestionById(Request $request) {

        $questionId = (is_null($request->questionId) || empty($request->questionId)) ? "" : $request->questionId;

        if ($questionId == "") {
            return $this->AppHelper->responseMessageHandle(0, "Question ID is required.");
        } else {
            try {
                $question = $this->QuestionModel->find_by_id($questionId);

                if ($question) {
                    $delete_question = $this->QuestionModel->delete_by_id($questionId);

                    if ($delete_question) {
                        return $this->AppHelper->responseMessageHandle(1, "Operation Successfully");
                    } else {
                        return $this->AppHelper->responseMessageHandle(0, "Error Occured");
                    }
                } else {
                    return $this->AppHelper->responseMessageHandle(0, "Invalid Question Id");
                }
            } catch (Exception $e) {
                return $this->AppHelper->responseMessageHandle(0, "Error Occured " . $e->getMessage());
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

    public function getSAllClientResponses() {

        $all_response_list = $this->ClientResponse->find_all();

        $formated_list = array();
        foreach ($all_response_list as $key => $value) {
            $client_info = $this->ClientInfo->find_by_id($value['client_id']);

            $formated_list[$key]['clientName'] = $client_info['first_name'];
            $formated_list[$key]['emailAddress'] = $client_info['email'];

            $result_list = explode(",", $value['result']);

            $formated_list[$key]['vataResult'] = $result_list[0];
            $formated_list[$key]['pittaResult'] = $result_list[1];
            $formated_list[$key]['kappaResult'] = $result_list[2];

            $formated_list[$key]['result'] = $value['result'];
            $formated_list[$key]['submitedTime'] = $value['create_time'];
        }

        return $this->AppHelper->responseEntityHandle(1, "Operation Successfully", $formated_list);
    }
}
