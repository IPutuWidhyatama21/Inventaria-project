<?php 


class AdminPage extends Controller{

    public function index() {

        $_SESSION['status'] = [];

        session_start();

        if (empty($_SESSION['status'])){
            header('location: '. BASEURL . '/login');
        } 
        
        // pagination
        $batasHalaman = 3;
        $jumlah_data = count($this->model('Barang_model')->queryData());
        $data['halaman_aktif'] = (isset($idPages)) ? (int)$idPages : 1 ;
        $data['jumlah_halaman'] = ceil($jumlah_data / $batasHalaman);

        $data['judul'] = 'Dasboard';
        $data['barang'] = $this->model('Barang_model')->getAllBarang();
        $data['rakData'] = $this->model('Rak_model')->queryRak();

        $data['activeItem'] = 'active-item';

        $this->view('tamplates/headerAdmin', $data);
        $this->view('AdminPage/index', $data);
        $this->view('tamplates/footer');
    }

    public function tambahRak() {
        var_dump($_POST);
        if ($this->model('Rak_model')->tambahRak($_POST) > 0){
            header('location: '. BASEURL.'/AdminPage');
            exit;
        }
    }

    public function editbarang()
    {
        $data['judul'] = 'Edit Barang';
        $data['activeItem'] = 'active-item';

        $this->view('tamplates/headerAdmin', $data);
        $this->view('adminpage/editbarang', $data);
        $this->view('tamplates/footer');
    }

    public function tambahBarang()
    {
        if( $this->model('Barang_model')->tambahDataBarang($_POST) ) {
            header('Location: ' . BASEURL . '/AdminPage');
            exit;
        } else {
            header('Location: ' . BASEURL . '/AdminPage');
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

        $data['judul'] = 'AdminPage';
        $data['barang'] = $this->model('Barang_model')->getAllBarangPage( $halamanAwal, $batasHalaman );
        $data['rakData'] = $this->model('Rak_model')->queryRak();
        $data['activeItem'] = 'active-item';

        $this->view('tamplates/headerAdmin', $data);
        $this->view('adminpage/index', $data);
        $this->view('tamplates/footer');
    }

    public function deleteBarang($id)
    {
        if( $this->model('Barang_model')->deleteDataBarang($id) ){
            header('Location: ' . BASEURL . '/AdminPage');
        }
    }

    public function selectbertingkat(){
        $this->model('Rak_model')->queryselectbertingkat();
    }

    

}