<?php

Class ValueHandler extends Controller {
    
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