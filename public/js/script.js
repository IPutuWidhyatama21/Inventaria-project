// Deklarasi Variable & Const

// Deklarasi Variable & Const Edit Barang
var UpdateButton = document.querySelectorAll('#EditBtn');
var SelectEditRak = document.getElementById('EditRakID');
var SelectKolom = document.getElementById('jumlahKolom');
var IDBarang = document.getElementById('editIdBarang');
// End Deklarasi Variable & Const Edit Barang

// Deklarasi Variable & Const Tambah Barang
var SelectTambahRak = document.getElementById('inputRakbarang');
var SelectTambahKolom = document.getElementById('inputKolombarang');
// End Deklarasi Variable & Const Tambah Barang

// Deklarasi URL Gambar
var ImageInput = document.getElementById('EditChoose');
var PreviewImage = document.getElementById('PreviewImg');

// Change Image Script
if (ImageInput != null) {

    ImageInput.addEventListener('change', () => {

        const file = ImageInput.files[0];
        const Reader = new FileReader();

        PreviewImage.innerHTML = "";

        Reader.addEventListener('load', () => {

            const image = document.createElement('img');
            image.src = Reader.result;
            image.classList.add('img-brg');
            PreviewImage.appendChild(image);

        })

    Reader.readAsDataURL(file);

    })

}
// End Change Image Script

// Edit Data Script
UpdateButton.forEach(update => {

    // Fetch Data (Pengambilan Data Function)
    update.addEventListener('click', function() {
        var IdValue = this.dataset.nilai;
        
        console.log(IdValue);

        var URLGambar = 'http://localhost/inventaria-project/public/img/image_upload/';


            fetch('http://localhost/inventaria-project/public/multipage/getValueId/' + IdValue)
            .then(response => response.json())
            .then(data => {
                console.log(data);
                document.getElementById('editIdBarang').value = data.id_barang;
                document.getElementById('nama_brg').value = data.nama_barang;
                document.getElementById('gambar').src = URLGambar + data.gambar;
                document.getElementById('keterangan').value = data.keterangan;
                document.getElementById('stok').value = data.stok;
                var DataGambar = data.gambar;
                var Kolom = data.kolom;

                // // Buat array byte yang dapat diubah menjadi Blob
                // var byteCharacters = atob(DataGambar); // atob digunakan untuk mendecode base64
                // var byteNumbers = new Array(byteCharacters.length);
                // for (var i = 0; i < byteCharacters.length; i++) {
                // byteNumbers[i] = byteCharacters.charCodeAt(i);
                // }
                // var byteArray = new Uint8Array(byteNumbers);

                // // Buat objek Blob dari array byte
                // var blob = new Blob([byteArray], { type: 'image/jpeg' }); // Gantilah 'image/jpeg' sesuai dengan tipe file yang sesuai

                // // Buat objek File dari objek Blob dan nama file
                // var file = new File([blob], namaFile, { type: 'image/jpeg' }); // Gantilah 'image/jpeg' sesuai dengan tipe file yang sesuai

                // // Sekarang 'file' adalah objek File yang dapat Anda gunakan
                // console.log("Nama File" + file);

                fetch('http://localhost/inventaria-project/public/multipage/QueryRak/')
                .then(response => response.json())
                .then(dataRak => {
        

                    console.log(dataRak);

                    SelectEditRak.innerHTML = "";
                    

                    dataRak.forEach(element => {

                        var optionNamaRak = document.createElement('option');
                        optionNamaRak.value = element.id_rak;
                        optionNamaRak.text = element.nama_rak;
                        SelectEditRak.appendChild(optionNamaRak);

                        if( element.id_rak == data.id_rak ){
                            optionNamaRak.selected = true;

                            Value = optionNamaRak.selected;
                        }

                    });

                    // Deklarasi Value ID Rak
                    var SelectedIDRak = SelectEditRak.value;
                    // End Deklarasi

                    // Console Log
                    console.log("Data Selected Id = " + SelectedIDRak);

                    fetch('http://localhost/inventaria-project/public/multipage/getValueRak/' + SelectedIDRak)
                        .then(response => response.json())
                        .then(dataValueRak => {
                
                        var DataKolom = dataValueRak.jumlah_kolom;
                
                        console.log("Total Kolom : " + DataKolom);
                
                        SelectKolom.innerHTML = "";
                
                        for (let  i = 1; i <= DataKolom; i++) {
                
                            const OptionKolom = document.createElement('option');
                            OptionKolom.value = i;
                            OptionKolom.text = i;
                            SelectKolom.appendChild(OptionKolom);

                            
                            if ( i == Kolom ) {
                                i = Kolom;
                                OptionKolom.value = i;
                                OptionKolom.selected = true;
    
                                console.log("Kolom Selected Hehe:D : " +  i);
                            }

                        }
                        
                    })
        
                });

                // Function Click Rak
                SelectEditRak.addEventListener('click', function() {

                    var SelectedIDRak = SelectEditRak.value;

                    console.log("SELECT RAK : " + SelectedIDRak);
                    
                    fetch('http://localhost/inventaria-project/public/multipage/getValueRak/' + SelectedIDRak)
                        .then(response => response.json())
                        .then(dataValueRak => {
                
                        var DataKolom = dataValueRak.jumlah_kolom;
                
                        console.log("Total Kolom : " + DataKolom);
                
                        SelectKolom.innerHTML = "";
                
                        for (let  i = 1; i <= DataKolom; i++) {
                
                            const OptionKolom = document.createElement('option');
                            OptionKolom.value = i;
                            OptionKolom.text = i;
                            SelectKolom.appendChild(OptionKolom);


                        }
                
                    })
    
                });
                // End Function Click Rak

            })

        .catch(error => {
            console.error(error);
            console.log('Error Pada Bagian Response: ', error.responseText);
        });
        
    });
     // End Fetch Data

   
});
// End Edit Data Script



