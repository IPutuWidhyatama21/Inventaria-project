<?php 

class Barang_model {
    private $tabel = "barang";
    private $db;


    public function __construct()
    {
        $this->db = new Database;    
    }

    public function queryData()
    {

        $this->db->query("SELECT * FROM " . $this->tabel);
        return $this->db->resultSet();

    }

    public function getAllBarang() {

        $this->db->query("SELECT * FROM " . $this->tabel . " INNER JOIN rak ON " . $this->tabel . ".id_rak = rak.id_rak LIMIT 3 OFFSET 0");
        return $this->db->resultSet();

    }

    public function getAllBarangPage($halamanAwal, $batasHalaman)
    {
        $this->db->query("SELECT * FROM " . $this->tabel . " INNER JOIN rak ON " . $this->tabel . ".id_rak = rak.id_rak LIMIT " . $batasHalaman . " OFFSET " . $halamanAwal);
        return $this->db->resultSet();
    }

    public function uploadGambar()
        {
            $namaFile = $_FILES['gambarBarang']['name'];
            $ukuranFile = $_FILES['gambarBarang']['size'];
            $errorFile = $_FILES['gambarBarang']['error'];
            $tmpNameFile = $_FILES['gambarBarang']['tmp_name'];
            $gambar = [];

            // cek apakah gambar diupload atau tidak 
            if ( $errorFile === 4 ){
                echo "<script>
                        alert('Masukkan gambar terlebih dahulu!');
                    </script>";
                    return false;
            }

            // cek apakah yang diupload adalah gambar
            $ekstensiGambarValid = ['jpg','png','jpeg'];
            $ekstensiGambar = explode('.', $namaFile);
            $ekstensiGambar = strtolower(end($ekstensiGambar));

            if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
                echo "<script>
                        alert('Yang anda masukan bukan gambar!');
                    </script>";
                    return false;
            }

            // cek ukuran gambar 
            if( $ukuranFile > 100000000 ) {
                echo "<script>
                        alert('Ukuran gambar terlalu besar!');
                    </script>";
                    return false;
            }

            // lolos pengechekan, generate nama baru, gambar siap di upload
            $namaFileBaru = uniqid();
            $namaFileBaru .= '.';
            $namaFileBaru .= $ekstensiGambar;
            move_uploaded_file($tmpNameFile, 'img/image_upload/' . $namaFileBaru);

            return $namaFileBaru;
        }

    public function tambahDataBarang($dataBarang) {

        $gambar = $this->uploadGambar();

        $query = "INSERT INTO barang 
                    VALUES (
                        NULL, :namaBarang, :keterangan, :stok, :id_rak, :gambar, :kolom
                        )";
        $this->db->query($query);
        $this->db->bind('namaBarang', $dataBarang['namaBarang']);
        $this->db->bind('keterangan', $dataBarang['keterangan']);
        $this->db->bind('stok', $dataBarang['stok']);
        $this->db->bind('id_rak', $dataBarang['idRak']);
        $this->db->bind('gambar', $gambar);
        $this->db->bind('kolom', $dataBarang['jumlahKolom']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    // Percobaan Membuat Model Edit Barang
    public function editDataBarang($id_barang, $namaBarang, $rak, $gambar, $keterangan, $kolom, $stok)
    {

        // // Check if 'gambarBarang' key exists in $_FILES array
        if (isset($_FILES['gambarBarang']) && $_FILES['gambarBarang']['error'] == 4) {
           $gambar = $_POST;
        } else {
            // Perform image upload only if 'gambarBarang' is set and there is no error
            if (isset($_FILES['gambarBarang']) && $_FILES['gambarBarang']['error'] !== 4) {
                $gambar = $this->uploadGambar();
            } else {
                $gambar = $_FILES['gambarBarang'];
            }
        }

        $query = "UPDATE barang 
                SET nama_barang = :namaBarang, 
                    keterangan = :keterangan, 
                    stok = :stok,
                    id_rak = :idRak,
                    gambar = :gambar, 
                    kolom = :kolom
                WHERE id_barang = :id_barang";

        $this->db->query($query);
        $this->db->bind('namaBarang', $namaBarang);
        $this->db->bind('keterangan', $keterangan);
        $this->db->bind('stok', $stok);
        $this->db->bind('idRak', $rak);
        $this->db->bind('gambar', $gambar);
        $this->db->bind('kolom', $kolom);
        $this->db->bind('id_barang', $id_barang);

        $this->db->execute();
        return $this->db->rowCount();
    }


    public function deleteDataBarang($id)
    {
        $query = "DELETE FROM " . $this->tabel . " WHERE id_barang = :id";

        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getValueIdData($id) {
        $this->db->query('SELECT * FROM ' . $this->tabel . " INNER JOIN rak ON " . $this->tabel .".id_rak = rak.id_rak WHERE " . $this->tabel . ".id_barang = :id");
        $this->db->bind('id', $id); 
        return $this->db->singel();
    }

    public function QueryJumlahKolom($IdBarang) {
        $this->db->query('SELECT * FROM ' . $this->tabel . " INNER JOIN rak ON " . $this->tabel .".id_rak = rak.id_rak WHERE " . $this->tabel . ".id_barang = :id");
        $this->db->bind('id', $idBarang); 
        return $this->db->singel();
    }

    public function queryCariData($keyword)
    {
        $this->db->query("SELECT * FROM " . $this->tabel . " INNER JOIN rak ON " . $this->tabel . ".id_rak = rak.id_rak" .
        " WHERE nama_barang LIKE :keyword OR 
                keterangan LIKE :keyword");
        $this->db->bind('keyword', "%$keyword%");
        $this->db->execute();
        return $this->db->resultSet();
    }

}

?>