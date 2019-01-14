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
        <!-- Theme style -->
        <link rel="stylesheet" href="<?=base_url('assets/dist/css/AdminLTE.min.css');?>">
        <link rel="stylesheet" href="<?=base_url('assets/dist/css/skins/skin-green.min.css');?>">

        <style type="text/css">
            .profile-badge{
                border:1px solid #c1c1c1;
                padding:5px;
                position: relative;
            }
            .profile-badge img{
                height: 200px;
                width: 100%;
            }
            .user-detail{
                background-color: #fff;
                position: relative;
                padding:65px 0px 10px 0px;
                color:#8B8B89;
            }
            .user-detail h3, h4{
                margin: 0px;
                margin:0px 0px 5px 0px;
                color: #000;
            }
            .user-detail p{
                font-size:14px;
            }
            .user-detail .btn{
                margin-bottom:10px;
                background-color: #fff;
                border:1px solid #DEDEDE;
                border-radius: 0px;
                color:black;
            }
            .user-detail .btn i{
                color:#D35B4D;
                padding-right:18px;
            }
            .profile-pic{
                position: absolute;
                height:120px;
                width:120px;
                left: 50%;
                transform: translateX(-50%);
                top: 140px;
                z-index: 1001;
            }
            .profile-pic img{
                height: 100%;
                width: 100%;
                border-radius: 50%;
                box-shadow: 0px 0px 5px 0px #c1c1c1;
            }
            .hover-detail{
                background-color: #fff;
                border:1px solid #7C7C7C;
                position: absolute;
                width: 200px;
                box-shadow: 0px 0px 6px 0px #7C7C7C; 
                display:none;
                top: 145px;
                left: 50%;
                transform: translateX(-50%);
            }
            .hover-detail:hover,
            .user-detail .btn:hover ~ .hover-detail{
                display: block;
            }
            .checkbox label{
                text-align: left;
                width: 100%;
            }
            .Following label{
                padding-bottom: 5px;
                border-bottom:1px solid #c2c2c2;
            }
            .checkbox label span{
                float:right;
            }
            .hover-detail{
                padding:5px;
            }
        </style>
    </head>
    <body class="hold-transition skin-green layout-top-nav">
        <div class="wrapper">
            <?php $this->load->view('peneliti/header-navbar');?>
            <div class="content-wrapper">
                <div class="container">
                <section class="content-header">
                    <h1>Dashboard</h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
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
                        <div class="box-body">
                            <h3 class="text-center"><u>Biodata Member</u></h3>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="row">
                                        <div class="col-md-12 col-md-offset-7 col-sm-6 col-xs-12 profile-badge">
                                            <img src="<?=base_url('assets/images/bg.jpg')?>">
                                            <div class="profile-pic">
                                                <img src="<?=base_url('assets/images/profile-empty.png')?>">
                                            </div>
                                            <div class="user-detail text-center">
                                              <h3><?=$tbPeneliti->nama?></h3>
                                              <h4><?=$tbPSatker->satker?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7 col-md-offset-2 col-sm-6 col-xs-12">
                                    <ul class="nav nav-tabs nav-justified">
                                      <li role="presentation"><a href="<?=base_url('index.php/Peneliti/Biodata/')?>">Akun</a></li>
                                      <li role="presentation"><a href="<?=base_url('index.php/Peneliti/Biodata/Datadiri')?>">Biodata</a></li>
                                      <li role="presentation"><a href="<?=base_url('index.php/Peneliti/Biodata/Pendidikan')?>">Pendidikan</a></li>
                                      <li role="presentation"><a href="<?=base_url('index.php/Peneliti/Biodata/Berkas')?>">Berkas</a></li>
                                      <li role="presentation"><a href="<?=base_url('index.php/Peneliti/Biodata/JurnalPublikasi')?>">Jurnal/Publikasi</a></li>
                                      <li role="presentation" class="active"><a href="<?=base_url('index.php/Peneliti/Biodata/Buku')?>">Buku</a></li>
                                    </ul>
                                    <center><h3>Buku</h3></center>
                                    <br>
                                    <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bs-example-modal-sm"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
                                    <br>
                                    <br>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <tr>
                                                <th>No.</th>
                                                <th>Judul</th>
                                                <th>Penerbit</th>
                                                <th>ISBN</th>
                                                <th>Tahun</th>
                                                <th>Aksi</th>
                                            </tr>
                                            <?php if(!empty($tbPenelitiBuku)): ?>
                                            <?php $no=1; foreach($tbPenelitiBuku as $value): ?>
                                                <tr>
                                                    <td><?=$no++?></td>
                                                    <td><?=$value->judul?></td>
                                                    <td><?=$value->penerbit?></td>
                                                    <td><?=$value->isbn?></td>
                                                    <td><?=$value->tahun?></td>
                                                    <td>
                                                        <a class="btn btn-danger" href="<?=base_url('index.php/Peneliti/Biodata/HapusBuku/'.$value->id_peneliti_buku)?>" onclick="return confirm('Yakin hapus?')"><span class="glyphicon glyphicon-remove"></span> Hapus</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            <?php endif; ?>
                                        </table>
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

        <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah Buku</h4>
              </div>
              <div class="modal-body">
                <form method="POST" action="<?=base_url('index.php/Peneliti/Biodata/TambahBuku')?>" class="form-horizontal" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Judul Buku</label>
                        <div class="col-sm-10">
                            <input type="text" name="judul" class="form-control" placeholder="Judul Buku">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Penerbit</label>
                        <div class="col-sm-10">
                            <input type="text" name="penerbit" class="form-control" placeholder="Penerbit">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">ISBN</label>
                        <div class="col-sm-10">
                            <input type="text" name="isbn" class="form-control" placeholder="ISBN">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Tahun</label>
                        <div class="col-sm-10">
                            <input type="number" name="tahun" class="form-control" placeholder="Tahun">
                        </div>
                    </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Tambah & Simpan</button>
              </div>
                </form>
            </div>
          </div>
        </div>

        <!-- REQUIRED JS SCRIPTS -->
        <!-- jQuery 2.2.3 -->
        <script src="<?=base_url('assets/plugins/jQuery/jquery-2.2.3.min.js');?>"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="<?=base_url('assets/bootstrap/js/bootstrap.min.js');?>"></script>
        <!-- AdminLTE App -->
        <script src="<?=base_url('assets/dist/js/app.min.js');?>"></script>

    </body>
</html>
