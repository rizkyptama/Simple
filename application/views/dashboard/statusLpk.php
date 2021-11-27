<style type="text/css">
    fieldset {
        border: 1px solid #ddd !important;
        margin: 0;
        xmin-width: 0;
        padding: 10px;       
        position: relative;
        border-radius:4px;
        background-color:#f5f5f5;
        padding-left:10px!important;
    }   
    
    legend {
        font-size:14px;
        font-weight:bold;
        margin-bottom: 0px; 
        width: 20%; 
        border: 1px solid #ddd;
        border-radius: 4px; 
        padding: 5px 5px 5px 10px; 
        background-color: #ffffff;
    }
</style>
<?= $this->session->flashdata('notif');?>
<div class="row">
    <div class="col-lg-12">
        <div class="card card-statistics">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div class="card-heading">
                    <h4 class="card-title">Laporan</h4>
                </div>
                <div class="float-right">
                    <!-- <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModalCetak">Update Laporan</button> -->
                </div>
            </div>
            <div class="card-body">
                <div class="datatable-wrapper table-responsive">
                    <table id="datatableStatus" class="display compact table table-hover table-striped text-center">
                        <thead>
                            <tr>
                                <th width="2%">No.</th>
                                <th>Nama Lembaga</th>
                                <th>Tahun Lapor</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            foreach ($laporan as $row) { 
                                $tahun = explode('-', $row->tanggal_lapor);
                                ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $row->nama; ?></td>
                                    <td><?= $tahun[0]; ?></td>
                                    <td><?= $row->status; ?></td>
                                    <td>
                                        <button class="btn btn-info btn-sm" type="button" data-toggle="modal" data-target="#myModalLihat<?= $row->kode_lapor; ?>">Detail</button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <thead>
                            <th width="2%"></th>
                            <th></th>
                            <th>Tahun Lapor</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- The Modal -->
<div class="modal" id="myModalCetak">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Update Laporan LPK / BLKLN</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <form action="<?= base_url('DashboardLPK/updateLaporan'); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <fieldset class="col-md-12 mt-10">
                        <legend>Data LPK/BLKLN</legend>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="control-label">Nama LPK/BLKLN <span style="color:red" title="Wajib Diisi">*</span></label>
                                <input type="text" name="nama" class="form-control" placeholder="Nama LPK/BLKLN" autocomplete="off" required="" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="control-label">Alamat <span style="color:red" title="Wajib Diisi">*</span></label>
                                <textarea class="form-control" name="alamat" autocomplete="off"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="control-label">No. Telepon <span style="color:red" title="Wajib Diisi">*</span></label>
                                <input type="text" name="no_telepon" class="form-control" placeholder="No. Telepon" autocomplete="off" required="" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="control-label">Email <span style="color:red" title="Wajib Diisi">*</span></label>
                                <input type="email" name="email" class="form-control" placeholder="Email" autocomplete="off" required="" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="control-label">No. Izin <span style="color:red" title="Wajib Diisi">*</span></label>
                                <input type="text" name="no_izin" class="form-control" placeholder="No. Izin" autocomplete="off" required="" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="control-label">Tanggal Izin <span style="color:red" title="Wajib Diisi">*</span></label>
                                <input type="date" name="tanggal_izin" class="form-control" autocomplete="off" required="" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="control-label">Jenis <span style="color:red" title="Wajib Diisi">*</span></label><br>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline3" name="jenis" class="custom-control-input" autocomplete="off" value="Pemerintah" required>
                                    <label class="custom-control-label" for="customRadioInline3">Pemerintah</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline4" name="jenis" class="custom-control-input" autocomplete="off" value="Swasta" required>
                                    <label class="custom-control-label" for="customRadioInline4">Swasta</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline5" name="jenis" class="custom-control-input" autocomplete="off" value="Perusahaan" required>
                                    <label class="custom-control-label" for="customRadioInline5">Perusahaan</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="control-label">Status Akreditas <span style="color:red" title="Wajib Diisi">*</span></label>
                                <input type="text" name="status_akreditas" class="form-control" autocomplete="off" required="" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="control-label">No. Akreditas <span style="color:red" title="Wajib Diisi">*</span></label>
                                <input type="text" name="no_akreditas" class="form-control" autocomplete="off" required="" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="control-label">Ruang Lingkup <span style="color:red" title="Wajib Diisi">*</span></label>
                                <input type="text" name="ruang_lingkup" class="form-control" autocomplete="off" required="" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="control-label">Program Yang Ditawarkan <span style="color:red" title="Wajib Diisi">*</span></label>
                                <input type="text" name="program" class="form-control" autocomplete="off" required="" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Foto Kegiatan</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile" name="kegiatan" autocomplete="off">
                                    <label class="custom-file-label" for="customFile">Pilih File</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Daftar Absensi Pelatihan</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile" name="absensi" autocomplete="off">
                                    <label class="custom-file-label" for="customFile">Pilih File</label>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="col-md-12 mt-10">
                        <legend>Data Pimpinan</legend>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="control-label">Nama Pimpinan <span style="color:red" title="Wajib Diisi">*</span></label>
                                <input type="text" name="nama_pimpinan" class="form-control" placeholder="Nama Pimpinan" autocomplete="off" required="" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="control-label">No. Telepon Pimpinan <span style="color:red" title="Wajib Diisi">*</span></label>
                                <input type="text" name="no_telepon_pimpinan" class="form-control" placeholder="(+62) ..." autocomplete="off" required="" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="control-label">Nama Penanggung Jawab <span style="color:red" title="Wajib Diisi">*</span></label>
                                <input type="text" name="nama_pj" class="form-control" placeholder="Nama Pimpinan" autocomplete="off" required="" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="control-label">Jabatan Penanggung Jawab <span style="color:red" title="Wajib Diisi">*</span></label>
                                <input type="text" name="jabatan_pj" class="form-control" placeholder="Nama Pimpinan" autocomplete="off" required="" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="control-label">No. Telepon Penanggung Jawab <span style="color:red" title="Wajib Diisi">*</span></label>
                                <input type="text" name="no_telepon_pj" class="form-control" placeholder="(+62) ..." autocomplete="off" required="" />
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="col-md-12 mt-10">
                        <legend>Data Pengurus</legend>
                        <table class="table table-striped">
                            <center>
                                <tr>
                                    <!-- <th scope="col" rowspan="2">No.</th> -->
                                    <th scope="col" rowspan="2" class="align-middle">Tipe</th>
                                    <th scope="col" colspan="2">Jenis Kelamin</th>
                                </tr>
                                <tr>
                                    <th scope="col">Laki-laki</th>
                                    <th scope="col">Perempuan</th>
                                </tr>
                                <tr>
                                    <td>Karyawan</td>
                                    <td><input type="number" name="karyawan_laki" class="form-control" value="0" required="" autocomplete="off" /></td>
                                    <td><input type="number" name="karyawan_perempuan" class="form-control" value="0" required="" autocomplete="off" /></td>
                                </tr>
                                <tr>
                                    <td>Tenaga Pelatihan Tetap</td>
                                    <td><input type="number" name="tpt_laki" class="form-control" value="0" required="" autocomplete="off" /></td>
                                    <td><input type="number" name="tpt_perempuan" class="form-control" value="0" required="" autocomplete="off" /></td>
                                </tr>
                                <tr>
                                    <td>Tenaga Pelatihan Tidak Tetap</td>
                                    <td><input type="number" name="tptt_laki" class="form-control" value="0" required="" autocomplete="off" /></td>
                                    <td><input type="number" name="tptt_perempuan" class="form-control" value="0" required="" autocomplete="off" /></td>
                                </tr>
                                <tr>
                                    <td>Instruktur Tetap</td>
                                    <td><input type="number" name="it_laki" class="form-control" value="0" required="" autocomplete="off" /></td>
                                    <td><input type="number" name="it_perempuan" class="form-control" value="0" required="" autocomplete="off" /></td>
                                </tr>
                                <tr>
                                    <td>Instruktur Tidak Tetap</td>
                                    <td><input type="number" name="itt_laki" class="form-control" value="0" required="" autocomplete="off" /></td>
                                    <td><input type="number" name="itt_perempuan" class="form-control" value="0" required="" autocomplete="off" /></td>
                                </tr>
                                <tr>
                                    <td>Asesor Kompetensi</td>
                                    <td><input type="number" name="ak_laki" class="form-control" value="0" required="" autocomplete="off" /></td>
                                    <td><input type="number" name="ak_perempuan" class="form-control" value="0" required="" autocomplete="off" /></td>
                                </tr>
                                <tr>
                                    <td>Instruktur/Asesor WNA</td>
                                    <td><input type="number" name="aw_laki" class="form-control" value="0" required="" autocomplete="off" /></td>
                                    <td><input type="number" name="aw_perempuan" class="form-control" value="0" required="" autocomplete="off" /></td>
                                </tr>
                            </center>
                        </table>
                    </fieldset>
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

<?php 
$no = 1;
foreach ($laporan as $row) { 
    $query1 = $this->db->query("SELECT * FROM table_anggota WHERE kode_user = '$row->kode_lapor' AND tipe = 'Karyawan' AND jenis_kelamin = 'Laki-laki' LIMIT 1")->result_array();
    $query2 = $this->db->query("SELECT * FROM table_anggota WHERE kode_user = '$row->kode_lapor' AND tipe = 'Karyawan' AND jenis_kelamin = 'Perempuan' LIMIT 1")->result_array();
    $query3 = $this->db->query("SELECT * FROM table_anggota WHERE kode_user = '$row->kode_lapor' AND tipe = 'Tenaga Pelatihan Tetap' AND jenis_kelamin = 'Laki-laki' LIMIT 1")->result_array();
    $query4 = $this->db->query("SELECT * FROM table_anggota WHERE kode_user = '$row->kode_lapor' AND tipe = 'Tenaga Pelatihan Tetap' AND jenis_kelamin = 'Perempuan' LIMIT 1")->result_array();
    $query5 = $this->db->query("SELECT * FROM table_anggota WHERE kode_user = '$row->kode_lapor' AND tipe = 'Tenaga Pelatihan Tidak Tetap' AND jenis_kelamin = 'Laki-laki' LIMIT 1")->result_array();
    $query6 = $this->db->query("SELECT * FROM table_anggota WHERE kode_user = '$row->kode_lapor' AND tipe = 'Tenaga Pelatihan Tidak Tetap' AND jenis_kelamin = 'Perempuan' LIMIT 1")->result_array();
    $query7 = $this->db->query("SELECT * FROM table_anggota WHERE kode_user = '$row->kode_lapor' AND tipe = 'Instruktur Tetap' AND jenis_kelamin = 'Laki-laki' LIMIT 1")->result_array();
    $query8 = $this->db->query("SELECT * FROM table_anggota WHERE kode_user = '$row->kode_lapor' AND tipe = 'Instruktur Tetap' AND jenis_kelamin = 'Perempuan' LIMIT 1")->result_array();
    $query9 = $this->db->query("SELECT * FROM table_anggota WHERE kode_user = '$row->kode_lapor' AND tipe = 'Instruktur Tidak Tetap' AND jenis_kelamin = 'Laki-laki' LIMIT 1")->result_array();
    $query10 = $this->db->query("SELECT * FROM table_anggota WHERE kode_user = '$row->kode_lapor' AND tipe = 'Instruktur Tidak Tetap' AND jenis_kelamin = 'Perempuan' LIMIT 1")->result_array();
    $query11 = $this->db->query("SELECT * FROM table_anggota WHERE kode_user = '$row->kode_lapor' AND tipe = 'Asesor Kompetensi' AND jenis_kelamin = 'Perempuan' LIMIT 1")->result_array();
    $query12 = $this->db->query("SELECT * FROM table_anggota WHERE kode_user = '$row->kode_lapor' AND tipe = 'Asesor Kompetensi' AND jenis_kelamin = 'Perempuan' LIMIT 1")->result_array();
    $query13 = $this->db->query("SELECT * FROM table_anggota WHERE kode_user = '$row->kode_lapor' AND tipe = 'Instruktur/Asesor WNA' AND jenis_kelamin = 'Laki-laki' LIMIT 1")->result_array();
    $query14 = $this->db->query("SELECT * FROM table_anggota WHERE kode_user = '$row->kode_lapor' AND tipe = 'Instruktur/Asesor WNA' AND jenis_kelamin = 'Perempuan' LIMIT 1")->result_array();
    $query15 = $this->db->query("SELECT * FROM table_program WHERE kode_lapor = '$row->kode_lapor'")->result_array();
    $query16 = $this->db->query("SELECT * FROM table_penyelenggara WHERE kode_lapor = '$row->kode_lapor'")->result_array();
    $query17 = $this->db->query("SELECT * FROM table_lsp WHERE kode_lapor = '$row->kode_lapor'")->result_array();
    $query18 = $this->db->query("SELECT * FROM table_sdm WHERE kode_lapor = '$row->kode_lapor'")->result_array();
    $query19 = $this->db->query("SELECT * FROM table_mitra WHERE kode_lapor = '$row->kode_lapor'")->result_array();
    ?>
    <!-- The Modal -->
    <div class="modal" id="myModalLihat<?= $row->kode_lapor; ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Detail Laporan <?= $row->nama; ?></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="tab tab-border nav-center">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show" id="profile-tab" data-toggle="tab" href="#profile<?= $row->kode_lapor; ?>" role="tab" aria-controls="profile" aria-selected="true"> <i class="fa fa-home"></i> Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pengembangan-pelatihan-tab" data-toggle="tab" href="#pengembangan-pelatihan<?= $row->kode_lapor; ?>" role="tab" aria-controls="pengembangan-pelatihan"> <i class="fa fa-home"></i> Pengembangan Pelatihan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="penyelenggaraan-pelatihan-tab" data-toggle="tab" href="#penyelenggaraan-pelatihan<?= $row->kode_lapor; ?>" role="tab" aria-controls="penyelenggaraan-pelatihan"> <i class="fa fa-home"></i> Penyelenggaraan Pelatihan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="penyelenggaran-uji-kompetensi-tab" data-toggle="tab" href="#penyelenggaraan-uji-kompetensi<?= $row->kode_lapor; ?>" role="tab" aria-controls="penyelenggaran-uji-kompetensi" aria-selected="true"> <i class="fa fa-home"></i> Penyelenggaraan Uji Kompetensi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pengembangan-kelembagaan-tab" data-toggle="tab" href="#pengembangan-kelembagaan<?= $row->kode_lapor; ?>" role="tab" aria-controls="pengembangan-kelembagaan" aria-selected="true"> <i class="fa fa-home"></i> Pengembangan kelembagaan dan SDM</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="kemitraan-tab" data-toggle="tab" href="#kemitraan<?= $row->kode_lapor; ?>" role="tab" aria-controls="kemitraan" aria-selected="true"> <i class="fa fa-home"></i> Kemitraan</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="profile<?= $row->kode_lapor; ?>" role="tabpanel" aria-labelledby="profile-tab">
                                <fieldset class="col-md-12 mt-10">
                                    <legend>Data LPK/BLKLN</legend>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="control-label">Nama LPK/BLKLN <span style="color:red" title="Wajib Diisi">*</span></label>
                                            <input type="text" value="<?= $row->nama; ?>" name="nama" class="form-control" placeholder="Nama LPK/BLKLN" required="" autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="control-label"><?= $query15[0]['nama_program']; ?>Alamat <span style="color:red" title="Wajib Diisi">*</span></label>
                                            <textarea class="form-control" name="alamat"><?= $row->alamat; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="control-label">No. Telepon <span style="color:red" title="Wajib Diisi">*</span></label>
                                            <input type="text" value="<?= $row->telepon; ?>" name="no_telepon" class="form-control" placeholder="No. Telepon" required="" autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="control-label">Email <span style="color:red" title="Wajib Diisi">*</span></label>
                                            <input type="email" value="<?= $row->email; ?>" name="email" class="form-control" placeholder="Email" required="" autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="control-label">No. Izin <span style="color:red" title="Wajib Diisi">*</span></label>
                                            <input type="text" value="<?= $row->no_izin; ?>" name="no_izin" class="form-control" placeholder="No. Izin" required="" autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="control-label">Tanggal Izin <span style="color:red" title="Wajib Diisi">*</span></label>
                                            <input type="date" value="<?= $row->tanggal_izin; ?>" name="tanggal_izin" class="form-control" required="" autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="control-label">Jenis <span style="color:red" title="Wajib Diisi">*</span></label><br>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="customRadioInline3" name="jenis" class="custom-control-input" value="Pemerintah" autocomplete="off" required <?php if ($row->jenis == 'Pemerintah') {echo 'checked';} ?>>
                                                <label class="custom-control-label" for="customRadioInline3">Pemerintah</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="customRadioInline4" name="jenis" class="custom-control-input" value="Swasta" autocomplete="off" required <?php if ($row->jenis == 'Swasta') {echo 'checked';} ?>>
                                                <label class="custom-control-label" for="customRadioInline4">Swasta</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="customRadioInline5" name="jenis" class="custom-control-input" value="Perusahaan" autocomplete="off" required <?php if ($row->jenis == 'Perusahaan') {echo 'checked';} ?>>
                                                <label class="custom-control-label" for="customRadioInline5">Perusahaan</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="control-label">Status Akreditas <span style="color:red" title="Wajib Diisi">*</span></label>
                                            <input type="text" value="<?= $row->status_akreditas; ?>" name="status_akreditas" class="form-control" required="" autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="control-label">No. Akreditas <span style="color:red" title="Wajib Diisi">*</span></label>
                                            <input type="text" value="<?= $row->no_akreditas; ?>" name="no_akreditas" class="form-control" required="" autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="control-label">Ruang Lingkup <span style="color:red" title="Wajib Diisi">*</span></label>
                                            <input type="text" value="<?= $row->ruang_lingkup; ?>" name="ruang_lingkup" class="form-control" required="" autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="control-label">Program Yang Ditawarkan <span style="color:red" title="Wajib Diisi">*</span></label>
                                            <input type="text" name="program" class="form-control" required="" autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Foto Kegiatan</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="customFile" name="kegiatan" autocomplete="off">
                                                <label class="custom-file-label" for="customFile">Pilih File</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Daftar Absensi Pelatihan</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="customFile" name="absensi" autocomplete="off">
                                                <label class="custom-file-label" for="customFile">Pilih File</label>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="col-md-12 mt-10">
                                    <legend>Data Pimpinan</legend>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="control-label">Nama Pimpinan <span style="color:red" title="Wajib Diisi">*</span></label>
                                            <input type="text" value="<?= $row->nama_pimpinan; ?>" name="nama_pimpinan" class="form-control" placeholder="Nama Pimpinan" autocomplete="off" required="" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="control-label">No. Telepon Pimpinan <span style="color:red" title="Wajib Diisi">*</span></label>
                                            <input type="text" value="<?= $row->no_telepon_pimpinan; ?>" name="no_telepon_pimpinan" class="form-control" placeholder="(+62) ..." autocomplete="off" required="" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="control-label">Nama Penanggung Jawab <span style="color:red" title="Wajib Diisi">*</span></label>
                                            <input type="text" value="<?= $row->nama_pj; ?>" name="nama_pj" class="form-control" placeholder="Nama Pimpinan" autocomplete="off" required="" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="control-label">Jabatan Penanggung Jawab <span style="color:red" title="Wajib Diisi">*</span></label>
                                            <input type="text" value="<?= $row->jabatan_pj; ?>" name="jabatan_pj" class="form-control" placeholder="Nama Pimpinan" autocomplete="off" required="" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="control-label">No. Telepon Penanggung Jawab <span style="color:red" title="Wajib Diisi">*</span></label>
                                            <input type="text" value="<?= $row->no_telepon_pj; ?>" name="no_telepon_pj" class="form-control" placeholder="(+62) ..." autocomplete="off" required="" />
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="col-md-12 mt-10">
                                    <legend>Data Pengurus</legend>
                                    <table class="table table-striped">
                                        <center>
                                            <tr>
                                                <!-- <th scope="col" rowspan="2">No.</th> -->
                                                <th scope="col" rowspan="2" class="align-middle">Tipe</th>
                                                <th scope="col" colspan="2">Jenis Kelamin</th>
                                            </tr>
                                            <tr>
                                                <th scope="col">Laki-laki</th>
                                                <th scope="col">Perempuan</th>
                                            </tr>
                                            <tr>
                                                <td>Karyawan</td>
                                                <td><input type="number" name="karyawan_laki" class="form-control" value="<?= $query1[0]['jumlah']; ?>" required="" autocomplete="off" /></td>
                                                <td><input type="number" name="karyawan_perempuan" class="form-control" value="<?= $query2[0]['jumlah']; ?>" required="" autocomplete="off" /></td>
                                            </tr>
                                            <tr>
                                                <td>Tenaga Pelatihan Tetap</td>
                                                <td><input type="number" name="tpt_laki" class="form-control" value="<?= $query3[0]['jumlah']; ?>" required="" autocomplete="off" /></td>
                                                <td><input type="number" name="tpt_perempuan" class="form-control" value="<?= $query4[0]['jumlah']; ?>" required="" autocomplete="off" /></td>
                                            </tr>
                                            <tr>
                                                <td>Tenaga Pelatihan Tidak Tetap</td>
                                                <td><input type="number" name="tptt_laki" class="form-control" value="<?= $query5[0]['jumlah']; ?>" required="" autocomplete="off" /></td>
                                                <td><input type="number" name="tptt_perempuan" class="form-control" value="<?= $query6[0]['jumlah']; ?>" required="" autocomplete="off" /></td>
                                            </tr>
                                            <tr>
                                                <td>Instruktur Tetap</td>
                                                <td><input type="number" name="it_laki" class="form-control" value="<?= $query7[0]['jumlah']; ?>" required="" autocomplete="off" /></td>
                                                <td><input type="number" name="it_perempuan" class="form-control" value="<?= $query8[0]['jumlah']; ?>" required="" autocomplete="off" /></td>
                                            </tr>
                                            <tr>
                                                <td>Instruktur Tidak Tetap</td>
                                                <td><input type="number" name="itt_laki" class="form-control" value="<?= $query9[0]['jumlah']; ?>" required="" autocomplete="off" /></td>
                                                <td><input type="number" name="itt_perempuan" class="form-control" value="<?= $query10[0]['jumlah']; ?>" required="" autocomplete="off" /></td>
                                            </tr>
                                            <tr>
                                                <td>Asesor Kompetensi</td>
                                                <td><input type="number" name="ak_laki" class="form-control" value="<?= $query11[0]['jumlah']; ?>" required="" autocomplete="off" /></td>
                                                <td><input type="number" name="ak_perempuan" class="form-control" value="<?= $query12[0]['jumlah']; ?>" required="" autocomplete="off" /></td>
                                            </tr>
                                            <tr>
                                                <td>Instruktur/Asesor WNA</td>
                                                <td><input type="number" name="aw_laki" class="form-control" value="<?= $query13[0]['jumlah']; ?>" required="" autocomplete="off" /></td>
                                                <td><input type="number" name="aw_perempuan" class="form-control" value="<?= $query14[0]['jumlah']; ?>" required="" autocomplete="off" /></td>
                                            </tr>
                                        </center>
                                    </table>
                                </fieldset>
                            </div>
                            <div class="tab-pane fade active" id="pengembangan-pelatihan<?= $row->kode_lapor; ?>" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div data-role="dynamic-fields">
                                            <div class="form-biasa">
                                                <?php foreach ($query15 as $a) { ?>
                                                    <fieldset>
                                                        <legend>Pengembangan Pelatihan</legend>
                                                        <div class="form-group">
                                                            <label  for="field-name">Nama Program</label>
                                                            <input type="text" class="form-control" id="field-name" value="<?= $a['nama_program']; ?>" autocomplete="off">
                                                        </div>

                                                        <div class="form-group">
                                                            <label  for="field-value">Inisiator</label>
                                                            <input type="text" class="form-control" id="field-value" value="<?= $a['inisiator_program']; ?>" autocomplete="off">
                                                        </div>

                                                        <div class="form-group">
                                                            <label  for="field-value">Durasi Pelatihan</label>
                                                            <input type="text" class="form-control" id="field-value" value="<?= $a['durasi_pelatihan_program']; ?>" autocomplete="off">
                                                        </div>

                                                        <div class="form-group">
                                                            <label  for="field-value">Standar Kompetensi</label>
                                                            <input type="text" class="form-control" id="field-value" value="<?= $a['standar_kompetensi_program']; ?>" autocomplete="off">
                                                        </div>

                                                        <div class="form-group">
                                                            <label  for="field-value">Keterangan</label>
                                                            <textarea class="form-control"><?= $a['keterangan_program']; ?></textarea>
                                                        </div>
                                                    </fieldset>
                                                <?php } ?>
                                            </div>  <!-- /div.form-biasa -->
                                        </div>  <!-- /div[data-role="dynamic-fields"] -->
                                    </div>  <!-- /div.col-md-12 -->
                                </div>  <!-- /div.row -->
                            </div>
                            <div class="tab-pane fade active" id="penyelenggaraan-pelatihan<?= $row->kode_lapor; ?>" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div data-role="dynamic-fields">
                                            <div class="form-biasa">
                                                <?php foreach ($query16 as $b) { ?>
                                                    <fieldset>
                                                        <legend>Penyelenggaraan Pelatihan</legend>
                                                        <div class="form-group">
                                                            <label  for="field-name">Nama Program</label>
                                                            <input type="text" class="form-control" id="field-name" value="<?= $b['nama_program_penyelenggara']; ?>" autocomplete="off">
                                                        </div>

                                                        <div class="form-group">
                                                            <label  for="field-value">Jadwal Pelaksanaan</label>
                                                            <input type="text" class="form-control" id="field-value" value="<?= $b['jadwal_pelaksanaan_penyelenggara']; ?>" autocomplete="off">
                                                        </div>

                                                        <div class="form-group">
                                                            <label  for="field-value">Jumlah Peserta</label>
                                                            <input type="number" class="form-control" id="field-value" value="<?= $b['jumlah_peserta_penyelenggara']; ?>" autocomplete="off">
                                                        </div>

                                                        <div class="form-group">
                                                            <label  for="field-value">Jumlah Lulusan</label>
                                                            <input type="number" class="form-control" id="field-value" value="<?= $b['jumlah_lulusan_penyelenggara']; ?>" autocomplete="off">
                                                        </div>

                                                        <div class="form-group">
                                                            <label  for="field-value">Keterangan</label>
                                                            <textarea class="form-control" name="keterangan_penyelenggara[]" autocomplete="off" ><?= $b['keterangan_penyelenggara']; ?></textarea>
                                                        </div>
                                                    </fieldset>
                                                <?php } ?>
                                            </div>  <!-- /div.form-biasa -->
                                        </div>  <!-- /div[data-role="dynamic-fields"] -->
                                    </div>  <!-- /div.col-md-12 -->
                                </div>  <!-- /div.row -->
                            </div>
                            <div class="tab-pane fade active" id="penyelenggaraan-uji-kompetensi<?= $row->kode_lapor; ?>" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div data-role="dynamic-fields">
                                            <div class="form-biasa">
                                                <?php foreach ($query17 as $c) { ?>
                                                    <fieldset>
                                                        <legend>Penyelenggaraan Pelatihan</legend>
                                                        <div class="form-group">
                                                            <label  for="field-name">Nama LSP</label>
                                                            <input type="text" class="form-control" id="field-name" value="<?= $c['nama_lsp']; ?>" autocomplete="off" >
                                                        </div>

                                                        <div class="form-group">
                                                            <label  for="field-value">Skema Sertifikasi</label>
                                                            <input type="text" class="form-control" id="field-value" value="<?= $c['skema_sertifikasi_lsp']; ?>" autocomplete="off"  >
                                                        </div>

                                                        <div class="form-group">
                                                            <label  for="field-value">Jadwal Pelaksanaan</label>
                                                            <input type="text" class="form-control" id="field-value" value="<?= $c['jadwal_pelaksanaan_lsp']; ?>" autocomplete="off" >
                                                        </div>

                                                        <div class="form-group">
                                                            <label  for="field-value">Jumlah Peserta</label>
                                                            <input type="number" class="form-control" id="field-value" value="<?= $c['jumlah_peserta_lsp']; ?>" autocomplete="off" >
                                                        </div>

                                                        <div class="form-group">
                                                            <label  for="field-value">Keterangan</label>
                                                            <textarea class="form-control" name="keterangan_lsp[]" autocomplete="off"><?= $c['keterangan_lsp']; ?></textarea>
                                                        </div>
                                                    </fieldset>
                                                <?php } ?>
                                            </div>  <!-- /div.form-biasa -->
                                        </div>  <!-- /div[data-role="dynamic-fields"] -->
                                    </div>  <!-- /div.col-md-12 -->
                                </div>  <!-- /div.row -->
                            </div>
                            <div class="tab-pane fade active" id="pengembangan-kelembagaan<?= $row->kode_lapor; ?>" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div data-role="dynamic-fields">
                                            <div class="form-biasa">
                                                <?php foreach ($query18 as $d) { ?>
                                                    <fieldset>
                                                        <legend>Pengembangan Kelembagaan dan SDM</legend>
                                                        <div class="form-group">
                                                            <label  for="field-name">Nama Kegiatan</label>
                                                            <input type="text" class="form-control" id="field-name" value="<?= $d['nama_kegiatan_sdm']; ?>" autocomplete="off">
                                                        </div>

                                                        <div class="form-group">
                                                            <label  for="field-value">Jadwal</label>
                                                            <input type="text" class="form-control" id="field-value" value="<?= $d['jadwal_sdm']; ?>" autocomplete="off" >
                                                        </div>

                                                        <div class="form-group">
                                                            <label  for="field-value">Lokasi</label>
                                                            <input type="text" class="form-control" id="field-value" placeholder="Lokasi" value="<?= $d['lokasi_sdm']; ?>" autocomplete="off" >
                                                        </div>

                                                        <div class="form-group">
                                                            <label  for="field-value">Penyelenggara</label>
                                                            <input type="text" class="form-control" id="field-value" value="<?= $d['penyelenggara_sdm']; ?>" autocomplete="off">
                                                        </div>

                                                        <div class="form-group">
                                                            <label  for="field-value">Keterangan</label>
                                                            <textarea class="form-control" name="keterangan_sdm[]" autocomplete="off"><?= $d['keterangan_sdm']; ?></textarea>
                                                        </div>
                                                    </fieldset>
                                                <?php } ?>
                                            </div>  <!-- /div.form-biasa -->
                                        </div>  <!-- /div[data-role="dynamic-fields"] -->
                                    </div>  <!-- /div.col-md-12 -->
                                </div>  <!-- /div.row -->
                            </div>
                            <div class="tab-pane fade active" id="kemitraan<?= $row->kode_lapor; ?>" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div data-role="dynamic-fields">
                                            <div class="form-biasa">
                                                <?php foreach ($query19 as $e) { ?>
                                                    <fieldset>
                                                        <legend>Kemitraan</legend>
                                                        <div class="form-group">
                                                            <label  for="field-name">Nama Mitra</label>
                                                            <input type="text" class="form-control" id="field-name" value="<?= $e['nama_mitra']; ?>" autocomplete="off" >
                                                        </div>

                                                        <div class="form-group">
                                                            <label  for="field-value">Alamat</label>
                                                            <input type="text" class="form-control" id="field-value" value="<?= $e['alamat_mitra']; ?>" autocomplete="off" >
                                                        </div>

                                                        <div class="form-group">
                                                            <label  for="field-value">Bentuk Kemitraan</label>
                                                            <input type="text" class="form-control" id="field-value" value="<?= $e['bentuk_kemitraan']; ?>" autocomplete="off">
                                                        </div>
                                                    </fieldset>
                                                <?php } ?>
                                            </div>  <!-- /div.form-biasa -->
                                        </div>  <!-- /div[data-role="dynamic-fields"] -->
                                    </div>  <!-- /div.col-md-12 -->
                                </div>  <!-- /div.row -->
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
<?php } ?>

<script type="text/javascript">
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
  });
