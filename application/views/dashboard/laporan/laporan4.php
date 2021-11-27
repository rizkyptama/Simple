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
      font-size: 11px;
    }

    .table-condensed thead td{
      text-align: center;
      border-left : 1px solid #999999;
      border-right: 1px solid #999999;
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
                          DAFTAR STATUS PESERTA PELATIHAN TAHUN 2019
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
                              <strong>Tingkat Pendidikan</strong>
                            </td>
                            <td colspan="2">
                              <strong>Jenis Kelamin</strong>
                            </td>
                            <td colspan="12">
                              <strong>Kecamatan</strong>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <strong>Laki-laki</strong>
                            </td>
                            <td>
                              <strong>Perempuan</strong>
                            </td>
                            <td>
                              <strong>SAWANGAN</strong>
                            </td>
                            <td>
                              <strong>BOJONGSARI</strong>
                            </td>
                            <td>
                              <strong>PANCORAN MAS</strong>
                            </td>
                            <td>
                              <strong>CIPAYUNG</strong>
                            </td>
                            <td>
                              <strong>SUKMA JAYA</strong>
                            </td>
                            <td>
                              <strong>CILODONG</strong>
                            </td>
                            <td>
                              <strong>CIMANGGIS</strong>
                            </td>
                            <td>
                              <strong>TAPOS</strong>
                            </td>
                            <td>
                              <strong>BEJI</strong>
                            </td>
                            <td>
                              <strong>LIMO</strong>
                            </td>
                            <td>
                              <strong>CINERE</strong>
                            </td>
                            <td>
                              <strong>DST</strong>
                            </td>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            $total = new stdClass();
                            $total->l = 0;
                            $total->p = 0;
                            $total->SAWANGAN = 0;
                            $total->BOJONGSARI = 0;
                            $total->PANCORANMAS = 0;
                            $total->CIPAYUNG = 0;
                            $total->SUKMAJAYA = 0;
                            $total->CILODONG = 0;
                            $total->CIMANGGIS = 0;
                            $total->TAPOS = 0;
                            $total->BEJI = 0;
                            $total->LIMO = 0;
                            $total->CINERE = 0;
                            $total->DST = 0;
                            foreach ($dataLaporan as $laporan) :
                          ?>
                            <tr>
                              <td><?= $laporan->terakhir  ?> </td>
                              <td><?= $laporan->l ?> </td>
                              <td><?= $laporan->p ?> </td>
                              <td><?= $laporan->SAWANGAN ?> </td>
                              <td><?= $laporan->BOJONGSARI ?> </td>
                              <td><?= $laporan->PANCORANMAS ?> </td>
                              <td><?= $laporan->CIPAYUNG ?> </td>
                              <td><?= $laporan->SUKMAJAYA ?> </td>
                              <td><?= $laporan->CILODONG ?> </td>
                              <td><?= $laporan->CIMANGGIS ?> </td>
                              <td><?= $laporan->TAPOS ?> </td>
                              <td><?= $laporan->BEJI ?> </td>
                              <td><?= $laporan->LIMO ?> </td>
                              <td><?= $laporan->CINERE ?> </td>
                              <td><?= $laporan->DST ?> </td>
                            </tr>
                          <?php 
                            $total->l += $laporan->l;
                            $total->p += $laporan->p;
                            $total->SAWANGAN += $laporan->SAWANGAN;
                            $total->BOJONGSARI += $laporan->BOJONGSARI;
                            $total->PANCORANMAS += $laporan->PANCORANMAS;
                            $total->CIPAYUNG += $laporan->CIPAYUNG;
                            $total->SUKMAJAYA += $laporan->SUKMAJAYA;
                            $total->CILODONG += $laporan->CILODONG;
                            $total->CIMANGGIS += $laporan->CIMANGGIS;
                            $total->TAPOS += $laporan->TAPOS;
                            $total->BEJI += $laporan->BEJI;
                            $total->LIMO += $laporan->LIMO;
                            $total->CINERE += $laporan->CINERE;
                            $total->DST += $laporan->DST;
                            endforeach; 
                          ?>
                          <tr>
                              <td>Total </td>
                              <td><?= $total->l ?> </td>
                              <td><?= $total->p ?> </td>
                              <td><?= $total->SAWANGAN ?> </td>
                              <td><?= $total->BOJONGSARI ?> </td>
                              <td><?= $total->PANCORANMAS ?> </td>
                              <td><?= $total->CIPAYUNG ?> </td>
                              <td><?= $total->SUKMAJAYA ?> </td>
                              <td><?= $total->CILODONG ?> </td>
                              <td><?= $total->CIMANGGIS ?> </td>
                              <td><?= $total->TAPOS ?> </td>
                              <td><?= $total->BEJI ?> </td>
                              <td><?= $total->LIMO ?> </td>
                              <td><?= $total->CINERE ?> </td>
                              <td><?= $total->DST ?> </td>
                            </tr>
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