// Select Bertingkat Tambah Rak Script
fetch('http://localhost/inventaria-project/public/multipage/QueryRak/')
    .then(response => response.json())
    .then(dataRak => {


        console.log(dataRak);

        SelectTambahRak.innerHTML = "";
            

        dataRak.forEach(element => {

            var optionNamaRak = document.createElement('option');
            optionNamaRak.value = element.id_rak;
            optionNamaRak.text = element.nama_rak;
            SelectTambahRak.appendChild(optionNamaRak);

        });

        // Deklarasi Value ID Rak
        var SelectedIDRak = SelectTambahRak.value;
        // End Deklarasi

        // Console Log
        console.log("Data Selected Id = " + SelectedIDRak);

        fetch('http://localhost/inventaria-project/public/multipage/getValueRak/' + SelectedIDRak)
            .then(response => response.json())
            .then(dataValueRak => {
        
            var DataKolom = dataValueRak.jumlah_kolom;
        
            console.log("Total Kolom : " + DataKolom);
        
            SelectTambahKolom.innerHTML = "";
        
            for (let  i = 1; i <= DataKolom; i++) {
        
                const OptionKolom = document.createElement('option');
                OptionKolom.value = i;
                OptionKolom.text = i;
                SelectTambahKolom.appendChild(OptionKolom);

            }
                
        })

    });

    // Function Click Rak
    SelectTambahRak.addEventListener('click', function() {

        var SelectedIDRak = SelectTambahRak.value;

        console.log("SELECT RAK : " + SelectedIDRak);
            
        fetch('http://localhost/inventaria-project/public/multipage/getValueRak/' + SelectedIDRak)
            .then(response => response.json())
            .then(dataValueRak => {
        
            var DataKolom = dataValueRak.jumlah_kolom;
        
            console.log("Total Kolom : " + DataKolom);
        
            SelectTambahKolom.innerHTML = "";
        
            for (let  i = 1; i <= DataKolom; i++) {
        
                const OptionKolom = document.createElement('option');
                OptionKolom.value = i;
                OptionKolom.text = i;
                SelectTambahKolom.appendChild(OptionKolom);


            }
        
        })

    });
// End Function Click Rak

// End Select Bertingkat Tambah Rak Script