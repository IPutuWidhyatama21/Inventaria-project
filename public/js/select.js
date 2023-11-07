function getSelectedValue() {
    var selectedValue = document.getElementById("inputRakbarang").value;

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax_handler.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log("_______BEGIN______", xhr.responseText, "________END_______");
                var response = JSON.parse(xhr.responseText);
                var htmlOutput = generateHTMLOutput(response.result);
                console.log(htmlOutput); // Menampilkan hasil di konsol
            } else {
                console.error("Terjadi kesalahan: " + xhr.status);
            }
        }
    };

    // Ubah format data yang dikirimkan ke server ke dalam format x-www-form-urlencoded
    var formData = new FormData();
    formData.append("selectedValue", selectedValue);

    // Kirim data ke server
    xhr.send(formData);
}

function generateHTMLOutput(result) {
    var htmlOutput = "<div>" + result + "</div>"; // Contoh sederhana

    return htmlOutput;
}

getSelectedValue();
