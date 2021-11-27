<head>
    <title><?= $title; ?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="<?= $title; ?>" />
    <meta name="author" content="Frais Mediatech" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- app favicon -->
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/home/images/icon.png">
    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <!-- plugin stylesheets -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/dashboard/css/vendors.css" />
    <!-- app style -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/dashboard/css/style.css" />
    <!-- plugins -->
    <script src="<?= base_url(); ?>assets/dashboard/js/vendors.js"></script>
    <!-- custom app -->
    <script src="<?= base_url(); ?>assets/dashboard/js/app.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script> window.setTimeout(function() { $(".alert-success").fadeTo(200, 0).slideUp(200, function(){ $(this).remove(); }); }, 2000); </script>
    <script> window.setTimeout(function() { $(".alert-danger").fadeTo(200, 0).slideUp(200, function(){ $(this).remove(); }); }, 2000); </script>
</head>

<?php 
function tanggal_indo($tanggal, $cetak_hari = false)
{
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
    $waktu = explode(' ', $split[2]);
    $tgl_indo = $waktu[0] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
    
    
    if ($cetak_hari) {
        $num = date('N', strtotime($tanggal));
        return $hari[$num] . '<br>' . $tgl_indo . ' '. $waktu[1];
    }
    return $tgl_indo;
}
?>  