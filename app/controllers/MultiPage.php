<?php

class MultiPage extends Controller{

    public function admin()
    {
        $data['judul'] = 'Admin';

        $_SESSION['status'] = [];

        session_start();

        if (empty($_SESSION['status'])){
            header('location: '. BASEURL . '/login');
        } else {
            if($_SESSION['status'] == 2) {
                header('location: '. BASEURL . '/multipage/user');
            }
        }

       // pagination
       $batasHalaman = 3;
       $jumlah_data = count($this->model('Barang_model')->queryData());
       $data['halaman_aktif'] = (isset($idPages)) ? (int)$idPages : 1 ;
       $data['jumlah_halaman'] = ceil($jumlah_data / $batasHalaman);

       $data['judul'] = 'Dashboard';
       $data['barang'] = $this->model('Barang_model')->getAllBarang();
       $data['rakData'] = $this->model('Rak_model')->queryRak();
    //    $data['kolom'] = $this->model('Rak_model')->querySelectBertingkat();

       $data['activeItem'] = 'active-item';
        
        $this->view('tamplates/headerAdmin', $data);
        $this->view('AdminPage/index', $data);
        $this->view('tamplates/footer');
        
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
                header('location: '. BASEURL . '/multipage/admin');
            }
        }

        // pagination
       $batasHalaman = 3;
       $jumlah_data = count($this->model('Barang_model')->queryData());
       $data['halaman_aktif'] = (isset($idPages)) ? (int)$idPages : 1 ;
       $data['jumlah_halaman'] = ceil($jumlah_data / $batasHalaman);

       $data['judul'] = 'Dashboard';
       $data['barang'] = $this->model('Barang_model')->getAllBarang();
       $data['rakData'] = $this->model('Rak_model')->queryRak();

       $data['activeItem'] = 'active-item';
        
        $this->view('tamplates/headerUser', $data);
        $this->view('UserPage/index', $data);
        $this->view('tamplates/footer');
        
    }


    // System
    public function tambahRak(){
        var_dump($_POST);
        if ($this->model('Rak_model')->tambahRak($_POST) > 0){
            header('location: '. BASEURL.'/adminpage');
            exit;
        }
    }

    public function editbarang()
    {

        // Percobaan Membuat Controllers editbarang
        // var_dump($_POST);
        // if ($this->model('Barang_model')->editDataBarang($_POST) > 0){
        //     header('location: '. BASEURL.'/adminpage');
        //     exit;
        // }

        $data['judul'] = 'Edit Barang';
        $data['activeItem'] = 'active-item';

        $this->view('tamplates/headerAdmin', $data);
        $this->view('adminpage/editbarang', $data);
        $this->view('tamplates/footer');
    }

    public function tambahBarang()
    {
        if( $this->model('Barang_model')->tambahDataBarang($_POST) ) {
            header('Location: ' . BASEURL . '/adminpage');
            exit;
        } else {
            header('Location: ' . BASEURL . '/adminpage');
        }
    }

    public function page($idPages)
    {
        // pagination
        $batasHalaman = 3;
        $jumlah_data = count($this->model('Barang_model')->queryData());
        $data['halaman_aktif'] = (isset($idPages)) ? (int)$idPages : 1 ;
        $halamanAwal = ( $batasHalaman * $data['halaman_aktif'] ) - $batasHalaman ;
        $data['jumlah_halaman'] = ceil($jumlah_data / $batasHalaman);

        $data['judul'] = 'Dashboard';
        $data['barang'] = $this->model('Barang_model')->getAllBarangPage( $halamanAwal, $batasHalaman );
        $data['rakData'] = $this->model('Rak_model')->queryRak();
        $data['activeItem'] = 'active-item';

        $this->view('tamplates/header', $data);
        $this->view('adminpage/index', $data);
        $this->view('tamplates/footer');
    }

    public function deleteBarang($id)
    {
        if( $this->model('Barang_model')->deleteDataBarang($id) ){
            header('Location: ' . BASEURL . '/adminpage');
        }
    }

    public function selectbertingkat(){
        $this->model('Rak_model')->queryselectbertingkat();
    }


}