<?php
class Users extends Controller
{

    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function register()
    {
        //Check for post
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Process from
            //  Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //Init data
            $data = [
                'name'                  => trim($_POST['name']),
                'email'                 => trim($_POST['email']),
                'password'              => trim($_POST['password']),
                'confirm_password'      => trim($_POST['confirm_password']),
                'name_err'              => '',
                'email_err'             => '',
                'password_err'          => '',
                'confirm_password_err'  => '',
            ];

            //Validate email
            if (empty($data['email'])) {
                $data['email_err'] = "Please Enter email";
            } else {
                //Check email
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = "Email is already registered.";
                }
            }

            //Validate name
            if (empty($data['name'])) {
                $data['name_err'] = "Please Enter name";
            }

            //Validate password
            if (empty($data['password'])) {
                $data['password_err'] = "Please Enter password";
            } elseif (strlen($data['password']) < 6) {
                $data['password_err'] = "Password must be at least 6 characters";
            }

            //Validate confirm_password
            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = "Please Enter Confirm password";
            } else {
                if ($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_err'] = "Passwords do not match";
                }
            }

            if (empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                //validated

                //Hash Password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                //Register User
                if ($this->userModel->register($data)) {
                    flash('register_success', 'You are registered and can login now');
                    redirect('users/login');
                } else {
                    die("Register fail!");
                }
            } else {
                //Load view with errors
                $this->view('users/register', $data);
            }
        } else {
            //Init data
            $data = [
                'name'                  => '',
                'email'                 => '',
                'password'              => '',
                'confirm_password'      => '',
                'name_err'              => '',
                'email_err'             => '',
                'password_err'          => '',
                'confirm_password_err'  => '',
            ];
            //Load view
            $this->view('users/register', $data);
        }
    }

    public function login()
    {
        //Check for post
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Process from
            //  Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //Init data
            $data = [
                'email'                 => trim($_POST['email']),
                'password'              => trim($_POST['password']),
                'email_err'             => '',
                'password_err'          => '',
            ];

            //Validate email
            if (empty($data['email'])) {
                $data['email_err'] = "Please Enter email";
            }

            //Validate password
            if (empty($data['password'])) {
                $data['password_err'] = "Please Enter password";
            }

            //check email
            if (!$this->userModel->findUserByEmail($data['email'])) {
                $data['email_err'] = "User not found";
            }

            if (empty($data['email_err']) && empty($data['password_err'])) {
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);
                if ($loggedInUser) {
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['password_err'] = "Password incorrect";

                    //Load view with errors
                    $this->view('users/login', $data);
                }
            } else {
                //Load view with errors
                $this->view('users/login', $data);
            }
        } else {
            //Init data
            $data = [
                'email'                 => '',
                'password'              => '',
                'email_err'             => '',
                'password_err'          => '',
            ];
            //Load view
            $this->view('users/login', $data);
        }
    }

    public function createUserSession($user)
    {
        $_SESSION['user_id']    = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name']  = $user->name;
        redirect('pages/index');
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        session_destroy();
        redirect('users/login');
    }
}
