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
        <!-- Select2 -->
        <link rel="stylesheet" href="<?=base_url('assets/plugins/select2/select2.min.css')?>">
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
                        <li><a href="#"><i class="fa fa-dashboard"></i> Pengajuan</a></li>
                        <li class="active"><a href="#"></i> Tambah</a></li>
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
                            <h3 class="box-title">Dashboard</h3>
                        </div>
                        <div class="box-body" role="navigation">
                            <ul class="nav nav-tabs nav-justified">
                                <li><a href="<?=base_url('index.php/Peneliti/Pengajuan/EditRegistrasi/'.$tbProposalBerkas->id_proposal)?>">Registrasi Proposal</a></li>
                                <li><a href="<?=base_url('index.php/Peneliti/Pengajuan/EditIsi/'.$tbProposalBerkas->id_proposal)?>">Isi Proposal</a></li>
                                <li><a href="<?=base_url('index.php/Peneliti/Pengajuan/EditPenelitiAnggaran/'.$tbProposalBerkas->id_proposal)?>">Peneliti & Anggaran</a></li>
                                <li class="active"><a href="#">Upload Berkas</a></li>
                            </ul>
                            <br>
                            <p>Silahkan isi form peneliti dan anggaran.</p>
                            <p>Personel dalam penelitian ini Maksimal orang</p>

                            <?=form_open_multipart('Peneliti/Pengajuan/UpdateBerkasCover/'.$tbProposalBerkas->id_proposal)?>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="cover">File Cover Proposal</label>
                                        <input type="file" required="" class="form-control-file" name="cover" id="cover">
                                    </div>
                                    <span class="label label-warning">Format file dalam bentuk pdf.</span>
                                </div>
                                <div class="col-md-1">
                                    <div class="pull-left">
                                        <button type="submit" class="btn btn-primary btn-block btn-flat"><span class="glyphicon glyphicon-upload"></span> Upload</button>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="pull-left">
                                        <?php if(!empty($tbProposalBerkas->cover_proposal)){ ?>
                                            <div class="alert alert-success alert-dismissible text-center" role="alert">
                                                <span class="glyphicon glyphicon-ok"></span> Berkas sudah terupload
                                            </div>
                                        <?php }else{ ?>
                                            <div class="alert alert-danger alert-dismissible text-center" role="alert">
                                                <span class="glyphicon glyphicon-remove"></span> Berkas belum terupload
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <?=form_close()?>
                            <br>
                            <?=form_open_multipart('Peneliti/Pengajuan/UpdateBerkasIsi/'.$tbProposalBerkas->id_proposal)?>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="isi">File Isi Proposal (Tanpa Identitas)</label>
                                        <input type="file" required="" class="form-control-file" name="isi" id="isi">
                                    </div>
                                    <span class="label label-warning">Format file dalam bentuk pdf.</span>
                                </div>
                                <div class="col-md-1">
                                    <div class="pull-left">
                                        <button type="submit" class="btn btn-primary btn-block btn-flat"><span class="glyphicon glyphicon-upload"></span> Upload</button>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="pull-left">
                                        <?php if(!empty($tbProposalBerkas->content_proposal)){ ?>
                                            <div class="alert alert-success alert-dismissible text-center" role="alert">
                                                <span class="glyphicon glyphicon-ok"></span> Berkas sudah terupload
                                            </div>
                                        <?php }else{ ?>
                                            <div class="alert alert-danger alert-dismissible text-center" role="alert">
                                                <span class="glyphicon glyphicon-remove"></span> Berkas belum terupload
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <?=form_close()?>
                            <br>
                            <?=form_open_multipart('Peneliti/Pengajuan/UpdateBerkasAnggaran/'.$tbProposalBerkas->id_proposal)?>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="anggaran">File Anggaran dan Biaya</label>
                                        <input type="file" required="" class="form-control-file" name="anggaran_biaya" id="anggaran">
                                    </div>
                                    <span class="label label-warning">Format file dalam bentuk pdf.</span>
                                </div>
                                <div class="col-md-1">
                                    <div class="pull-left">
                                        <button type="submit" class="btn btn-primary btn-block btn-flat"><span class="glyphicon glyphicon-upload"></span> Upload</button>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="pull-left">
                                        <?php if(!empty($tbProposalBerkas->anggaran_biaya_proposal)){ ?>
                                            <div class="alert alert-success alert-dismissible text-center" role="alert">
                                                <span class="glyphicon glyphicon-ok"></span> Berkas sudah terupload
                                            </div>
                                        <?php }else{ ?>
                                            <div class="alert alert-danger alert-dismissible text-center" role="alert">
                                                <span class="glyphicon glyphicon-remove"></span> Berkas belum terupload
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <?=form_close()?>
                            <br>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <?=form_open_multipart('Peneliti/Pengajuan/EditPenelitiAnggaran/'.$tbProposalBerkas->id_proposal)?>
                                    <div class="pull-left">
                                        <button type="submit" class="btn btn-default btn-block btn-flat">Kembali</button>
                                    </div>
                                    <?=form_close()?>
                                    <?=form_open_multipart('Peneliti/Pengajuan/')?>
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary btn-block btn-flat">Selesai <span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>
                                    </div>
                                    <?=form_close()?>
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
        <!-- AdminLTE App -->
        <script src="<?=base_url('assets/dist/js/app.min.js');?>"></script>
        <!-- Select2 -->
        <script src="<?=base_url('assets/plugins/select2/select2.full.min.js');?>"></script>
        <script type="text/javascript">
            $(function(){
                $('.select2').select2();
            });
        </script>
    </body>
</html>