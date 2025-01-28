<?php
require 'DBController.php';

class UserController extends DBController {
    public $id = null;
    private $first_Name = null;
    private $last_Name = null;
    private $email = null;
    private $pass = null;
    private $bio = null;
    private $photo = null;

    private $temp_id;
    private $email_Temp;

    public $firstName_Error = null;
    public $lastName_Error = null;
    public $email_Error = null;
    
    public $temp_PhotoPath = null;
    public $temp_FolderPath = '../images/temp/';
    public $display_Photo = "../images/default_Profile.png";

    private $pass_EmptyValidation = 0;
    private $pass_EmailValidation = 0;
    private $pass_DuplicateValidation = 0;
    private $pass_FullValidation = 0;

    public function get_ID(){
        echo $this->id;
    }

    public function get_firstName_Temp(){
        echo $this->first_Name;
    }

    public function get_lastName_Temp(){
        echo $this->last_Name;
    }

    public function get_Email_Temp(){
        echo $this->email;
    }

    public function get_Bio_Temp(){
        echo $this->bio;
    }

    public function show_Users() {
        $results = $this->get_All_Users();
        return $results;
    }

    public function emptyFolder($folderPath) {
        $files = glob($folderPath.'/*');  
        foreach($files as $file){
            if(is_file($file)) unlink($file);
        } 
    }

    private function user($data) {
        $this->first_Name = $data["firstName_Input"];
        $this->last_Name = $data["lastName_Input"];
        $this->email = $data["email_Input"];
        $this->bio = $data["bio_Input"];
    }

    public function preprocessing_Update($current_id){
        $user_Profile_Temp = $this->show_Specific_User($current_id);

        if($user_Profile_Temp){
            $this->id = $user_Profile_Temp["id"];
            $this->first_Name = $user_Profile_Temp["first_name"];
            $this->last_Name = $user_Profile_Temp["last_name"];
            $this->email = $user_Profile_Temp["email"];
            $this->email_Temp = $user_Profile_Temp["email"];
            $this->bio = $user_Profile_Temp["bio"];
            $this->display_Photo = $user_Profile_Temp["photo"];
            $this->temp_PhotoPath = $user_Profile_Temp["photo"];
            $this->photo = $user_Profile_Temp["photo"];
        }
    }

    private function validate_Empty($img){
        $this->firstName_Error = empty(trim($this->first_Name)) ? "First name must be filled!" : null;
        $this->lastName_Error = empty(trim($this->last_Name)) ? "Last name must be filled!" : null;
        $this->email_Error = empty(trim($this->email)) ? "Email must be filled!" : null;

        if($img['error'] == UPLOAD_ERR_OK){
            $this->display_Photo = "../images/temp/" . basename($img['name']);
            if($this->display_Photo != $this->temp_PhotoPath){
                $this->temp_PhotoPath = $this->display_Photo;
                $this->emptyFolder($this->temp_FolderPath);
                move_uploaded_file($img['tmp_name'], $this->temp_PhotoPath);
            }
        } else{
            $files = glob($this->temp_FolderPath . '*');
            if(!empty($files)){
                $this->display_Photo = reset($files);
                $this->temp_PhotoPath = $this->display_Photo;
            } else{
                $this->display_Photo = "../images/default_Profile_2.png";
            }
        }

        if($this->firstName_Error == null && $this->lastName_Error == null && $this->email_Error == null && $this->temp_PhotoPath != null){
            $this->pass_EmptyValidation = 1;
        }
    }

    private function validate_Empty_Update(){
        $this->firstName_Error = empty(trim($this->first_Name)) ? "First name must be filled!" : null;
        $this->lastName_Error = empty(trim($this->last_Name)) ? "Last name must be filled!" : null;
        $this->email_Error = empty(trim($this->email)) ? "Email must be filled!" : null;

        if($this->firstName_Error == null && $this->lastName_Error == null && $this->email_Error == null){
            $this->pass_EmptyValidation = 1;
        }
    }

