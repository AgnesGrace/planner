<?php
class User{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Add user to the db
    public function register($data){
        $this->db->query('INSERT INTO users(name, email, password) VALUES(:name, :email, :password)');
        $this->db->bind(':name', $data['name'] );
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        // next we execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
    public function login($email, $password){
        // first find a user with the email
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);
        $row= $this->db->singleRow();
        $hashed_password = $row->password;
        if(password_verify($password, $hashed_password)){
            return $row;
        }else{
            return false;
        }

    }

    public function findUserByEmail($email){
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);
        $row = $this->db->singleRow();

        // Check row
        if($this->db->rowCount()>0){
            return true;
        }else{
            return false;
        }
    }
    public function getUserById($id){
        $this->db->query('SELECT * FROM users WHERE id = :id');
        $this->db->bind(':id', $id);
        $row = $this->db->singleRow();
        return $row;
    }
}