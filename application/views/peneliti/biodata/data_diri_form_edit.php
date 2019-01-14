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
                                        <div class="col-md-12 col-md-offset-7 col-sm-3 col-xs-12 profile-badge">
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
                                <div class="col-md-7 col-md-offset-2 col-sm-3 col-xs-12">
                                    <ul class="nav nav-tabs nav-justified">
                                      <li role="presentation"><a href="<?=base_url('index.php/Peneliti/Biodata/')?>">Akun</a></li>
                                      <li role="presentation" class="active"><a href="<?=base_url('index.php/Peneliti/Biodata/Datadiri')?>">Biodata</a></li>
                                      <li role="presentation"><a href="<?=base_url('index.php/Peneliti/Biodata/Pendidikan')?>">Pendidikan</a></li>
                                      <li role="presentation"><a href="<?=base_url('index.php/Peneliti/Biodata/Berkas')?>">Berkas</a></li>
                                      <li role="presentation"><a href="<?=base_url('index.php/Peneliti/Biodata/JurnalPublikasi')?>">Jurnal/Publikasi</a></li>
                                      <li role="presentation"><a href="<?=base_url('index.php/Peneliti/Biodata/Buku')?>">Buku</a></li>
                                    </ul>
                                    <center><h3>Data Diri</h3></center>
                                    <br>
                                    <form method="POST" action="<?=base_url('index.php/Peneliti/Biodata/UpdateDatadiri/')?>" class="form-horizontal">
                                        <input type="hidden" value="<?=$this->session->userdata('id_peneliti')?>" name="id_peneliti">
                                        <div class="form-group">
                                            <label for="fungsional" class="col-sm-3 control-label">Fungsional</label>
                                            <div class="col-sm-9">
                                              <select name="fungsional" class="form-control">
                                                  <?php foreach($tbMFungsional as $value): ?>
                                                    <option value="<?=$value->id_fungsional?>" <?php if($value->id_fungsional==$tbPeneliti->id_fungsional){ echo 'selected'; } ?>><?=$value->fungsional?></option>
                                                  <?php endforeach; ?>
                                              </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="nidn" class="col-sm-3 control-label">NIDN / NIP</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="nidn" class="form-control" id="nidn" placeholder="NIDN" value="<?=$tbPeneliti->nidn?>">
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="text" name="nip" class="form-control" id="nip" placeholder="NIP" value="<?=$tbPeneliti->nip?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"></label>
                                            <div class="col-sm-9">
                                                Dosen wajib mencantumkan NIDN dengan benar sesuai dengan data yang ada pada http://forlap.ristekdikti.go.id dan NIDN sudah terdaftar pada database Litapdimas. Untuk melihat dan meregistrasikan NIDN anda silahkan masuk kedalam menu Info - NIDN. 
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Nama Lengkap</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="nama" class="form-control" placeholder="Nama" value="<?=$tbPeneliti->nama?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Tempat/Tgl Lahir</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="tempat" class="form-control" placeholder="tempat" value="<?=$tbPeneliti->tempat?>">
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="date" name="tgl_lhr" class="form-control" placeholder="" value="<?=$tbPeneliti->tgl_lhr?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Alamat</label>
                                            <div class="col-sm-9">
                                                <textarea name="alamat" class="form-control"><?=$tbPeneliti->alamat?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="fungsional" class="col-sm-3 control-label">Satker</label>
                                            <div class="col-sm-9">
                                              <select name="satker" class="form-control">
                                                  <?php foreach($tbMSatker as $value): ?>
                                                    <option value="<?=$value->id_satker?>" <?php if($value->id_satker==$tbPeneliti->id_satker){ echo 'selected'; } ?>><?=$value->satker?></option>
                                                  <?php endforeach; ?>
                                              </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Jabatan</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="jabatan" class="form-control" placeholder="jabatan" value="<?=$tbPeneliti->jabatan?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Pangkat/Gol</label>
                                            <div class="col-sm-3">
                                                <select name="gol" class="form-control">
                                                  <?php foreach($tbMPangkat as $value): ?>
                                                    <option value="<?=$value->id_pangkat?>" <?php if($value->id_pangkat==$tbPeneliti->id_pangkat){ echo 'selected'; } ?>><?=$value->pangkat_gol?></option>
                                                  <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <label class="col-sm-3 control-label">Jab. Fung.</label>
                                            <div class="col-sm-3">
                                                <select name="jabfung" class="form-control">
                                                  <?php foreach($tbMJabatanFungsional as $value): ?>
                                                    <option value="<?=$value->id_jab_fungsional?>" <?php if($value->id_jab_fungsional==$tbPeneliti->id_jab_fungsional){ echo 'selected'; } ?>><?=$value->jab_fungsional?></option>
                                                  <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Email</label>
                                            <div class="col-sm-3">
                                                <input type="email" name="email" class="form-control" placeholder="email" value="<?=$tbPeneliti->email?>">
                                            </div>
                                            <label class="col-sm-3 control-label">No. HP</label>
                                            <div class="col-sm-3">
                                                <input type="number" name="no_hp" class="form-control" placeholder="no hp" value="<?=$tbPeneliti->hp?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="bidang_ilmu" class="col-sm-3 control-label">Bidang Ilmu</label>
                                            <div class="col-sm-9">
                                              <select name="bidang_ilmu" class="form-control">
                                                  <?php foreach($tbMBidangIlmu as $value): ?>
                                                    <option value="<?=$value->id_bidang_ilmu?>" <?php if($value->id_bidang_ilmu==$tbPeneliti->id_bidang_ilmu){ echo 'selected'; } ?>><?=$value->bidang_ilmu?></option>
                                                  <?php endforeach; ?>
                                              </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"></label>
                                            <div class="col-sm-9">
                                                <div class="pull-right">
                                                    <button type="submit" class="btn btn-primary btn-block btn-flat">Simpan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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

    </body>
</html>
