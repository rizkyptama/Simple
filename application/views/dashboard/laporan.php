<div class="row">
    <div class="col-lg-12">
        <div class="card card-statistics">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div class="card-heading">
                    <h4 class="card-title">Laporan</h4>
                </div>
                <div class="float-right">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModalCetak">Cetak Laporan</button>
                </div>
            </div>
            <div class="card-body">
                <div class="datatable-wrapper table-responsive">
                    <table id="datatable" class="display compact table table-hover table-striped text-center">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Inisiator</th>
                                <th>Pelatihan</th>
                                <th>Jenis Pelatihan</th>
                                <th>Kuota</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>System Architect</td>
                                <td>example@gmail.com</td>
                                <td><span class="badge badge-success">LPK</span></td>
                                <td><span class="badge badge-success">123</span></td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>System Architect</td>
                                <td>example@gmail.com</td>
                                <td><span class="badge badge-success">LPK</span></td>
                                <td><span class="badge badge-success">123</span></td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>System Architect</td>
                                <td>example@gmail.com</td>
                                <td><span class="badge badge-success">LPK</span></td>
                                <td><span class="badge badge-success">123</span></td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>System Architect</td>
                                <td>example@gmail.com</td>
                                <td><span class="badge badge-success">LPK</span></td>
                                <td><span class="badge badge-success">123</span></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="modal" id="myModalCetak">
                      <div class="modal-dialog">
                        <div class="modal-content">

                          <!-- Modal Header -->
                          <div class="modal-header">
                            <h4 class="modal-title">Modal Cetak Laporan</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Kategori</label>
                                <select class="form-control">
                                    <option>Infromasi</option>
                                    <option>Pelatihan / Kegiatan</option>
                                    <option>LPK / BLKLN</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Tanggal Awal</label>
                                        <input type="date" class="form-control" name="" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Tanggal Akhir</label>
                                        <input type="date" class="form-control" name="" autocomplete="off">
                                    </div>
                                </div>
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