<?php
    class Users extends Controller{
        public function __construct(){
            $this->userModel = $this->model('User');
        }

        public function login(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data = [
                    'email' => $_POST['email'],
                    'pass' => $_POST['pass'],
                    'email_err' => '',
                    'pass_err' => ''
                ];

                if(empty($data['email'])){
                    $data['email_err'] = 'Please enter an Email!';
                }
                if(empty($data['pass'])){
                    $data['pass_err'] = 'Please enter a Password';
                }
                if(empty($data['email_err']) && empty($data['pass_err'])){
                    if($this->userModel->findUserByEmail($data['email'])){
                        $loginUser = $this->userModel->login($data['email'],$data['pass']);
                        if($loginUser){
                            $this->createSession($loginUser);
                        }else{
                            $data['pass_err'] = 'Password Incorrect!';
                            $this->view('users/login', $data);
                        }
                    }else{
                        flash('post_msg','User not found!!','alert alert-danger');
                        $data['email_err'] = 'Please register first!';
                        $this->view('users/login',$data);
                    }
                }else{
                    $this->view('users/login', $data);
                }
            }else{
                $data= [
                    'email' => '',
                    'pass' => '',
                    'email_err' => '',
                    'pass_err' => ''
                ];

                $this->view('users/login', $data);
            }
        }

        public function register(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data = [
                    'name' => $_POST['name'],
                    'email' => $_POST['email'],
                    'pass' => $_POST['pass'],
                    'conpass' => $_POST['conpass'],
                    'name_err' => '',
                    'email_err' => '',
                    'pass_err' => '',
                    'conpass_err' => ''
                ];

                if(empty($data['name'])){
                    $data['name_err'] = 'Please enter a name!';
                }
                if(empty($data['email'])){
                    $data['email_err'] = 'Please enter an email!';
                }elseif($this->userModel->findUserByEmail($data['email'])){
                    $data['email_err'] = 'Email already in use!';
                }
                if(empty($data['pass'])){
                    $data['pass_err'] = 'Please enter a password!';

                }elseif(strlen($data['pass']) < 6){
                    $data['pass_err'] = 'Password must be at least 6 character long!';
                }
                if(empty($data['conpass'])){
                    $data['conpass_err'] = 'Please confirm your password!';
                }
                if($data['pass'] !== $data['conpass']){
                    $data['conpass_err'] = 'Passwords do not match!';
                }

                if(empty($data['name_err']) && empty($data['email_err']) && empty($data['pass_err']) && empty($data['conpass_err'])){
                    $data['pass'] = password_hash($data['pass'], PASSWORD_DEFAULT);
                    if($this->userModel->register($data)){
                        flash('post_msg','Registration successful! You can now log in!');
                        redirect('users/login');
                    }else{
                        flash('post_msg','Something went wrong!','alert alert-danger');
                        $this->view('users/register',$data);
                    }
                }else{
                    $this->view('users/register', $data);
                }

            }else{
                $data = [
                    'name' => '',
                    'email' => '',
                    'pass' => '',
                    'conpass' => '',
                    'name_err' => '',
                    'email_err' => '',
                    'pass_err' => '',
                    'conpass_err' => ''
                ];
                $this->view('users/register', $data);
            }
        }

        public function createSession($user){
            session_start();
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_name'] = $user->name;
            $_SESSION['user_email'] = $user->email;
            redirect('posts');
        }
        public function logout(){
            session_destroy();
            redirect('users/login');
        }
    }