<?= $this->session->flashdata('notif');?>
<div class="row account-contant">
    <div class="col-12">
        <div class="card card-statistics">
            <div class="card-body">
                <form method="POST" action="<?= base_url('DashboardLPK/ubahPassword'); ?>" enctype="multipart/form-data">
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                    <input type="hidden" name="kode" value="">
                    <div class="tab tab-border">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show" id="profile-tab" data-toggle="tab" href="#password" role="tab" aria-controls="profile" aria-selected="true"> <i class="fa fa-key"></i> Password</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="password" role="tabpanel" aria-labelledby="password-tab">
                                <div class="form-group">
                                    <label>Password Lama</label>
                                    <input type="password" name="pwLama" value="" class="form-control" autocomplete="off" require>
                                </div>
                                <div class="form-group">
                                    <label>Password Baru</label>
                                    <input type="password" name="pwBaru" value="" class="form-control" autocomplete="off" require>
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
<script type="text/javascript">
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
          var fileName = $(this).val().split("\\").pop();
          $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
      });
  </script>