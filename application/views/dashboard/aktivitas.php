<style type="text/css">
	textarea {
		resize: none;
	}
</style>
<div class="row">
	<div class="col-xl-6 col-xxl-6 col-sm-6 col-12 mb-30">
		<div class="card card-statistics h-100 mb-0">
			<div class="card-header d-flex justify-content-between">
				<div class="card-heading">
					<h4 class="card-title">Aktivitas Admin</h4>
				</div>
			</div>
			<div class="card-body">
				<ul class="activity">
					<?php
					$randomangka = 1;
					foreach ($historyAdmin as $row) { 
						if ($randomangka == '1') {
							$warna = 'info';
						} elseif ($randomangka == '2') {
							$warna = 'success';
						} elseif ($randomangka == 3) {
							$warna = 'warning';
						} elseif ($randomangka == 4) {
							$warna = 'primary';
						} elseif ($randomangka == 5) {
							$warna = 'danger';
						}
					?>
						<li class="activity-item <?= $warna; ?>">
							<div class="activity-info">
								<h5 class="mb-0"><?= $row->kode_user; ?> <span class="badge badge-success"><?= $row->waktu; ?></span></h5>
								<span>
									<?= $row->aktivitas; ?>
								</span>
								<!-- <pre> -->
								<?php if ($row->detail != NULL) { ?>
									<textarea class="form-control" id="myTextArea<?= $randomangka; ?>" onclick="prettyPrint()" readonly="" cols=50 rows=10><?= $row->detail; ?></textarea>
									<script type="text/javascript">
										function prettyPrint() {
										    var ugly = document.getElementById('myTextArea<?= $randomangka; ?>').value;
										    var obj = JSON.parse(ugly);
										    var pretty = JSON.stringify(obj, undefined, 4);
										    document.getElementById('myTextArea<?= $randomangka; ?>').value = pretty;
										}
									</script>
								<?php } ?>
								<!-- </pre>/ -->
							</div>
						</li>
					<?php 
					$randomangka = $randomangka + 1;
					} ?>
				</ul>
			</div>
		</div>
	</div>
	<div class="col-xl-6 col-xxl-6 col-sm-6 col-12 mb-30">
		<div class="card card-statistics h-100 mb-0">
			<div class="card-header d-flex justify-content-between">
				<div class="card-heading">
					<h4 class="card-title">Aktivitas User</h4>
				</div>
			</div>
			<div class="card-body">
				<ul class="activity">
					<?php
					$randomangka = 1;
					foreach ($history as $row) { 
						if ($randomangka == '1') {
							$warna = 'info';
						} elseif ($randomangka == '2') {
							$warna = 'success';
						} elseif ($randomangka == 3) {
							$warna = 'warning';
						} elseif ($randomangka == 4) {
							$warna = 'primary';
						} elseif ($randomangka == 5) {
							$warna = 'danger';
						}
					$data = $this->db->query("SELECT * FROM table_user WHERE kode_user != 'ADMIN'")->result_array();
					?>
						<li class="activity-item <?= $warna; ?>">
							<div class="activity-info">
								<h5 class="mb-0"><?= $row->kode_user; ?> <span class="badge badge-success"><?= $row->waktu; ?></span></h5>
								<span>
									<?= $row->aktivitas; ?>
								</span>
								<!-- <pre> -->
								<?php if ($row->detail != NULL) { ?>
									<textarea class="form-control" id="myTextAreaa<?= $randomangka; ?>" onclick="prettyPrint<?= $randomangka; ?>()" readonly="" cols=50 rows=10><?= $row->detail; ?></textarea>
									<script type="text/javascript">
										function prettyPrint<?= $randomangka; ?>() {
										    var ugly = document.getElementById('myTextAreaa<?= $randomangka; ?>').value;
										    var obj = JSON.parse(ugly);
										    var pretty = JSON.stringify(obj, undefined, 4);
										    document.getElementById('myTextAreaa<?= $randomangka; ?>').value = pretty;
										}
									</script>
								<?php } ?>
								<!-- </pre>/ -->
							</div>
						</li>
					<?php 
					$randomangka = $randomangka + 1;
					} ?>
				</ul>
			</div>
		</div>
	</div>
</div>