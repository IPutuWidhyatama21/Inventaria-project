        <div class="col-10 container-editbrg">

                <!-- Navbar Design -->
                <div class="navbar-design shadow">
                    <div class="manage d-flex">
                        <i class="fa-solid fa-box"></i>
                        <h3 class="manage-text align-self-center">Kelola Barang</h3>
                    </div>
                </div>
                <!-- End Navbar Design -->

                <!-- Users Card Design -->
                <div class="container-brg container-sm shadow-lg">
                    <div class="row">
                        <div class="col-md-5">
                            <img class="img-brg rounded" src="<?= BASEURL ?>/img/ice-tea-with-mint 1.jpg" alt="">
                            <div class="file-form mb-3">
                                <label for="choose" class="btn btn-warning">
                                    <i class="fa-solid fa-camera"></i>
                                </label>
                                <input class="form-control form-control-sm" id="choose" type="file" name="gambarBarang">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <form action="" method="post">
                                    <div class="container-sm form-edit">
                                        <div class="mb-3">
                                            <input type="hidden" name="id_barang" value="<?= $data['databarang']['id_barang']; ?>">
                                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nama Barang" name="namaBarang" value="<?= $data['databarang']['nama_barang'] ?>">
                                        </div>
                                    </div>
                                    <div class="container-sm form-edit2">
                                        <select class="form-select mb-3" aria-label="Default select example" name="idRak">

                                            <option value="<?= $data['databarang']['id_rak'] ?>"><?= $data['databarang']['nama_rak'] ?></option>

                                            <?php foreach ( $data['rakData'] as $rowRak) : ?>
                                                <option value="<?= $rowRak['id_rak'] ?>"><?= $rowRak['nama_rak'] ?></option>
                                            <?php endforeach; ?>

                                        </select>
                                    </div>
                                    <div class="container-sm form-edit2">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Keterangan" name="keterangan" value="<?= $data['databarang']['keterangan'] ?>">
                                        </div>
                                    </div>
                                    <div class="container-sm form-edit2">
                                        <select class="form-select mb-3" aria-label="Default select example" name="jumlahKolom">

                                        <?php foreach ( $data['databarang'] as $rowKolom ) : ?>
                                            <?= $i = 1; $i++; $i <= $data['databarang']['jumlah_kolom'] ?>
                                            <option><?= $i ?></option>
                                        <?php endforeach; ?>

                                        </select>
                                    </div>
                                    <div class="container-sm form-edit2">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Stock" name="stok" value="<?= $data['databarang']['stok'] ?>">
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
                <!-- End Users Card Design -->
            </div>
        </div>
    </div>      