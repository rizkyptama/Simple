<section class="ftco-section mt-5 nomargintop">
 <div class="container">
  <h2 class="text-center text-info ftco-animate"><b>Jadwal Pelatihan</b></h2>
  <br>
  <div class="row d-flex ftco-animate justify-content-center">
    <?php foreach ($pelatihan as $row) { ?>
    <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3 divControl">
      <div class="card">
        <div class="card-body">
          <a href="<?= base_url(); ?>Home/pelatihanDetail/<?= $row->kode_pelatihan; ?>"><h5 class="text-info"><?= $row->nama;?></h5></a>
          <?php
          $date = date('Y-m-d');
          if ($date > $row->tanggal_berakhir_daftar) { ?>
          <span class="badge badge-danger">Expired</span>
          <?php } ?>
          <span class="badge badge-success"><?= $row->standar_kompetensi;?></span>
          <p><?= $row->keterangan;?></p>
          <a href="<?= base_url(); ?>Home/pelatihanDetail/<?= $row->kode_pelatihan; ?>" class="btn btn-info float-right">Selengkapnya</a>
        </div>
      </div>
    </div>
    <?php } ?>    
  </div>
  <div class="row justify-content-center">
    <div class="prev">prev</div>
    <div id="divPages"></div>
    <div class="next">next</div>
  </div>
</div>
</section>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/home/js/pagination.js"></script>
