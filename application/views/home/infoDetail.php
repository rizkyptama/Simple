<section class="ftco-section">
  <div class="container">
    <!-- Tab panes -->
    <div class="row mt-5 nomargintop">
      <?php foreach ($detail as $detail) { ?>
      <div class="col-lg-8 col-md-7 col-sm-12 col-12">
        <img src="<?= base_url(); ?>assets/upload/berita/<?= $detail->photo; ?>" class="img-fluid">
        <br>
        <span class="badge badge-success"><?php echo date("d F Y", strtotime($detail->tanggal)); ?></span>
        <span class="badge badge-warning"><?php echo $detail->tipe; ?></span>
        <h3><b><?php echo $detail->judul; ?></b></h3>
        <p class="text-justify"><?php echo $detail->detail; ?></p>
      </div>
      <?php } ?>

      <div class="col-lg-4 col-md-5 col-sm-12 col-12">
        <h4 class="text-info"><b>Berita / Event Terbaru</b></h4>
        <?php 
        foreach ($info as $info) { ?>
        <div class="card mb-2">
          <div class="row m-1">
            <div class="col-lg-4 col-md-4 col-sm-4 col-4">
              <img src="<?= base_url(); ?>assets/upload/berita/<?= $info->photo; ?>" class="img-donatur2">
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-8">
              <h6 class="mb-0"><b><a href="<?= base_url(); ?>Home/infoDetail/<?= $info->id; ?>"><?php echo $info->judul; ?></a></b></h6>
              <small><?php echo date("d F Y", strtotime($info->tanggal)); ?></small>
            </div>
          </div>
        </div>
        <?php }?>
      </div>
    </div>
  </div>
</section>