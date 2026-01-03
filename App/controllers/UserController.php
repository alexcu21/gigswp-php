<?php
namespace App\Controllers;

use Framework\Database;
use Framework\Validation;
class UserController
{
    protected $db;

    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }

    /**
     * 
     * show login page
     * @return void
     */
    public function login()
    {
        loadView('users/login');
    }

    /**
     * 
     * show register page
     * @return void
     */
    public function create()
    {
        loadView('users/create');
    }

    /**
     * Store user in Database
     * 
     * @return void
     */

    public function store()
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $password = $_POST['password'];
        $password_confirmation = $_POST['password_confirmation'];

        $errors = [];

        if (!Validation::email($email)) {
            $errors['email'] = 'Please enter a valid email address';
        }

        if (!Validation::string($name, 2, 255)) {
            $errors['name'] = 'Please enter a valid name';
        }

        if(!validation::string($password, 6, 255)){
            $errors['password'] = 'The password must be at least 6 characters long';
        }

        if (!Validation::match($password, $password_confirmation)) {
            $errors['password'] = 'Passwords do not match';
        }

        if(!empty($errors)){
            loadView('users/create', [
                'errors' => $errors,
                'user' => [
                    'name' => $name,
                    'email' => $email,
                    'city' => $city,
                    'state' => $state,
                    'password' => $password,
                    'password_confirmation' => $password_confirmation
                ]
            ]);
            exit;
        }
        //check if email exist
        $params = [
            'email' => $email
        ];

        $user = $this->db->query("SELECT * FROM users WHERE email = :email", $params)->fetch();

        if($user){
            $errors['email'] = 'Email already exists';
            loadView('users/create',
            ['errors' => $errors]
            );
            exit;
        }   

        //create user account
        $params = [
            'name' => $name,
            'email' => $email,
            'city' => $city,
            'state' => $state,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ];

        $this->db->query("INSERT INTO users (name, email, city, state, password) VALUES (:name, :email, :city, :state, :password)", $params);

        redirect('/');
    }
}