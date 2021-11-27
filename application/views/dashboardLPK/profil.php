<?= $this->session->flashdata('notif');?>
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
    <div class="row account-contant">
        <div class="col-12">
            <div class="card card-statistics">
                <center>
                    <img class="p-20" src="<?= base_url();?>assets/upload/logo/<?= $row->photo; ?>" alt="<?= $row->photo; ?>" width="30%" height="30%">
                </center>
                <div class="card-body">
                    <form method="POST" action="<?= base_url('DashboardLPK/ubahProfil'); ?>" enctype="multipart/form-data">
                        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                        <input type="hidden" name="kode" value="<?= $row->kode_user; ?>">
                        <div class="tab tab-border">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true"> <i class="fa fa-home"></i> Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pengurus-tab" data-toggle="tab" href="#pengurus" role="tab" aria-controls="pengurus" aria-selected="false"><i class="fa fa-user"></i> Pengurus </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="detail-tab" data-toggle="tab" href="#detail" role="tab" aria-controls="detail" aria-selected="false"><i class="fa fa-list"></i> Detail </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="form-group">
                                        <label>No. Izin</label>
                                        <input type="text" name="no_izin" value="<?= $row->no_izin ?>" class="form-control" autocomplete="off" >
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal izin</label>
                                        <input type="date" name="tgl_izin" value="<?= $row->tanggal_izin ?>" class="form-control" autocomplete="off" >
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Lembaga</label>
                                        <input type="text" name="nama" value="<?= $row->nama; ?>" class="form-control" autocomplete="off" >
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <textarea class="form-control" name="alamat" autocomplete="off" ><?= $row->alamat ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Telepon</label>
                                        <input type="text" name="no_telepon" value="<?= $row->telepon ?>" class="form-control" autocomplete="off" >
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" value="<?= $row->email ?>" class="form-control" autocomplete="off" >
                                    </div>
                                    <div class="form-group">
                                        <label>Logo Perusahaan</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFile"  name="logo" autocomplete="off" required>
                                            <label class="custom-file-label" for="customFile">Pilih File (Ukuran Disarankan 349x200 pixel)</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pengurus" role="tabpanel" aria-labelledby="pengurus-tab">
                                    <div class="form-group">
                                        <label>Nama Direktur Lembaga</label>
                                        <input type="text" name="nama_pimpinan" value="<?= $row->nama_pimpinan ?>" class="form-control" autocomplete="off" >
                                    </div>
                                    <div class="form-group">
                                        <label>No Direktur Lembaga</label>
                                        <input type="text" name="no_telepon_pimpinan" value="<?= $row->no_telepon_pimpinan ?>" class="form-control" autocomplete="off" >
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Penanggung Jawab Lembaga</label>
                                        <input type="text" name="nama_pj" value="<?= $row->nama_pj ?>" class="form-control" autocomplete="off" >
                                    </div>
                                    <div class="form-group">
                                        <label>Jabatan Penanggung Jawab Lembaga</label>
                                        <input type="text" name="jabatan_pj" value="<?= $row->jabatan_pj ?>" class="form-control" autocomplete="off" >
                                    </div>
                                    <div class="form-group">
                                        <label>No Penanggung Jawab Lembaga</label>
                                        <input type="text" name="no_telepon_pj" value="<?= $row->no_telepon_pj ?>" class="form-control" autocomplete="off" >
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Kelembagaan</label>
                                        <select class="form-control"  name="jenis">
                                            <option <?php if ($row->jenis == 'Pemerintah') {echo 'selected';} ?>>Pemerintah</option>
                                            <option <?php if ($row->jenis == 'Swasta') {echo 'selected';} ?>>Swasta</option>
                                            <option <?php if ($row->jenis == 'Perusahaan') {echo 'selected';} ?>>Perusahaan</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Ruang Lingkup Lembaga</label>
                                        <input type="text" name="ruang_lingkup" value="<?= $row->ruang_lingkup; ?>" class="form-control" autocomplete="off" >
                                    </div>
                                    <div class="form-group">
                                        <label>Status Akreditasi</label>
                                        <input type="text" name="status_akreditas" value="<?= $row->status_akreditas; ?>" class="form-control" autocomplete="off" >
                                    </div>
                                    <div class="form-group">
                                        <label>No. Akreditasi</label>
                                        <input type="text" name="no_akreditas" value="<?= $row->no_akreditas; ?>" class="form-control" autocomplete="off" >
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="detail" role="tabpanel" aria-labelledby="detail-tab">
                                    <div class="accordion" id="accordionsimplefill">
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
                                                                <input type="hidden" name="id[]" value="<?= $query1[0]['id']; ?>">
                                                                <input type="number" name="jumlah[]" value="<?= $query1[0]['jumlah']; ?>" class="form-control" autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Perempuan</label>
                                                                <input type="hidden" name="id[]" value="<?= $query2[0]['id']; ?>">
                                                                <input type="number" name="jumlah[]" value="<?= $query2[0]['jumlah']; ?>" class="form-control" autocomplete="off">
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
                                                                <input type="hidden" name="id[]" value="<?= $query3[0]['id']; ?>">
                                                                <input type="number" name="jumlah[]" value="<?= $query3[0]['jumlah']; ?>" class="form-control" autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Perempuan</label>
                                                                <input type="hidden" name="id[]" value="<?= $query4[0]['id']; ?>">
                                                                <input type="number" name="jumlah[]" value="<?= $query4[0]['jumlah']; ?>" class="form-control" autocomplete="off">
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
                                                                <input type="hidden" name="id[]" value="<?= $query5[0]['id']; ?>">
                                                                <input type="number" name="jumlah[]" value="<?= $query5[0]['jumlah']; ?>" class="form-control" autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Perempuan</label>
                                                                <input type="hidden" name="id[]" value="<?= $query6[0]['id']; ?>">
                                                                <input type="number" name="jumlah[]" value="<?= $query6[0]['jumlah']; ?>" class="form-control" autocomplete="off">
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
                                                                <input type="hidden" name="id[]" value="<?= $query7[0]['id']; ?>">
                                                                <input type="number" name="jumlah[]" value="<?= $query7[0]['jumlah']; ?>" class="form-control" autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Perempuan</label>
                                                                <input type="hidden" name="id[]" value="<?= $query8[0]['id']; ?>">
                                                                <input type="number" name="jumlah[]" value="<?= $query8[0]['jumlah']; ?>" class="form-control" autocomplete="off">
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
                                                                <input type="hidden" name="id[]" value="<?= $query9[0]['id']; ?>">
                                                                <input type="number" name="jumlah[]" value="<?= $query9[0]['jumlah']; ?>" class="form-control" autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Perempuan</label>
                                                                <input type="hidden" name="id[]" value="<?= $query10[0]['id']; ?>">
                                                                <input type="number" name="jumlah[]" value="<?= $query10[0]['jumlah']; ?>" class="form-control" autocomplete="off">
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
                                                                <input type="hidden" name="id[]" value="<?= $query11[0]['id']; ?>">
                                                                <input type="number" name="jumlah[]" value="<?= $query11[0]['jumlah']; ?>" class="form-control" autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Perempuan</label>
                                                                <input type="hidden" name="id[]" value="<?= $query12[0]['id']; ?>">
                                                                <input type="number" name="jumlah[]" value="<?= $query12[0]['jumlah']; ?>" class="form-control" autocomplete="off">
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
                                                                <input type="hidden" name="id[]" value="<?= $query13[0]['id']; ?>">
                                                                <input type="number" name="jumlah[]" value="<?= $query13[0]['jumlah']; ?>" class="form-control" autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Perempuan</label>
                                                                <input type="hidden" name="id[]" value="<?= $query14[0]['id']; ?>">
                                                                <input type="number" name="jumlah[]" value="<?= $query14[0]['jumlah']; ?>" class="form-control" autocomplete="off">
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
                        <button type="submit" class="btn btn-success float-right">Simpan</button>
                    </form>
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