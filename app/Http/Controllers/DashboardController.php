<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use App\Models\AdminUser;
use App\Models\ClientInfo;
use App\Models\ClientResponse;
use App\Models\Question;
use Exception;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $AppHelper;
    private $QuizModel;
    private $ClientInfo;
    private $QuizResponse;
    private $AdminUsers;

    public function __construct()
    {
        $this->AppHelper = new AppHelper();
        $this->ClientInfo = new ClientInfo();
        $this->QuizResponse = new ClientResponse();
        $this->AdminUsers = new AdminUser();
        $this->QuizModel = new Question();
    }

    public function getDashboardStatsInfo() {
        
        try {
            $dashboardDataInfo = array();

            $dashboardDataInfo['adminUserCount'] = $this->getAdminUserCount();
            $dashboardDataInfo['questionCount'] = $this->getAllQuestionCount();
            $dashboardDataInfo['responseCount'] = $this->getAllResponseCount();

            return $this->AppHelper->responseEntityHandle(1, "Operation Complete", $dashboardDataInfo);
        } catch (Exception $e) {
            return $this->AppHelper->responseMessageHandle(0, "Error Occured " . $e->getMessage());
        }
    }

    private function getAdminUserCount() {
        return $this->AdminUsers->count_all();
    }

    private function getAllQuestionCount() {
        return $this->QuizModel->count();
    }

    private function getAllResponseCount() {
        return $this->QuizResponse->count();
    }
}
