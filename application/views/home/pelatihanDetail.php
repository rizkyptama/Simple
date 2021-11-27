<section class="ftco-section">
  <div class="container">
    <!-- Tab panes -->
    <div class="col-md-12 mt-5 row">
      <div class="col-md-8">
        <div class="row">
          <div class="col-md-12">
            <?=$this->session->userdata('notif')?>
          </div>
        </div>
        <div class="card">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h3><b><?= $detail[0]->nama;  ?></b></h3>
            <div class="float-right">
              <small><?php $date = date('Y-m-d'); if ($date > $detail[0]->tanggal_berakhir_daftar) { ?> <span class="badge badge-danger">Expired</span><?php } ?></small>
            </div>
          </div>
          <div class="card-body"> 
            <p class="text-justify">Kuota : <?= $detail[0]->kuota;  ?> Peserta</p>
            <p class="text-justify">Standar Kompetensi : <?= $detail[0]->standar_kompetensi;  ?> Peserta</p>
            <p class="text-justify">Keterangan : <?= $detail[0]->keterangan;  ?></p>
            <p class="text-justify">Tanggal Mulai Pelatihan : <?= tanggal_indo($detail[0]->tanggal_mulai_pelatihan, TRUE);  ?></p>
            <p class="text-justify">Tanggal Berakhir Pelatihan : <?= tanggal_indo($detail[0]->tanggal_berakhir_pelatihan, TRUE);  ?></p>
          </div>
          <?php
          $date = date('Y-m-d');
          if ($date <= $detail[0]->tanggal_berakhir_daftar) { ?>
            <div class="card-footer">
              <button class="btn btn-primary"  data-toggle="modal" data-target="#myModalTambahPeserta">Daftar</button>
            </div>
          <?php } ?>
        </div>
      </div>
      <div class="col-md-4">
        <div class="col-md-12">
          <br>
          <h5 class="text-info"><b>Pelatihan Lainnya</b></h5>
          <?php foreach ($lainnya as $row) { ?>
            <div class="card">
              <div class="card-body">
                <h6 class="mb-0"><b><a href="<?= base_url(); ?>Home/pelatihanDetail/<?= $row->kode_pelatihan;  ?>"><?= $row->nama;  ?></a></b></h6>
                <small>Mulai Pelatihan : <?= $row->tanggal_mulai_pelatihan; ?><br>Berakhir Pelatihan : <?= $row->tanggal_berakhir_pelatihan; ?></small>
              </div>
            </div><br>
          <?php } ?>
        </div>
      </div>
    </div>
  </section>
  <?php 
  function tanggal_indo($tanggal, $cetak_hari = false) {
    $hari = array ( 
      1 => 'Senin',
      2 => 'Selasa',
      3 => 'Rabu',
      4 => 'Kamis',
      5 => 'Jumat',
      6 => 'Sabtu',
      7 => 'Minggu'
    );

    $bulan = array (
      1 => 'Januari',
      2 => 'Februari',
      3 => 'Maret',
      4 => 'April',
      5 => 'Mei',
      6 => 'Juni',
      7 => 'Juli',
      8 => 'Agustus',
      9 => 'September',
      10 => 'Oktober',
      11 => 'November',
      12 => 'Desember'
    );
    $split = explode('-', $tanggal);
      // $waktu = explode(' ', $split[2]);
    $tgl_indo = $split[2]. ' ' .$bulan[ (int)$split[1] ]. ' ' . $split[0];


    if ($cetak_hari) {
      $num = date('N', strtotime($tanggal));
      return $hari[$num] . ', ' . $tgl_indo;
    }
    return $tgl_indo;
  }
  ?>


  <!-- The Modal -->
  <div class="modal" id="myModalTambahPeserta">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title">Daftar Pelatihan <?= $detail[0]->nama;  ?></h6>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form action="<?= base_url('Home/daftarPelatihan');?>" method="POST" enctype="multipart/form-data">
        
          <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">

          <input type="hidden" id="id" name="id" value="<?= $detail[0]->kode_pelatihan;  ?>">
          <div class="modal-body">
            <div class="form-group">
              <label>NIK</label>
              <input type="text" id="nik" name="nik" class="form-control" placeholder="NIK" required="" autocomplete="off">
              <button type="button" id="cariNIKButton" class="btn btn-primary btn-block mt-1" onclick="carinik()">Cari</button>
              <hr>
              <h6>*Apabila belum punya Nomor Induk Pencaker,Silahkan Daftar di </h6>
              <a href="http://bkol.depok.go.id/register/2">BKOL Depok</a>
            </div>
            <div class="form-group">
              <label>No. Kartu Keluarga</label>
              <input type="text" id="kk" name="kk" class="form-control" placeholder="No. Kartu Keluarga" required="" autocomplete="off" readonly>
            </div>
            <div class="form-group">
              <label>No. AK1</label>
              <input type="text" id="ak1" name="ak1" class="form-control" placeholder="No. AK1" required="" autocomplete="off" readonly>
            </div>
            <div class="form-group">
              <label>Nama</label>
              <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama" required="" autocomplete="off" readonly>
            </div>
            <div class="form-group">
              <label>Jenis Kelamin</label>
              <input type="text" id="jenis_kelamin" name="jk" class="form-control" placeholder="Jenis Kelamin" required="" autocomplete="off" readonly>
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" id="email" name="email" class="form-control" placeholder="Email" required="" autocomplete="off" readonly>
            </div>
            <div class="form-group">
              <label>No. Telpon/HP</label>
              <input type="text" id="no_telepon" name="no_telepon" class="form-control" placeholder="No. Telepon/HP" required="" autocomplete="off" readonly>
            </div>
            <div class="form-group">
              <label>Alamat</label>
              <textarea class="form-control" id="alamat" name="alamat"  readonly></textarea>
            </div>
            <div class="form-group">
              <label>Kelurahan</label>
              <input type="text" id="kelurahan" name="kelurahan" class="form-control" placeholder="Kelurahan" value="" readonly autocomplete="off">
            </div>
            <div class="form-group">
              <label>Kecamatan</label>
              <input type="text" id="kecamatan" name="kecamatan" class="form-control" placeholder="Kecamatan" value="" readonly autocomplete="off">
            </div>
            <div class="form-group">
              <label>Tempat Lahir</label>
              <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" required="" autocomplete="off" readonly>
            </div>
            <div class="form-group">
              <label>Tanggal Lahir</label>
              <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control" required="" autocomplete="off" readonly>
            </div>
            <div class="form-group">
              <label>Pendidikan Terakhir</label>
              <input type="text" id="pendidikan_terakhir"  name="pendidikan" class="form-control" placeholder="Pendidikan Terakhir" required="" autocomplete="off" readonly>
            </div>
            <div class="form-group">
              <label>Foto</label>
              <input type="file" id="foto" name="foto" class="form-control foto" autocomplete="off">
              <p>Gambar JPG/PNG Max. 2Mb</p>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>


  <!-- The Modal -->
  <div class="modal" id="myModalTambah">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h6 class="modal-title">Daftar Pelatihan <?= $detail[0]->nama;  ?></h6>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form action="<?= base_url('Home/daftarPelatihan');?>" method="POST" enctype="multipart/form-data">
        
        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">

          <input type="hidden" name="id" value="<?= $detail[0]->kode_pelatihan;  ?>">
          <!-- Modal body -->
          <div class="modal-body">
            <div class="form-group">
              <label>NIK</label>
              <input type="text" name="nik" class="form-control" placeholder="NIK" required="" autocomplete="off">
            </div>
            <div class="form-group">
              <label>No. Kartu Keluarga</label>
              <input type="text" name="kk" class="form-control" placeholder="No. Kartu Keluarga" required="" autocomplete="off">
            </div>
            <div class="form-group">
              <label>No. AK1</label>
              <input type="text" name="ak1" class="form-control" placeholder="No. AK1" required="" autocomplete="off">
            </div>
            <div class="form-group">
              <label>Nama</label>
              <input type="text" name="nama" class="form-control" placeholder="Nama" required="" autocomplete="off">
            </div>
            <div class="form-group">
              <label>Jenis Kelamin</label>
              <select class="form-control" name="jk">
                <option hidden="" value="">Silahkan Pilih</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" name="email" class="form-control" placeholder="Email" required="" autocomplete="off">
            </div>
            <div class="form-group">
              <label>No. Telpon/HP</label>
              <input type="text" name="no_telepon" class="form-control" placeholder="No. Telepon/HP" required="" autocomplete="off">
            </div>
            <div class="form-group">
              <label>Alamat</label>
              <textarea class="form-control" name="alamat"></textarea>
            </div>
            <input name="provinsi" type="hidden" class="form-control" value="JAWA BARAT" readonly autocomplete="off">
            <input name="kota" type="hidden" class="form-control" value="KOTA DEPOK" readonly autocomplete="off">
            <div class="form-group">
              <label>Kecamatan</label>
              <select name="kecamatan" class="form-control">
                <option hidden>-Pilih Kecamatan-</option>
              </select>
            </div>
            <div class="form-group">
              <label>Kelurahan</label>
              <select name="kelurahan" class="form-control">
                <option hidden>-Pilih Kelurahan-</option>
              </select>
            </div>
            <div class="form-group">
              <label>Tempat Lahir</label>
              <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" required="" autocomplete="off">
            </div>
            <div class="form-group">
              <label>Tanggal Lahir</label>
              <input type="date" name="tanggal_lahir" class="form-control" required="" autocomplete="off">
            </div>
            <div class="form-group">
              <label>Pendidikan Terakhir</label>
              <select class="form-control" name="pendidikan">
                <option hidden="" value="">Silahkan Pilih</option>
                <option value="SD">SD</option>
                <option value="SMP">SMP</option>
                <option value="SMK">SMK</option>
                <option value="Perguruan Tinggi">Perguruan Tinggi</option>
              </select>
            </div>
            <div class="form-group">
              <label>Foto</label>
              <input type="file" name="foto" class="form-control foto" required="" autocomplete="off">
              <p>Gambar JPG/PNG Max. 2Mb</p>
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
  <script type="text/javascript">
    $(".foto").change(function() {
      if (this.files && this.files[0] && this.files[0].name.match(/\.(jpg|png|jpeg|PNG|JPG|JPEG)$/) ) {
        if(this.files[0].size>2097152) {
          $('.foto').val('');
          alert('Batas Maximal Ukuran File 2MB !');
        }
        else {
          var reader = new FileReader();
          reader.readAsDataURL(this.files[0]);
        }
      } else{
        $('.foto').val('');
        alert('Hanya File jpg/png Yang Diizinkan !');
      }
    });
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
      onChangeProvinsi();
    });
  </script>
  <script type="text/javascript">

    function onChangeProvinsi(){

      var form_data = {}


      $.ajax({
        url: "<?= base_url() ?>Indonesia/get_kecamatan",
        type: "POST",
        data: "form_data",
        dataType: "json",
        success : function(data){
          $("select[name='kecamatan']").empty();
          var option = "<option value='' hidden>-Pilih Kecamatan-</option>";
          $.each(data, function(index, value){
            option += "<option value='"+value.name+"'>"+value.name+"</option>";
          });
        // console.log(data, option);
        $("select[name='kecamatan']").append(option);
      },
      error : function(e){
        console.log(e);
      },
    });

      $("select[name='kecamatan']").change(function(){
        var form_data = {
          districtsId : $(this).val(),
        }

        $.ajax({
          url: "<?= base_url() ?>Indonesia/get_kelurahan",
          type: "POST",
          data: form_data,
          dataType: "json",
          success : function(data){
            $("select[name='kelurahan']").empty();
            var option = "<option value='' hidden>-Pilih Kelurahan-</option>";
            $.each(data, function(index, value){
              option += "<option value='"+value.name+"'>"+value.name+"</option>";
            });
          // console.log(data, option);
          $("select[name='kelurahan']").append(option);
        },
        error : function(e){
          console.log(e);
        },
      });
      });
    }


    function carinik(){
        var nik = $("#nik").val();
        // alert(nik);
        $.ajax({
            url: "<?= base_url();?>Home/getPencakerByNIK",
            type: "POST",
            data: "nik="+nik,
            dataType: "JSON",
            crossDomain: true,
            headers: {
              "Access-Control-Allow-Origin":"*",
              "Access-Control-Allow-Methods":"GET, POST, OPTIONS, PUT, DELETE",
              "Access-Control-Allow-Headers": "Origin, X-Requested-With, Content-Type, Accept"
            },
            success : function(data){
                $("#kk").val(data.data[0].nik);
                $("#ak1").val(data.data[0].noak1);
                $("#nama").val(data.data[0].nama);
                jeniskelamin = "Laki-laki";
                if(data.data[0].jeniskelamin == "0"){
                    jeniskelamin = "Laki-laki";
                }
                else{
                    jeniskelamin = "Perempuan";
                }
                $("#jenis_kelamin").val(jeniskelamin);
                $("#email").val(data.data[0].email);
                $("#no_telepon").val(data.data[0].notelepon);
                $("#alamat").text(data.data[0].alamat);
                $("#kelurahan").val(data.data[0].kelurahan);
                $("#kecamatan").val(data.data[0].kecamatan);
                $("#tempat_lahir").val(data.data[0].tempatlahir);
                $("#tanggal_lahir").val(data.data[0].tgllahir);
                $("#pendidikan_terakhir").val(data.data[0].pendidikanterkahir);
            },
            error : function(e){
                console.log(e);
            },
        });
    }

