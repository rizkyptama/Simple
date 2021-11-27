<section class="ftco-section mt-5 nomargintop">
 <div class="container">
  <h2 class="text-center text-info ftco-animate"><b>Berita / Event</b></h2>
  <br>
  <div class="row justify-content-center">
    <?php foreach ($berita as $row) { ?>
    <div class="col-md-4 d-flex ftco-animate fadeInUp ftco-animated divControl">
      <div class="blog-entry justify-content-end w-100">
        <a href="<?= base_url(); ?>Home/infoDetail" class="block-20" style="background-image: url('<?= base_url(); ?>assets/upload/berita/<?= $row->photo; ?>');">
        </a>
        <div class="text mt-3 mb-3 float-right d-block">
          <h3 class="heading"><a href="<?= base_url(); ?>Home/infoDetail/<?= $row->id; ?>"><?= $row->judul; ?></a></h3>
          <p class="text-justify"><?= $row->detail; ?></p>
          <a href="<?= base_url(); ?>Home/infoDetail/<?= $row->id; ?>" class="btn btn-info float-right">Selengkapnya</a>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
  
</div>
<div class="row justify-content-center">
  <div class="prev">prev</div>
  <div id="divPages"></div>
  <div class="next">next</div>
</div>
</div>
</section>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/home/js/pagination.js"></script>
