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
                        Master
                        <small><i>Proposal</i></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-gears"></i> Master</a></li>
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
                            <h3 class="box-title">Data Tabel Master Proposal</h3>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="bidangilmu" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID Proposal</th>
                                            <th>Judul</th>
                                            <th>Kluster</th>
                                            <th>Bidang Ilmu</th>
                                            <th>Peneliti</th>
                                            <th>Status Proposal</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1; foreach ($tbProposal as $value): ?>
                                        <?php
                                            $tbMasterKluster = $this->Tbl_master_kluster->whereAnd(array('id_kluster'=>$value->id_kluster))->row();
                                            $tbMasterBidangIlmu = $this->Tbl_master_bidang_ilmu->whereAnd(array('id_bidang_ilmu'=>$value->id_bidang_ilmu))->row();
                                            $tbPeneliti = $this->Tbl_peneliti->whereAnd(array('id_peneliti'=>$value->id_peneliti))->row();
                                            $tbProposalContent = $this->Tbl_proposal_content->whereAnd(array('id_proposal'=>$value->id_proposal))->row();
                                            if($value->status_proposal=="0"){
                                                $status = "DRAFT";
                                            }else if($value->status_proposal=="1"){
                                                $status = "DIKIRIM";
                                            }else if($value->status_proposal=="2"){
                                                $status = "DITERIMA";
                                            }
                                        ?>
                                        <tr>
                                            <td><?=$no++?></td>
                                            <td><?=$value->id_proposal?></td>
                                            <td><?=$tbProposalContent->judul?></td>
                                            <td><?=$tbMasterKluster->kluster?></td>
                                            <td><?=$tbMasterBidangIlmu->bidang_ilmu?></td>
                                            <td><?=$tbPeneliti->nama?></td>
                                            <td><?=$status?></td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group" aria-label="Action">
                                                    <a href="<?=base_url('index.php/Admin/Proposal/Detail/'.$value->id_proposal)?>" class="btn btn-primary">Detail</a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php $no++; endforeach ?>
                                    </tbody>
                                </table>
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