<?php
    // function carinik(){
    //   $nik = $("#nik").val();
    //   // alert($nik);
    //     $.ajax({
    //       url: "https://betabkol.depok.go.id/apipencaker/getPencakerByNIK",
    //       type: "POST",
    //       data: "nik="+$nik,
    //       dataType: "json",
    //       success : function(data){
    //         $("#kk").val(data.response[0].nik);
    //         $("#ak1").val(data.response[0].noak1);
    //         $("#nama").val(data.response[0].nama);
    //         jeniskelamin = "Laki-laki";
    //         if(data.response[0].jeniskelamin == "0"){
    //           jeniskelamin = "Laki-laki";
    //         }
    //         else{
    //           jeniskelamin = "Perempuan";
    //         }
    //         $("#jenis_kelamin").val(jeniskelamin);
    //         $("#email").val(data.response[0].email);
    //         $("#no_telepon").val(data.response[0].notelepon);
    //         $("#alamat").text(data.response[0].alamat);
    //         $("#kelurahan").val(data.response[0].kelurahan);
    //         $("#kecamatan").val(data.response[0].kecamatan);
    //         $("#tempat_lahir").val(data.response[0].tempatlahir);
    //         $("#tanggal_lahir").val(data.response[0].tgllahir);
    //         $("#pendidikan_terakhir").val(data.response[0].pendidikanterkahir);
    //       },
    //       error : function(e){
    //         console.log(e);
    //       },
    //     });
    // }
?>

  </script>
  <script> window.setTimeout(function() { $(".alert-success").fadeTo(200, 0).slideUp(200, function(){ $(this).remove(); }); }, 9000); </script>
  <script> window.setTimeout(function() { $(".alert-danger").fadeTo(200, 0).slideUp(200, function(){ $(this).remove(); }); }, 9000); </script>