</script>

<script type="text/javascript">
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.0/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.bootstrap4.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.colVis.min.js"></script>
</script>

<script type="text/javascript">
    $("#datatableStatus").dataTable({
        language: {
            "decimal":        "",
            "emptyTable":     "Data Tidak Tersedia Di Table",
            "info":           "Menampilkan _START_ Sampai _END_ Dari _TOTAL_ Data",
            "infoEmpty":      "Menampilkan 0 Sampai 0 Dari 0 Data",
            "infoFiltered":   "(Dari Total _MAX_ Data)",
            "infoPostFix":    "",
            "thousands":      ",",
            "lengthMenu":     "Menampilkan _MENU_ Data",
            "loadingRecords": "Loading...",
            "processing":     "Memproses...",
            "search":         "Cari :",
            "zeroRecords":    "Tidak Ada Data Yang Sesuai",
            "paginate": {
                "first":      "Pertama",
                "last":       "Terakhir",
                "next":       ">",
                "previous":   "<"
            },
            "aria": {
                "sortAscending":  ": activate to sort column ascending",
                "sortDescending": ": activate to sort column descending"
            }
        },
        initComplete: function () {
            this.api().columns([2, 3]).every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                .appendTo( $(column.header()).empty() )
                .on( 'change', function () {
                    var val = $.fn.dataTable.util.escapeRegex(
                        $(this).val()
                        );
                    column
                    .search( val ? '^'+val+'$' : '', true, false )
                    .draw();
                } );
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        },
        "dom": 'Bfrtip',
        "buttons": [
        {
            extend: 'excelHtml5',
            text: 'Export Excel',
            exportOptions: {
                columns: [ 0, 1, 2, 3 ]
            },
        },
        ],
    });
</script>