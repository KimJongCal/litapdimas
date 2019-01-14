<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>LP2M - LITAPDIMAS</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Icon -->
        <link href="<?=base_url('assets/images/logo.png'); ?>" rel="icon" type="image/x-icon" />
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="<?=base_url('assets/bootstrap/css/bootstrap.min.css');?>">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="<?=base_url('assets/plugins/datatables/dataTables.bootstrap.css')?>">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?=base_url('assets/dist/css/AdminLTE.min.css');?>">
        <link rel="stylesheet" href="<?=base_url('assets/dist/css/skins/skin-green.min.css');?>">
    </head>
    <body class="hold-transition skin-green layout-top-nav">
        <div class="wrapper">
            <?php $this->load->view('peneliti/header-navbar');?>
            <div class="content-wrapper">
                <div class="container">
                <section class="content-header">
                    <h1>
                        Peneliti
                        <small><i>Registrasi Penelitian Ganda</i></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li class="active"><a href="#"><i class="fa fa-gears"></i> Penelitian Ganda</a></li>
                    </ol>
                </section>
                <section class="content">
                    <?php if (!empty($this->session->flashdata('type_message'))) { ?>
                        <div class="alert alert-<?=$this->session->flashdata('type_message')?> alert-dismissible text-center" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <?=$this->session->flashdata('message');?>
                        </div>
                    <?php } ?>
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Penelitian Ganda</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>Prosedur Pengajuan</h3>
                                    <ol>
                                        <li>Mengisi form pengajuan</li>
                                        <li>Mengupload bukti pendukung (link artikel jurnal terakreditasi/internasional atau terindex I10 Googleschoolar) melalui menu <a href="<?=base_url('index.php/Peneliti/Biodata/JurnalPublikasi')?>">Jurnal/Publikasi</a></li>
                                        <li>Mendapatkan persetujuan dari Administrator atau petugas dari Kemenag Pusat</li>
                                        <li>Administrator Satker (LP2M/P3M) akan diberikan notifikasi bahwa peneliti telah disetujui</li>
                                    </ol>
                                </div>
                                <div class="col-md-6">
                                    <h3>Form Pengajuan</h3>
                                    <p>Sebelum mengusulkan penelitian ganda, pastikan semua persyaratan telah terpenuhi.</p>
                                    <div class="alert alert-warning alert-dismissible" role="alert">
                                        <h4>Informasi</h4>
                                        <p>Pengajuan anda terakhir masih menunggu persetujuan.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                </div>
            </div>
            <?php $this->load->view('peneliti/footer'); ?>
        </div>

        <!-- REQUIRED JS SCRIPTS -->
        <!-- jQuery 2.2.3 -->
        <script src="<?=base_url('assets/plugins/jQuery/jquery-2.2.3.min.js');?>"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="<?=base_url('assets/bootstrap/js/bootstrap.min.js');?>"></script>
        <!-- DataTables -->
        <script src="<?=base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
        <script src="<?=base_url('assets/plugins/datatables/dataTables.bootstrap.min.js')?>"></script>
        <!-- SlimScroll -->
        <script src="<?=base_url('assets/plugins/slimScroll/jquery.slimscroll.min.js')?>"></script>
        <!-- FastClick -->
        <script src="<?=base_url('assets/plugins/fastclick/fastclick.js')?>"></script>
        <!-- AdminLTE App -->
        <script src="<?=base_url('assets/dist/js/app.min.js');?>"></script>
        <!-- page script -->
        <script>
          $(function () {
            $('#users').DataTable({
              "paging": true,
              "responsive": true,
              "lengthChange": true,
              "searching": true,
              "ordering": true,
              "info": true,
              "autoWidth": true
            });
          });
        </script>
        <script type="text/javascript">
          $('#tambah_tooltip').tooltip();
        </script>
    </body>
</html>
