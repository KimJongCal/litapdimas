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
                                <li><a href="<?=base_url('index.php/Peneliti/Pengajuan/EditRegistrasi/'.$tbProposalAnggaran->id_proposal)?>">Registrasi Proposal</a></li>
                                <li><a href="<?=base_url('index.php/Peneliti/Pengajuan/EditIsi/'.$tbProposalAnggaran->id_proposal)?>">Isi Proposal</a></li>
                                <li class="active"><a href="#">Peneliti & Anggaran</a></li>
                                <li><a style="pointer-events: none; color: black">Upload Berkas</a></li>
                            </ul>
                            <h5>Silahkan isi form peneliti dan anggaran.</strong></h5>
                            <h3>I. Peneliti</h3>
                            <a href="#" data-toggle="modal" data-target="#modalTambahPeneliti" class="btn btn-primary">Tambah Peneliti</a>
                            <br>
                            <br>
                            <div class="table-responsive">
                                <table id="peneliti" class="table table-bordered table-striped">
                                    <tr>
                                        <th>Jabatan</th>
                                        <th>Nama Peneliti</th>
                                        <th>ID Peneliti</th>
                                        <th>Satker</th>
                                        <th>Aksi</th>
                                    </tr>
                                    <?php foreach($tbProposalPeneliti as $value): ?>
                                    <tr>
                                        <td><?=$value->jabatan_proposal?></td>
                                        <td><?=$value->nama?></td>
                                        <td><?=$value->id_peneliti?></td>
                                        <td><?=$value->satker?></td>
                                        <td>
                                            <a href="<?=base_url('index.php/Peneliti/Pengajuan/HapusPeneliti/'.$value->id_proposal_peneliti.'/'.$value->id_proposal)?>" onclick="return confirm('Yakin hapus?')" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Hapus</a>
                                        </td>   
                                    </tr>
                                    <?php endforeach; ?>
                                </table>
                            </div>
                            <h3>II. Anggaran</h3>
                            <?=form_open_multipart('Peneliti/Pengajuan/UpdateAnggaran/'.$tbProposalAnggaran->id_proposal)?>
                            <div class="row">
                                <div class="col-md-6">
                                    <p>Anggaran Yang diajukan (Rp.)</p>
                                    <div class="form-group">
                                        <input type="number" name="anggaran" class="form-control" value="<?=$tbProposalAnggaran->anggaran?>">
                                    </div>
                                    <p><i>Jangan menggunakan tanda baca contoh : <strong>50000000</strong></i></p>
                                </div>
                                <div class="col-md-6">
                                    <p>Standart Biaya</p>
                                    <p>Rp. 0 s/d Rp. 0</p>
                                </div>
                            </div>
                            <h3>III. Luaran</h3>
                            <p>Capaian Luaran</p>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" name="ipteks" value="1" id="ipteks" <?php if($tbProposalAnggaran->ipteks=="1"){ echo 'checked'; } ?>>
                                      <label class="form-check-label" for="ipteks">
                                        Proses dan produk IPTEKS
                                      </label>
                                    </div>
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" name="hki" value="1" id="hki" <?php if($tbProposalAnggaran->hki=="1"){ echo 'checked'; } ?>>
                                      <label class="form-check-label" for="hki">
                                        HKI
                                      </label>
                                    </div>
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" name="bahan_ajar" value="1" id="bahan_ajar" <?php if($tbProposalAnggaran->bahan_ajar=="1"){ echo 'checked'; } ?>>
                                      <label class="form-check-label" for="bahan_ajar">
                                        Bahan Ajar
                                      </label>
                                    </div>
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" name="teknologi_tg" value="1" id="teknologi_tg" <?php if($tbProposalAnggaran->teknologi_tg=="1"){ echo 'checked'; } ?>>
                                      <label class="form-check-label" for="teknologi_tg">
                                        Teknologi Tepat Guna
                                      </label>
                                    </div>
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" name="lap_penelitian" value="1" id="lap_penelitian" <?php if($tbProposalAnggaran->lap_penelitian=="1"){ echo 'checked'; } ?>>
                                      <label class="form-check-label" for="lap_penelitian">
                                        Laporan Penelitian
                                      </label>
                                    </div>
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" name="jurnal" value="1" id="jurnal" <?php if($tbProposalAnggaran->jurnal=="1"){ echo 'checked'; } ?>>
                                      <label class="form-check-label" for="jurnal">
                                        Jurnal
                                      </label>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="pull-left">
                                        <a href="<?=base_url('index.php/Peneliti/Pengajuan/EditIsi/'.$tbProposalAnggaran->id_proposal)?>" class="btn btn-default btn-block btn-flat">Kembali</a>
                                    </div>
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary btn-block btn-flat">Simpan & Lanjutkan <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></button>
                                    </div>
                                </div>
                            </div>
                            <?=form_close()?>
                        </div>
                    </div>
                </section>
                </div>
            </div>
            <?php $this->load->view('peneliti/footer'); ?>
        </div>

        <!-- Tambah Peneliti -->
        <div class="modal fade" id="modalTambahPeneliti" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Peneliti</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <?=form_open_multipart('Peneliti/Pengajuan/TambahPeneliti')?>
                    <input type="hidden" value="<?=$tbProposalAnggaran->id_proposal?>" name="id_proposal">
                    <div class="form-group">
                        <label>Peneliti</label>
                        <select name="peneliti" class="form-control select2" style="width: 100%;" required="">
                            <option selected="selected">Pilih Peneliti</option>
                            <?php foreach($tbPeneliti as $value): ?>
                                <option value="<?=$value->id_peneliti?>"><?=$value->nama?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                <?=form_close()?>
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
        <!-- Select2 -->
        <script src="<?=base_url('assets/plugins/select2/select2.full.min.js');?>"></script>
        <script type="text/javascript">
            $(function(){
                $('.select2').select2();
            });
        </script>
    </body>
</html>