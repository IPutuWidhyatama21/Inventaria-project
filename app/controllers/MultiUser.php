<?php

class MultiUser extends Controller{

    public function admin()
    {
        $data['judul'] = 'Admin';

        $_SESSION['status'] = [];

        session_start();

        if (empty($_SESSION['status'])){
            header('location: '. BASEURL . '/login');
        } else {
            if($_SESSION['status'] == 2) {
                header('location: '. BASEURL . '/multiuser/user');
            }
        }
        
        $this->view('tamplates/headermultiuser', $data);
        $this->view('loginmultiuser/admin', $data);
        $this->view('tamplates/footermultiuser');
        
    }

    public function user()
    {
        $data['judul'] = 'User';

        $_SESSION['status'] = [];

        session_start();

        if (empty($_SESSION['status'])){
            header('location: '. BASEURL . '/login');
        } else {
            if($_SESSION['status'] == 1) {
                header('location: '. BASEURL . '/multiuser/admin');
            }
        }
        
        $this->view('tamplates/headermultiuser', $data);
        $this->view('loginmultiuser/user', $data);
        $this->view('tamplates/footermultiuser');
        
    }


}