    private function validate_Email(){
        if(filter_var($this->email, FILTER_VALIDATE_EMAIL) === false){
            $this->email_Error = "Email format not valid!";
            $this->email = null;
        } else{
            $this->email_Error = null;
            $this->pass_EmailValidation = 1;
        }
    }

    private function validate_Duplicate(){
        $all_Emails = $this->get_All_Email();
        $this->pass_DuplicateValidation = 1;
        $this->email_Error = null;

        foreach($all_Emails as $i){
            if($i == $this->email){
                $this->email = null;
                $this->email_Error = "Email already used!";
                $this->pass_DuplicateValidation = 0;
                break;
            }
        }
    }

    private function validate_Duplicate_Update(){
        $all_Emails = $this->get_All_Email();
        $this->pass_DuplicateValidation = 1;
        $this->email_Error = null;

        foreach($all_Emails as $i){
            if($i == $this->email && $this->email != $this->email_Temp){
                $this->email = null;
                $this->email_Error = "Email already used!";
                $this->pass_DuplicateValidation = 0;
                break;
            }
        }
    }

    private function create_UserID() {
        $this->pass_FullValidation = 1;
        $temp_ID = $this->get_Last_ID();
        
        $prefix = $temp_ID[0];

        $number = (int)substr($temp_ID, 1);
        $number += 1;
    
        if ($number > 999) {
            $number = 0;

            if($prefix == "Z"){
                $this->pass_FullValidation = 0;
                return;
            } else{
                ++$prefix;
            }
        }
    
        $this->id = $prefix . str_pad($number, 3, "0", STR_PAD_LEFT);
    }

    private function hash_Password(){
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $temp_Pass = null;

        $shuffled_Characters = str_shuffle($characters); // shuffle 3 kali, because why not
        $shuffled_Characters = str_shuffle($characters);
        $shuffled_Characters = str_shuffle($characters);

        for ($i = 0; $i < 8; $i++) {
            $temp_Pass .= $shuffled_Characters[rand(0, strlen($shuffled_Characters) - 1)];
        }

        // $temp_Pass = "admin123";
        $this->pass = md5($temp_Pass);
    }

    private function move_Photo(){
        $destination = "../images/";
    
        $extension = pathinfo($this->temp_PhotoPath, PATHINFO_EXTENSION);
        
        $this->photo = $destination . $this->id . "_Photo." . $extension;
    
        rename($this->temp_PhotoPath, $this->photo);
    }

    public function create_User($data, $img) {
        $this->user($data);

        $this->validate_Empty($img);
        if($this->pass_EmptyValidation == 0){
            return;
        }

        $this->validate_Email();
        if($this->pass_EmailValidation == 0){
            return;
        }

        $this->validate_Duplicate();
        if($this->pass_DuplicateValidation == 0){
            return;
        }

        $this->create_UserID();
        if($this->pass_FullValidation == 0){
            // echo "Database is full!";
            // header("Location: full_User.php");
        }

        $this->hash_Password();

        $this->move_Photo();

        $this->insert_User($this->id, $this->first_Name, $this->last_Name, $this->email, $this->pass, $this->bio, $this->photo);
    
        header("Location: create_user_page_success.php");
    }

    public function show_Specific_User($current_id) {
        $results = $this->get_User_Profile($current_id);
        return $results;
    }

    public function remove_User($data){
        $delete_Photo_Path = realpath($data['photo']);

        if(file_exists($delete_Photo_Path)){
            unlink($delete_Photo_Path);
        }

        $this->delete_User($data['id']);
        header("Location: dashboard_page.php");
    }

    public function modify_User($data) {
        $this->id = $data['id_Temp'];
        $this->display_Photo = $data['photo_Temp'];
        $this->user($data);
        
        $this->validate_Empty_Update();
        if($this->pass_EmptyValidation == 0){
            return;
        }

        $this->validate_Email();
        if($this->pass_EmailValidation == 0){
            return;
        }

        $this->update_User($this->first_Name, $this->last_Name, $this->email, $this->bio, $this->id);

        header("Location: update_page_success.php");
    }   
}