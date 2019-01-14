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
                                <li><a href="<?=base_url('index.php/Peneliti/Pengajuan/EditRegistrasi/'.$tbProposalContent->id_proposal)?>">Registrasi Proposal</a></li>
                                <li class="active"><a href="#">Isi Proposal</a></li>
                                <li><a style="pointer-events: none; color: black">Peneliti & Anggaran</a></li>
                                <li><a style="pointer-events: none; color: black">Upload Berkas</a></li>
                            </ul>
                            <h5>Silahkan isi form dibawah ini sesuai proposal yang akan anda ajukan.</strong></h5>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box">
                                      <div class="box-header with-border">
                                        <h3 class="box-title">I. Judul (<?=word_count($tbProposalContent->judul)?>)</h3>
                                        <div class="pull-right">
                                            <a href="#" class="btn btn-primary"  data-toggle="modal" data-target="#modalJudul" id="tambah_tooltip" title="Tambah">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </div>
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
                                        <div class="pull-right">
                                            <a href="#" class="btn btn-primary"  data-toggle="modal" data-target="#modalLatarBelakang" id="tambah_tooltip" title="Tambah">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </div>
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
                                        <div class="pull-right">
                                            <a href="#" class="btn btn-primary"  data-toggle="modal" data-target="#modalRumusanMasalah" id="tambah_tooltip" title="Tambah">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </div>
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
                                        <div class="pull-right">
                                            <a href="#" class="btn btn-primary"  data-toggle="modal" data-target="#modalTujuanPenelitian" id="tambah_tooltip" title="Tambah">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </div>
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
                                        <div class="pull-right">
                                            <a href="#" class="btn btn-primary"  data-toggle="modal" data-target="#modalKajian" id="tambah_tooltip" title="Tambah">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </div>
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
                                        <div class="pull-right">
                                            <a href="#" class="btn btn-primary"  data-toggle="modal" data-target="#modalKonsep" id="tambah_tooltip" title="Tambah">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </div>
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
                                        <div class="pull-right">
                                            <a href="#" class="btn btn-primary"  data-toggle="modal" data-target="#modalMetode" id="tambah_tooltip" title="Tambah">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </div>
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
                                        <div class="pull-right">
                                            <a href="#" class="btn btn-primary"  data-toggle="modal" data-target="#modalRencanaPembahasan" id="tambah_tooltip" title="Tambah">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </div>
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
                                        <div class="pull-right">
                                            <a href="#" class="btn btn-primary"  data-toggle="modal" data-target="#modalPustaka" id="tambah_tooltip" title="Tambah">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </div>
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
                            <br>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="pull-left">
                                        <a href="<?=base_url('index.php/Peneliti/Pengajuan/EditRegistrasi/'.$tbProposalContent->id_proposal)?>" class="btn btn-default btn-block btn-flat">Kembali</a>
                                    </div>
                                    <div class="pull-right">
                                        <?=form_open_multipart('Peneliti/Pengajuan/EditPenelitiAnggaran/'.$tbProposalContent->id_proposal)?>
                                            <button type="submit" class="btn btn-primary btn-block btn-flat">Simpan & Lanjutkan <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></button>
                                        <?=form_close()?>
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

        <!-- Judul -->
        <div class="modal fade" id="modalJudul" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Judul</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <?=form_open_multipart('Peneliti/Pengajuan/UpdateIsiJudul')?>
                    <input type="hidden" name="id" value="<?=$tbProposalContent->id_proposal?>">
                    <textarea id="editor1" name="isi" rows="10" cols="80">
                        <?=$tbProposalContent->judul?>
                    </textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                <?=form_close()?>
            </div>
          </div>
        </div>

        <!-- Latar Belakang -->
        <div class="modal fade" id="modalLatarBelakang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Latar Belakang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <?=form_open_multipart('Peneliti/Pengajuan/UpdateIsiLatarBelakang')?>
                    <input type="hidden" name="id" value="<?=$tbProposalContent->id_proposal?>">
                    <textarea id="editor2" name="isi" rows="10" cols="80">
                        <?=$tbProposalContent->latar_belakang?>
                    </textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                <?=form_close()?>
            </div>
          </div>
        </div>

        <!-- Rumusan Masalah -->
        <div class="modal fade" id="modalRumusanMasalah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Rumusan Masalah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <?=form_open_multipart('Peneliti/Pengajuan/UpdateIsiRumusanMasalah')?>
                    <input type="hidden" name="id" value="<?=$tbProposalContent->id_proposal?>">
                    <textarea id="editor3" name="isi" rows="10" cols="80">
                        <?=$tbProposalContent->rumusan_masalah?>
                    </textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                <?=form_close()?>
            </div>
          </div>
        </div>

        <!-- Tujuan Penelitian -->
        <div class="modal fade" id="modalTujuanPenelitian" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Tujuan Penelitian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <?=form_open_multipart('Peneliti/Pengajuan/UpdateIsiTujuan')?>
                    <input type="hidden" name="id" value="<?=$tbProposalContent->id_proposal?>">
                    <textarea id="editor4" name="isi" rows="10" cols="80">
                        <?=$tbProposalContent->tujuan_penelitian?>
                    </textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                <?=form_close()?>
            </div>
          </div>
        </div>

        <!-- Kajian -->
        <div class="modal fade" id="modalKajian" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Kajian (Penelitian)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <?=form_open_multipart('Peneliti/Pengajuan/UpdateIsiKajian')?>
                    <input type="hidden" name="id" value="<?=$tbProposalContent->id_proposal?>">
                    <textarea id="editor5" name="isi" rows="10" cols="80">
                        <?=$tbProposalContent->kajian_penelitian?>
                    </textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                <?=form_close()?>
            </div>
          </div>
        </div>

        <!-- Konsep / Teori -->
        <div class="modal fade" id="modalKonsep" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Konsep Atau Teori Relevan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <?=form_open_multipart('Peneliti/Pengajuan/UpdateIsiKonsep')?>
                    <input type="hidden" name="id" value="<?=$tbProposalContent->id_proposal?>">
                    <textarea id="editor6" name="isi" rows="10" cols="80">
                        <?=$tbProposalContent->konsep_teori?>
                    </textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                <?=form_close()?>
            </div>
          </div>
        </div>

        <!-- Metode dan Teknik Penggalian Data -->
        <div class="modal fade" id="modalMetode" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Metode dan Teknik Penggalian Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <?=form_open_multipart('Peneliti/Pengajuan/UpdateIsiMetode')?>
                    <input type="hidden" name="id" value="<?=$tbProposalContent->id_proposal?>">
                    <textarea id="editor7" name="isi" rows="10" cols="80">
                        <?=$tbProposalContent->metode_teknik?>
                    </textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                <?=form_close()?>
            </div>
          </div>
        </div>

        <!-- Rencana Pembahasan -->
        <div class="modal fade" id="modalRencanaPembahasan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Rencana Pembahasan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <?=form_open_multipart('Peneliti/Pengajuan/UpdateIsiRencana')?>
                    <input type="hidden" name="id" value="<?=$tbProposalContent->id_proposal?>">
                    <textarea id="editor8" name="isi" rows="10" cols="80">
                        <?=$tbProposalContent->rencana_pembahasan?>
                    </textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                <?=form_close()?>
            </div>
          </div>
        </div>

        <!-- Pustaka Acuan atau Bibliografi -->
        <div class="modal fade" id="modalPustaka" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Pustaka Acuan atau Bibliografi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <?=form_open_multipart('Peneliti/Pengajuan/UpdateIsiPustaka')?>
                    <input type="hidden" name="id" value="<?=$tbProposalContent->id_proposal?>">
                    <textarea id="editor9" name="isi" rows="10" cols="80">
                        <?=$tbProposalContent->pustaka_bibliografi?>
                    </textarea>
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
        <!-- CK Editor -->
        <script src="<?=base_url('assets/plugins/ckeditor/ckeditor.js')?>"></script>
        <!-- Select2 -->
        <script src="<?=base_url('assets/plugins/select2/select2.full.min.js');?>"></script>
        <script>
          $(function () {
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            CKEDITOR.replace('editor1')
            CKEDITOR.replace('editor2')
            CKEDITOR.replace('editor3')
            CKEDITOR.replace('editor4')
            CKEDITOR.replace('editor5')
            CKEDITOR.replace('editor6')
            CKEDITOR.replace('editor7')
            CKEDITOR.replace('editor8')
            CKEDITOR.replace('editor9')
          })
        </script>
    </body>
</html>