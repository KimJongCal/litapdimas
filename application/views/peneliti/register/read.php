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
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?=base_url('assets/dist/css/AdminLTE.min.css');?>">
    </head>
    <body class="hold-transition register-page">
        <div class="register-box">
          <div class="register-logo">
            <a href="<?=base_url('Auth/Login');?>"><b>LITAPDIMAS ADMIN</b></a>
          </div>

          <div class="register-box-body">
            <p class="login-box-msg">Pendaftaran</p>
            <?php if (!empty($this->session->flashdata('type_message'))) { ?>
                <div class="alert alert-<?=$this->session->flashdata('type_message')?> alert-dismissible text-center" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?=$this->session->flashdata('message');?>
                    <?php $this->session->sess_destroy(); ?>
                </div>
            <?php } ?>
            <div class="alert alert-warning alert-dismissible" role="alert">
                <p>Gunakan Email aktif, karena aktivasi akan dikirimkan melalui email.</p>
                <p>Satu email hanya dapat digunakan untuk satu akun.</p>
            </div>
            <form action="<?=base_url('index.php/Register/Add')?>" method="post">
              <div class="form-group has-feedback">
                <label>Nama Lengkap : </label>
                <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required="">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
              </div>
              <div class="form-group has-feedback">
                <label>Email : </label>
                <input type="email" name="email" class="form-control" placeholder="Email" required="">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
              </div>
              <div class="form-group has-feedback">
                <label>Password : </label>
                <input type="password" name="password" class="form-control" placeholder="Password" required="">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              </div>
              <div class="form-group has-feedback">
                <label>Ulangi Password : </label>
                <input type="password" name="password2" class="form-control" placeholder="Ulangi Password" required="">
                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
              </div>
              <div class="form-group has-feedback">
                <label>No. Handphone : </label>
                <input type="number" name="no_hp" class="form-control" placeholder="No. Handphone" required="">
                <span class="glyphicon glyphicon-card form-control-feedback"></span>
              </div>
              <div class="form-group has-feedback">
                <label>Institusi : </label>
                <select name="id_satker" class="form-control select2" required="">
                    <?php foreach($tbMSatker as $value): ?>
                        <option value="<?=$value->id_satker?>"><?=$value->satker?></option>
                    <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group has-feedback">
                    <label>Fungsional : </label>
                    <select name="fungsional" class="form-control" required="">
                      <?php foreach($tbMFungsional as $value): ?>
                        <option value="<?=$value->id_fungsional?>"><?=$value->fungsional?></option>
                      <?php endforeach; ?>
                    </select>
              </div>
              <div class="form-group has-feedback">
                    <label>Jabatan Fungsional : </label>
                    <select name="jabfung" class="form-control" required="">
                      <?php foreach($tbMJabatanFungsional as $value): ?>
                        <option value="<?=$value->id_jab_fungsional?>"><?=$value->jab_fungsional?></option>
                      <?php endforeach; ?>
                    </select>
              </div>
              <div class="form-group has-feedback">
                    <label>Pangkat / Golongan : </label>
                    <select name="gol" class="form-control" required="">
                      <?php foreach($tbMPangkat as $value): ?>
                        <option value="<?=$value->id_pangkat?>"><?=$value->pangkat_gol?></option>
                      <?php endforeach; ?>
                    </select>
              </div>
              <div class="form-group has-feedback">
                    <label>Bidang Ilmu : </label>
                    <select name="bidang_ilmu" class="form-control" required="">
                      <?php foreach($tbMBidangIlmu as $value): ?>
                        <option value="<?=$value->id_bidang_ilmu?>"><?=$value->bidang_ilmu?></option>
                      <?php endforeach; ?>
                    </select>
              </div>
              <div class="row">
                <!-- /.col -->
                <div class="col-xs-4">
                  <a href="<?=base_url('index.php/Login')?>" class="btn btn-default btn-block btn-flat">Kembali</a>
                </div>
                <div class="col-xs-4 pull-right">
                  <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                </div>
                <!-- /.col -->
              </div>
            </form>
          </div>
          <!-- /.form-box -->
        </div>
        <!-- /.register-box -->

        <!-- jQuery 2.2.3 -->
        <script src="<?=base_url('assets/plugins/jQuery/jquery-2.2.3.min.js');?>"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="<?=base_url('assets/bootstrap/js/bootstrap.min.js');?>"></script>
        <!-- Select2 -->
        <script src="<?=base_url('assets/plugins/select2/select2.full.min.js');?>"></script>
        <script type="text/javascript">
            $(function(){
                $('.select2').select2();
            });
        </script>
    </body>
</html>
