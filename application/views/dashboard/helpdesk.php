<div class="row">
    <?= $this->session->flashdata('notif');?>
    <div class="col-lg-12">
        <div class="card card-statistics crypto-currency">
            <div class="card-header d-flex justify-content-between">
                <div class="card-heading">
                    <h4 class="card-title">Data Pengaduan</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="datatable-wrapper table-responsive">
                    <table id="datatable" class="table table-borderless w-100">
                        <thead class="bg-light">
                            <tr>
                                <th width="2%">No.</th>
                                <th>Nik</th>
                                <th>Tanggal</th>
                                <th>Jenis Helpdesk</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Pesan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            foreach ($helpdesk as $row) { ?>
                                <tr>
                                    <td><?= $no++; ?>.</td>
                                    <td>
                                        <?php if ($row->nik != NULL) { ?>
                                            <?= $row->nik; ?>
                                        <?php } else { ?>
                                            -
                                        <?php } ?>
                                    </td>
                                    <td><?= tanggal_indo($row->tanggal, true); ?></td>
                                    <td><span class="badge badge-success"><?= $row->tipe; ?></span></td>
                                    <td><?= $row->nama; ?></td>
                                    <td><?= $row->email; ?></td>
                                    <td><?= $row->pesan; ?></td>
                                    <td><button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModalEdit<?= $row->id; ?>">Edit</button></td>
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
foreach ($helpdesk as $row) { ?>
    <!-- The Modal -->
    <div class="modal" id="myModalEdit<?= $row->id; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Detail Helpdesk</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="POST" action="<?= base_url('Dashboard/ubahStatusHelpdesk'); ?>" class="text-center justify-content-center">
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                    <input type="hidden" name="id" value="<?= $row->id; ?>">
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="status">
                                <option value="Sudah" <?php if ($row->status_h == 'Sudah') { echo 'selected'; } ?>>Sudah</option>
                                <option value="Belum" <?php if ($row->status_h == 'Belum') { echo 'selected'; } ?>>Belum</option>
                            </select>
                        </div>                  
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php } ?>