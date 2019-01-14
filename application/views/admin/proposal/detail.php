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
        <?php
            function word_count($data){
                if(str_word_count($data) <= 0){
                    return "0 Kata";
                }else{
                    return (str_word_count($data)-2)." Kata";
                }
            }
        ?>
        <div class="wrapper">
            <?php $this->load->view('admin/header-navbar');?>
            <?php $this->load->view('admin/header-sidebar');?>
            <div class="content-wrapper">
                <section class="content-header">
                    <h1>
                        Proposal
                        <small><i>Detail</i></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-gears"></i> Proposal</a></li>
                        <li class="active"><i>Detail</i></li>
                    </ol>
                </section>
                <section class="content">
                    <?php if (!empty($this->session->flashdata('type_message'))) { ?>
                        <div class="alert alert-<?=$this->session->flashdata('type_message')?> alert-dismissible text-center" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <?=$this->session->flashdata('message');?>
                        </div>
                    <?php } ?>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Data Proposal</h3>
                                </div>
                                <div class="box-body">
                                    <table class="table">
                                        <tr>
                                            <td>No. Registrasi</td>
                                            <td> : </td>
                                            <td><?=$tbProposal->id_proposal?></td>
                                        </tr>
                                        <tr>
                                            <td>Kluster</td>
                                            <td> : </td>
                                            <td><?=$tbProposalKluster->kluster?></td>
                                        </tr>
                                        <tr>
                                            <td>Bidang Ilmu</td>
                                            <td> : </td>
                                            <td><?=$tbProposalBidangIlmu->bidang_ilmu?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Data Peneliti</h3>
                                </div>
                                <div class="box-body">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Jabatan</th>
                                            <th>Nama</th>
                                            <th>Satuan Kerja</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($tbProposalPeneliti as $value): ?>
                                        <?php
                                            $tbPeneliti = $this->Tbl_peneliti->whereAnd(array('id_peneliti' => $value->id_peneliti))->row();
                                            $tbPenelitiUsers = $this->Tbl_peneliti_users->whereAnd(array('id_peneliti'=>$tbPeneliti->id_peneliti))->row();
                                            $tbPenelitiSatker = $this->Tbl_master_satker->whereAnd(array('id_satker'=>$tbPeneliti->id_satker))->row();
                                            $tbPenelitiFungsional = $this->Tbl_master_fungsional->whereAnd(array('id_fungsional'=>$tbPeneliti->id_fungsional))->row();
                                        ?>
                                        <tr>
                                            <td><?=$value->jabatan?></td>
                                            <td><?=$tbPeneliti->nama?></td>
                                            <td><?=$tbPenelitiSatker->satker?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Data Isi/Content Proposal</h3>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="box">
                                              <div class="box-header with-border">
                                                <h3 class="box-title">I. Judul (<?=word_count($tbProposalContent->judul)?>)</h3>
                                              </div>
                                              <div class="box-body">
                                                <?php
                                                    if(!empty($tbProposalContent->judul)){
                                                        echo $tbProposalContent->judul;
                                                    }else{
                                                        echo 'Belum Diisi.';
                                                    }
                                                ?>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="box">
                                              <div class="box-header with-border">
                                                <h3 class="box-title">II. Latar Belakang (<?=word_count($tbProposalContent->latar_belakang)?>)</h3>
                                              </div>
                                              <div class="box-body">
                                                <?php
                                                    if(!empty($tbProposalContent->latar_belakang)){
                                                        echo $tbProposalContent->latar_belakang;
                                                    }else{
                                                        echo 'Belum Diisi.';
                                                    }
                                                ?>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="box">
                                              <div class="box-header with-border">
                                                <h3 class="box-title">III. Rumusan Masalah (<?=word_count($tbProposalContent->rumusan_masalah)?>)</h3>
                                              </div>
                                              <div class="box-body">
                                                <?php
                                                    if(!empty($tbProposalContent->rumusan_masalah)){
                                                        echo $tbProposalContent->rumusan_masalah;
                                                    }else{
                                                        echo 'Belum Diisi.';
                                                    }
                                                ?>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="box">
                                              <div class="box-header with-border">
                                                <h3 class="box-title">IV. Tujuan Penelitian (<?=word_count($tbProposalContent->tujuan_penelitian)?>)</h3>
                                              </div>
                                              <div class="box-body">
                                                <?php
                                                    if(!empty($tbProposalContent->tujuan_penelitian)){
                                                        echo $tbProposalContent->tujuan_penelitian;
                                                    }else{
                                                        echo 'Belum Diisi.';
                                                    }
                                                ?>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="box">
                                              <div class="box-header with-border">
                                                <h3 class="box-title">V. Kajian (Penelitian) (<?=word_count($tbProposalContent->kajian_penelitian)?>)</h3>
                                              </div>
                                              <div class="box-body">
                                                <?php
                                                    if(!empty($tbProposalContent->kajian_penelitian)){
                                                        echo $tbProposalContent->kajian_penelitian;
                                                    }else{
                                                        echo 'Belum Diisi.';
                                                    }
                                                ?>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="box">
                                              <div class="box-header with-border">
                                                <h3 class="box-title">VI. Konsep atau Teori Relevan (<?=word_count($tbProposalContent->konsep_teori)?>)</h3>
                                              </div>
                                              <div class="box-body">
                                                <?php
                                                    if(!empty($tbProposalContent->konsep_teori)){
                                                        echo $tbProposalContent->konsep_teori;
                                                    }else{
                                                        echo 'Belum Diisi.';
                                                    }
                                                ?>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="box">
                                              <div class="box-header with-border">
                                                <h3 class="box-title">VII. Metode dan Teknik Penggalian Data (<?=word_count($tbProposalContent->metode_teknik)?>)</h3>
                                              </div>
                                              <div class="box-body">
                                                <?php
                                                    if(!empty($tbProposalContent->metode_teknik)){
                                                        echo $tbProposalContent->metode_teknik;
                                                    }else{
                                                        echo 'Belum Diisi.';
                                                    }
                                                ?>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="box">
                                              <div class="box-header with-border">
                                                <h3 class="box-title">VIII. Rencana Pembahasan (<?=word_count($tbProposalContent->rencana_pembahasan)?>)</h3>
                                              </div>
                                              <div class="box-body">
                                                <?php
                                                    if(!empty($tbProposalContent->rencana_pembahasan)){
                                                        echo $tbProposalContent->rencana_pembahasan;
                                                    }else{
                                                        echo 'Belum Diisi.';
                                                    }
                                                ?>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="box">
                                              <div class="box-header with-border">
                                                <h3 class="box-title">IX. Pustaka Acuan atau Bibliografi (<?=word_count($tbProposalContent->pustaka_bibliografi)?>)</h3>
                                              </div>
                                              <div class="box-body">
                                                <?php
                                                    if(!empty($tbProposalContent->pustaka_bibliografi)){
                                                        echo $tbProposalContent->pustaka_bibliografi;
                                                    }else{
                                                        echo 'Belum Diisi.';
                                                    }
                                                ?>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Data Anggaran Proposal</h3>
                                </div>
                                <div class="box-body">
                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <td>Anggaran</td>
                                            <td>:</td>
                                            <td><?=$tbProposalAnggaran->anggaran?></td>
                                        </tr>
                                        <tr>
                                            <td>Capaian Luaran</td>
                                            <td>:</td>
                                            <td>
                                                <ol>
                                                    <?php if($tbProposalAnggaran->ipteks=="1"){ ?>
                                                        <li>Proses dan produk IPTEKS</li>
                                                    <?php } ?>
                                                    <?php if($tbProposalAnggaran->hki=="1"){ ?>
                                                        <li>HKI</li>
                                                    <?php } ?>
                                                    <?php if($tbProposalAnggaran->bahan_ajar=="1"){ ?>
                                                        <li>Bahan Ajar</li>
                                                    <?php } ?>
                                                    <?php if($tbProposalAnggaran->teknologi_tg=="1"){ ?>
                                                        <li>Teknologi Tepat Guna</li>
                                                    <?php } ?>
                                                    <?php if($tbProposalAnggaran->lap_penelitian=="1"){ ?>
                                                        <li>Laporan Penelitian</li>
                                                    <?php } ?>
                                                    <?php if($tbProposalAnggaran->jurnal=="1"){ ?>
                                                        <li>Jurnal</li>
                                                    <?php } ?>
                                                </ol>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Data Berkas Proposal</h3>
                                </div>
                                <div class="box-body">
                                    <table class="table">
                                        <tr>
                                            <td>Cover</td>
                                            <td> : </td>
                                            <td>
                                                <a class="btn btn-primary btn-flat" href="<?=base_url('uploads/'.$tbProposalBerkas->cover_proposal)?>" targer="_blank">Lihat</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Content/Isi Proposal</td>
                                            <td> : </td>
                                            <td>
                                                <a class="btn btn-primary btn-flat" href="<?=base_url('uploads/'.$tbProposalBerkas->content_proposal)?>" targer="_blank">Lihat</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>RAB / Anggaran Biaya Proposal</td>
                                            <td> : </td>
                                            <td>
                                                <a class="btn btn-primary btn-flat" href="<?=base_url('uploads/'.$tbProposalBerkas->anggaran_biaya_proposal)?>" targer="_blank">Lihat</a>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if($tbProposal->status_proposal!=2): ?>
                    <div class="row">
                        <div class="col-md-12">
                            <form method="POST" action="<?=base_url('index.php/Admin/Proposal/Terima/'.$tbProposal->id_proposal)?>">
                                <button type="submit" class="btn btn-primary btn-block btn-lg btn-flat">Terima / Loloskan</button>
                            </form>
                        </div>
                    </div>
                    <?php endif; ?>
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
