<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use App\Models\AdminUser;
use Exception;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    private $AppHelper;
    private $AdminUser;

    public function __construct()
    {
        $this->AppHelper = new AppHelper();
        $this->AdminUser = new AdminUser();
    }

    public function getAllAdminUserList() {
        $adminList = $this->AdminUser->find_all();

        $adminUserList = array();
        foreach ($adminList as $key => $value) {
            $adminUserList[$key]['firstName'] = $value['first_name'];
            $adminUserList[$key]['lastName'] = $value['last_name'];
            $adminUserList[$key]['email'] = $value['email'];
        }

        return $this->AppHelper->responseEntityHandle(1, "Opereation Successfully", $adminUserList);
    }

    public function addNewAdminUser(Request $request) {

        $firstname = (is_null($request->firstName) || empty($request->firstName)) ? "" : $request->firstName;
        $lastName = (is_null($request->lastName) || empty($request->lastName)) ? "" : $request->lastName;
        $email = (is_null($request->email) || empty($request->email)) ? "" : $request->email;
        $password = (is_null($request->password) || empty($request->password)) ? "" : $request->password;

        if ($firstname == "") {

        } else if ($lastName == "") {

        } else if ($email == "") {

        } else if ($password == "") {

        } else {
            try {

            } catch (Exception $e) {
                return $this->AppHelper->responseMessageHandle(0, "Operation Failed " . $e->getMessage());
            }
        }
    }
}
