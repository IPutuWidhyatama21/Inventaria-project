// Edit Data Script
var UpdateButton = document.querySelectorAll('#EditBtn');
var SelectEditRak = document.getElementById('EditRakID');
var SelectKolom = document.getElementById('jumlahKolom');
var IDBarang = document.getElementById('editIdBarang');

var Value = null;

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

                    var SelectedIDRak = SelectEditRak.value;

                    console.log("DATA ID INI ADALAH : " + SelectedIDRak);

                    fetch('http://localhost/inventaria-project/public/multipage/getValueRak/' + SelectedIDRak)
                        .then(response => response.json())
                        .then(dataValueRak => {
                
                        var DataKolom = dataValueRak.jumlah_kolom;
                
                        console.log("JUMLAH KOLOM :" + DataKolom);
                
                        SelectKolom.innerHTML = "";
                
                        for (let  i = 1; i <= DataKolom; i++) {
                
                            const OptionKolom = document.createElement('option');
                            OptionKolom.value = i;
                            OptionKolom.text = i;
                            SelectKolom.appendChild(OptionKolom);
                
                            // if ( i == DataQueryKolom ) {
                            //     OptionKolom.selected == true;
                            //     OptionKolom.value == i;
                            // }
                
                        }
                
                    })
        
                });

                // 
                SelectEditRak.addEventListener('click', function() {

                    var SelectedIDRak = SelectEditRak.value;
                    
                    fetch('http://localhost/inventaria-project/public/multipage/getValueRak/' + SelectedIDRak)
                        .then(response => response.json())
                        .then(dataValueRak => {
                
                        var DataKolom = dataValueRak.jumlah_kolom;
                
                        console.log("JUMLAH KOLOM :" + DataKolom);
                
                        SelectKolom.innerHTML = "";
                
                        for (let  i = 1; i <= DataKolom; i++) {
                
                            const OptionKolom = document.createElement('option');
                            OptionKolom.value = i;
                            OptionKolom.text = i;
                            SelectKolom.appendChild(OptionKolom);
                
                            // if ( i == DataQueryKolom ) {
                            //     OptionKolom.selected == true;
                            //     OptionKolom.value == i;
                            // }
                
                        }
                
                    })    
    
                });
                // 

            })

            .catch(error => {
                console.error(error);
                console.log('Error Pada Bagian Response: ', error.responseText);
            });
        
    });
    // End Fetch Data

   
});
// End Edit Data Script