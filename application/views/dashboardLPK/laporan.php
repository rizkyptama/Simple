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
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModalCetak">Update Laporan</button>
                </div>
            </div>
            <div class="card-body">
                <div class="datatable-wrapper table-responsive">
                    <table id="datatable" class="display compact table table-hover table-striped text-center">
                        <thead>
                            <tr>
                                <th width="2%">No.</th>
                                <th>Tanggal Lapor</th>
                                <th>Laporan Semester</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            foreach ($laporan as $row) { ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $row->tanggal_lapor; ?></td>
                                    <td>
                                        <?php $mydate= $row->tanggal_lapor;?>
                                        <?php $month = date("m",strtotime($mydate));?>
                                    
                                        <?php $myyear= $row->tanggal_lapor;?>
                                        <?php $year = date("Y",strtotime($myyear));?>
                                    
                                        <?php $bulansekarang = date('m');?>
                                        <?php $tahusekarang = date('Y');?>
                                    
                                        <?php 
                            
                                        if ($year == date('Y') && $month >= 1 && $month <= 6){
                                            echo "Laporan Semester 1 Tahun ".date('Y');
                                          
                                        }
                                        else if ($year == date('Y') && $month >= 7 && $month <= 12) {
                                            echo "Laporan Semester 2 Tahun ".date('Y');
                                          
                                        }
                                        
                                        ?>
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
    $query1 = $this->db->query("SELECT * FROM table_anggota WHERE kode_user = '$row->kode_user' AND tipe = 'Karyawan' AND jenis_kelamin = 'Laki-laki' LIMIT 1")->result_array();
    $query2 = $this->db->query("SELECT * FROM table_anggota WHERE kode_user = '$row->kode_user' AND tipe = 'Karyawan' AND jenis_kelamin = 'Perempuan' LIMIT 1")->result_array();
    $query3 = $this->db->query("SELECT * FROM table_anggota WHERE kode_user = '$row->kode_user' AND tipe = 'Tenaga Pelatihan Tetap' AND jenis_kelamin = 'Laki-laki' LIMIT 1")->result_array();
    $query4 = $this->db->query("SELECT * FROM table_anggota WHERE kode_user = '$row->kode_user' AND tipe = 'Tenaga Pelatihan Tetap' AND jenis_kelamin = 'Perempuan' LIMIT 1")->result_array();
    $query5 = $this->db->query("SELECT * FROM table_anggota WHERE kode_user = '$row->kode_user' AND tipe = 'Tenaga Pelatihan Tidak Tetap' AND jenis_kelamin = 'Laki-laki' LIMIT 1")->result_array();
    $query6 = $this->db->query("SELECT * FROM table_anggota WHERE kode_user = '$row->kode_user' AND tipe = 'Tenaga Pelatihan Tidak Tetap' AND jenis_kelamin = 'Perempuan' LIMIT 1")->result_array();
    $query7 = $this->db->query("SELECT * FROM table_anggota WHERE kode_user = '$row->kode_user' AND tipe = 'Instruktur Tetap' AND jenis_kelamin = 'Laki-laki' LIMIT 1")->result_array();
    $query8 = $this->db->query("SELECT * FROM table_anggota WHERE kode_user = '$row->kode_user' AND tipe = 'Instruktur Tetap' AND jenis_kelamin = 'Perempuan' LIMIT 1")->result_array();
    $query9 = $this->db->query("SELECT * FROM table_anggota WHERE kode_user = '$row->kode_user' AND tipe = 'Instruktur Tidak Tetap' AND jenis_kelamin = 'Laki-laki' LIMIT 1")->result_array();
    $query10 = $this->db->query("SELECT * FROM table_anggota WHERE kode_user = '$row->kode_user' AND tipe = 'Instruktur Tidak Tetap' AND jenis_kelamin = 'Perempuan' LIMIT 1")->result_array();
    $query11 = $this->db->query("SELECT * FROM table_anggota WHERE kode_user = '$row->kode_user' AND tipe = 'Asesor Kompetensi' AND jenis_kelamin = 'Perempuan' LIMIT 1")->result_array();
    $query12 = $this->db->query("SELECT * FROM table_anggota WHERE kode_user = '$row->kode_user' AND tipe = 'Asesor Kompetensi' AND jenis_kelamin = 'Perempuan' LIMIT 1")->result_array();
    $query13 = $this->db->query("SELECT * FROM table_anggota WHERE kode_user = '$row->kode_user' AND tipe = 'Instruktur/Asesor WNA' AND jenis_kelamin = 'Laki-laki' LIMIT 1")->result_array();
    $query14 = $this->db->query("SELECT * FROM table_anggota WHERE kode_user = '$row->kode_user' AND tipe = 'Instruktur/Asesor WNA' AND jenis_kelamin = 'Perempuan' LIMIT 1")->result_array();
    ?>
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
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">                                            
                    <div class="modal-body">
                        <div class="tab tab-border nav-center">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true"> <i class="fa fa-home"></i> Laporan</a>
                                </li>
                                <!--<li class="nav-item">-->
                                <!--    <a class="nav-link" id="pengembangan-pelatihan-tab" data-toggle="tab" href="#pengembangan-pelatihan" role="tab" aria-controls="pengembangan-pelatihan"> <i class="fa fa-home"></i> Pengembangan Pelatihan</a>-->
                                <!--</li>-->
                                <!--<li class="nav-item">-->
                                <!--    <a class="nav-link" id="penyelenggaraan-pelatihan-tab" data-toggle="tab" href="#penyelenggaraan-pelatihan" role="tab" aria-controls="penyelenggaraan-pelatihan"> <i class="fa fa-home"></i> Penyelenggaraan Pelatihan</a>-->
                                <!--</li>-->
                                <!--<li class="nav-item">-->
                                <!--    <a class="nav-link" id="penyelenggaran-uji-kompetensi-tab" data-toggle="tab" href="#penyelenggaraan-uji-kompetensi" role="tab" aria-controls="penyelenggaran-uji-kompetensi" aria-selected="true"> <i class="fa fa-home"></i> Penyelenggaraan Uji Kompetensi</a>-->
                                <!--</li>-->
                                <!--<li class="nav-item">-->
                                <!--    <a class="nav-link" id="pengembangan-kelembagaan-tab" data-toggle="tab" href="#pengembangan-kelembagaan" role="tab" aria-controls="pengembangan-kelembagaan" aria-selected="true"> <i class="fa fa-home"></i> Pengembangan kelembagaan dan SDM</a>-->
                                <!--</li>-->
                                <!--<li class="nav-item">-->
                                <!--    <a class="nav-link" id="kemitraan-tab" data-toggle="tab" href="#kemitraan" role="tab" aria-controls="kemitraan" aria-selected="true"> <i class="fa fa-home"></i> Kemitraan</a>-->
                                <!--</li>-->
                                <!--<li class="nav-item">-->
                                <!--    <a class="nav-link" id="dokumentasi-tab" data-toggle="tab" href="#dokumentasi" role="tab" aria-controls="dokumentasi" aria-selected="true"> <i class="fa fa-home"></i> Dokumentasi</a>-->
                                <!--</li>-->
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
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
                                                <label class="control-label">Alamat <span style="color:red" title="Wajib Diisi">*</span></label>
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
                                                    <input type="radio" id="customRadioInline3" name="jenis" class="custom-control-input" value="Pemerintah" required <?php if ($row->jenis == 'Pemerintah') {echo 'checked';} ?>>
                                                    <label class="custom-control-label" for="customRadioInline3">Pemerintah</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="customRadioInline4" name="jenis" class="custom-control-input" value="Swasta" required <?php if ($row->jenis == 'Swasta') {echo 'checked';} ?>>
                                                    <label class="custom-control-label" for="customRadioInline4">Swasta</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="customRadioInline5" name="jenis" class="custom-control-input" value="Perusahaan" required <?php if ($row->jenis == 'Perusahaan') {echo 'checked';} ?>>
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
                                        <!-- <div class="col-12">
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
                                        </div> -->
                                    </fieldset>
                                    <fieldset class="col-md-12 mt-10">
                                        <legend>Data Pimpinan</legend>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="control-label">Nama Pimpinan <span style="color:red" title="Wajib Diisi">*</span></label>
                                                <input type="text" value="<?= $row->nama_pimpinan; ?>" name="nama_pimpinan" class="form-control" placeholder="Nama Pimpinan" required="" autocomplete="off"/>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="control-label">No. Telepon Pimpinan <span style="color:red" title="Wajib Diisi">*</span></label>
                                                <input type="text" value="<?= $row->no_telepon_pimpinan; ?>" name="no_telepon_pimpinan" class="form-control" placeholder="(+62) ..." required="" autocomplete="off" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="control-label">Nama Penanggung Jawab <span style="color:red" title="Wajib Diisi">*</span></label>
                                                <input type="text" value="<?= $row->nama_pj; ?>" name="nama_pj" class="form-control" placeholder="Nama Pimpinan" required="" autocomplete="off" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="control-label">Jabatan Penanggung Jawab <span style="color:red" title="Wajib Diisi">*</span></label>
                                                <input type="text" value="<?= $row->jabatan_pj; ?>" name="jabatan_pj" class="form-control" placeholder="Nama Pimpinan" required="" autocomplete="off" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="control-label">No. Telepon Penanggung Jawab <span style="color:red" title="Wajib Diisi">*</span></label>
                                                <input type="text" value="<?= $row->no_telepon_pj; ?>" name="no_telepon_pj" class="form-control" placeholder="(+62) ..." required="" autocomplete="off" />
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset class="col-md-12 mt-10">
                                        <legend>Data Pengurus</legend>
                                        <table class="table table-striped table-responsive">
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
                                <!--<div class="tab-pane active" id="pengembangan-pelatihan" role="tabpanel" aria-labelledby="profile-tab">-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div data-role="dynamic-fields">
                                                <div class="form-biasa">
                                                    <fieldset>
                                                        <legend>Pengembangan Pelatihan</legend>
                                                        <div class="form-group">
                                                            <label  for="field-name">Nama Program</label>
                                                            <input type="text" class="form-control" id="field-name" placeholder="Nama Program" name="nama_program[]" autocomplete="off">
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label  for="field-value">Inisiator</label>
                                                            <input type="text" class="form-control" id="field-value" placeholder="Inisiator" name="inisiator_program[]" autocomplete="off">
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label  for="field-value">Durasi Pelatihan</label>
                                                            <input type="text" class="form-control" id="field-value" placeholder="Durasi Pelatihan" name="durasi_pelatihan_program[]" autocomplete="off">
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label  for="field-value">Standar Kompetensi</label>
                                                            <input type="text" class="form-control" id="field-value" placeholder="Standar Kompetensi" name="standar_kompetensi_program[]" autocomplete="off">
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label  for="field-value">Keterangan</label>
                                                            <textarea class="form-control" name="keterangan_program[]"></textarea>
                                                        </div>
                                                        <button class="btn btn-danger m-2 float-right" data-role="remove">
                                                            -
                                                        </button>
                                                        <button class="btn btn-primary m-2 float-right" data-role="add">
                                                            +
                                                        </button>
                                                    </fieldset>
                                                </div>  <!-- /div.form-biasa -->
                                            </div>  <!-- /div[data-role="dynamic-fields"] -->
                                        </div>  <!-- /div.col-md-12 -->
                                    </div>  <!-- /div.row -->
                                <!--</div>-->
                                <!--<div class="tab-pane active" id="penyelenggaraan-pelatihan" role="tabpanel" aria-labelledby="profile-tab">-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div data-role="dynamic-fields">
                                                <div class="form-biasa">
                                                    <fieldset>
                                                        <legend>Penyelenggaraan Pelatihan</legend>
                                                        <div class="form-group">
                                                            <label  for="field-name">Nama Program</label>
                                                            <input type="text" class="form-control" id="field-name" placeholder="Nama Program" name="nama_program_penyelenggara[]" autocomplete="off">
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label  for="field-value">Jadwal Pelaksanaan</label>
                                                            <input type="text" class="form-control" id="field-value" placeholder="Jadwal Pelaksanaan" name="jadwal_pelaksanaan_penyelenggara[]" autocomplete="off">
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label  for="field-value">Jumlah Peserta</label>
                                                            <input type="number" class="form-control" id="field-value" name="jumlah_peserta_penyelenggara[]" autocomplete="off">
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label  for="field-value">Jumlah Lulusan</label>
                                                            <input type="number" class="form-control" id="field-value" name="jumlah_lulusan_penyelenggara[]" autocomplete="off">
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label  for="field-value">Keterangan</label>
                                                            <textarea class="form-control" name="keterangan_penyelenggara[]"></textarea>
                                                        </div>
                                                        <button class="btn btn-danger m-2 float-right" data-role="remove">
                                                            -
                                                        </button>
                                                        <button class="btn btn-primary m-2 float-right" data-role="add">
                                                            +
                                                        </button>
                                                    </fieldset>
                                                </div>  <!-- /div.form-biasa -->
                                            </div>  <!-- /div[data-role="dynamic-fields"] -->
                                        </div>  <!-- /div.col-md-12 -->
                                    </div>  <!-- /div.row -->
                                <!--</div>-->
                                <!--<div class="tab-pane fade active" id="penyelenggaraan-uji-kompetensi" role="tabpanel" aria-labelledby="profile-tab">-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div data-role="dynamic-fields">
                                                <div class="form-biasa">
                                                    <fieldset>
                                                        <legend>Penyelenggaraan Uji Kompetensi</legend>
                                                        <div class="form-group">
                                                            <label  for="field-name">Nama LSP</label>
                                                            <input type="text" class="form-control" id="field-name" placeholder="Nama LSP" name="nama_lsp[]" autocomplete="off">
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label  for="field-value">Skema Sertifikasi</label>
                                                            <input type="text" class="form-control" id="field-value" placeholder="Skema Sertifikasi" name="skema_sertifikasi_lsp[]" autocomplete="off">
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label  for="field-value">Jadwal Pelaksanaan</label>
                                                            <input type="text" class="form-control" id="field-value" placeholder="Jadwal Pelaksanaan" name="jadwal_pelaksanaan_lsp[]" autocomplete="off">
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label  for="field-value">Jumlah Peserta</label>
                                                            <input type="number" class="form-control" id="field-value" name="jumlah_peserta_lsp[]" autocomplete="off">
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label  for="field-value">Keterangan</label>
                                                            <textarea class="form-control" name="keterangan_lsp[]" autocomplete="off"></textarea>
                                                        </div>
                                                        <button class="btn btn-danger m-2 float-right" data-role="remove">
                                                            -
                                                        </button>
                                                        <button class="btn btn-primary m-2 float-right" data-role="add">
                                                            +
                                                        </button>
                                                    </fieldset>
                                                </div>  <!-- /div.form-biasa -->
                                            </div>  <!-- /div[data-role="dynamic-fields"] -->
                                        </div>  <!-- /div.col-md-12 -->
                                    </div>  <!-- /div.row -->
                                <!--</div>-->
                                <!--<div class="tab-pane fade active" id="pengembangan-kelembagaan" role="tabpanel" aria-labelledby="profile-tab">-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div data-role="dynamic-fields">
                                                <div class="form-biasa">
                                                    <fieldset>
                                                        <legend>Pengembangan Kelembagaan dan SDM</legend>
                                                        <div class="form-group">
                                                            <label  for="field-name">Nama Kegiatan</label>
                                                            <input type="text" class="form-control" id="field-name" placeholder="Nama Kegiatan" name="nama_kegiatan_sdm[]" autocomplete="off">
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label  for="field-value">Jadwal</label>
                                                            <input type="text" class="form-control" id="field-value" placeholder="Jadwal" name="jadwal_sdm[]" autocomplete="off">
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label  for="field-value">Lokasi</label>
                                                            <input type="text" class="form-control" id="field-value" placeholder="Lokasi" name="lokasi_sdm[]" autocomplete="off">
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label  for="field-value">Penyelenggara</label>
                                                            <input type="text" class="form-control" id="field-value" placeholder="Penyelenggara" name="penyelenggara_sdm[]" autocomplete="off">
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label  for="field-value">Keterangan</label>
                                                            <textarea class="form-control" name="keterangan_sdm[]" autocomplete="off"></textarea>
                                                        </div>
                                                        <button class="btn btn-danger m-2 float-right" data-role="remove">
                                                            -
                                                        </button>
                                                        <button class="btn btn-primary m-2 float-right" data-role="add">
                                                            +
                                                        </button>
                                                    </fieldset>
                                                </div>  <!-- /div.form-biasa -->
                                            </div>  <!-- /div[data-role="dynamic-fields"] -->
                                        </div>  <!-- /div.col-md-12 -->
                                    </div>  <!-- /div.row -->
                                <!--</div>-->
                                <!--<div class="tab-pane fade active" id="kemitraan" role="tabpanel" aria-labelledby="profile-tab">-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div data-role="dynamic-fields">
                                                <div class="form-biasa">
                                                    <fieldset>
                                                        <legend>Kemitraan</legend>
                                                        <div class="form-group">
                                                            <label  for="field-name">Nama Mitra</label>
                                                            <input type="text" class="form-control" id="field-name" placeholder="Nama Mitra" name="nama_mitra[]" autocomplete="off">
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label  for="field-value">Alamat</label>
                                                            <input type="text" class="form-control" id="field-value" placeholder="Alamat" name="alamat_mitra[]" autocomplete="off">
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label  for="field-value">Bentuk Kemitraan</label>
                                                            <input type="text" class="form-control" id="field-value" placeholder="Bentuk Kemitraan" name="bentuk_kemitraan[]" autocomplete="off">
                                                        </div>
                                                        <button class="btn btn-danger m-2 float-right" data-role="remove">
                                                            -
                                                        </button>
                                                        <button class="btn btn-primary m-2 float-right" data-role="add">
                                                            +
                                                        </button>
                                                    </fieldset>
                                                </div>  <!-- /div.form-biasa -->
                                            </div>  <!-- /div[data-role="dynamic-fields"] -->
                                        </div>  <!-- /div.col-md-12 -->
                                    </div>  <!-- /div.row -->
                                <!--</div>-->
                                <!--<div class="tab-pane fade active" id="dokumentasi" role="tabpanel" aria-labelledby="profile-tab">-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div data-role="dynamic-fields">
                                                <div class="form-biasa">
                                                    <fieldset>
                                                        <legend>Dokumentasi</legend>
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
                                                </div>  
                                            </div> 
                                        </div>  
                                    </div>  
                                <!--</div>-->
                            </div>
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

<script type="text/javascript">
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
  });
</script>
<script type="text/javascript">
    $(function() {
    // Remove button click
    $(document).on(
        'click',
        '[data-role="dynamic-fields"] > .form-biasa [data-role="remove"]',
        function(e) {
            e.preventDefault();
            $(this).closest('.form-biasa').remove();
        }
        );
    // Add button click
    $(document).on(
        'click',
        '[data-role="dynamic-fields"] > .form-biasa [data-role="add"]',
        function(e) {
            e.preventDefault();
            var container = $(this).closest('[data-role="dynamic-fields"]');
            new_field_group = container.children().filter('.form-biasa:first-child').clone();
            new_field_group.find('input').each(function(){
                $(this).val('');
            });
            container.append(new_field_group);
        }
        );
});
</script>