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
                        Pengajuan
                        <small><i>Proposal</i></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li class="active"><a href="#"><i class="fa fa-gears"></i> Pengajuan</a></li>
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
                            <h3 class="box-title">Daftar Pengajuan Proposal</h3>
                            <div class="pull-right">
                                <a href="<?=base_url('index.php/Peneliti/Pengajuan/TambahRegistrasi')?>" class="btn btn-primary" id="tambah_tooltip" title="Tambah">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="users" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>No</th>
                                            <th>Judul Proposal</th>
                                            <th>Tanggal</th>
                                            <th>Biaya</th>
                                            <th>Peneliti</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1; foreach($tbProposal as $value): ?>
                                            <?php 
                                                $tbProposalBerkas = $this->Tbl_proposal_berkas->whereAnd(array('id_proposal'=>$value->id_proposal))->row();

                                                if($value->status_proposal == 0){
                                                    $status = "DRAFT";
                                                }else if($value->status_proposal == 1){
                                                    $status = "Tahap Verifikasi dan Validasi Dokumen";
                                                }else if($value->status_proposal == 2){
                                                    $status = "Diterima/Lolos";
                                                }
                                            ?>  
                                            <tr>
                                                <td>
                                                    <?php if($value->status_proposal == 0){ ?>
                                                    <div class="btn-group">
                                                      <button type="button" class="btn btn-default">Aksi</button>
                                                      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <span class="caret"></span>
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                      </button>
                                                      <ul class="dropdown-menu">
                                                        <!-- Dropdown menu links -->
                                                        <li>
                                                            <a href="<?=base_url('index.php/Peneliti/Pengajuan/EditRegistrasi/'.$value->id_proposal)?>"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit</a>
                                                        </li>
                                                        <li>
                                                            <a href="<?=base_url('index.php/Peneliti/Pengajuan/HapusRegistrasi/'.$value->id_proposal)?>" onclick="return confirm('Yakin hapus?')"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Hapus</a>
                                                        </li>
                                                        <li role="separator" class="divider"></li>
                                                        <li>
                                                            <a href="<?=base_url('index.php/Peneliti/Pengajuan/Ajukan/'.$value->id_proposal)?>"><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span> Ajukan</a>
                                                        </li>
                                                      </ul>
                                                    </div>
                                                    <?php }else if($value->status_proposal == 1){ ?>
                                                    <div class="btn-group">
                                                      <button type="button" class="btn btn-default">Aksi</button>
                                                      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <span class="caret"></span>
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                      </button>
                                                      <ul class="dropdown-menu">
                                                        <!-- Dropdown menu links -->
                                                        <li>
                                                            <a href="<?=base_url('uploads'.$tbProposalBerkas->content_proposal)?>"><span class="glyphicon glyphicon-file" aria-hidden="true"></span> Download Proposal</a>
                                                        </li>
                                                        <li>
                                                            <a href="<?=base_url('uploads'.$tbProposalBerkas->anggaran_biaya_proposal)?>"><span class="glyphicon glyphicon-file" aria-hidden="true"></span> Download RAB</a>
                                                        </li>
                                                        <li role="separator" class="divider"></li>
                                                        <li><a href="#">#</a></li>
                                                      </ul>
                                                    </div>
                                                    <?php }else if($value->status_proposal == 2){ ?>
                                                    <div class="btn-group">
                                                      <button type="button" class="btn btn-default">Aksi</button>
                                                      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <span class="caret"></span>
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                      </button>
                                                      <ul class="dropdown-menu">
                                                        <!-- Dropdown menu links -->
                                                        <li>
                                                            <a href="<?=base_url('uploads/'.$tbProposalBerkas->content_proposal)?>"><span class="glyphicon glyphicon-file" aria-hidden="true"></span> Download Proposal</a>
                                                        </li>
                                                        <li>
                                                            <a href="<?=base_url('uploads/'.$tbProposalBerkas->anggaran_biaya_proposal)?>"><span class="glyphicon glyphicon-file" aria-hidden="true"></span> Download RAB</a>
                                                        </li>
                                                        <li role="separator" class="divider"></li>
                                                        <li><a href="#">#</a></li>
                                                      </ul>
                                                    </div>
                                                    <?php } ?>
                                                </td>
                                                <td><?=$no++?></td>
                                                <td>
                                                    <strong>No. Reg : <?=$value->id_proposal?></strong>
                                                    <?=$value->judul?>
                                                </td>
                                                <td><?=$value->date_created?></td>
                                                <td><?=$value->anggaran?></td>
                                                <td>
                                                    <ul>
                                                        <?php foreach($this->Tbl_proposal_peneliti->whereAndJoin(array('id_proposal'=>$value->id_proposal))->result() as $value2) { ?>
                                                            <li><?=$value2->nama?></li>
                                                        <?php } ?>
                                                    </ul>
                                                </td>
                                                <td><?=$status?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <div class="alert alert-warning alert-dismissible" role="alert">
                                <h4>Penjelasan</h4>
                                Upload proposal terdiri dari 2 file yaitu proposal lengkap dan RAB (Rencana Anggaran dan Biaya) dalam bentuk PDF
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
