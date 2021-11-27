<div class="row">
    <?= $this->session->flashdata('notif');?>
    <div class="col-lg-12">
        <div class="card card-statistics">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div class="card-heading">
                    <h4 class="card-title">Jenis Pelatihan</h4>
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
                                <th>Jenis Pelatihan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1; 
                            foreach ($jenis as $row) { ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $row->jenis; ?></td>
                                    <td>
                                        <button class="btn btn-warning btn-sm" type="button" data-toggle="modal" data-target="#myModalEdit<?= $row->kode_jenis; ?>">Edit</button>
                                        <button class="btn btn-danger btn-sm" type="button" onclick="hapusjenispelatihan('<?= $row->kode_jenis; ?>')">Delete</button>
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
foreach ($jenis as $row) { ?>
    <!-- The Modal -->

    <div class="modal" id="myModalEdit<?= $row->kode_jenis; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Edit Jenis Pelatihan</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="<?= base_url('Dashboard/ubahJenis');?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group">
                        <label>Judul</label>
                        <input type="hidden" name="id" value="<?= $row->kode_jenis; ?>">
                        <input type="text" name="jenis" class="form-control" value="<?= $row->jenis; ?>" autocomplete="off">
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
                <h4 class="modal-title">Tambah Jenis Pelatihan</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="<?= base_url('Dashboard/tambahJenisPelatihan');?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group">
                        <label>Jenis Pelatihan</label>
                        <input type="text" name="jenis" class="form-control" placeholder="Judul" required="" autocomplete="off">
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