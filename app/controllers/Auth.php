<?php

class Auth extends Controller {
    
    public function index() 
    {
        $this->view('auth/login');
    }

    public function register() 
    {
        $this->view('auth/register');
    }

    public function createUser()
    {
        if( $this->model('Dashboard_user_model')->tambahDataUser($_POST) > 0 ) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL . '/auth');
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: ' . BASEURL . '/auth');
            exit;
        }
    }

    public function login()
    {
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $data['login'] = $this->model('Dashboard_user_model')->getUser($email, $password);
            
            if ($data['login']['role'] == "ADMIN") {
                
                session_start();
                $_SESSION['isLoggedIn'] = true;
                $_SESSION['isAdmin'] = true;
                $_SESSION['username'] = $data['login']['username']; 
                $_SESSION['id'] = $data['login']['id']; 
                $_SESSION['address'] = $data['login']['address']; 
                $_SESSION['phone_number'] = $data['login']['phone_number']; 
                
                header('Location: ' . BASEURL . '/');
                exit();
            } else if ($data['login']['role'] == "SELLER") {
                session_start();
                $_SESSION['isLoggedIn'] = true;
                $_SESSION['isAdmin'] = false;
                $_SESSION['isSeller'] = true; 
                $_SESSION['isUser'] = false; 
                $_SESSION['username'] = $data['login']['username']; 
                $_SESSION['id'] = $data['login']['id']; 
                $_SESSION['address'] = $data['login']['address']; 
                $_SESSION['phone_number'] = $data['login']['phone_number']; 
                
                header('Location: ' . BASEURL . '/');
                exit();
            } else if ($data['login']['role'] == "USER") {
                session_start();
                $_SESSION['isLoggedIn'] = true;
                $_SESSION['isAdmin'] = false;
                $_SESSION['isSeller'] = false; 
                $_SESSION['isUser'] = true; 
                $_SESSION['username'] = $data['login']['username']; 
                $_SESSION['id'] = $data['login']['id']; 
                $_SESSION['address'] = $data['login']['address']; 
                $_SESSION['phone_number'] = $data['login']['phone_number']; 
                
                header('Location: ' . BASEURL . '/');
                exit();
            } else {
                header('Location: ' . BASEURL . '/');
                exit();
            }
        } else {
            header('Location: ' . BASEURL . '/auth');
            exit();
        }
    }


    public function logout()
    {
        
        if (session_status() == PHP_SESSION_NONE){
            session_start();
            $_SESSION['isLoggedIn'] = false; 
            session_unset();
            session_destroy();
        }

        session_destroy();
        header('Location: ' . BASEURL . '/');
        exit();
    }

}