<div class="row">
    <div class="col-lg-12">
        <div class="card card-statistics">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div class="card-heading">
                    <h4 class="card-title">User</h4>
                </div>
                <div class="float-right">
                    <!-- <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModalTambah">Tambah</button> -->
                </div>
            </div>
            <div class="card-body">
                <div class="datatable-wrapper table-responsive">
                    <table id="datatable" class="display compact table table-hover table-striped text-center">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>LPK/BLKLN</th>
                                <th>Tipe User</th>
                                <th>Status</th>
                                <!-- <th>Aksi</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            foreach ($lpkblkln as $row) { ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $row->username; ?></td>
                                    <td><?= $row->email; ?></td>
                                    <td><?= $row->nama; ?></td>
                                    <td><span class="badge badge-success"><?= $row->tipe; ?></span></td>
                                    <td>
                                        <?php if ($row->status == 'Aktif') { ?>
                                            <span class="badge badge-success"><?= $row->status; ?></span>
                                        <?php } elseif ($row->status == 'Pending') { ?>
                                            <span class="badge badge-warning">Menunggu Persetujuan</span>
                                        <?php } else { ?>
                                            <span class="badge badge-danger">Suspend</span>
                                        <?php } ?>
                                    </td>
                                    <!-- <td>
                                        <button class="btn btn-warning btn-sm" type="button" data-toggle="modal" data-target="#myModalEdit">Edit</button>
                                        <button class="btn btn-danger btn-sm" type="button" onclick="hapus()">Delete</button>
                                    </td> -->
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <!-- The Modal -->
                    <div class="modal" id="myModalEdit">
                      <div class="modal-dialog">
                        <div class="modal-content">

                          <!-- Modal Header -->
                          <div class="modal-header">
                            <h4 class="modal-title">Modal Edit</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="" class="form-control" placeholder="Username" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="" class="form-control" placeholder="Email" autocomplete="off">
                            </div>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success">Simpan</button>
                        </div>

                    </div>
                </div>
            </div>

            <!-- The Modal -->
                    <div class="modal" id="myModalTambah">
                      <div class="modal-dialog">
                        <div class="modal-content">

                          <!-- Modal Header -->
                          <div class="modal-header">
                            <h4 class="modal-title">Modal Tambah LPK / BLKNL</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="" class="form-control" placeholder="Username" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="" class="form-control" placeholder="Email" autocomplete="off">
                            </div>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success">Simpan</button>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
</div>