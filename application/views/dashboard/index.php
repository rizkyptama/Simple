<?= $this->session->flashdata('notif');?>
<div class="row">
    <div class="col-md-12">
        <div class="alert border-0 alert-success bg-gradient m-b-30 alert-dismissible fade show border-radius-none" role="alert">
            <strong>Selamat Datang !</strong> Pelatihan Kota Depok
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <i class="ti ti-close"></i>
            </button>
        </div>
    </div>
</div>
<!-- end row -->
<!-- begin row -->
<div class="row">
    <div class="col-sm-12">
        <div class="card card-statistics">
            <div class="row no-gutters">
                <div class="col-xxl-3 col-lg-3 bg-primary">
                    <div class="p-20">
                        <div class="d-flex m-b-10">
                            <p class="mb-0 font-regular font-weight-bold text-white">Total LPK</p>
                        </div>
                        <div class="d-block d-sm-flex h-100 align-items-center">
                            <div class="statistics mt-3 text-center">
                                <h3 class="mb-0 text-white"><i class="icon-arrow-up-circle"></i><?= $jumlahLPK[0]['total']; ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-lg-3 bg-info">
                    <div class="p-20">
                        <div class="d-flex m-b-10">
                            <p class="mb-0 font-regular text-white font-weight-bold">Total BLKLN</p>
                        </div>
                        <div class="d-block d-sm-flex h-100 align-items-center">
                            <div class="statistics mt-3 text-center">
                                <h3 class="mb-0 text-white"><i class="icon-arrow-up-circle"></i><?= $jumlahBLKLN[0]['total']; ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-lg-3 bg-warning">
                    <div class="p-20">
                        <div class="d-flex m-b-10">
                            <p class="mb-0 font-regular text-white font-weight-bold">Total Kegiatan</p>
                        </div>
                        <div class="d-block d-sm-flex h-100 align-items-center">
                            <div class="statistics mt-3 text-center">
                                <h3 class="mb-0 text-white"><i class="icon-arrow-up-circle"></i><?= $jumlahKegiatan[0]['total']; ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-lg-3 bg-success">
                    <div class="p-20">
                        <div class="d-flex m-b-10">
                            <p class="mb-0 font-regular text-white font-weight-bold">Total Peserta</p>
                        </div>
                        <div class="d-block d-sm-flex h-100 align-items-center">
                            <div class="statistics mt-3 text-center">
                                <h3 class="mb-0 text-white"><i class="icon-arrow-up-circle"></i><?= $jumlahPeserta ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <!-- <div class="col-lg-12">
        <div class="card card-statistics">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div class="card-heading">
                    <h4 class="card-title">Kegiatan Terbaru</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="datatable-wrapper table-responsive">
                    <table id="datatable" class="display compact table table-striped table-hover text-center">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Kegiatan</th>
                                <th>Tanggal</th>
                                <th>Total Peserta</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td><span class="badge badge-primary">61</span></td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Garrett Winters</td>
                                <td>Accountant</td>
                                <td>Tokyo</td>
                                <td><span class="badge badge-primary">61</span></td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Ashton Cox</td>
                                <td>Junior Technical Author</td>
                                <td>San Francisco</td>
                                <td><span class="badge badge-primary">61</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> -->
</div>
<!-- end container-fluid