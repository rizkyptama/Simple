<!-- <!DOCTYPE html> -->
<!-- <html> -->
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Laporan BKK</title>
  <style>
    table{
      border-collapse: collapse;
      border-spacing: 0;
      width: 100%;
      border: 1px solid #ddd;
    }

    .table-condensed td{
      border-top : 1px solid #999999;
      padding: 3px 5px;
    }

    .table-condensed tr:nth-child(even) {
      background-color: #f2f2f2;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-statistics">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="card-heading" style="text-align:center;">
                        <h3 class="card-title">
                          DAFTAR NAMA PESERTA PELATIHAN TAHUN 2019
                          <br>
                          KEGIATAN PELATIHAN BERBASIS KOMPETENSI
                        </h3>
                    </div>
                </div>
                <div class="card-body">
                  <div class="datatable-wrapper table-responsive" style="margin-top:20px; margin-bottom:30px;">
                      <table class="table table-condensed">
                        <thead>
                          <tr>
                            <td><strong>Periode : </strong></td>
                            <td>
                              <strong>
                                <?php if (!empty($tgl_awal)) {
                                  echo $tgl_awal;
                                }?>
                              </strong>
                            </td>
                            <td><strong>Sampai : </strong></td>
                            <td>
                              <strong>
                                <?php if (!empty($tgl_akhir)) {
                                  echo $tgl_akhir;
                                }?>
                              <strong
                            ></td>
                          </tr>
                      </table>
                    </div>
                    <!-- <div class="form-group">
                        <button id="btn-reset" class="btn btn-sm btn-info">Refresh Table</button>
                    </div> -->
                    <div class="datatable-wrapper table-responsive">
                      <table class="table table-condensed">
                        <thead>
                          <tr>
                            <td>
                              <strong>NIK</strong>
                            </td>
                            <td>
                              <strong>No Kartu Keluarga</strong>
                            </td>
                            <td>
                              <strong>Nama</strong>
                            </td>
                            <td>
                              <strong>Jenis Kelamin</strong>
                            </td>
                            <td>
                              <strong>Alamat</strong>
                            </td>
                            <td>
                              <strong>Kelurahan</strong>
                            </td>
                            <td>
                              <strong>Tempat Tanggall Lahir</strong>
                            </td>
                            <td>
                              <strong>No Telepon</strong>
                            </td>
                            <td>
                              <strong>Pendidikan Terakhir</strong>
                            </td>
                            <td>
                              <strong>Jenis Pelatihaan </strong>
                            </td>
                            <td>
                              <strong>No Pencaker</strong>
                            </td>
                            <td>
                              <strong>Keterangan</strong>
                            </td>

                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($dataLaporan as $laporan) :?>
                            <tr>
                              <td><?= $laporan->nik ?> </td>
                              <td><?= $laporan->kk ?> </td>
                              <td><?= $laporan->nama ?> </td>
                              <td><?= $laporan->jenis_kelamin ?> </td>
                              <td><?= $laporan->alamat ?> </td>
                              <td><?= $laporan->kelurahan ?> </td>
                              <td><?= $laporan->tempat_lahir." ".$laporan->tanggal_lahir ?> </td>
                              <td><?= $laporan->no_telepon ?> </td>
                              <td><?= $laporan->pendidikan_terakhir ?> </td>
                              <td><?= $laporan->jenis ?> </td>
                              <td><?= $laporan->no_pencaker ?> </td>
                              <td><?= $laporan->keterangan ?> </td>
                            </tr>
                          <?php endforeach; ?>
                        </tbody>

                      </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

  </div>
</body>
</html>