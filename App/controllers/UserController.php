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
}