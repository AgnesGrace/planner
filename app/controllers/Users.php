<?php 
class Users extends Controller{
    public $userModel;
    public function __construct()
    {
        // better understanding fron the main Controller class
        // so create User.php file in the model folder
        $this->userModel = $this->model('User');
    }
    public function signup(){
        // check if the method is post
        if($_SERVER['REQUEST_METHOD']=='POST'){
            // Data Sanitization
           
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            // then we process the form
            $data = [
                'name'=>trim($_POST['name']),
                'email'=>trim($_POST['email']),
                'password'=>trim($_POST['password']),
                'confirm_password'=>trim($_POST['confirm_password']),
                'name_error' =>'',
                'email_error'=>'',
                'password_error'=>'',
                'confirm_password_error'=>''
            ];

            // validation
            if(empty($data['name'])){
                $data['name_error'] = 'Please enter your name';
            }
            // validate and check if the email is unique
            if(empty($data['email'])){
                $data['email_error'] = 'Please enter your email address';
            }else{
                if($this->userModel->findUserByEmail($data['email'])){
                    $data['email_error'] = 'Email already exits';
                }
            }
            if(empty($data['password'])){
                $data['password_error'] = 'Please enter your password';
            }elseif(strlen($data['password'])<6){
                $data['password_error'] = 'Password must be at least 6 characters';
            }
            if(empty($data['confirm_password'])){
                $data['confirm_password_error'] = 'Please confirm your password';
            }else{
                if($data['password']!= $data['confirm_password']){
                    $data['confirm_password_error'] = 'Password do not match';  
                }
            }
            // To ensure that errors are empty
            if(empty($data['name_error']) && empty($data['email_error']) &&empty($data['password_error']) && empty($data['confirm_password_error'])){
               // Hash the user's password: THIS IS ALSO COMPATIBLE WITH CRYPT
               $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
               // Now we can register the user
              if( $this->userModel->register($data)){
                // create a helper function to handle this redirect
                //header('Location:' . URLROOT .'/users/login');
                flash('register_success', 'You are registered, Kindly login');
                redirectHelper('users/login');
              }else{
                die('Something went wrong');
              }

            }else{
                // Load views with errors
                $this->view('users/signup', $data);
            }
        }else{
            // Init data
            $data=[
                'name'=>'',
                'email'=>'',
                'password'=>'',
                'confirm_password'=>'',
                'name_error' =>'',
                'email_error'=>'',
                'password_error'=>'',
                'confirm_password_error'=>''
            ];
            // Load the specific view
            $this->view('users/signup', $data);
        
        }
    }
    public function login(){
        // check if the method is post
        if($_SERVER['REQUEST_METHOD']=='POST'){
            // then we process the form
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            // then we process the form
            $data = [
                'email'=>trim($_POST['email']),
                'password'=>trim($_POST['password']),
                'email_error'=>'',
                'password_error'=>'',
            ];
            //validation
            if(empty($data['email'])){
                $data['email_error'] = 'Please enter an email address';
            }
            if(empty($data['password'])){
                $data['password_error'] = 'Please enter your password';
            }
            // Check if the user exist
            if($this->userModel->findUserByEmail($data['email'])){
                // the user exist
            }else{
                $data['email_error'] = 'User not found';
            }
            // Ensure the errors are empty
            if(empty($data['email_error']) && empty($data['password_error'])){
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);
                if($loggedInUser){
                    // We create session variables here
                    $this->createUserSession($loggedInUser);
                }else{
                    $data['password_error'] = 'Incorrect Password';
                    $this->view('users/login', $data);
                }
            }else{
                // Load views with errors
                $this->view('users/login', $data);
            }

        }else{
            // Init data
            $data=[  
                'email'=>'',
                'password'=>'',
                'email_error'=>'',
                'password_error'=>'',
                
            ];
            // Load the specific view
            $this->view('users/login', $data);
        
        }

    }
     // user session
     public function createUserSession($user){
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_name'] = $user->name;
        $_SESSION['user_email'] = $user->email;
        redirectHelper('plans'); 
     }

    public function logout(){
        unset( $_SESSION['user_id']);
        unset( $_SESSION['user_name']);
        unset( $_SESSION['user_email']);
        session_destroy();
        redirectHelper('users/login');
    }
}