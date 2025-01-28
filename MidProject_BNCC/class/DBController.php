<?php
require '../database/DBH.php';

class DBController extends DBH {
    protected function get_All_Users() {
        $sql = "SELECT id, photo, first_name, last_name, email FROM users WHERE id != 'A001' ORDER BY id ASC;";
        $statement = $this->connect()->query($sql);
        $results = $statement->fetchAll();
        return $results;
    }

    protected function get_Last_ID(){
        $sql = "SELECT id FROM users ORDER BY id DESC LIMIT 1;";
        $statement = $this->connect()->query($sql);
        $results = $statement->fetchColumn();
        return $results;
    }

    protected function get_User_Profile($id){
        $sql = "SELECT * FROM users WHERE id = ?";
        $statement = $this->connect()->prepare($sql);
        $statement->execute([$id]);
        $results = $statement->fetch();
        return $results;
    }

    protected function get_Admin_Profile() {
        $sql = "SELECT * FROM users WHERE id = 'A001';";
        $statement = $this->connect()->query($sql);
        $results = $statement->fetch();
        return $results;
    }

    protected function get_All_Email(){
        $sql = "SELECT email FROM users;";
        $statement = $this->connect()->query($sql);
        $results = $statement->fetchAll(PDO::FETCH_COLUMN);
        return $results;
    }

    protected function insert_User($id, $first_name, $last_name, $email, $pass, $bio, $photo) {
        $sql = "INSERT INTO users (id, first_name, last_name, email, password, bio, photo) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $statement = $this->connect()->prepare($sql);
        $statement->execute([
            $id,
            $first_name,
            $last_name,
            $email,
            $pass,
            $bio,
            $photo
        ]);
        $this->close();
    }

    protected function update_User($first_Name, $last_Name, $email, $bio, $id) {
        $sql = "UPDATE users SET first_name = ?, last_name = ?, email = ?, bio = ? WHERE id = ?";
        $statement = $this->connect()->prepare($sql);
        $statement->execute([
            $first_Name,
            $last_Name,
            $email,
            $bio,
            $id
        ]);
        $this->close();
    }
    
    protected function delete_User($id){
        $sql = "DELETE FROM users WHERE id = ?";
        $statement = $this->connect()->prepare($sql);
        $statement->execute([$id]);
        $this->close();
    }
}
