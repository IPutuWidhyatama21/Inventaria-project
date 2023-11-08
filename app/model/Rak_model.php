<?php 

class Rak_model {
    private $tabel = 'rak';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function tambahRak($data){
        $query = "INSERT INTO rak VALUES ('',:nama_rak,:jumlah_kolom) ";

        $this->db->query($query);
        $this->db->bind('nama_rak',$data['namarak']);
        $this->db->bind('jumlah_kolom',$data['jumlahkolom']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function queryRak() 
    {
        $this->db->query("SELECT * FROM " . $this->tabel);
        return $this->db->resultSet();
    }

    public function querySelectBertingkat() {

        require_once '../app/controllers/ValueHandler.php';

        $controller = new ValueHandler;
        $selectedValue = $controller->handleRequest();

        $this -> db -> query("SELECT * FROM " . $this -> tabel . " WHERE '$selectedValue' = id_rak");
        return $this->db->resultSet();

    }
    
    // public function queryselectbertingkat(){
    //     $this->db->query("SELECT * FROM " . $this->tabel);
    //     $result = $this->db->resultSet();
    //     return $result;

    //     // Mencoba Menambahkan Function Select Bertingkat
    //     $session_start();

    //     $_SESSION['rak'] = $result['nama_rak'];

    //     if ($_SESSION['rak'] == $result['nama_rak']) {
    //         $this->db->query("SELECT * FROM " . $this->tabel . " WHERE nama_rak = '" . $result['nama_rak'] . "'");
    //         $resultData = $this->db->resultSet();
    //         return $resultData;
    //     }

    //     while ($row = $result) {
    //         // Lakukan sesuatu dengan data, misalnya, tampilkan di halaman web
    //         $rakId = $row['id_rak'];
    //         $rakNama = $row['nama_rak'];
    //         $jumlahKolom = $row['jumlah_kolom'];
        
    //         $data[] = array('id_rak' => $rakId, 'rak_nama' => $rakNama, 'jumlah_kolom' => $jumlahKolom);
    //         // Anda bisa menyesuaikan sesuai dengan struktur tabel Anda
    //     }
    //     echo json_encode(array('data'=> $data));
    // }


}

Class ValueHandler {
    
    public function handleRequest() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $json = file_get_contents('php://input');
            $dataValue = json_decode($json, true);

            // Panggil model atau lakukan operasi apa pun yang Anda butuhkan dengan $data di sini
            $result = $this->processData($dataValue);

            // Kirim hasil dalam format JSON
            echo json_encode(["result" => $result]);
        } else {
            echo json_encode(["error" => "Metode request tidak valid"]);
        }
    }

    private function processData($dataValue) {
        return $dataValue;
    }

}

?>