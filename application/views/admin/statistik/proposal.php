<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Admin - LITAPDIMAS</title>
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
    <body class="hold-transition skin-green sidebar-mini">
        <div class="wrapper">
            <?php $this->load->view('admin/header-navbar');?>
            <?php $this->load->view('admin/header-sidebar');?>
            <div class="content-wrapper">
                <section class="content-header">
                    <h1>
                        Statistik
                        <small><i>Proposal</i></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-gears"></i> Statistik</a></li>
                        <li class="active"><i>Proposal</i></li>
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
                            <h3 class="box-title">Statistik Proposal</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-blue-active"><i class="fa fa-file-text"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Total Proposal</span>
                                            <span class="info-box-number"><?=$num_proposal?></span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-yellow-active"><i class="fa fa-paper-plane"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">Proposal Terkirim</span>
                                            <span class="info-box-number"><?=$num_proposal_1?></span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->

                                <!-- fix for small devices only -->
                                <div class="clearfix visible-sm-block"></div>

                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-green-active"><i class="fa fa-check"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">Proposal Diterima/Lolos</span>
                                            <span class="info-box-number"><?=$num_proposal_2?></span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Statistik Proposal (Kluster)</h3>
                                </div>
                                <div class="box-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>No</th>
                                                <th>Kluster</th>
                                                <th>Jumlah</th>
                                            </tr>
                                            <?php $no = 1; foreach ($tbMKluster as $value) : ?>
                                            <tr>
                                                <td><?=$no++?></td>
                                                <td><?=$value->kluster?></td>
                                                <td><?=$kluster[$value->id_kluster]?></td>
                                            </tr>
                                            <?php $no++; endforeach; ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Statistik Proposal (Bidang Ilmu)</h3>
                                </div>
                                <div class="box-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>No</th>
                                                <th>Bidang Ilmu</th>
                                                <th>Jumlah</th>
                                            </tr>
                                            <?php $no = 1; foreach ($tbMBidangIlmu as $value) : ?>
                                            <tr>
                                                <td><?=$no++?></td>
                                                <td><?=$value->bidang_ilmu?></td>
                                                <td><?=$bidang_ilmu[$value->id_bidang_ilmu]?></td>
                                            </tr>
                                            <?php $no++; endforeach; ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <?php $this->load->view('admin/footer'); ?>
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
            $('#bidangilmu').DataTable({
              "paging": true,
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
