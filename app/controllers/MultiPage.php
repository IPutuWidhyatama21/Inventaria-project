<?php

class MultiPage extends Controller{

    // Function Parse URL
    public function parseURL()
    {
        if( isset($_GET['url']) ) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
    // End Function Parse URL

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

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $id_barang = $_POST['id_barang'];
            $namaBarang = $_POST['namaBarang'];
            $rak = $_POST['idRak'];
            $gambar = isset($_FILES['gambarBarang']) ? $_FILES['gambarBarang'] : null;
            $keterangan = $_POST['keterangan'];
            $kolom = $_POST['jumlahKolom'];
            $stok = $_POST['stok'];
    
            $data = [
                'id_barang' => $id_barang,
                'namaBarang' => $namaBarang,
                'rak' => $rak,
                'gambar' => $gambar,
                'keterangan' => $keterangan,
                'kolom' => $kolom,
                'stok' => $stok
            ];
    
            if ($this->model('Barang_model')->editDataBarang($data['id_barang'], $data['namaBarang'], $data['rak'], $data['gambar'], $data['keterangan'], $data['kolom'], $data['stok'])) {
                // Handle update success
                header('Location: ' . BASEURL . '/multipage/admin');
                exit;

            } else {
                // Handle update failure
                echo 'Gagal Memperbaharui Barang.';
            }

        }
    }

    public function getValueId($idValue) {
        header('Content-Type: application/json');
        $data = $this->model('Barang_model')->getValueIdData($idValue);
        echo json_encode($data);
    }

    public function getValueRak($ValueRak) {
        header('Content-Type: application/json');
        $dataValueRak = $this->model('Rak_model')->getValueRakData($ValueRak);
        echo json_encode($dataValueRak);
    }

    public function QueryKolom($IdBarang) {
        header('Content-Type: application/json');
        $DataQueryKolom = $this->model('Barang_model')->QueryJumlahKolom($IdBarang);
        echo json_encode($DataQueryKolom);
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

    public function QueryRak() {
        header('Content-Type: application/json');
        $data = $this->model('Rak_model')->queryRak();
        echo json_encode($data);
    }

    public function queryDataRak($id) {

    }


    // Manage User Function
    public function manageuser() {

        $url = $this->parseURL();
        $getactivePage = isset($url[1]) ? $url[1] : null;
        $limitdata = 4;
        $jumlahDataUser = $this->model('ManageUser_model')->countallUsername();
        $jumlahHalaman = ceil($jumlahDataUser / $limitdata);
        $activePage = (isset($getactivePage) && is_numeric($getactivePage)) ? $getactivePage : 1;
        $awalData = ($activePage - 1) * $limitdata;

        $data['UserName'] = $this->model('ManageUser_model')->getAllUser($awalData, $limitdata);
        $data['judul'] = 'Manage User';
        $data['activepage'] = $activePage;
        $data['jumlahHalaman'] = $jumlahHalaman;

        $data['activeItem'] = 'active-item';

        $this->view('tamplates/headerAdmin', $data);
        $this->view('AdminPage/manageusers', $data);
        $this->view('tamplates/footer');
    }

    public function deleteUser($id) {

        if( $this->model('ManageUser_model')->deleteDataUser($id) ){
            header('Location: ' . BASEURL . '/multipage/manageuser');
        }

    }

    public function adduser() {
       
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Handle form submission
            $username = $_POST['username'];
            $password = $_POST['password'];

            require_once __DIR__ . '/../model/ManageUser_model.php';
            $model = new ManageUser_model();
            $success = $model->addUser($username, $password);

            if ($success) {
                // User added successfully, you can redirect or show a success message here
                echo "<script>
                alert('User added successfully!');
                    window.location.href = 'manageuser';
                </script>
                ";
            } else {
                // Handle errors
                echo "<script>
                alert('Failed to add user');
                </script>
                ";
            }
        }

        $data['judul'] = 'Manage User';

        $this->view('tamplates/headerAdmin', $data);
        $this->view('AdminPage/manageuser');
        $this->view('tamplates/footer');

    }

    public function useredit() {

        $url = $this->parseURL();
        $id_user = $url[2];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $username = $_POST['Username'];
            $Password = $_POST['Password'];
            $RePassword = $_POST['RePassword'];  
            $url = $this->parseURL();
            $id_user = $url[2];           
            if($Password == $RePassword) {

                var_dump($username,$Password,$RePassword,$id_user);
                require_once __DIR__ . '/../model/ManageUser_model.php';
                $model = new ManageUser_model();
                $success = $model->updateUser($username, $Password, $id_user);

                
                if ($success) {
                    // User added successfully, you can redirect or show a success message here
                    echo "<script>
                    alert('User Update Successfully!');
                    window.location.href = '/inventaria-project/public/multipage/manageuser/';
                    </script>
                    ";
                } else {
                    // Handle errors
                    echo "<script>
                    alert('Failed to Update User');
                    window.location.href = '/inventaria-project/public/multipage/manageuser/';
    
                    </script>
                    ";
                }
            } else {
                echo "<script>
                alert('Failed to Update User because Password and Re-Password are Not Match');
                window.location.href = '/inventaria-project/public/multipage/manageuser/';

                </script>
                ";
            }
        }

        $data['UserName'] = $this->model('ManageUser_model')->getUserbyId($id_user);
        $data['judul'] = 'Manage User';
        $data['activeItem'] = 'active-item';

        $this->view('tamplates/headerAdmin', $data);
        $this->view('AdminPage/useredit', $data);
        $this->view('tamplates/footer');
    }

}