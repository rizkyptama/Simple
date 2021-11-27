<section class="ftco-section mt-5 nomargintop">
 <div class="container">
  <h2 class="text-center text-info ftco-animate"><b>LPK / BLKLN</b></h2>
  <br>
  <div class="row d-flex ftco-animate justify-content-center">
    <?php foreach ($lpk as $lpk) { ?>
      <div class="col-md-4 d-flex ftco-animate fadeInUp ftco-animated removelpk">
        <div class="blog-entry justify-content-end w-100">
          <a href="<?= base_url();?>Home/lpkDetail/<?= $lpk->kode_user; ?>" class="block-20">
            <img src="<?= base_url(); ?>assets/upload/logo/<?= $lpk->photo; ?>" style="width: 100%; height: 100%;">
          </a>
          <div class="text mt-3 mb-3 float-right d-block">
            <h3 class="heading"><a href="<?= base_url();?>Home/lpkDetail/<?= $lpk->kode_user; ?>"><?= $lpk->nama; ?></a></h3>
            <a href="<?= base_url(); ?>Home/lpkDetail/<?= $lpk->kode_user; ?>" class="btn btn-info float-right">Selengkapnya</a>
          </div>
        </div>
      </div>
    <?php } ?>
    
  </div>
  <div class="row justify-content-center">
    <?= $prev; ?>
    <div id="divPages"></div>    
    <?= $next; ?>
  </div>
</div>
</section>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/home/js/pagination.js"></script>