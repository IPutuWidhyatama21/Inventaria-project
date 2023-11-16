<div class="col-10">

                    <!-- Navbar Design -->
                    <div class="navbar-design shadow">
                        <div class="d-flex justify-content-between">
                            <div class="col-6">
                                <div class="input-group search-layout">
                                    <input type="text" class="form-control" placeholder="Search..." aria-label="Recipient's username" aria-describedby="button-addon2">
                                    <button class="btn btn-warning" type="button" id="button-addon2">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex justify-content-end profile-layout">
                                    <p>Admin</p>
                                    <i class="fa-solid fa-circle-user"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Navbar Design -->


                    <!-- Item Card Design -->
                    <div class="item-barang ">

                        <div class="row row-cols-1 row-cols-md-3 g-4">
                            <?php foreach ( $data['barang'] as $rowBarang ) : ?>
                                <div class="col p-4">
                                    <div class="card h-100 ">
                                        <img src="<?= BASEURL ?>/img/image_upload/<?= $rowBarang['gambar'] ?>" class="rounded" alt="Item">
                                        <div class="card-body rounded">
                                        <h5 class="card-title text-center mb-2"><?= $rowBarang['nama_barang'] ?> </h5>
                                        <p class="card-text">Rak : <?= $rowBarang['nama_rak'] ?> </p>
                                        <p class="card-text">Keterangan : <?= $rowBarang['keterangan'] ?> </p>
                                        <p class="card-text">Kolom : <?= $rowBarang['kolom'] ?> </p>
                                        <p class="card-text">Stok : <?= $rowBarang['stok'] ?> </p>    
                                        </div>
        
                                        <div class="card-footer">
                                            <div class="float-start">
                                                <div class="tombol">
                                                    <a href="<?= BASEURL ?>/multipage/editbarang/<?= $rowBarang['id_barang'] ?>" class="btn btn-warning justify-content-center edit-btn" data-bs-toggle="modal" data-bs-target="#exampleModal" id="EditBtn" data-nilai="<?= $rowBarang['id_barang'] ?>"><i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i></a>
                                                    <a href="<?= BASEURL ?>/multipage/deleteBarang/<?= $rowBarang['id_barang'] ?>"  onclick="return confirm('Yakin Barang Ingin Dihapus?')" class="btn btn-danger"><i class="fa-solid fa-trash-can" style="color: #ffffff;"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            
                        </div>
                    </div>
                    <!-- End Item Card Design -->


                        <!-- pagination start-->
                        <div class="pagination d-flex justify-content-center">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                <?php if ( $data['halaman_aktif'] > 1) : ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?= BASEURL ?>/multipage/admin/<?= $data['halaman_aktif'] - 1 ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <?php endif; ?>

                                <?php for ( $i = 1; $i <= $data['jumlah_halaman'] ; $i++ ) : ?>
                                <?php if( $i == $data['halaman_aktif'] ) : ?>
                                    <li class="page-item"><a class="page-link active" href="<?= BASEURL ?>/multipage/admin/<?= $i ?>"><?= $i ?></a></li>
                                <?php else : ?>
                                    <li class="page-item"><a class="page-link" href="<?= BASEURL ?>/multipage/admin/<?= $i ?>"><?= $i ?></a></li>
                                <?php endif; ?>
                                <?php endfor; ?>

                                <?php if( $data['halaman_aktif'] < $data['jumlah_halaman']) : ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?= BASEURL ?>/multipage/admin/<?= $data['halaman_aktif'] + 1 ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                                <?php endif; ?>
                                </ul>
                            </nav>
                        </div>
                        <!-- Pagination End -->

                    <!-- Button trigger modal -->
                    <div class="d-flex justify-content-end btn-add fixed-bottom ">
                        <button type="button" class="btn btn-add btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </div>
                    
                    
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">ADD</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="accordion" id="accordionExample">
                                        <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Rak
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <form class="accordion-body form-control" action="<?=BASEURL?>/multipage/tambahRak" method="POST">
                                                <div class="mb-3 row">
                                                    <label for="inputRak" class="col-sm-4 col-form-label">Nama Rak :</label>
                                                    <div class="col-sm-7">
                                                    <input type="text" name="namarak" class="form-control" id="inputRak">
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label for="inputJmlKolom" class="col-sm-4 col-form-label">Jumlah kolom :</label>
                                                    <div class="col-sm-7">
                                                    <input type="text" name="jumlahkolom"class="form-control" id="inputJmlKolom">
                                                    </div>
                                                </div>
                                                <div class="mb-3 row col-md-3 save-button">
                                                    <button type="submit" class="btn btn-warning">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                        </div>
                                        <br>
                                        <form action="<?= BASEURL ?>/multipage/tambahBarang" method="post" enctype="multipart/form-data">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingTwo">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                                Barang
                                            </button>
                                            </h2>
                                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="mb-3 row">
                                                    <label for="inputBrg" class="col-sm-4 col-form-label">Nama Barang :</label>
                                                    <div class="col-sm-7">
                                                        <input type="text" class="form-control" id="inputBrg" name="namaBarang">
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label for="inputKet" class="col-sm-4 col-form-label">Keterangan :</label>
                                                    <div class="col-sm-7">
                                                        <input type="text" class="form-control" id="inputKet" name="keterangan">
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label for="inputRak" class="col-sm-4 col-form-label">Rak :</label>
                                                    <div class="col-sm-7">
                                                        <select name="idRak" class="form-select" aria-label="Default select example" id="inputRakbarang">
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label for="inputKolom" class="col-sm-4 col-form-label">Kolom :</label>
                                                    <div class="col-sm-7">
                                                        <select class="form-select" aria-label="Default select example" id="inputKolombarang" name="jumlahKolom">
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label for="inputStok" class="col-sm-4 col-form-label">Stock :</label>
                                                    <div class="col-sm-7">
                                                        <input type="text" class="form-control" id="inputStok" name="stok">
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label for="inputGambar" class="col-sm-4 col-form-label">Gambar :</label>
                                                    <div class="col-sm-7">
                                                    <input class="form-control" type="file" id="inputGambar" name="gambarBarang">
                                                    </div>
                                                </div>
                                                <div class="mb-3 row col-md-3 save-button">
                                                    <button type="submit" class="btn btn-warning">Save</button>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
            

                    <!-- Modal Edit -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Barang</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                   

                                    <div class="row">
                                            <div class="col-md-6">
                                                <div class="container-img">
                                                    <div id="PreviewImg">
                                                        <img class="img-brg" src="" alt="" id="gambar">
                                                    </div>
                                                    <div class="file-form mb-3">
                                                        <label for="EditChoose" class="btn btn-warning">
                                                            <i class="fa-solid fa-camera"></i>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <form action="<?=BASEURL?>/multipage/editbarang" method="post" enctype="multipart/form-data" class="form-edit">
                                                        <input class="form-control form-control-sm" id="EditChoose" type="file" name="gambarBarang">
                                                        <div class="container-sm form-edit">
                                                            <div class="mb-3">
                                                                <input type="hidden" name="id_barang" value="" id="editIdBarang">
                                                                <input type="text" class="form-control namabrg" id="nama_brg" placeholder="Nama Barang" name="namaBarang" value="">
                                                            </div>
                                                        </div>
                                                        <div class="container-sm form-edit2">
                                                            <select class="form-select mb-3" aria-label="Default select example" id="EditRakID" name="idRak">
                                                            </select>
                                                        </div>
                                                        <div class="container-sm form-edit2">
                                                            <div class="mb-3">
                                                                <input type="text" class="form-control" id="keterangan" placeholder="Keterangan" name="keterangan" value="">
                                                            </div>
                                                        </div>
                                                        <div class="container-sm form-edit2">
                                                            <select class="form-select mb-3" id="jumlahKolom" aria-label="Default select example" name="jumlahKolom">
                                                            </select>
                                                        </div>
                                                        <div class="container-sm form-edit2">
                                                            <div class="mb-3">
                                                                <input type="text" class="form-control" id="stok" placeholder="Stock" name="stok" value="">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="mb-3 col-md-3 save-buttonedit">
                                                                <button type="submit" class="btn btn-warning">Save</button>
                                                            </div>
                                                            <div class="mb-3 col-md-3 cancel-buttonedit">
                                                                <button type="button" class="btn btn-danger">Cancel</button>
                                                            </div>
                                                        </div>
                                                        </form>
                                                    </div>
                                        </div>
                               

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal Edit -->
        </div>
    </div>
</div>
