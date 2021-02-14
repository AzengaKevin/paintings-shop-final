<?php namespace App\Models;

use App\Core\Database;

class User{

    private ?Database $db = null;

    public function __construct() {
        $this->db = Database::init();
    }

    /**
     * Get a user that matches the specififed login credential
     * 
     * @param an array of the credentials
     * 
     * @return object of user from db if it exixsts else null
     */
    public function findByUsernameOrEmail(array $data)
    {
        $sql = "SELECT * FROM users WHERE username=:username OR email=:email";
        
        $this->db->prepare($sql);
    
        $this->db->bind('username', $data['login']);
        $this->db->bind('email', $data['login']);
    
        return $this->db->single();
    }

    /**
     * Get user from the database with such an email
     * 
     * @param string $email specified email address
     * 
     * @return object of user from db if it exixsts else null
     * 
     */
    public function findByEmail(string $email)
    {
        //Check if user with that email exists
        $query = "SELECT * FROM users WHERE email = :email";
    
        $this->db->prepare($query);

        $this->db->bind('email', $email);
        
        return $this->db->single();

    }

    /**
     * Persists a user entity to the database
     * 
     * @param array $data contains the user fields
     * 
     * @return object of the user created user
     * 
     */
    public function create(array $data)
    {
        $sql = "INSERT INTO users(name, username, email, password) VALUES (:name, :username, :email, :password)";

        $this->db->prepare($sql);

        $this->db->bind('name', $data['name']);
        $this->db->bind('username', $data['username']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('password', password_hash($data['email'], PASSWORD_DEFAULT));

        if($this->db->execute()){

            return $this->findByEmail($data['email']);

        }
    }

}