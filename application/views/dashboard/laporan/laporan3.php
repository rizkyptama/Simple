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
                          LAPORAN REKAPITULASI KEGIATAN LEMBAGA PELATIHAN KERJA
                        </h3>
                    </div>
                </div>
                <div class="card-body">
                  <!-- <div class="datatable-wrapper table-responsive" style="margin-top:20px; margin-bottom:30px;">
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
                    </div> -->
                    <!-- <div class="form-group">
                        <button id="btn-reset" class="btn btn-sm btn-info">Refresh Table</button>
                    </div> -->
                    <div class="datatable-wrapper table-responsive">
                      <table class="table table-condensed">
                        <thead>
                          <tr>
                            <td rowspan="2">
                              <strong>No</strong>
                            </td>
                            <td rowspan="2">
                              <strong>Nama LPK</strong>
                            </td>
                            <td rowspan="2">
                              <strong>No Registrasi</strong>
                            </td>
                            <td rowspan="2">
                              <strong>Alamat Kantor/Telp/Fax/Email</strong>
                            </td>
                            <td rowspan="2">
                              <strong>Nomor & tgl izin atau Tanda Daftar</strong>
                            </td>
                            <td rowspan="2">
                              <strong>Nama Kepala LPK dan No Telp/HP</strong>
                            </td>
                            <td colspan="3">
                              <strong>Program Pelatihan yang diselenggarakan</strong>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <strong>Nama Program</strong>
                            </td>
                            <td>
                              <strong>Jumlah Peserta</strong>
                            </td>
                            <td>
                              <strong>Jumlah Lulusan</strong>
                            </td>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($dataLpk as $lpk) :?>
                            <tr>
                              <td><?= $lpk->no ?> </td>
                              <td><?= $lpk->nama_lpk ?> </td>
                              <td><?= $lpk->no_reg ?> </td>
                              <td><?= $lpk->alamat ?> </td>
                              <td><?= $lpk->no_izin." ".$lpk->tanggal_izin ?> </td>
                              <td><?= $lpk->nama_pimpinan." ".$lpk->no_telepon_pimpinan ?> </td>
                              <td><?= $lpk->nama_program ?> </td>
                              <td><?= $lpk->jumlah_peserta ?> </td>
                              <td><?= $lpk->jumlah_lulusan ?> </td>
                            </tr>
                          <?php endforeach; ?>
                        </tbody>

                      </table>
                    </div>

                    <div class="datatable-wrapper table-responsive" style="margin-top:30px;">
                      <table class="table table-condensed">
                        <thead>
                          <tr>
                            <td rowspan="2" colspan="4">
                              <strong>Sebagai Tempat Uji Kompetensi</strong>
                            </td>
                            <td rowspan="1" colspan="8">
                              <strong>Jumlah Karyawan</strong>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="2">
                              <strong>Tenaga Pelatihan Tetap</strong>
                            </td>
                            <td colspan="2">
                              <strong>Tenaga Pelatihan Tidak Tetap</strong>
                            </td>
                            <td colspan="2">
                              <strong>Instruktur Tetap</strong>
                            </td>
                            <td colspan="2">
                              <strong>Instruktur Tidak Tetap</strong>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <strong>Kejuruan</strong>
                            </td>
                            <td>
                              <strong>Skema Sertifikasi</strong>
                            </td>
                            <td>
                              <strong>Kapasitas</strong>
                            </td>
                            <td>
                              <strong>Nama LSP</strong>
                            </td>
                            <td>
                              <strong>L</strong>
                            </td>
                            <td>
                              <strong>P</strong>
                            </td>
                            <td>
                              <strong>L</strong>
                            </td>
                            <td>
                              <strong>P</strong>
                            </td>
                            <td>
                              <strong>L</strong>
                            </td>
                            <td>
                              <strong>P</strong>
                            </td>
                            <td>
                              <strong>L</strong>
                            </td>
                            <td>
                              <strong>P</strong>
                            </td>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($dataBlkln as $blkln) :?>
                            <tr>
                              <td><?= $blkln->kejuruan ?> </td>
                              <td><?= $blkln->skema ?> </td>
                              <td><?= $blkln->kapasitas ?> </td>
                              <td><?= $blkln->nama ?> </td>
                              <td><?= $blkln->tptp ?> </td>
                              <td><?= $blkln->tptl ?> </td>
                              <td><?= $blkln->tpttp ?> </td>
                              <td><?= $blkln->tpttl ?> </td>
                              <td><?= $blkln->itp ?> </td>
                              <td><?= $blkln->itl ?> </td>
                              <td><?= $blkln->ittp ?> </td>
                              <td><?= $blkln->ittl ?> </td>
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