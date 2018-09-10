<?php
include_once 'dbh.php';

include_once 'config.php';
// require: stops the code when there is an error "Fatal Error". 
// include: just show message that there is an error but continue running the code.
// ISSET  :   check if this variable is exsist or not then to check that this variable is set or not.
// bindparam : pass variables only.
// bindvalue : pass variables and values.

class SignUp
{
    private $errors = [];
    
    public function __construct()
    {
        if (Request::method() == 'POST') {
            $this->createNewUser();
        } else {
            $this->displayForm();
        }
    }
    private function displayForm()
    {
        $errors = $this->errors;
        require 'index.php';           //'sign-up-form.php'
    }
    private function createNewUser()
    {
        if ($this->isValidForm()) {
            $this->insertToDatabase();
        } else {
            $this->displayForm(); // with errors
        }
    }
    private function isValidForm()
    {
        if ( Validation::isEmpty('first')){
            $this->errors['first']= 'First Name Is Required';
        }
        if ( Validation::isEmpty('last')){
            $this->errors['last']= 'Last Name Is Required';
        }
        if (Validation::isEmpty('pwd')) {
            $this->errors['pwd'] = 'pwd is required';
        }
        if (Validation::isEmpty('email')) {
            $this->errors['email'] = 'email is required';
        } elseif (! Validation::isEmail('email')) {
            $this->errors['email'] = 'Invalid email address';
        } elseif (Database::exists('email')) {
            $this->errors['email'] = 'email address exists';
        } 
        return empty($this->errors);
    }
    public function errors()
    {
        return $this->errors;
    }
    public function insertToDatabase(){
        if (isset($_POST['submit'])) {

            $first = $_POST ['first'];
            $last  = $_POST ['last'];
            $email = $_POST ['email'];
            $user  = $_POST ['user'];
            $pwd   = $_POST ['pwd'];

        $sql = 'INSERT INTO users SET first=:first, last=:last, email=:email, user=:user, pwd=:pwd';
        $query = $conn->prepare ('$sql');
        $query-> bindParam ('first', $first);
        $query-> bindParam ('last',  $last);
        $query-> bindParam ('email', $email);
        $query-> bindParam ('user',  $user);
        $query-> bindParam ('pwd',   $pwd);
        $insert = $query->execute();
        if($insert == TRUE) 
        {
            echo "DONE";
        }
    }
}}
new SignUp;

/* foreach (['first', 'last'] as $name) {
            if (Validation::isEmpty($name)) {
                $this->errors['first'] = 'first name is required';
            } elseif (! Validation::isValidName('first')) {
                $this->errors['first'] = 'Invalid first name';
            }
        }*/
