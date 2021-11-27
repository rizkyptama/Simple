<?= $this->session->flashdata('notif');?>
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
        width: auto; 
        border: 1px solid #ddd;
        border-radius: 4px; 
        padding: 5px 5px 5px 10px; 
        background-color: #ffffff;
    }
    tbody .bod {
        display:block;
        max-height:500px;
        overflow-y:auto;
    }
    thead .hea, tbody .bod tr {
        display:table;
        width: var(--table-width);
        table-layout:fixed;
    }
</style>
<div class="row">
    <div class="col-lg-12">
        <div class="card card-statistics">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div class="card-heading">
                    <h4 class="card-title">LPK / BLKLN</h4>
                </div>
                <div class="float-right">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModalTambah">Tambah</button>
                </div>
            </div>
            <div class="card-body">
                <div class="datatable-wrapper table-responsive">
                    <table id="datatableLPK" class="display compact table table-hover table-striped text-center" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama / Tipe</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            foreach ($lpkblkln as $row) { ?>
                                <tr>
                                    <td><?= $no++; ?>.</td>
                                    <td><?= $row->nama; ?> / <?= $row->tipe; ?></td>
                                    <td><?= $row->email; ?></td>
                                    <td><?= $row->alamat; ?></td>
                                    <td>
                                        <?php if ($row->status == 'Aktif') { ?>
                                            <span class="badge badge-success">Aktif</span>
                                        <?php } elseif ($row->status == 'Pending') { ?>
                                            <span class="badge badge-warning">Menunggu Persetujuan</span>
                                        <?php } else { ?>
                                            <span class="badge badge-danger">Suspend</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if ($row->status == 'Pending') { ?>
                                            <button type="button" class="btn btn-danger btn-sm" onclick="blokir('<?= $row->kode_user; ?>')">Blokir</button>
                                            <button type="button" class="btn btn-success btn-sm" onclick="aktivasi('<?= $row->kode_user; ?>', '<?= $row->nama; ?>', '<?= $row->alamat; ?>', '<?= $row->email; ?>')">Aktivasi</button>
                                        <?php } elseif ($row->status == 'Suspend') { ?>
                                           <button type="button" class="btn btn-success btn-sm" onclick="aktivasi('<?= $row->kode_user; ?>', '<?= $row->nama; ?>', '<?= $row->alamat; ?>', '<?= $row->email; ?>')">Buka Blokir</button>
                                       <?php } else { ?>
                                        <button type="button" class="btn btn-danger btn-sm" onclick="blokir('<?= $row->kode_user; ?>')">Blokir</button>
                                    <?php } ?>
                                    <button class="btn btn-info btn-sm" type="button" data-toggle="modal" data-target="#myModalLihat<?= $row->kode_user; ?>">Detail</button>
                                    <button class="btn btn-danger btn-sm" type="button" onclick="hapusLPK('<?= $row->kode_user; ?>')">Delete</button>
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
foreach ($lpkblkln as $row) { 
    $query1 = $this->db->query("SELECT jumlah FROM table_anggota WHERE kode_user = '$row->kode_user' AND tipe = 'Karyawan' AND jenis_kelamin = 'Laki-laki' LIMIT 1")->result_array();
    $query2 = $this->db->query("SELECT jumlah FROM table_anggota WHERE kode_user = '$row->kode_user' AND tipe = 'Karyawan' AND jenis_kelamin = 'Perempuan' LIMIT 1")->result_array();
    $query3 = $this->db->query("SELECT jumlah FROM table_anggota WHERE kode_user = '$row->kode_user' AND tipe = 'Tenaga Pelatihan Tetap' AND jenis_kelamin = 'Laki-laki' LIMIT 1")->result_array();
    $query4 = $this->db->query("SELECT jumlah FROM table_anggota WHERE kode_user = '$row->kode_user' AND tipe = 'Tenaga Pelatihan Tetap' AND jenis_kelamin = 'Perempuan' LIMIT 1")->result_array();
    $query5 = $this->db->query("SELECT jumlah FROM table_anggota WHERE kode_user = '$row->kode_user' AND tipe = 'Tenaga Pelatihan Tidak Tetap' AND jenis_kelamin = 'Laki-laki' LIMIT 1")->result_array();
    $query6 = $this->db->query("SELECT jumlah FROM table_anggota WHERE kode_user = '$row->kode_user' AND tipe = 'Tenaga Pelatihan Tidak Tetap' AND jenis_kelamin = 'Perempuan' LIMIT 1")->result_array();
    $query7 = $this->db->query("SELECT jumlah FROM table_anggota WHERE kode_user = '$row->kode_user' AND tipe = 'Instruktur Tetap' AND jenis_kelamin = 'Laki-laki' LIMIT 1")->result_array();
    $query8 = $this->db->query("SELECT jumlah FROM table_anggota WHERE kode_user = '$row->kode_user' AND tipe = 'Instruktur Tetap' AND jenis_kelamin = 'Perempuan' LIMIT 1")->result_array();
    $query9 = $this->db->query("SELECT jumlah FROM table_anggota WHERE kode_user = '$row->kode_user' AND tipe = 'Instruktur Tidak Tetap' AND jenis_kelamin = 'Laki-laki' LIMIT 1")->result_array();
    $query10 = $this->db->query("SELECT jumlah FROM table_anggota WHERE kode_user = '$row->kode_user' AND tipe = 'Instruktur Tidak Tetap' AND jenis_kelamin = 'Perempuan' LIMIT 1")->result_array();
    $query11 = $this->db->query("SELECT jumlah FROM table_anggota WHERE kode_user = '$row->kode_user' AND tipe = 'Asesor Kompetensi' AND jenis_kelamin = 'Perempuan' LIMIT 1")->result_array();
    $query12 = $this->db->query("SELECT jumlah FROM table_anggota WHERE kode_user = '$row->kode_user' AND tipe = 'Asesor Kompetensi' AND jenis_kelamin = 'Perempuan' LIMIT 1")->result_array();
    $query13 = $this->db->query("SELECT jumlah FROM table_anggota WHERE kode_user = '$row->kode_user' AND tipe = 'Instruktur/Asesor WNA' AND jenis_kelamin = 'Laki-laki' LIMIT 1")->result_array();
    $query14 = $this->db->query("SELECT jumlah FROM table_anggota WHERE kode_user = '$row->kode_user' AND tipe = 'Instruktur/Asesor WNA' AND jenis_kelamin = 'Perempuan' LIMIT 1")->result_array();
    ?>
    <!-- The Modal -->
    <div class="modal" id="myModalLihat<?= $row->kode_user; ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Detail <?= $row->tipe; ?> : <?= $row->nama; ?></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <img class="p-20" src="<?= base_url();?>assets/upload/logo/<?= $row->photo; ?>" alt="<?= $row->photo; ?>">
                <div class="modal-body">
                    <div class="tab tab-border">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show" id="profile-tab" data-toggle="tab" href="#profile<?= $row->kode_user; ?>" role="tab" aria-controls="profile" aria-selected="true"> <i class="fa fa-home"></i> Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pengurus-tab" data-toggle="tab" href="#pengurus<?= $row->kode_user; ?>" role="tab" aria-controls="pengurus" aria-selected="false"><i class="fa fa-user"></i> Pengurus </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="detail-tab" data-toggle="tab" href="#detail<?= $row->kode_user; ?>" role="tab" aria-controls="detail" aria-selected="false"><i class="fa fa-list"></i> Detail </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="profile<?= $row->kode_user; ?>" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="form-group">
                                    <label>No. Izin</label>
                                    <input type="text" value="<?= $row->no_izin ?>" class="form-control" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label>Tanggal izin</label>
                                    <input type="date" value="<?= $row->tanggal_izin ?>" class="form-control" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label>Nama Lembaga</label>
                                    <input type="text" value="<?= $row->nama; ?>" class="form-control" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea class="form-control" autocomplete="off"><?= $row->alamat ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Telepon</label>
                                    <input type="text" value="<?= $row->telepon ?>" class="form-control" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" value="<?= $row->email ?>" class="form-control" autocomplete="off">
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pengurus<?= $row->kode_user; ?>" role="tabpanel" aria-labelledby="pengurus-tab">
                                <div class="form-group">
                                    <label>Nama Direktur Lembaga</label>
                                    <input type="text" value="<?= $row->nama_pimpinan ?>" class="form-control" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label>No Direktur Lembaga</label>
                                    <input type="text" value="<?= $row->no_telepon_pimpinan ?>" class="form-control" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label>Nama Penanggung Jawab Lembaga</label>
                                    <input type="text" value="<?= $row->nama_pj ?>" class="form-control" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label>Jabatan Penanggung Jawab Lembaga</label>
                                    <input type="text" value="<?= $row->jabatan_pj ?>" class="form-control" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label>No Penanggung Jawab Lembaga</label>
                                    <input type="text" value="<?= $row->no_telepon_pj ?>" class="form-control" autocomplete="off">
                                </div>
                            </div>
                            <div class="tab-pane fade" id="detail<?= $row->kode_user; ?>" role="tabpanel" aria-labelledby="detail-tab">
                                <div class="accordion" id="accordionsimplefill">
                                    <div class="mb-2 acd-group">
                                        <div class="card-header bg-primary rounded-0">
                                            <h5 class="mb-0">
                                                <a href="#collapse" class="btn-block text-white text-left acd-heading collapsed" data-toggle="collapse">Lembaga</a>
                                            </h5>
                                        </div>
                                        <div id="collapse" class="collapse" data-parent="#accordionsimplefill">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label>Jenis Kelembagaan</label>
                                                    <select class="form-control autocomplete="off"">
                                                        <option <?php if ($row->jenis == 'Pemerintah') {echo 'selected';} ?>>Pemerintah</option>
                                                        <option <?php if ($row->jenis == 'Swasta') {echo 'selected';} ?>>Swasta</option>
                                                        <option <?php if ($row->jenis == 'Perusahaan') {echo 'selected';} ?>>Perusahaan</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Ruang Lingkup Lembaga</label>
                                                    <input type="text" value="<?= $row->ruang_lingkup; ?>" class="form-control" autocomplete="off">
                                                </div>
                                                <div class="form-group">
                                                    <label>Status Akreditasi</label>
                                                    <input type="text" value="<?= $row->status_akreditas; ?>" class="form-control" autocomplete="off">
                                                </div>
                                                <div class="form-group">
                                                    <label>No. Akreditasi</label>
                                                    <input type="text" value="<?= $row->no_akreditas; ?>" class="form-control" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2 acd-group">
                                        <div class="card-header bg-primary rounded-0">
                                            <h5 class="mb-0">
                                                <a href="#collapse1" class="btn-block text-white text-left acd-heading collapsed" data-toggle="collapse">Karyawan</a>
                                            </h5>
                                        </div>
                                        <div id="collapse1" class="collapse" data-parent="#accordionsimplefill">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Laki - Laki</label>
                                                            <input type="number" value="<?= $query1[0]['jumlah']; ?>" class="form-control" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Perempuan</label>
                                                            <input type="number" value="<?= $query2[0]['jumlah']; ?>" class="form-control" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2 acd-group">
                                        <div class="card-header rounded-0 bg-primary">
                                            <h5 class="mb-0">
                                                <a href="#collapse2" class="btn-block text-white text-left acd-heading collapsed" data-toggle="collapse">Tenaga Kerja Tetap</a>
                                            </h5>
                                        </div>
                                        <div id="collapse2" class="collapse" data-parent="#accordionsimplefill">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Laki - Laki</label>
                                                            <input type="number" value="<?= $query3[0]['jumlah']; ?>" class="form-control" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Perempuan</label>
                                                            <input type="number" value="<?= $query4[0]['jumlah']; ?>" class="form-control" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2 acd-group border-bottom-0">
                                        <div class="card-header rounded-0 bg-primary">
                                            <h5 class="mb-0">
                                                <a href="#collapse3" class="btn-block text-white text-left acd-heading collapsed" data-toggle="collapse">Tenaga Kerja Tidak Tetap</a>
                                            </h5>
                                        </div>
                                        <div id="collapse3" class="collapse" data-parent="#accordionsimplefill">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Laki - Laki</label>
                                                            <input type="number" value="<?= $query5[0]['jumlah']; ?>" class="form-control" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Perempuan</label>
                                                            <input type="number" value="<?= $query6[0]['jumlah']; ?>" class="form-control" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2 acd-group border-bottom-0">
                                        <div class="card-header rounded-0 bg-primary">
                                            <h5 class="mb-0">
                                                <a href="#collapse4" class="btn-block text-white text-left acd-heading collapsed" data-toggle="collapse">Instruktur Tetap</a>
                                            </h5>
                                        </div>
                                        <div id="collapse4" class="collapse" data-parent="#accordionsimplefill">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Laki - Laki</label>
                                                            <input type="number" value="<?= $query7[0]['jumlah']; ?>" class="form-control" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Perempuan</label>
                                                            <input type="number" value="<?= $query8[0]['jumlah']; ?>" class="form-control" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2 acd-group border-bottom-0">
                                        <div class="card-header rounded-0 bg-primary">
                                            <h5 class="mb-0">
                                                <a href="#collapse5" class="btn-block text-white text-left acd-heading collapsed" data-toggle="collapse">Instruktur Tidak Tetap</a>
                                            </h5>
                                        </div>
                                        <div id="collapse5" class="collapse" data-parent="#accordionsimplefill">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Laki - Laki</label>
                                                            <input type="number" value="<?= $query9[0]['jumlah']; ?>" class="form-control" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Perempuan</label>
                                                            <input type="number" value="<?= $query10[0]['jumlah']; ?>" class="form-control" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2 acd-group border-bottom-0">
                                        <div class="card-header rounded-0 bg-primary">
                                            <h5 class="mb-0">
                                                <a href="#collapse6" class="btn-block text-white text-left acd-heading collapsed" data-toggle="collapse">Asesor Kompetensi</a>
                                            </h5>
                                        </div>
                                        <div id="collapse6" class="collapse" data-parent="#accordionsimplefill">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Laki - Laki</label>
                                                            <input type="number" value="<?= $query11[0]['jumlah']; ?>" class="form-control" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Perempuan</label>
                                                            <input type="number" value="<?= $query12[0]['jumlah']; ?>" class="form-control" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2 acd-group border-bottom-0">
                                        <div class="card-header rounded-0 bg-primary">
                                            <h5 class="mb-0">
                                                <a href="#collapse7" class="btn-block text-white text-left acd-heading collapsed" data-toggle="collapse">Asesor Instruksi Asing</a>
                                            </h5>
                                        </div>
                                        <div id="collapse7" class="collapse" data-parent="#accordionsimplefill">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Laki - Laki</label>
                                                            <input type="number" value="<?= $query13[0]['jumlah']; ?>" class="form-control" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Perempuan</label>
                                                            <input type="number" value="<?= $query14[0]['jumlah']; ?>" class="form-control" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- The Modal -->
<div class="modal" id="myModalTambah">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah LPK / BLKLN</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <form action="<?= base_url('Dashboard/buatAkunLPK'); ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                <div class="modal-body">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="control-label">Type Akun <span style="color:red" title="Wajib Diisi">*</span></label><br>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline1" name="tipe" class="custom-control-input" value="LPK" autocomplete="off" required>
                                <label class="custom-control-label" for="customRadioInline1">LPK</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline2" name="tipe" class="custom-control-input" value="BLKLN" autocomplete="off" required>
                                <label class="custom-control-label" for="customRadioInline2">BLKLN</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInlineX" name="tipe" class="custom-control-input" value="BLK komunitas" autocomplete="off" required>
                                <label class="custom-control-label" for="customRadioInlineX">BLK komunitas</label>
                            </div>
                        </div>
                    </div>
                    <fieldset class="col-md-12">
                        <legend>Akun Login</legend>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="control-label">Username <span style="color:red" title="Wajib Diisi">*</span></label>
                                <input type="text" name="username" class="form-control" placeholder="Username" autocomplete="off" required="" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="control-label">Password <span style="color:red" title="Wajib Diisi">*</span></label>
                                <input type="password" name="password" class="form-control" placeholder="*********" autocomplete="off" required="" />
                            </div>
                        </div>
                    </fieldset>
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
                                    <input type="radio" id="customRadioInline3" name="jenis" class="custom-control-input" value="Pemerintah" autocomplete="off" required>
                                    <label class="custom-control-label" for="customRadioInline3">Pemerintah</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline4" name="jenis" class="custom-control-input" value="Swasta" autocomplete="off" required>
                                    <label class="custom-control-label" for="customRadioInline4">Swasta</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline5" name="jenis" class="custom-control-input" value="Perusahaan" autocomplete="off" required>
                                    <label class="custom-control-label" for="customRadioInline5">Perusahaan</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="control-label">Status Akreditas <span style="color:red" title="Wajib Diisi">*</span></label>
                                <input type="text" name="status_akreditas" class="form-control" required="" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="control-label">No. Akreditas <span style="color:red" title="Wajib Diisi">*</span></label>
                                <input type="text" name="no_akreditas" class="form-control" required="" autocomplete="off" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="control-label">Ruang Lingkup <span style="color:red" title="Wajib Diisi">*</span></label>
                                <input type="text" name="ruang_lingkup" class="form-control" required="" autocomplete="off" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Logo Perusahaan</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile" name="logo" autocomplete="off">
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
                        <div class="table-responsive">
                            <table class="table table-striped" style="margin-bottom: 0;">
                                <center>
                                    <thead class="hea">
                                        <tr>
                                            <!-- <th scope="col" rowspan="2">No.</th> -->
                                            <th rowspan="2" class="align-middle" width="30%">Tipe</th>
                                            <th colspan="2" width="70%">Jenis Kelamin</th>
                                        </tr>
                                        <tr>
                                            <th>Laki-laki</th>
                                            <th>Perempuan</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bod">
                                        <tr>
                                            <td>Karyawan</td>
                                            <td><input type="number" name="karyawan_laki" class="form-control" value="0" autocomplete="off" required="" /></td>
                                            <td><input type="number" name="karyawan_perempuan" class="form-control" value="0" autocomplete="off" required="" /></td>
                                        </tr>
                                        <tr>
                                            <td>Tenaga Pelatihan<br> Tetap</td>
                                            <td><input type="number" name="tpt_laki" class="form-control" value="0" autocomplete="off"  required="" /></td>
                                            <td><input type="number" name="tpt_perempuan" class="form-control" value="0" autocomplete="off" required="" /></td>
                                        </tr>
                                        <tr>
                                            <td>Tenaga Pelatihan<br> Tidak Tetap</td>
                                            <td><input type="number" name="tptt_laki" class="form-control" value="0" autocomplete="off" required="" /></td>
                                            <td><input type="number" name="tptt_perempuan" class="form-control" value="0" autocomplete="off" required="" /></td>
                                        </tr>
                                        <tr>
                                            <td>Instruktur Tetap</td>
                                            <td><input type="number" name="it_laki" class="form-control" value="0" autocomplete="off" required="" /></td>
                                            <td><input type="number" name="it_perempuan" class="form-control" value="0" autocomplete="off" required="" /></td>
                                        </tr>
                                        <tr>
                                            <td>Instruktur Tidak<br> Tetap</td>
                                            <td><input type="number" name="itt_laki" class="form-control" value="0" autocomplete="off" required="" /></td>
                                            <td><input type="number" name="itt_perempuan" class="form-control" value="0" autocomplete="off" required="" /></td>
                                        </tr>
                                        <tr>
                                            <td>Asesor<br> Kompetensi</td>
                                            <td><input type="number" name="ak_laki" class="form-control" value="0" autocomplete="off" required="" /></td>
                                            <td><input type="number" name="ak_perempuan" class="form-control" value="0" autocomplete="off" required="" /></td>
                                        </tr>
                                        <tr>
                                            <td>Instruktur/<br>Asesor WNA</td>
                                            <td><input type="number" name="aw_laki" class="form-control" value="0" autocomplete="off" required="" /></td>
                                            <td><input type="number" name="aw_perempuan" class="form-control" value="0" autocomplete="off" required="" /></td>
                                        </tr>
                                    </tbody>
                                </center>
                            </table>
                        </div>
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
<script type="text/javascript">
    $("#datatableLPK").dataTable({
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
        "dom": 'Bfrtip',
        "buttons": [
        {
            extend: 'excelHtml5',
            text: 'Export Excel',
            exportOptions: {
                columns: [ 0, 1, 2, 3, 4]
            },
        },
        ],
    });
</script>

<script>
    $( document ).ready(function() {
      var csfrData = {};
        csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo
        $this->security->get_csrf_hash(); ?>';
        $.ajaxSetup({
        data: csfrData
        });
    });
    </script>

<script type="text/javascript">
    // $(document).ready(function(){
        // $("#postingBtn").click(function(){
                // $("#postingBtn").attr("disabled", "disabled");
            // });
    // });
    
    function aktivasi(id, nama, alamat, email){
        swal({
            title: "Apakah Anda Yakin Mengaktifkan Akun Ini ?",
            // text: "Data Akan Menjadi Aktif !",
            icon: "warning",
            buttons: true,
        })
        .then((result) => {
            if (result) {
                $.ajax({
                    url: '<?= base_url();?>Dashboard/aktivasiAkun',
                    type: 'POST',
                    data: {
                        "id" : id,
                        "nama" : nama,
                        "alamat" : alamat,
                        "email" : email,
                    },
                    dataType: "HTML",
                    error: function (xhr, ajaxOptions, thrownError) {
                        swal("Error!", "Please try again", "error");
                    },
                    success: function(data) {
                        swal("Success!", "Akun Berhasil Diaktifkan!", "success");
                        setTimeout(function(){
                            window.location.reload();
                        }, 1000);
                    }
                });
            } else {
            }
        });
    }

    function blokir(id){
        swal({
            title: "Apakah Anda Yakin Memblokir Akun Ini ?",
            // text: "Data Akan Menjadi Aktif !",
            icon: "warning",
            buttons: true,
        })
        .then((result) => {
            if (result) {
                $.ajax({
                    url: '<?= base_url();?>Dashboard/blokirAkun',
                    type: 'POST',
                    data: {
                        "id" : id
                    },
                    dataType: "HTML",
                    error: function (xhr, ajaxOptions, thrownError) {
                        swal("Error!", "Please try again", "error");
                    },
                    success: function(data) {
                        swal("Success!", "Akun Berhasil Diblokir!", "success");
                        setTimeout(function(){
                            window.location.reload();
                        }, 1000);
                    }
                });
            } else {
            }
        });
    }

    function hapusLPK(id){
        swal({
            title: "Apakah Anda Yakin?",
            text: "Semua Data Akan Terhapus Secara Permanen!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: '<?= base_url();?>Dashboard/hapusAkun',
                    type: 'POST',
                    data: {
                        "id" : id
                    },
                    dataType: "HTML",
                    error: function (xhr, ajaxOptions, thrownError) {
                        swal("Error deleting!", "Please try again", "error");
                    },
                    success: function(data) {
                        swal("Deleted!", "Akun Berhasil Dihapus!.", "success");
                        setTimeout(function(){
                            window.location.reload();
                        }, 1000);
                    }
                });
            } else {
            }
        });
    }
</script>
<script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
  });
</script>