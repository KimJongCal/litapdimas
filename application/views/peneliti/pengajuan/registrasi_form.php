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
                                <li class="active"><a href="#">Registrasi Proposal</a></li>
                                <li><a style="pointer-events: none; color: black">Isi Proposal</a></li>
                                <li><a style="pointer-events: none; color: black">Peneliti & Anggaran</a></li>
                                <li><a style="pointer-events: none; color: black">Upload Berkas</a></li>
                            </ul>
                            <h5>Silahkan isi form dibawah ini untuk mendapatkan <strong>Nomor Registrasi Proposal</strong></h5>
                            <form method="POST" action="<?=base_url('index.php/Peneliti/Pengajuan/AddRegistrasi')?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kluster</label>
                                            <select name="kluster" required="" class="form-control select2" style="width: 100%;">
                                                <?php foreach($tbMKluster as $value): ?>
                                                    <option value="<?=$value->id_kluster?>"><?=$value->kluster?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Bidang Ilmu</label>
                                            <select name="bidang_ilmu" class="form-control select2" style="width: 100%;" required="">
                                                <?php foreach($tbMBidangIlmu as $value): ?>
                                                    <option value="<?=$value->id_bidang_ilmu?>"><?=$value->bidang_ilmu?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="pull-left">
                                            <a href="<?=base_url('index.php/Peneliti/Pengajuan/')?>" class="btn btn-default btn-block btn-flat">Tutup</a>
                                        </div>
                                        <div class="pull-right">
                                            <button type="submit" class="btn btn-primary btn-block btn-flat">Simpan & Lanjutkan <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
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