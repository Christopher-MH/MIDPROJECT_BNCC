<?php
require 'DBController.php';

class AdminController extends DBController {
    private $email = null;
    private $pass = null;
    private $hashed_Pass = null;

    public $email_Error = null;
    public $fail_Login = "none";

    private $pass_EmptyValidation = 0;
    private $pass_EmailValidation = 0;

    public function show_Admin() {
        $results = $this->get_Admin_Profile();
        return $results;
    }

    public function logout(){
        header("Location: login_page.php");
    }

    public function get_Email_Temp(){
        echo $this->email;
    }

    private function login_Info($data) {
        $this->email = $data["email_Input"];
        $this->pass = $data["password_Input"];
    }

    private function validate_Empty(){
        $this->pass_EmptyValidation = 0;
        $this->email_Error = empty(trim($this->email)) ? "Email must be filled!" : null;

        if($this->email_Error == null){
            $this->pass_EmptyValidation = 1;
        }
    }

    private function validate_Email(){
        if(filter_var($this->email, FILTER_VALIDATE_EMAIL) === false){
            $this->email_Error = "Email format not valid!";
            $this->email = null;
            $this->pass_EmailValidation = 0;
        } else{
            $this->email_Error = null;
            $this->pass_EmailValidation = 1;
        }
    }

    public function login($data){
        $this->login_Info($data);

        $this->validate_Empty();
        if($this->pass_EmptyValidation == 0){
            return;
        }

        $this->validate_Email();
        if($this->pass_EmailValidation == 0){
            return;
        }

        $this->hashed_Pass = md5($this->pass);

        $admin_Profile = $this->show_Admin();

        if($this->email != $admin_Profile["email"] || $this->hashed_Pass != $admin_Profile["password"]){
            $this->fail_Login = "block";
            return;
        }

        header("Location: ../page_php/dashboard_page.php");
    }
}