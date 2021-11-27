<div class="row">
    <?= $this->session->flashdata('notif');?>
    <div class="col-lg-12">
        <div class="card card-statistics">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div class="card-heading">
                    <h4 class="card-title">Youtube</h4>
                </div>
                <div class="float-right">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModalTambah">Tambah</button>
                </div>
            </div>
            <div class="card-body">
                <div class="datatable-wrapper table-responsive">
                    <table id="datatable" class="display compact table table-hover table-striped text-center">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Judul</th>
                                <th>Link Youtube</th>
                                <th>Link Google</th>
                                <th>Bannner</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1; 
                            foreach ($slider as $row) { ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= tanggal_indo($row->tanggal, true); ?></td>
                                    <td><?= $row->judul;?></td>
                                    <td><?= $row->linkyt; ?></td>
                                    <td><?= $row->linkgoogle; ?></td>
                                    <td><img src="<?= base_url(); ?>assets/upload/youtube/<?= $row->photo; ?>" class="col-lg-6 img-fluid"></td>
                                    <td>
                                        <button class="btn btn-warning btn-sm" type="button" data-toggle="modal" data-target="#myModalEdit<?= $row->id; ?>">Edit</button>
                                        <button class="btn btn-danger btn-sm" type="button" onclick="hapus('<?= $row->id; ?>')">Delete</button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$no = 1; 
foreach ($slider as $row) { ?>
    <!-- The Modal -->

    <div class="modal" id="myModalEdit<?= $row->id; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Edit Link Youtube</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="<?= base_url('Dashboard/editYoutube');?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                <!-- Modal body -->
                <div class="modal-body">
                     <center><img src="<?= base_url(); ?>assets/upload/youtube/<?= $row->photo; ?>" class="col-lg-6 img-fluid" style="padding:20px"></center>
                    <div class="form-group">
                        <label>Judul</label>
                        <input type="hidden" name="id" value="<?= $row->id; ?>">
                        <input type="text" name="judul" class="form-control" autocomplete="off" value="<?= $row->judul; ?>" >
                    </div>
                    <div class="form-group">
                        <label>Link Youtube</label>
                        <input type="text" name="linkyt" class="form-control" autocomplete="off" value="<?= $row->linkyt; ?>" >
                    </div>
                    <div class="form-group">
                        <label>Link Google</label>
                        <input type="text" name="linkgoogle" class="form-control" autocomplete="off" value="<?= $row->linkgoogle; ?>" >
                    </div>
                    <div class="form-group">
                        <label>Foto</label>
                        <input type="file" name="foto" class="form-control foto" autocomplete="off" required="">
                        <p>Gambar JPG/PNG Max. 2Mb</p>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php } ?>

<!-- The Modal -->
<div class="modal" id="myModalTambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Link Youtube</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="<?= base_url('Dashboard/tambahYoutube');?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                <!-- Modal body -->
                <div class="modal-body">
                <div class="form-group">
                        <label>Judul</label>
                        <input type="text" name="judul" class="form-control" placeholder="Judul" autocomplete="off" required="">
                    </div>
                    <div class="form-group">
                        <label>Link Youtube</label>
                        <input type="text" name="linkyt" class="form-control" placeholder="Link Youtube" autocomplete="off" required="">
                    </div>
                    <div class="form-group">
                        <label>Link Google</label>
                        <input type="text" name="linkgoogle" class="form-control" placeholder="Link Google" autocomplete="off" required="">
                    </div>
                    <div class="form-group">
                        <label>Banner</label>
                        <input type="file" name="foto" class="form-control foto" autocomplete="off" required="">
                        <p>Gambar JPG/PNG Max. 2Mb</p>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
$(".foto").change(function() {
    if (this.files && this.files[0] && this.files[0].name.match(/\.(jpg|png|jpeg|PNG|JPG|JPEG)$/) ) {
        if(this.files[0].size>2097152) {
            $('.foto').val('');
            alert('Batas Maximal Ukuran File 2MB !');
        }
        else {
            var reader = new FileReader();
            reader.readAsDataURL(this.files[0]);
        }
    } else{
        $('.foto').val('');
        alert('Hanya File jpg/png Yang Diizinkan !');
    }
});
</script>